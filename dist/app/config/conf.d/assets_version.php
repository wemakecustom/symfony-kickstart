<?php

/**
 * Cache buster
 * Converts current time to a short string to use as key
 *
 * The key will be appended to each asset as a query string
 *
 * Ex: http://example.com/assets/global.css?muw6vx
 */

$container->loadFromExtension('framework', array(
    'templating'      => array(
        'engines' => array('twig'),
        'assets_version' => base_convert(time(), 10, 36), // ex: muw6vx
    ),
));
