<?php

namespace MamuzContentManager\Service;

use MamuzContentManager\Feature\QueryInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

class Query implements EventManagerAwareInterface, QueryInterface
{
    use EventManagerAwareTrait;

    /** @var QueryInterface */
    private $mapper;

    /**
     * @param QueryInterface $mapper
     */
    public function __construct(QueryInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    public function findActivePageByPath($path)
    {
        return $this->mapper->findActivePageByPath($path);
    }
}
