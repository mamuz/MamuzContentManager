<?php

namespace MamuzContentManager\Feature;

use MamuzContentManager\Entity\Page;

interface QueryInterface
{
    /**
     * @param string $path
     * @return Page
     */
    public function findPublishedPageByPath($path);
}
