<?php

namespace Omkom\SiteBundle\Entity;

use Doctrine\ORM\EntityRepository;
// use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
// use Doctrine\ORM\Query;
// use Omkom\SiteBundle\Entity\Page;
// use Closure;

/**
 * PageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PageRepository extends EntityRepository
{
    public function findByViewcount($limit)
    {
        $query = $this->getEntityManager()->createQuery("
                    SELECT p FROM {$this->_entityName} p
                    ORDER BY p.viewcount DESC");
                      
        $query->setMaxResults($limit);
        $query->setFirstResult(0);
        $results = new Paginator($query, $fetchJoin = true);
        return $results;
    }

}
