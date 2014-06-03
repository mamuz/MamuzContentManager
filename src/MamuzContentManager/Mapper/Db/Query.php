<?php

namespace MamuzContentManager\Mapper\Db;

use Doctrine\Common\Persistence\ObjectRepository;
use MamuzContentManager\Entity\NullPage;
use MamuzContentManager\Feature\QueryInterface;

class Query implements QueryInterface
{
    /** @var ObjectRepository */
    private $repository;

    /**
     * @param ObjectRepository $repository
     */
    public function __construct(ObjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findActivePageByPath($path)
    {
        $page = $this->repository->findOneBy(
            array(
                'path'   => $path,
                'active' => true,
            )
        );

        if (null === $page) {
            $page = new NullPage;
        }

        return $page;
    }
}
