<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

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
        $builder->add('firstName', 'text');
        $builder->add('lastName', 'text');
        $builder->add('address', 'textarea');
        $builder->add('zipCode', 'text');
        $builder->add('city', 'text');
        $builder->add('country', 'country', array('placeholder' => 'Choose an option'));
        $builder->add('customerGroup', 'entity', array(
            'class'         =>  $this->customerGroupEntity,
            'data_class'    =>  $this->customerGroupEntity,
            'choice_label'  =>  'name',
            'expanded'      =>  true,
            'multiple'      =>  false,
            'required'      =>  true,
            'label'         =>  'I\'m interested in'
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
