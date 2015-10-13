<?php

namespace EcommerceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('headoo_ecommerce');

        $rootNode
            ->children()
            	->arrayNode('customergroup')
					->children()
						->scalarNode('entity')
							->defaultValue('EcommerceBundle\Entity\CustomerGroup')
						->end()
					->end()
				->end()
				->arrayNode('service')
					->children()
						->scalarNode('entity')
							->defaultValue('EcommerceBundle\Entity\Service')
						->end()
					->end()
				->end()
				->arrayNode('servicerange')
					->children()
						->scalarNode('entity')
							->defaultValue('EcommerceBundle\Entity\ServiceRange')
						->end()
					->end()
				->end()
				->arrayNode('pricecurrency')
					->children()
						->scalarNode('entity')
							->defaultValue('EcommerceBundle\Entity\PriceCurrency')
						->end()
					->end()
				->end()
				->arrayNode('paymentmethod')
					->children()
						->scalarNode('entity')
							->defaultValue('EcommerceBundle\Entity\PaymentMethod')
						->end()
					->end()
				->end()
				->arrayNode('ordereditem')
					->children()
						->scalarNode('entity')
							->defaultValue('EcommerceBundle\Entity\OrderedItem')
						->end()
					->end()
				->end()
				->arrayNode('order')
					->children()
						->scalarNode('entity')
							->defaultValue('EcommerceBundle\Entity\Order')
						->end()
					->end()
				->end()
				->arrayNode('confirmationemail')
					->children()
						->scalarNode('entity')
							->defaultValue('EcommerceBundle\Entity\ConfirmationEmail')
						->end()
					->end()
				->end()
				->arrayNode('breadcrumb')
					->children()
						->scalarNode('home')
							->defaultValue('')
						->end()
					->end()
				->end()
				->arrayNode('store')
					->children()
						->scalarNode('email_sender')
							->defaultValue('')
						->end()
					->end()
				->end()
			->end();   
        
        return $treeBuilder;
    }
}
