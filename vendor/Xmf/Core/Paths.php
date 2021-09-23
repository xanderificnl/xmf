<?php

namespace Xmf\Core;

if (!defined('APP_PATH')) {
    echo "Please define `APP_PATH`";
    exit;
}

define('DS', DIRECTORY_SEPARATOR);
define('VENDOR_PATH', dirname(__FILE__, 3));
define('XMF_PATH', dirname(__FILE__, 2));
define('XMF_CORE_PATH', dirname(__FILE__));