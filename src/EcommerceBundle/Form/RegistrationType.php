<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/*
 * This file overrides FOSUserBundle RegistrationFormType
 */
class RegistrationType extends AbstractType
{
    private $customerGroupEntity;

    public function __construct($customerGroupEntity){
        $this->customerGroupEntity = $customerGroupEntity;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', 'text', array('label' => 'hecommerce.management.firstname'));
        $builder->add('lastName', 'text', array('label' => 'hecommerce.management.name'));
        $builder->add('address', 'text', array('label' => 'hecommerce.management.address'));
        $builder->add('zipCode', 'text', array('label' => 'hecommerce.management.zipcode'));
        $builder->add('city', 'text', array('label' => 'hecommerce.management.city'));
        $builder->add('country', 'text', array('label' => 'hecommerce.management.country'));
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
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'hecommerce_user_registration';
    }
}
