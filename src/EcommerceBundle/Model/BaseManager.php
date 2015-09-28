<?php

namespace EcommerceBundle\Model;

use Doctrine\ORM\EntityManager;

abstract class BaseManager
{
    protected $em;
    
    protected $entity;

    public function __construct(EntityManager $em, $entity)
    {
        $this->em = $em;
        $this->entity = $entity;
    }
    
    /**
     * Gets the repository of the entity.
     *
     */
    public function getRepository()
    {
        return $this->em->getRepository($this->entity);
    }
    
    /**
     * Creates a new instance of the entity.
     *
     */
    public function create() 
    {
        $entity = new $this->entity();
        return $entity;
    }

    /**
     * Save the entity.
     *
     * @param object $entity
     */
    public function save($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }
    
    /**
     * Load the instance with the associated id.
     *
     * @param integer $id
     */
    public function load($id)
    {
        return $this->getRepository()->find($id);
    }
    
    /**
     * Load all instances.
     *
     */
    public function loadAll() 
    {
        return $this->getRepository()->findAll();
    }
}
