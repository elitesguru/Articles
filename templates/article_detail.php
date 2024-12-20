<?php
include('includes/db.php');
include('includes/header.php');

if (isset($_GET['id'])) {
    $article_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM articles WHERE id = :id");
    $stmt->bindParam(':id', $article_id);
    $stmt->execute();
    $article = $stmt->fetch();

    // Get messages for the article
    $stmt = $conn->prepare("SELECT * FROM messages WHERE article_id = :article_id ORDER BY date_posted DESC");
    $stmt->bindParam(':article_id', $article_id);
    $stmt->execute();
    $messages = $stmt->fetchAll();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST['user_name'];
    $message = $_POST['message'];
    $stmt = $conn->prepare("INSERT INTO messages (article_id, user_name, message) VALUES (:article_id, :user_name, :message)");
    $stmt->bindParam(':article_id', $article_id);
    $stmt->bindParam(':user_name', $user_name);
    $stmt->bindParam(':message', $message);
    $stmt->execute();
}

?>

<div class="container mt-5">
    <h2><?= htmlspecialchars($article['title']) ?></h2>
    <p><?= nl2br(htmlspecialchars($article['content'])) ?></p>
    <p class="text-muted">Posted on: <?= $article['date_posted'] ?></p>

    <h3>Comments</h3>
    <form action="article_detail.php?id=<?= $article['id'] ?>" method="POST">
        <div class="mb-3">
            <input type="text" name="user_name" class="form-control" placeholder="Your name" required>
        </div>
        <div class="mb-3">
            <textarea name="message" class="form-control" placeholder="Your message" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Post Message</button>
    </form>

    <div class="mt-4">
        <h4>All Messages</h4>
        <?php foreach ($messages as $msg): ?>
            <div class="mb-3">
                <strong><?= htmlspecialchars($msg['user_name']) ?>:</strong> <?= nl2br(htmlspecialchars($msg['message'])) ?>
                <p class="text-muted"><?= $msg['date_posted'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include('includes/footer.php'); ?>
