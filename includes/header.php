<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kids Learning Platform</title>
    <link rel="stylesheet" href="/learnABCs/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">
    <script src="/learnABCs/js/highscore.js"></script>
</head>
<body class="<?php echo isset($page_class) ? $page_class : ''; ?>">
    <?php if(isset($_SESSION['username'])): ?>
    <nav class="main-nav">
        <div class="nav-logo">
            <span class="logo-text">🎨 Learn ABCs</span>
        </div>
        <ul class="nav-links">
            <li><a href="/learnABCs/index.php" class="nav-item">🏠 Home</a></li>
            <li><a href="/learnABCs/modules/math.php" class="nav-item">🔢 Math</a></li>
            <li><a href="/learnABCs/modules/spelling.php" class="nav-item">📝 Spelling</a></li>
            <li><a href="/learnABCs/modules/clock.php" class="nav-item">🕒 Clock</a></li>
            <li><a href="/learnABCs/modules/drawing.php" class="nav-item">✏️ Drawing</a></li>
            <li><a href="/learnABCs/modules/videos.php" class="nav-item">🎬 Videos</a></li>
            <li><a href="/learnABCs/modules/discovery.php" class="nav-item">🔍 Discovery</a></li>
            <li><a href="/learnABCs/logout.php" class="nav-item logout">🚪 Logout</a></li>
        </ul>
    </nav>
    <div class="content-wrapper">
    <?php endif; ?>