<?php
require __DIR__ . '/../../vendor/autoload.php';

use App\Helpers\Text;
use App\Model\Post;
use App\Connection;
use App\URL;

$title = 'Mon Blog';

$pdo = Connection::getPDO();

$currentPage = URL::getPositiveInt('page', 1);
  
$count = (int)$pdo->query('SELECT COUNT(id) FROM post')->fetch(PDO::FETCH_NUM)[0];
$perPage = 12;
$pages = ceil($count / $perPage);
if ($currentPage > $pages) {
    throw new Exception('Cette page n\'existe pas');
}
$offset = $perPage * ($currentPage - 1);
$query = $pdo->query("SELECT * FROM post ORDER BY created_at DESC LIMIT $perPage OFFSET $offset");
$posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);
?>


<h1>Mon Blog</h1>


<div class="row">
    <?php foreach($posts as $post): ?> 
        <div class="col-md-3"> 
            <?php 
            $categories = $query->fetchAll();
            require '../views/post/card.php'; ?>
        </div>
    <?php endforeach ?>
</div>

<div class="d-flex justify-content-between my-4">
    <?php if ($currentPage > 1): ?>
        <?php 
        $link = $router->url('home');
        if ($currentPage > 2) $link .= '?page=' . ($currentPage - 1);
        ?>
        <a href="<?= $link ?>?page=<?= $currentPage - 1 ?>" class="btn btn-primary">&laquo; Page précédente</a>
    <?php endif ?>
    <?php if ($currentPage < $pages): ?>
        <a href="<?= $router->url('home') ?>?page=<?= $currentPage + 1 ?>" class="btn btn-primary ms-auto">Page suivante &raquo;</a>
    <?php endif ?>
</div>