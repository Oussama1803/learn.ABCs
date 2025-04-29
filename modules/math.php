<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}
include '../includes/header.php';

$score = 0;
$message = '';
$question = '';
$answer = '';
$options = [];

// Generate a random math question
function generateQuestion() {
    $num1 = rand(1, 10);
    $num2 = rand(1, 10);
    $operation = rand(1, 3);
    
    switch ($operation) {
        case 1:
            $question = "$num1 + $num2 = ?";
            $answer = $num1 + $num2;
            break;
        case 2:
            // Ensure subtraction doesn't result in negative numbers
            if ($num1 < $num2) {
                $temp = $num1;
                $num1 = $num2;
                $num2 = $temp;
            }
            $question = "$num1 - $num2 = ?";
            $answer = $num1 - $num2;
            break;
        case 3:
            $question = "$num1 × $num2 = ?";
            $answer = $num1 * $num2;
            break;
    }
    
    // Generate options (including the correct answer)
    $options = [$answer];
    while (count($options) < 4) {
        $option = $answer + rand(-5, 5);
        if ($option != $answer && !in_array($option, $options) && $option >= 0) {
            $options[] = $option;
        }
    }
    
    // Shuffle options
    shuffle($options);
    
    return [
        'question' => $question,
        'answer' => $answer,
        'options' => $options
    ];
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_answer']) && isset($_POST['correct_answer'])) {
        $userAnswer = $_POST['user_answer'];
        $correctAnswer = $_POST['correct_answer'];
        
        if ($userAnswer == $correctAnswer) {
            $score = isset($_POST['score']) ? $_POST['score'] + 10 : 10;
            $message = "Correct! +10 points";
        } else {
            $score = isset($_POST['score']) ? $_POST['score'] : 0;
            $message = "Incorrect! The correct answer is $correctAnswer";
        }
    }
}

// Generate a new question
$questionData = generateQuestion();
$question = $questionData['question'];
$answer = $questionData['answer'];
$options = $questionData['options'];
?>

<div class="math-quiz module-container">
    <h1>Math Quiz</h1>
    <p class="module-description">Practice your math skills by solving these problems!</p>
    
    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
    
    <div class="score">Score: <?php echo $score; ?></div>
    
    <div class="question-container">
        <div class="question"><?php echo $question; ?></div>
        
        <form method="POST" class="options">
            <?php foreach ($options as $option): ?>
                <button type="submit" name="user_answer" value="<?php echo $option; ?>" class="option">
                    <?php echo $option; ?>
                </button>
            <?php endforeach; ?>
            
            <input type="hidden" name="correct_answer" value="<?php echo $answer; ?>">
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
        updateHighScore('math', currentScore);
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