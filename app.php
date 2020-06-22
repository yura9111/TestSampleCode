<?php

require "vendor/autoload.php";

/**
 * some magical routing...
 */
$controller = new \App\Controller\MainController();
$controller->mainAction($argv[1]);