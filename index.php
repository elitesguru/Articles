<?php
include('includes/db.php');
include('includes/header.php');

// Fetch all articles
$stmt = $conn->prepare("SELECT * FROM articles ORDER BY date_posted DESC");
$stmt->execute();
$articles = $stmt->fetchAll();

?>
<div class="container mt-5">
    <h2>Latest Articles <i class="bi-newspaper"></i></h2>
    <div class="row">
        <?php foreach ($articles as $article): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($article['title']) ?></h5>
                        <p class="card-text"><?= substr(htmlspecialchars($article['content']), 0, 100) ?>...</p>
                        <p class="text-muted"><?= $article['date_posted'] ?></p>
                        <a href="article_detail.php?id=<?= $article['id'] ?>" class="btn btn-primary"><i class="bi-eye"></i> Read More</a>
                        <div class="mt-3">
                            <a href="#" class="text-success me-2"><i class="bi-heart-fill"></i> Like</a>
                            <a href="#" class="text-primary"><i class="bi-arrow-repeat"></i> Repost</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-5">
        <h3>Stay Connected <i class="bi-chat-dots"></i></h3>
        <p>If you'd like to contact the author or discuss the article, feel free to leave a comment or send a message!</p>
    </div>
</div>

<?php include('includes/footer.php'); ?>
