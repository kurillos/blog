<?php 
require '../vendor/autoload.php';

define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


if(isset($GET['page']) && $GET['page'] === '1') {
    // réécrire l'url sans le paramétre ?page
    $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
    $get = $_GET;
    unset($get['page']);
    $query = http_build_query($get);
    if (!empty($query)) {
        $uri = $uri . '?' . $query;
    }
    http_response_code(301);
    header('Location: ' . $uri);
    exit();
    dd($uri);
}

use App\Router;

$router = new Router(dirname(__DIR__) . '/views');
$router
    ->get('/', 'post/index.php', 'home')
    ->get('/blog/[*:slug]-[i:id]', 'post/show.php', 'post')
    ->get('/blog/category', 'category/show.php', 'category')
    ->run();