<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServiceRangeType extends AbstractType
{
    protected $serviceRangeClass;
	
	public function __construct ($serviceRangeClass)
	{
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
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->serviceRangeClass
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'headoo_ecommercebundle_servicerange';
    }
}
