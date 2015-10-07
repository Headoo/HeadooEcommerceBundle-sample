<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Controller\GenericController;

/**
 * Service controller.
 *
 */
class ServiceController extends GenericController
{
    public function __construct()
    {
        parent::__construct('headoo_ecommerce.service.entity', 'service');
    }

    /**
     * Creates a new entity.
     *
     * @Template()
     */
    public function createAction(Request $request)
    {
        $entity = $this->getEntity();
        $entity = new $entity;
        $form = GenericController::createCreateForm($entity);
        $form->handleRequest($request);
        //todo: get languages parameters and display on twig 

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('hecommerce_' . $this->entityName . '_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
}
