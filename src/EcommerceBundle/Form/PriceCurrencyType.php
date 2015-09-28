<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PriceCurrencyType extends AbstractType
{
	protected $priceCurrencyClass;
	
	public function __construct ($priceCurrencyClass)
	{
	    $this->priceCurrencyClass = $priceCurrencyClass;
	}

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', 'currency')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->priceCurrencyClass
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'headoo_ecommercebundle_pricecurrency';
    }
}
