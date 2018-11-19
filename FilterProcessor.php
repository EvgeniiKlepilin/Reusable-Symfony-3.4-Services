<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Utils;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Description of FilterProcessor
 * Creates valid DQL filters for select query
 * Filters must be provided as an array of arrays:
 *      {"field" => "field_name", "value" => "value", "operator" => "operator"}
 * Acceptable Operator Values:
 *      eq | gt | lt | gte | lte | neq | in | notIn
 * @author eugene
 */
class FilterProcessor
{

    private $entityManager;
    private $queryBuilder;
    
    private $permitTransaction = true;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->queryBuilder = $entityManager->createQueryBuilder();
    }

    public function makeQuery(
        array $filters,
        string $className,
        string $orderField = 'id',        
        string $orderBy = 'DESC',
        int $limit = 20,
        int $offset = 0
        )
    {
        //create base query: Select All from given Object
        $this->queryBuilder->select(array('object'))
            ->from('AppBundle:' . $className, 'object');
        //check if filters are not empty
        if (!empty($filters)) {
            for ($i = 0; $i < count($filters); $i++) {
                //add all filters
                $this->queryBuilder
                    ->andWhere($this->processFilter($filters[$i]));
            }
        }
        //set Order
        $this->queryBuilder->orderBy('object.' . $orderField, $orderBy);
        //set Offset
        $this->queryBuilder->setFirstResult($offset);
        //set Limit
        $this->queryBuilder->setMaxResults($limit);
    }

    private function processFilter($filter)
    {
        switch ($filter['operator']) {
            case 'eq':
                return $this->queryBuilder->expr()
                        ->eq('object.' . $filter['field'],
                            "'" . $filter['value'] . "'");
            case 'gt':
                return $this->queryBuilder->expr()
                        ->gt('object.' . $filter['field'],
                            "'" . $filter['value'] . "'");
            case 'lt':
                return $this->queryBuilder->expr()
                        ->lt('object.' . $filter['field'],
                            "'" . $filter['value'] . "'");
            case 'lte':
                return $this->queryBuilder->expr()
                        ->lte('object.' . $filter['field'],
                            "'" . $filter['value'] . "'");
            case 'gte':
                return $this->queryBuilder->expr()
                        ->gte('object.' . $filter['field'],
                            "'" . $filter['value'] . "'");
            case 'neq':
                return $this->queryBuilder->expr()
                        ->neq('object.' . $filter['field'],
                            "'" . $filter['value'] . "'");
            case 'like':
                return $this->queryBuilder->expr()
                        ->like('object.' . $filter['field'],
                            "'" . $filter['value'] . "%'");
            case 'notLike':
                return $this->queryBuilder->expr()
                        ->notLike('object.' . $filter['field'],
                            "'" . $filter['value'] . "%'");
            case 'in':
                //filter['value'] must be an array here
                return $this->queryBuilder->expr()
                        ->in('object.' . $filter['field'],
                            "'" . implode("','", $filter['value']) . "'");
            case 'notIn':
                //filter['value'] must be an array here
                return $this->queryBuilder->expr()
                        ->notIn('object.' . $filter['field'],
                            "'" . implode("','", $filter['value']) . "'");            
            default:
                return null;
        }
    }
    
    public function getPermitTransaction()
    {
        return $this->permitTransaction;
    }

    public function setPermitTransaction($permitTransaction)
    {
        $this->permitTransaction = $permitTransaction;
        return $this;
    }

    
    public function getResults()
    {
        //dump($this->queryBuilder->getDQL());
        if($this->permitTransaction){
            return $this->queryBuilder->getQuery()->getResult();
        } else {
            return "";
        }
        
    }
}
