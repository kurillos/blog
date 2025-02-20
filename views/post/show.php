<?php
use App\Connection;
use App\Model\Post;

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$query = $pdo->prepare('SELECT * FROM post WHERE id = :id');
$query->execute(['id' => $id]);
$query->setFetchMode(PDO::FETCH_CLASS, Post::class);
/**
 * @var Post|false
 */
$post = $query->fetch();

if ($post === false) {
    throw new Exception('Aucun article ne correspond à cet ID');
}

if($post->getSlug() !== $slug) {
    $url = $router->url('post', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301);

    
    header('Location: ' . $url);
    exit();
};

$query = $pdo->prepare('SELECT * FROM post_category pc WHERE pc.post_id = :id');
$query->execute(['id' => $post->getID()]);
$categories = $query->fetchAll();
dd($categories);
?>

<h1 class="card-title"><?= e($post->getName()) ?></h1>
<p class="text-muted"><?= $post->getCreatedAt()->format('d F Y') ?></p>
<p><?= nl2br(htmlentities($post->getFormattedContent())) ?></p>
