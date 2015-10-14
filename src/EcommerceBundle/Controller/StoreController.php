<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Store controller.
 *
 */
class StoreController extends Controller
{   
    /**
     * Displays the buying interface.
     *
     * @Template()
     */
    public function buyAction()
    {
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $user               = $this->get('security.token_storage')->getToken()->getUser();
        $services           = $this->get('hecommerce.service.manager')->loadByCustomerGroupAndPriceCurrency($user->getCustomerGroup(), $user->getPriceCurrency());
        $order              = $this->get('hecommerce.order.manager')->loadOrderForConnectedUser();

        if ($order) {
            $total          = $order->getTotalPaymentDue();
        } else {
            $total          = 0;
        }
        
        $quantity = $this->getNumberOfOrderedItems($order);
    
        return array(
            'services'          => $services,
            'quantity'          => $quantity,
            'total'             => $total,
            'user'              => $user
        );
    }
    
    /**
     * Gets the ordered items.
     *
     */
    public function cartAction(Request $request)
    {
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $serviceId          = $request->attributes->get('id');
        $quantity           = $request->request->get('service-' . $serviceId);

        $service            = $this->get('hecommerce.service.manager')->load($serviceId);
        $order              = $this->get('hecommerce.order.manager')->create();

        $this->createOrderedItem($service, $order, $quantity);
     
        $this->saveOrderedItemsPrice($order);
        
        return $this->redirect($this->generateUrl('hecommerce_store_buy'));
    }
    
    /**
     * Displays the ordered items added to the cart.
     *
     * @Template()
     */
    public function summaryAction()
    {     
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $order              = $this->get('hecommerce.order.manager')->loadOrderForConnectedUser();
        $orderedItems       = $this->get('hecommerce.ordereditem.manager')->loadByOrder($order);

        $userMessage        = $this->verifyUserDetails();

        if ($order) {
            $deleteForm     = $this->container->get('hecommerce.handler.controller')->createDeleteEntityForm($order->getId(), 'order');
        } else {
            $deleteForm     = null;
        }
        
        return array(
            'order'         => $order,
            'orderedItems'  => $orderedItems,
            'userMessage'   => $userMessage,
            'delete_form'   => $deleteForm->createView()
        );
    }
    
    /**
     * Displays the payment methods.
     *
     * @Template()
     */
    public function paymentAction()
    {
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $order              = $this->get('hecommerce.order.manager')->loadOrderForConnectedUser();
        $paymentMethods     = $this->get('hecommerce.paymentmethod.manager')->loadAll();
        
        return array(
            'order'             => $order,
            'paymentMethods'    => $paymentMethods
        );
    }
    
    /**
     * Creates an ordered item.
     *
     */
    private function createOrderedItem($service, $order, $quantity)
    {
        $orderedItemManager     = $this->get('hecommerce.ordereditem.manager');
        $currentOrder           = $orderedItemManager->loadByServiceAndOrder($service, $order);
        
        if ($currentOrder) {
            $orderedItem        = $currentOrder;
            $currentQuantity    = $orderedItem->getQuantity();
            $newQuantity        = $currentQuantity + $quantity;
            $orderedItem->setQuantity($newQuantity);
        } else {
            $orderedItem        = $orderedItemManager->create();
            $orderedItem->setService($service);
            $orderedItem->setOrder($order);
            $orderedItem->setQuantity($quantity);
        }
        
        $orderedItemManager->save($orderedItem);
    }
    
    /**
     * Gets the number of ordered items in an order.
     *
     */
    public function getNumberOfOrderedItems($order)
    {
        $orderedItems           = $this->get('hecommerce.ordereditem.manager')->loadByOrder($order);
        $orderedItemsQuantity   = [];
        foreach ($orderedItems as $item) {
            $orderedItemsQuantity[] = $item->getQuantity();
        }
        
        return array_sum($orderedItemsQuantity);
    }
    
    /**
     * Save the addition of the ordered items prices to the order.
     *
     */
    public function saveOrderedItemsPrice($order)
    {
        $orderedItems               = $this->get('hecommerce.ordereditem.manager')->loadByOrder($order);
        $orderedItemsPrice          = [];
        foreach ($orderedItems as $item) {
            $price                  = $item->getService()->getPrice();
            $quantity               = $item->getQuantity();
            $orderedItemsPrice[]    = $quantity * $price;
        }
          
        $order->setTotalPaymentDue(array_sum($orderedItemsPrice));
        $this->get('hecommerce.order.manager')->save($order);
    }
    
    /**
     * Verify if any of the main user details are absent.
     *
     */
    public function verifyUserDetails()
    {
        $user                       = $this->get('security.token_storage')->getToken()->getUser();
        $userDetails = [
                        'firstName' => $user->getFirstName(),
                        'lastName'  => $user->getLastName(),
                        'address'   => $user->getAddress(),
                        'zipCode'   => $user->getZipCode(),
                        'city'      => $user->getCity(),
                        'country'   => $user->getCountry(),
                        ];
                        
        foreach ($userDetails as $detail) {
            if ($detail == NULL) {
                return $userMessage = $this->get('translator')->trans('hecommerce.store.userdetails', array(), 'store');
            }
        }
    }

}
