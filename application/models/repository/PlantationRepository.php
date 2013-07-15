<?php
namespace models\repository;
use models\constants\PlantationStatus;

use Doctrine\ORM\Tools\Pagination\Paginator;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
/**
 *
 * PlantationRepository
 * @author prayag
 * @created 12 Oct 2012
 */

class PlantationRepository extends EntityRepository{
	function getJustPaidPlantationById($plantationCode){
		$plantationStatus = PlantationStatus::PENDING;
		$queryBuilder = $this->_em->createQueryBuilder();

		$queryBuilder->select('p')
					 ->from('models\Plantation','p')
					 ->where("p.id='$plantationCode'")
					 ->andWhere("p.status='$plantationStatus'");

		return $queryBuilder->getQuery()->getResult();

	}
}