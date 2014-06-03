<?php

namespace MamuzContentManager\Service;

use MamuzContentManager\Mapper\Db\Query as QueryMapper;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class QueryFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     * @return \MamuzContentManager\Feature\QueryInterface
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Doctrine\Common\Persistence\ObjectManager $entityManager */
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $repository = $entityManager->getRepository('MamuzContentManager\Entity\Page');

        $queryMapper = new QueryMapper($repository);
        $queryService = new Query($queryMapper);

        return $queryService;
    }
}
