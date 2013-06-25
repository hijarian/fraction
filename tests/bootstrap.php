<?php
/**
 * This is just a setup before test suite.
 *
 * It initializes the autoloader.
 */
require_once(__DIR__.'/../SplClassLoader.php');

$classLoader = new SplClassLoader('Hijarian\Fraction', realpath(__DIR__.'/../src'));
$classLoader->register();
