<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/*
 * This file overrides FOSUserBundle ProfileFormType
 */
class ProfileType extends AbstractType
{
    private $customerGroupEntity;

    public function __construct($customerGroupEntity){
        $this->$customerGroupEntity = $customerGroupEntity;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName');
        $builder->add('lastName');
        $builder->add('address');
        $builder->add('zipCode');
        $builder->add('city');
        $builder->add('country');
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
        return 'hecommerce_user_profile';
    }
}
