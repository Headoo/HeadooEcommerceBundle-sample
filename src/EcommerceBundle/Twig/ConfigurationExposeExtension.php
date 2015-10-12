<?php

namespace EcommerceBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ConfigurationExposeExtension extends \Twig_Extension
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getGlobals()
    {
        return array(
            'homePath' => $this->container->getParameter('headoo_ecommerce.breadcrumb.home')
        );
    }

    public function getName()
    {
        return 'configuration_expose_extension';
    }
}