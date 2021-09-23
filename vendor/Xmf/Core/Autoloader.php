<?php

namespace Xmf\Core;

require_once('Paths.php');

class Autoloader
{
    public array $search_paths = [
        APP_PATH . DS . "controllers" . DS,
        APP_PATH . DS . "models" . DS,
        VENDOR_PATH
    ];

    public array $mapped_files = [
        "Xmf\Core\\" => XMF_PATH . DS . "Core",
        "Xmf\Controller\\" => XMF_PATH . DS . "Controller",
        "Xmf\Exceptions\\" => XMF_PATH . DS . "Exceptions",
        "Xmf\\" => XMF_PATH
    ];

    public function __construct()
    {
        return $this;
    }

    public function register(): bool
    {
        return spl_autoload_register([$this, 'loadClass']);
    }

    public function loadClass($class_name): bool
    {
        $prefix = $class_name;

        while (false !== $pos = strrpos($prefix, '\\')) {
            $prefix = substr($class_name, 0, $pos + 1);
            $relative_class = substr($class_name, $pos + 1);

            if (in_array($prefix, array_keys($this->mapped_files))) {
                return $this->load($this->mapped_files[$prefix] . DS . $relative_class);
            }

            $prefix = rtrim($prefix, '\\');
        }

        $prefix = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);

        foreach ($this->search_paths as $path) {
            $file = $path . DS . $prefix;

            if ($this->load($file)) {
                return true;
            }
        }

        return false;
    }

    public function load($file): bool
    {
        $file .= ".php";

        if (file_exists($file)) {
            return require_once($file);
        }

        return false;

    }
}

(new Autoloader())->register();