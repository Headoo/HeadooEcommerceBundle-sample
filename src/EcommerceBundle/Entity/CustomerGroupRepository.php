<?php

namespace EcommerceBundle\Entity;

/**
 * CustomerGroupRepository
 *
 */
class CustomerGroupRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Create a query builder with customer groups to use on EcommerceBundle/Form/RegistrationFormType
     *
     * @return QueryBuilder
     */
    public function getCustomerGroups()
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('c')
            ->from('HeadooEcommerceBundle:CustomerGroup', 'c')
            ->where('r.name = :event')
            ->orWhere('r.name = :instore')
            ->setParameter('event', 'regular_event')
            ->setParameter('instore', 'regular_instore');
    }
}
