<?php

namespace EcommerceBundle\Entity;

/**
 * OrderedItemRepository
 *
 */
class OrderedItemRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Find the ordered item that is part of a specific invoice and related to a specific service (if there is already one). 
     *
     * @return object or null
     */
    public function findByServiceAndOrder($service, $order)
    {    
        return $this->getEntityManager()->createQueryBuilder()
                    ->select('o')
                    ->from('HeadooEcommerceBundle:OrderedItem', 'o')
                    ->where('o.service =' . $service)
                    ->andWhere('o.order =' . $order)
                    ->getQuery()
                    ->getOneOrNullResult();
    }

}
