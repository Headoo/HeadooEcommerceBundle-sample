<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerGroupType extends AbstractType
{
	protected $customerGroupEntity;
	protected $priceCurrencyEntity;
	
	public function __construct ($customerGroupEntity, $priceCurrencyEntity)
	{
	    $this->customerGroupEntity = $customerGroupEntity;
	    $this->priceCurrencyEntity = $priceCurrencyEntity;
	}

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'hecommerce.management.name'))
            ->add('priceCurrency', 'entity', array(
                'class' => $this->priceCurrencyEntity,
                'property' => 'code',
                'label' => 'hecommerce.pricecurrency.sing'
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->customerGroupEntity,
            'translation_domain' => 'management'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hecommerce_customergroup_form';
    }
}
