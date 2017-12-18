<?php
namespace AppBundle\Criteria;

use Doctrine\ORM\QueryBuilder;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Doctrine\ORM\Query\Expr;

class InquiryCriteriaBuilder implements CriteriaBuilderInterface, ToQueryBuilderInterface
{
    use ParameterParserTrait;

    const DEFAULT_SORT = 'id';

    protected $query;

    public function __construct(ParameterBag $query)
    {
        $this->query = $query;
    }

    /**
     *
     * {@inheritDoc}
     * @see \PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface::build()
     */
    public function build()
    {
        return new Criteria();
    }

    public function buildToQueryBuilder(QueryBuilder $builder)
    {
        $this->buildByQuery($builder);

        $this->setOrder($builder);

        $this->setOffsetAndLimit($builder);

    }

    private function buildByQuery(QueryBuilder $builder)
    {
        $values = $this->parseQueryValues();
        $composite = $this->createQueryComposite();

        if (! $values) return;

        $expr = $builder->expr();

        foreach ($values as $value) {
            $orX = [
                self::like($expr, 'main.name', $value),
                self::like($expr, 'main.email', $value),
                self::like($expr, 'main.tel', $value)
            ];

            $composite->add(new Expr\Orx($orX));
        }

        $builder->andWhere($composite);
    }

    private function setOrder(QueryBuilder $builder)
    {
        list($direction, $target) = $this->parseSort(self::DEFAULT_SORT);

        $enableFields = [
            'id' => 'main.id'
        ];

        $builder->orderBy($enableFields[$target], $direction);
    }

    private function setOffsetAndLimit(QueryBuilder $builder)
    {
        list($limit, $offset) = $this->getLimitAndOffset();

        $builder->setFirstResult($offset);

        $builder->setMaxResults($limit);
    }

    static private function like($expr, $field, $value)
    {
        return $expr->like($field, $expr->literal('%' . $value . '%'));
    }
}