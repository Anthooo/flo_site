<?php

namespace FloBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FloBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
