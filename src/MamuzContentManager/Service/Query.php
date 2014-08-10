<?php

namespace MamuzContentManager\Service;

use MamuzContentManager\Feature\QueryInterface;

class Query implements QueryInterface
{
    /** @var QueryInterface */
    private $mapper;

    /**
     * @param QueryInterface $mapper
     */
    public function __construct(QueryInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    public function findPublishedPageByPath($path)
    {
        return $this->mapper->findPublishedPageByPath($path);
    }
}
