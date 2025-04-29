<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}
include '../includes/header.php';

$score = 0;
$message = '';

// Generate a random time
function generateRandomTime() {
    $hour = rand(1, 12);
    $minute = rand(0, 11) * 5; // 0, 5, 10, 15, etc.
    
    return [
        'hour' => $hour,
        'minute' => $minute,
        'hourAngle' => ($hour * 30) + ($minute * 0.5), // 30 degrees per hour + adjustment for minutes
        'minuteAngle' => $minute * 6, // 6 degrees per minute
        'timeString' => sprintf("%d:%02d", $hour, $minute)
    ];
}

// Generate options for the time
function generateTimeOptions($correctTime) {
    $options = [$correctTime];
    
    while (count($options) < 4) {
        $hour = rand(1, 12);
        $minute = rand(0, 11) * 5;
        $timeString = sprintf("%d:%02d", $hour, $minute);
        
        if (!in_array($timeString, $options)) {
            $options[] = $timeString;
        }
    }
    
    shuffle($options);
    return $options;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_answer']) && isset($_POST['correct_time'])) {
        $userAnswer = $_POST['user_answer'];
        $correctTime = $_POST['correct_time'];
        
        if ($userAnswer === $correctTime) {
            $score = isset($_POST['score']) ? $_POST['score'] + 10 : 10;
            $message = "Correct! +10 points";
        } else {
            $score = isset($_POST['score']) ? $_POST['score'] : 0;
            $message = "Incorrect! The correct time is $correctTime";
        }
    }
}

// Generate a random time for the quiz
$timeData = generateRandomTime();
$options = generateTimeOptions($timeData['timeString']);
?>

<div class="clock-quiz module-container">
    <h1>Clock Reading</h1>
    <p class="module-description">Look at the clock and choose the correct time!</p>
    
    <?php if ($message): ?>
        <div class="message <?php echo strpos($message, 'Correct') !== false ? 'correct' : 'incorrect'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
    <div class="score">Score: <?php echo $score; ?></div>
    
    <div class="question-container">
        <div class="clock">
            <div class="center"></div>
            <div class="hour-hand" style="transform: rotate(<?php echo $timeData['hourAngle']; ?>deg);"></div>
            <div class="minute-hand" style="transform: rotate(<?php echo $timeData['minuteAngle']; ?>deg);"></div>
            
            <?php for ($i = 1; $i <= 12; $i++): ?>
                <?php 
                    $angle = ($i * 30) - 90; // Start from 12 o'clock position (which is -90 degrees)
                    $radius = 80; // Adjust this value based on your clock size
                    $x = $radius * cos($angle * M_PI / 180);
                    $y = $radius * sin($angle * M_PI / 180);
                ?>
                <div class="number" style="top: calc(50% + <?php echo $y; ?>px); left: calc(50% + <?php echo $x; ?>px); transform: translate(-50%, -50%);">
                    <?php echo $i; ?>
                </div>
            <?php endfor; ?>
        </div>
        
        <form method="POST" class="clock-options">
            <?php foreach ($options as $option): ?>
                <button type="submit" name="user_answer" value="<?php echo $option; ?>" class="clock-option">
                    <?php echo $option; ?>
                </button>
            <?php endforeach; ?>
            
            <input type="hidden" name="correct_time" value="<?php echo $timeData['timeString']; ?>">
            <input type="hidden" name="score" value="<?php echo $score; ?>">
        </form>
    </div>
    
    <a href="../index.php" class="check-button">Back to Home</a>
</div>

<script src="../js/highscore.js"></script>
<script>
    // Update high score when score changes
    const currentScore = <?php echo $score; ?>;
    if (currentScore > 0) {
        updateHighScore('clock', currentScore);
    }
    
    // Create progress bar (simulating 10 questions total)
    const questionNumber = Math.min(Math.floor(currentScore / 10) + 1, 10);
    createProgressBar(questionNumber, 10);
    
    // If incorrect answer, show restart button
    <?php if (strpos($message, 'Incorrect') !== false): ?>
    addRestartButton();
    <?php endif; ?>
</script>

<?php include '../includes/footer.php'; ?>