<?php

namespace EcommerceBundle\Entity;

/**
 * ConfirmationEmailRepository
 *
 */
class ConfirmationEmailRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Find the confirmation emails that are not yet sent. 
     *
     * @return object or null
     */
    public function findBySentDate()
    {   
        $qb = $this->getEntityManager()->createQueryBuilder();
        
        return $qb ->select('c')
                    ->from('EcommerceBundle\Entity\ConfirmationEmail','c')
                    ->where($qb->expr()->lte('c.sendAt', ':date'))
                    ->andwhere('c.sentAt is NULL')
                    ->setParameter('date', date("Y-m-d H:i:s"))
                    ->orderBy('c.id', 'asc')
                    ->getQuery()
                    ->getResult();
    }
}
