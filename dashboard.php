<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

include 'includes/header.php';
require_once 'config/database.php';

// Get user scores
$stmt = $pdo->prepare("SELECT module, MAX(score) as high_score FROM scores WHERE username = ? GROUP BY module");
$stmt->execute([$_SESSION['username']]);
$scores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="dashboard">
    <h2>Your Progress Dashboard</h2>
    
    <div class="score-cards">
        <?php foreach ($scores as $score): ?>
            <div class="score-card">
                <h3><?php echo ucfirst($score['module']); ?></h3>
                <p>High Score: <?php echo $score['high_score']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>