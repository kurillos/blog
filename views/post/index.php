<?php
use App\Helpers\Text;
use App\Model\Post;

$title = 'Mon Blog';

$pdo = new PDO('mysql:dbname=blog_caverne;host=127.0.0.1', 'root', 'root', [
       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
 ]);

$query = $pdo->query('SELECT * FROM post ORDER BY created_at DESC LIMIT 12');
$posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);
?>


<h1>Mon Blog</h1>


<div class="row">
    <?php foreach($posts as $post): ?> <!-- Utilisez $posts ici -->
        <div class="col-md-3"> 
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlentities($post->getName()) ?></h5>
                    <p><?= htmlentities($post-getExcerpt()) ?></p>
                    <p>
                        <a href="#" class="btn btn-primary">Voir plus</a>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>