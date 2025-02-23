<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title"><?= htmlentities($post->getName()) ?></h5>
        <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y') ?></p>
        <p><?= $post->getExcerpt() ?></p>
        <p>
        <?php foreach($categories as $category): ?>
        <a href="#"><?= e($category->getName()) ?></a>
        <?php endforeach ?>
        <?php
        $id = $post->getID();
        $slug = $post->getSlug(); 
        ?>
        <a href="<?= $router->url('post', ['slug' => $post->getSlug(), 'id' => $post->getID()]) ?>" class="btn btn-primary">Voir plus</a>
        </p>
    </div>
</div>