<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServiceType extends AbstractType
{
	protected $customerGroupClass;
	protected $serviceClass;
	protected $serviceRangeClass;
	
	public function __construct ($customerGroupClass, $serviceClass, $serviceRangeClass)
	{
	    $this->customerGroupClass = $customerGroupClass;
	    $this->serviceClass = $serviceClass;
	    $this->serviceRangeClass = $serviceRangeClass;
	}

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('customerGroup', 'entity', array(
                'class' => $this->customerGroupClass,
                'property' => 'name'
            ))
            ->add('serviceRange', 'entity', array(
                'class' => $this->serviceRangeClass,
                'property' => 'name'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->serviceClass
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'headoo_ecommercebundle_service';
    }
}
