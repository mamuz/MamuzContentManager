<?php

namespace MamuzContentManager\Entity;

class NullPage extends Page
{
    const NULL_TITLE = 'Error';

    const NULL_CONTENT = 'Page not found';

    public function getTitle()
    {
        return self::NULL_TITLE;
    }

    public function getContent()
    {
        return self::NULL_CONTENT;
    }
}
