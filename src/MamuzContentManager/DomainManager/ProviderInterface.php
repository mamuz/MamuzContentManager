<?php

namespace MamuzContentManager\DomainManager;

interface ProviderInterface
{
    /**
     * @return array
     */
    public function getContentManagerDomainConfig();
}
