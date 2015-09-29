<?php

namespace EcommerceBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class HeadooEcommerceBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
