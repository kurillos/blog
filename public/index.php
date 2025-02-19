<?php 
require '../vendor/autoload.php';

define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

use App\Router;

$router = new Router(dirname(__DIR__) . '/views');
$router
    ->get('/', 'post/index.php', 'home')
    ->get('/blog/category', 'category/show.php', 'category')
    ->run();