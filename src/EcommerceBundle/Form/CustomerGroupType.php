<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CustomerGroupType extends AbstractType
{
	protected $customerGroupClass;
	protected $priceCurrencyClass;
	
	public function __construct ($customerGroupClass, $priceCurrencyClass)
	{
	    $this->customerGroupClass = $customerGroupClass;
	    $this->priceCurrencyClass = $priceCurrencyClass;
	}

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('priceCurrency', 'entity', array(
                'class' => $this->priceCurrencyClass,
                'property' => 'code'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->customerGroupClass
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'headoo_ecommercebundle_customergroup';
    }
}
