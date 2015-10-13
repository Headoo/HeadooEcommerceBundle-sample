<?php

namespace EcommerceBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Listener responsible to add information to the user during the registration
 */
class FosRegistrationListener implements EventSubscriberInterface
{
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegisteringUserSuccess',
        );
    }
    public function onRegisteringUserSuccess(FormEvent $event)
    {
        if ($event->getRequest()->attributes->get('_locale')) {
            $userLanguage = $event->getRequest()->attributes->get('_locale');
        } else {
            // if no explicit locale has been set on this request, use the preferred language the user chose for his browser
            $userLanguage = $event->getRequest()->getPreferredLanguage();
        }

        $event->getForm()->getData()->setLanguage($userLanguage);
    }
}
