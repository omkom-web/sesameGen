<?php

namespace Sesame\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SesameAdminBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'SonataAdminBundle';
    }
}
