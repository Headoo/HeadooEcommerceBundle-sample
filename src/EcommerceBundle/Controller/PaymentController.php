<?php

namespace EcommerceBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Payum\Core\Request\GetHumanStatus;
use Symfony\Component\HttpFoundation\Request;
use \Exception;

/**
 * Payment controller
 * Created to be used with Payum Bundle
 *
 */
class PaymentController extends Controller
{    
    
    /**
     * Stripe Payment
     */  
    public function prepareStripeAction(Request $request)
    {
        $gatewayName = 'stripe';

        $storage = $this->get('payum')->getStorage('EcommerceBundle\Entity\Payment');
        
        $order = $this->get('hecommerce.order.manager')->loadOrderForConnectedUser();
        
        $payment = $storage->create();
        $payment->setNumber($order->getId());
        $payment->setCurrencyCode($order->getUser()->getPriceCurrency()->getCode());
        $payment->setTotalAmount($order->getTotalPaymentDue() * 100); // 123 = 1.23 EUR
        $payment->setDescription('Headoo Picture Marketing');
        $payment->setClientId($order->getUser()->getId());
        $payment->setClientEmail($order->getUser()->getEmail());
        
        $storage->update($payment);

        $captureToken = $this->get('payum.security.token_factory')->createCaptureToken(
            $gatewayName,
            $payment,
            'hecommerce_payment_done_stripe' // the route to redirect after capture;
        );

        return $this->redirect($captureToken->getTargetUrl());
    }
    
    /**
     * Stripe Payment done
     */   
    public function doneStripeAction(Request $request)
    {
        $token = $this->get('payum.security.http_request_verifier')->verify($request);

        $gateway = $this->get('payum')->getGateway($token->getGatewayName());

        // you can invalidate the token. The url could not be requested any more.
        // $this->get('payum.security.http_request_verifier')->invalidate($token);

        // Once you have token you can get the model from the storage directly. 
        $identity = $token->getDetails();
        $payment = $this->get('payum')->getStorage($identity->getClass())->find($identity);
        
        //$gateway->execute($status = new GetHumanStatus($token));
        //$payment = $status->getFirstModel();
        
        $orderManager = $this->get('hecommerce.order.manager');
        $order = $orderManager->loadOrderForConnectedUser();
        $paymentMethod = $this->get('hecommerce.paymentmethod.manager')->loadByName('stripe');
        
        //$gateway->execute($status = new GetHumanStatus($token));
        //var_dump($status->getValue());exit; --> captured
        
        if ($payment->getDetails()['status'] == 'paid')
        {
            $order->setPaymentDate(new \DateTime());
            $order->setPaymentMethod($paymentMethod);
            $order->setPaymentDetails($payment);
            $orderManager->save($order);
            
            try {               
                $confirmationEmailManager = $this->get('hecommerce.confirmationemail.manager');
                $confirmationEmail = $confirmationEmailManager->create();
                $confirmationEmail->setOrder($order);
                $confirmationEmail->setSendAt();
                $confirmationEmailManager->save($confirmationEmail);
            
                throw new Exception('Some Error Message');
            } catch (\Exception $e) {
                //send an email to the admin
                //var_dump($e->getMessage());
            }

            return $this->render(
                'HeadooEcommerceBundle:Store:confirmation.html.twig'
            );            
        } else {
            return $this->render(
                'HeadooEcommerceBundle:Store:fail.html.twig'
            ); 
        }       
        
        // or Payum can fetch the model for you while executing a request (Preferred).
        //$gateway->execute($status = new GetHumanStatus($token));
        //$payment = $status->getFirstModel();

        // you have order and payment status 
        // so you can do whatever you want for example you can just print status and payment details.

        /*return new JsonResponse(array(
            'status' => $status->getValue(),
            'payment' => array(
                'total_amount' => $payment->getTotalAmount(),
                'currency_code' => $payment->getCurrencyCode(),
                'details' => $payment->getDetails(),
            ),
        ));*/
    }
    
    /**
     * Offline Payment
     */   
    public function prepareOfflineAction()
    {
        $gatewayName = 'offline';

        $storage = $this->get('payum')->getStorage('EcommerceBundle\Entity\Payment');

        $order = $this->get('hecommerce.order.manager')->loadOrderForConnectedUser();
        
        $payment = $storage->create();
        $payment->setNumber($order->getId());
        $payment->setCurrencyCode($order->getUser()->getPriceCurrency()->getCode());
        $payment->setTotalAmount($order->getTotalPaymentDue() * 100); // 123 = 1.23 EUR
        $payment->setDescription('Headoo Picture Marketing');
        $payment->setClientId($order->getUser()->getId());
        $payment->setClientEmail($order->getUser()->getEmail());

        $storage->update($payment);

        $captureToken = $this->get('payum.security.token_factory')->createCaptureToken(
            $gatewayName, 
            $payment, 
            'hecommerce_payment_done_offline' // the route to redirect after capture
        );

        return $this->redirect($captureToken->getTargetUrl());    
    }

    
    /**
     * Offline Payment done
     */   
    public function doneOfflineAction(Request $request)
    {
        $token = $this->get('payum.security.http_request_verifier')->verify($request);

        $gateway = $this->get('payum')->getGateway($token->getGatewayName());

        // you can invalidate the token. The url could not be requested any more.
        // $this->get('payum.security.http_request_verifier')->invalidate($token);

        // Once you have token you can get the model from the storage directly. 
        $identity = $token->getDetails();
        $payment = $this->get('payum')->getStorage($identity->getClass())->find($identity);
        
        // or Payum can fetch the model for you while executing a request (Preferred).
        $gateway->execute($status = new GetHumanStatus($token));
        
        $orderManager = $this->get('hecommerce.order.manager');
        $order = $orderManager->loadOrderForConnectedUser();
        $paymentMethod = $this->get('hecommerce.paymentmethod.manager')->loadByName('offline');
        //$payment = $status->getFirstModel();

        if ($status->getValue() == 'captured')
        {
            //$order->setPaymentDate(new \DateTime());
            $order->setPaymentMethod($paymentMethod);
            $order->setPaymentDetails($payment);
            $orderManager->save($order);
            
            try {               
                $confirmationEmailManager = $this->get('hecommerce.confirmationemail.manager');
                $confirmationEmail = $confirmationEmailManager->create();
                $confirmationEmail->setOrder($order);
                $confirmationEmail->setSendAt();
                $confirmationEmailManager->save($confirmationEmail);
            
                throw new Exception('Some Error Message');
            } catch (\Exception $e) {
                //send an email to the admin
                //var_dump($e->getMessage());
            }
            
            return $this->render(
                'HeadooEcommerceBundle:Store:confirmation.html.twig'
            );            
        } else {
            return $this->render(
                'HeadooEcommerceBundle:Store:fail.html.twig'
            ); 
        }    
    }
    
}
