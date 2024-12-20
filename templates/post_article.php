<?php
include('includes/db.php');
include('includes/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stmt = $conn->prepare("INSERT INTO articles (title, content) VALUES (:title, :content)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->execute();
    header('Location: index.php');
}

?>

<div class="container mt-5">
    <h2><i class="bi-pencil-square"></i> Post a New Article</h2>
    <form action="post_article.php" method="POST">
        <div class="mb-3">
            <input type="text" name="title" class="form-control" placeholder="Title" required>
        </div>
        <div class="mb-3">
            <textarea name="content" class="form-control" placeholder="Article content" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary"><i class="bi-upload"></i> Post Article</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>
