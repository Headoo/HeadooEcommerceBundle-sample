<?php

namespace EcommerceBundle\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Translation\DataCollectorTranslator;
use Symfony\Component\Form\FormFactory;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class ControllerHandler
{
    private $em;

    private $translator;

    private $formFactory;

    private $router;

    public function __construct(EntityManager $em, DataCollectorTranslator $translator, FormFactory $formFactory, Router $router)
    {
        $this->em           = $em;
        $this->translator   = $translator;
        $this->formFactory  = $formFactory;
        $this->router       = $router;
    }

    public function deleteEntity($request, $id, $entityClass, $entityName)
    {
        $form = $this->createDeleteEntityForm($id, $entityName);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity = $this->em->getRepository($entityClass)->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find the entity.');
            }

            $this->em->remove($entity);
            $this->em->flush();
        }
    }

    public function createDeleteEntityForm($id, $entityName)
    {
        $submitTranslation = $this->translator->trans('hecommerce.management.delete', array(), 'management');

        return $this->formFactory->createBuilder('form', null, array())
            ->setAction($this->router->generate('hecommerce_management_' . $entityName . '_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => $submitTranslation))
            ->getForm()
        ;
    }
}
