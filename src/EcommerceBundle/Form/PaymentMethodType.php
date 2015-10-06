<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentMethodType extends AbstractType
{
	protected $paymentMethodEntity;
	
	public function __construct ($paymentMethodEntity)
	{
	    $this->paymentMethodEntity = $paymentMethodEntity;
	}

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'hecommerce.management.name'))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->paymentMethodEntity,
            'translation_domain' => 'management'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hecommerce_paymentmethod_form';
    }
}
