<?php

namespace F1soft\DoctrineExtensions\Paginate;

use Doctrine\ORM\Query;

class Paginate
{
    static public function count(Query $query)
    {
        /* @var $countQuery Query */
        $countQuery = clone $query;

        $countQuery->setHint(Query::HINT_CUSTOM_TREE_WALKERS, array('F1soft\DoctrineExtensions\Paginate\CountSqlWalker'));
        $countQuery->setFirstResult(null)->setMaxResults(null);

        return $countQuery->getSingleScalarResult();
    }
}