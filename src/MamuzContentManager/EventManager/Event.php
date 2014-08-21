<?php

namespace MamuzContentManager\EventManager;

interface Event
{
    const IDENTIFIER = 'mamuz-content-manager';

    const PRE_PAGE_RETRIEVAL = 'findPublishedPageByPath.pre';

    const POST_PAGE_RETRIEVAL = 'findPublishedPageByPath.post';
}
