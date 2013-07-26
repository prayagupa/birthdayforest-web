<?php
namespace models\repository;
use Doctrine\ORM\Tools\Pagination\Paginator;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
/**
 *
 * UserRepository
 * @author prayag
 * @created 12 Oct 2012
 */

class UserRepository extends EntityRepository{
	/**
	 * search a user by username
	 */
      public function findByUsername($username){
	      $queryBuilder = $this->_em->createQueryBuilder();
	      $queryBuilder->select('u')
              ->from('models\User','u')							                                                                      ->where("u.username='$username'");
	      return $queryBuilder->getQuery()->getResult();
      }
}
