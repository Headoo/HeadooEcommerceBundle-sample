<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PriceCurrencyType extends AbstractType
{
	protected $priceCurrencyEntity;
	
	public function __construct ($priceCurrencyEntity)
	{
	    $this->priceCurrencyEntity = $priceCurrencyEntity;
	}

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', 'currency', array('label' => 'hecommerce.management.code'))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->priceCurrencyEntity,
            'translation_domain' => 'management'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hecommerce_pricecurrency_form';
    }
}
