<?php
    require_once __DIR__ . '/backend/vendor/autoload.php';

    use Bidding\Routes as Routes;
    $route = new Routes();
    $route->pages($_REQUEST);
?>