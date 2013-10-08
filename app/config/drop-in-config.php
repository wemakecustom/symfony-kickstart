<?php

/**
 * This file should be put in app/config and app/config/conf.d shoud be created.
 * You also need to add `- { resource: drop-in-config.php }` in the `imports`
 * section of `config.yml`.
 * Any file created in app/config/conf.d will be imported in symfony's main
 * configuration.
 */

$that = $this;

$load_dir = function($dir) use ($that)
{
    if (!is_dir($dir)) {
        return;
    }

    $that->setCurrentDir($dir);

    foreach (scandir($dir) as $config_file) {
        if ('.' === $config_file || '..' === $config_file) {
            continue;
        }
            
        $that->import($config_file);
    }

    $that->setCurrentDir(__DIR__);
};

$load_dir(__DIR__.'/conf.d');
$load_dir(__DIR__.'/conf.'.$this->container->getParameter('kernel.environment').'.d');

unset($that, $load_dir);