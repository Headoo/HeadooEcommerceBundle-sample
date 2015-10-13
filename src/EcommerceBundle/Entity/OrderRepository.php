<?php

namespace EcommerceBundle\Entity;

/**
 * OrderRepository
 *
 */
class OrderRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Find the current non concluded order of the user that is connected (if there is already one). 
     *
     * Stripe: the order concluded has a paymentDate, a paymentMethod and the paymentDetails.
     * Offline: the order concluded has a paymentMethod and the paymentDetails. However, it is not yet paid so the paymentDate is empty.
     *
     * @return object or null
     */
    public function findOrderForConnectedUser($userId)
    {    
        return $this->getEntityManager()->createQueryBuilder()
                    ->select('o')
                    ->from('HeadooEcommerceBundle:Order', 'o')
                    ->where('o.user =' . $userId)
                    ->andWhere('o.paymentDetails is null')
                    ->getQuery()
                    ->getOneOrNullResult();
    }
    
}

