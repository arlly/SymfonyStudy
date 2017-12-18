<?php
namespace AppBundle\Repository;

use AppBundle\Fulcrum\Repository\RepositoryInterface;
use PHPMentors\DomainKata\Entity\EntityInterface;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;
use AppBundle\Criteria\ToQueryBuilderInterface;
use Doctrine\ORM\EntityRepository;

/**
 * InquiryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InquiryRepository extends EntityRepository implements RepositoryInterface
{

    public function add(EntityInterface $entity)
    {
        //
    }

    public function queryByCriteria(CriteriaBuilderInterface $criteriaBuilder)
    {
        $queryBuilder = $this->createQueryBuilder('main');

        if ($criteriaBuilder instanceof ToQueryBuilderInterface) {
            $criteriaBuilder->buildToQueryBuilder($queryBuilder);
            return $queryBuilder->getQuery();
        } else {
            return $queryBuilder->addCriteria($criteriaBuilder->build())->getQuery();
        }
    }

    public function update(EntityInterface $entity)
    {
        //
    }

    public function getOneByCriteria(CriteriaBuilderInterface $criteriaBuilder)
    {
        //
        $query = $this->queryByCriteria($criteriaBuilder);
        return $query->getOneOrNullResult();
    }

    public function remove(EntityInterface $entity)
    {
        //
    }
}
