<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
	protected $customerGroupEntity;
	protected $serviceEntity;
	protected $serviceRangeEntity;
	
	public function __construct ($customerGroupEntity, $serviceEntity, $serviceRangeEntity)
	{
	    $this->customerGroupEntity = $customerGroupEntity;
	    $this->serviceEntity = $serviceEntity;
	    $this->serviceRangeEntity = $serviceRangeEntity;
	}

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('translations', 'a2lix_translations', array(
                'label' => ' ',
                'fields'    => array(
                    'name'   => array(
                        'field_type' => 'text',
                        'label' => 'hecommerce.management.name'
                    ),
                    'description'   => array(
                        'field_type' => 'textarea',
                        'label' => 'hecommerce.management.description',
                    )
                )
            ))
            ->add('price', 'integer', array('label' => 'hecommerce.management.price'))
            ->add('customerGroup', 'entity', array(
                'class' => $this->customerGroupEntity,
                'property' => 'name',
                'label' => 'hecommerce.customergroup.sing'
            ))
            ->add('serviceRange', 'entity', array(
                'class' => $this->serviceRangeEntity,
                'property' => 'name',
                'label' => 'hecommerce.servicerange.sing'
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->serviceEntity,
            'translation_domain' => 'management'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hecommerce_service_form';
    }
}
