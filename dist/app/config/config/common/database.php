<?php

$ini_file = $this->container->getParameter('kernel.root_dir') . '/../confs/database.ini';

$this->container->addResource(new Symfony\Component\Config\Resource\FileResource($ini_file));

if (!file_exists($ini_file)) {
  echo $ini_file.' must exists';
  die();
}

$ini = parse_ini_file($ini_file);

$container->loadFromExtension('doctrine', array(
    'dbal' => array(
        'driver'   => 'pdo_mysql',
        'host'     => $ini['host'],
        'dbname'   => $ini['name'],
        'user'     => $ini['user'],
        'password' => $ini['pass'],
        'port'     => null,
        'charset'  => 'UTF8',
    ),
));
