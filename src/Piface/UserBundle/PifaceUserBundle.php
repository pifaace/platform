<?php

namespace Piface\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PifaceUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
