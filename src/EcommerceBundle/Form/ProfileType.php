<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/*
 * This file overrides FOSUserBundle ProfileFormType
 */
class ProfileType extends AbstractType
{
    private $customerGroupEntity;

    private $priceCurrencyEntity;

    public function __construct($customerGroupEntity, $priceCurrencyEntity){
        $this->customerGroupEntity = $customerGroupEntity;
        $this->priceCurrencyEntity = $priceCurrencyEntity;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', 'text', array('label' => 'hecommerce.management.firstname'));
        $builder->add('lastName', 'text', array('label' => 'hecommerce.management.name'));
        $builder->add('address', 'text', array('label' => 'hecommerce.management.address'));
        $builder->add('zipCode', 'text', array('label' => 'hecommerce.management.zipcode'));
        $builder->add('city', 'text', array('label' => 'hecommerce.management.city'));
        $builder->add('country', 'country', array('label' => 'hecommerce.management.country'));
        $builder->add('language', 'language', array('label' => 'hecommerce.management.language'));
        $builder->add('priceCurrency', 'entity', array(
            'class'         =>  $this->priceCurrencyEntity,
            'data_class'    =>  $this->priceCurrencyEntity,
            'choice_label'  =>  'code',
            'expanded'      =>  false,
            'multiple'      =>  false,
            'required'      =>  true,
            'label'         =>  'hecommerce.pricecurrency.sing'
        ));
        $builder->add('customerGroup', 'entity', array(
            'class'         =>  $this->customerGroupEntity,
            'data_class'    =>  $this->customerGroupEntity,
            'choice_label'  =>  'name',
            'expanded'      =>  true,
            'multiple'      =>  false,
            'required'      =>  true,
            'label'         =>  'hecommerce.management.interestedin'
        ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'management'
        ));
    }

    public function getParent()
    {
        return 'fos_user_profile';
    }

    public function getName()
    {
        return 'hecommerce_user_profile';
    }
}
