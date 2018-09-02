<?php
    require_once __DIR__ . '/vendor/autoload.php';
	$loader->add('backend\\test\\', __DIR__);

    use Bidding\Routes as Routes;
    $route = new Routes;
    $route->pages($_REQUEST);
?>