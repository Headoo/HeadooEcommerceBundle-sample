<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Generic controller.
 *
 */
class GenericController extends Controller
{
    protected $entity;

    protected $entityParameter;

    protected $folderName;

    protected $entityName;

    public function __construct($entityParameter, $folderName)
    {
        $this->entityParameter  = $entityParameter;
        $this->folderName       = $folderName;
        $this->entityName       = strtolower($this->folderName);
    }

    protected function getEntity()
    {
        $this->entity = $this->container->getParameter($this->entityParameter);
        return $this->entity;
    }

    /**
     * Lists all entities.
     *
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository($this->getEntity())->findAll();

        return array(
            'entities'      => $entities,
            'entityName'    => $this->entityName
        );
    }

    /**
     * Creates a new entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = $this->getEntity();
        $entity = new $entity;
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('hecommerce_management_' . $this->entityName . '_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create an entity.
     *
     * @param $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    protected function createCreateForm($entity)
    {
        $submitTranslation = $this->get('translator')->trans('hecommerce.management.ok', array(), 'management');

        $form = $this->createForm('hecommerce_' . $this->entityName . '_form', $entity, array(
            'action' => $this->generateUrl('hecommerce_management_' . $this->entityName . '_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => $submitTranslation));

        return $form;
    }

    /**
     * Displays a form to create a new entity.
     *
     */
    public function newAction(Request $request)
    {
        $entity= $this->getEntity();
        $entity = new $entity;
        $form   = $this->createCreateForm($entity);

        return $this->render('HeadooEcommerceBundle:' . $this->folderName . ':actions.html.twig',
            array(
                'entity'        => $entity,
                'form'          => $form->createView(),
                'entityName'    => $this->entityName
            )
        );
    }

    /**
     * Finds and displays an entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository($this->getEntity())->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find the entity.');
        }

        $deleteForm = $this->container->get('hecommerce.handler.controller')->createDeleteEntityForm($id, $this->entityName);

        return $this->render('HeadooEcommerceBundle:' . $this->folderName . ':actions.html.twig',
            array(
                'entity'        => $entity,
                'delete_form'   => $deleteForm->createView(),
                'entityName'    => $this->entityName
            )
        );
    }

    /**
     * Displays a form to edit an existing entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository($this->getEntity())->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->container->get('hecommerce.handler.controller')->createDeleteEntityForm($id, $this->entityName);

        return $this->render('HeadooEcommerceBundle:' . $this->folderName . ':actions.html.twig',
            array(
                'entity'        => $entity,
                'edit_form'     => $editForm->createView(),
                'delete_form'   => $deleteForm->createView(),
                'entityName'    => $this->entityName
            )
        );
    }

    /**
     * Creates a form to edit an entity.
     *
     * @param $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm($entity)
    {
        $submitTranslation = $this->get('translator')->trans('hecommerce.management.ok', array(), 'management');

        $form = $this->createForm('hecommerce_' . $this->entityName . '_form', $entity, array(
            'action' => $this->generateUrl('hecommerce_management_' . $this->entityName . '_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => $submitTranslation));

        return $form;
    }

    /**
     * Edits an existing entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository($this->getEntity())->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find the entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('hecommerce_management_' . $this->entityName . '_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes an entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $this->container->get('hecommerce.handler.controller')->deleteEntity($request, $id, $this->getEntity(), $this->entityName);

        return $this->redirect($this->generateUrl('hecommerce_management_' . $this->entityName));
    }
}
