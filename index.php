<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
include 'includes/header.php';
?>

<div class="welcome-container">
    <div class="welcome-header">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>! 👋</h1>
        <p class="welcome-subtitle">Let's learn something new today!</p>
    </div>
    
    <div class="module-grid">
        <div class="top-row">
            <a href="modules/math.php" class="module-card">
                <div class="card-icon">🔢</div>
                <h2>Math Quiz</h2>
                <p>Practice addition and subtraction with fun exercises!</p>
            </a>
        
            <a href="modules/spelling.php" class="module-card">
                <div class="card-icon">📝</div>
                <h2>Spelling Quiz</h2>
                <p>Learn to spell simple words and improve vocabulary</p>
            </a>
        
            <a href="modules/drawing.php" class="module-card">
                <div class="card-icon">✏️</div>
                <h2>Drawing</h2>
                <p>Express your creativity and draw anything you imagine!</p>
            </a>
        </div>
        <div class="bottom-row">
            <a href="modules/clock.php" class="module-card">
                <div class="card-icon">⏰</div>
                <h2>Tell the Time</h2>
                <p>Learn to read analog clocks with interactive exercises</p>
            </a>
            <a href="modules/videos.php" class="module-card video-module">
                <div class="card-icon">📺</div>
                <h2>Learning Videos</h2>
                <p>Watch fun educational videos and learn through animation!</p>
            </a>
            <a href="modules/discovery.php" class="module-card">
                <div class="card-icon">🌎</div>
                <h2>Discovery Zone</h2>
                <p>Learn about animals and countries around the world!</p>
            </a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>