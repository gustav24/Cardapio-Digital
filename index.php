<?php

require_once 'src/config/config.php';
require_once 'src/routes/router.php';


$router = new Router();
$router->handleRequest();
?> 