<?php

namespace GeoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GeoBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
