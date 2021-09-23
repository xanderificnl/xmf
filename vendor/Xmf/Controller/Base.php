<?php

namespace Xmf\Controller;

class Base
{
    public function __construct()
    {
        if (method_exists($this, 'init')) {
            $this->init();
        }
    }

    public function getIndex()
    {
        echo "You should overload getIndex()";
    }

    public function __destruct()
    {
        if (method_exists($this, 'teardown')) {
            $this->teardown();
        }
    }
}