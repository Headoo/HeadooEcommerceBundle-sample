<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PaymentMethodType extends AbstractType
{
	protected $paymentMethodClass;
	
	public function __construct ($paymentMethodClass)
	{
	    $this->paymentMethodClass = $paymentMethodClass;
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
            'data_class' => $this->paymentMethodClass
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'headoo_ecommercebundle_paymentmethod';
    }
}
