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

                $body = $this->getContainer()->get('templating')->render('HeadooEcommerceBundle:Store:confirmationEmail.html.twig', array('order' => $order, 'orderedItems' => $orderedItems));
                
                $swiftMailer = $this->getContainer()->get('mailer');
                $swiftMessage = \Swift_Message::newInstance();
                $swiftMessage->setSubject("Headoo - Votre commande " . $order->getId())
                            ->setFrom('ana@headoo.com')
                            ->setTo($order->getUser()->getEmail())
                            ->setContentType('text/html')
                            ->addPart($body, 'text/html');
                $swiftMailer->send($swiftMessage);

                $email->setSentAt();
                
            } catch (\Exception $e) {
                /* Something as failed in the line. I manage my priorities : I persist, I flush and then…
                   I can throw the exception (and not catch it so it will be managed by my main monolog handler, see config files).
                   I do not continue my loop because I'm not in a hurry and the other lines will be taken care of 
                   when this command will be relaunched by the cron and maybe, this will give me enough time to do something */
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
