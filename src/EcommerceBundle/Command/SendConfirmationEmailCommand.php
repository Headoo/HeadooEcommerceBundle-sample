<?php

namespace EcommerceBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SendConfirmationEmailCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('hecommerce:confirmationemail:send')
            ->setDescription('Send an email to confirm the payment')
            ->setHelp(<<<EOT
The <info>hecommerce:confirmationemail:send</info> command send an email to the user to confirm his payment.

  <info>php app/console hecommerce:confirmationemail:send</info>
EOT
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {   
        $output->writeln("<info>************ BEGIN - Sending an email to the users to confirm their payment *****************</info>");
        $em = $this->getContainer()->get('doctrine')->getManager();        
                    
        $emails = $this->getContainer()->get('hecommerce.confirmationemail.manager')->loadBySentDate();
                    
        foreach ($emails as $email) {
            try {  
                $order = $email->getOrder();             
                $orderedItems = $this->getContainer()->get('hecommerce.ordereditem.manager')->loadByOrder($order);

                $locale = $order->getUser()->getLanguage();
                $translator = $this->getContainer()->get('translator');
                $translator->setLocale($locale);
                $emailSubject = $translator->trans('hecommerce.store.mailsubject', array(), 'store');
                $emailTemplate = (empty('HeadooEcommerceBundle:Store:confirmationEmail.' . $locale . '.html.twig')) ?: 'HeadooEcommerceBundle:Store:confirmationEmail.en_US.html.twig';
                $emailSender = $this->getContainer()->getParameter('headoo_ecommerce.store.email_sender');
                $body = $this->getContainer()->get('templating')->render($emailTemplate, array('order' => $order, 'orderedItems' => $orderedItems));
                
                $swiftMailer = $this->getContainer()->get('mailer');
                $swiftMessage = \Swift_Message::newInstance();
                $swiftMessage->setSubject($emailSubject . " " . $order->getId())
                            ->setFrom($emailSender)
                            ->setTo($order->getUser()->getEmail())
                            ->setContentType('text/html')
                            ->addPart($body, 'text/html');
                $swiftMailer->send($swiftMessage);

                $email->setSentAt();
                
            } catch (\Exception $e) {
                $em->persist($email);
                $em->flush();
                throw $e;
            }
            $em->persist($email);
        }         
        $em->flush();
        
        $output->writeln("<info>************** END - " . count($emails) . " email(s) were sent *****************</info>");
    }
}
