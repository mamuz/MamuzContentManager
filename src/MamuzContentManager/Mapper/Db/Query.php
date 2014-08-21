<?php

namespace MamuzContentManager\Mapper\Db;

use Doctrine\Common\Persistence\ObjectRepository;
use MamuzContentManager\Entity\NullPage;
use MamuzContentManager\Entity\Page;
use MamuzContentManager\EventManager\AwareTrait as EventManagerAwareTrait;
use MamuzContentManager\EventManager\Event;
use MamuzContentManager\Feature\QueryInterface;

class Query implements QueryInterface
{
    use EventManagerAwareTrait;

    /** @var ObjectRepository */
    private $repository;

    /**
     * @param ObjectRepository $repository
     */
    public function __construct(ObjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findPublishedPageByPath($path)
    {
        $results = $this->trigger(Event::PRE_PAGE_RETRIEVAL, array('path' => $path));
        if ($results->stopped() && ($page = $results->last()) instanceof Page) {
            return $page;
        }

        $page = $this->getPage($path);

        $this->trigger(Event::POST_PAGE_RETRIEVAL, array('path' => $path, 'page' => $page));

        return $page;
    }

    /**
     * @param string $path
     * @return Page
     */
    private function getPage($path)
    {
        $page = $this->repository->findOneBy(
            array(
                'path'      => $path,
                'published' => true,
            )
        );

        if (null === $page) {
            $page = new NullPage;
        }

        return $page;
    }
}
