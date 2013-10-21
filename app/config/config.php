<?php

/**
 * This file should be put in app/config and app/config/conf.d shoud be created.
 * Any file created in app/config/conf.d will be imported in symfony's main configuration.
 *
 * To activate it, change AppKernel::registerContainerConfiguration to:
 *   $loader->load(__DIR__.'/config/config.php');
 *
 * See app/config/conf*.d for the real configuration files
 */

$this->import('parameters.yml');
$this->import('security.yml');


$directories = array_filter(array(
    __DIR__.'/conf.d',
    __DIR__.'/conf.'.$this->container->getParameter('kernel.environment').'.d',
), 'is_dir');

foreach ($directories as $directory) {
    $this->setCurrentDir($directory);

    foreach (scandir($directory) as $config_file) {
        if ('.' === $config_file || '..' === $config_file) {
            continue;
        }

        $this->import($config_file);
    }
}

$this->setCurrentDir(__DIR__);

unset($directory, $directories, $config_file);