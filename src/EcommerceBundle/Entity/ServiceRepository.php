<?php

namespace EcommerceBundle\Entity;

/**
 * ServiceRepository
 *
 */
class ServiceRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Load the services related to a customer group and the price currency of the user.
     *
     * @return object or null
     */
    public function findByCustomerGroupAndPriceCurrency($customerGroup, $priceCurrency)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb ->select('s')
            ->from('EcommerceBundle\Entity\Service','s')
            ->where('s.customerGroup.id =' . $customerGroup->getId())
            ->andwhere('s.priceCurrency.id =' . $priceCurrency->getId())
            ->getQuery()
            ->getResult();
    }
}
