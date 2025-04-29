<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}
include '../includes/header.php';

// Array of words with their images
$words = [
    ['word' => 'CAT', 'image' => 'https://cdn.pixabay.com/photo/2014/11/30/14/11/cat-551554_1280.jpg'],
    ['word' => 'DOG', 'image' => 'https://cdn.pixabay.com/photo/2016/12/13/05/15/puppy-1903313_1280.jpg'],
    ['word' => 'SUN', 'image' => 'https://cdn.pixabay.com/photo/2016/03/09/09/22/workplace-1245776_1280.jpg'],
    ['word' => 'BALL', 'image' => 'https://cdn.pixabay.com/photo/2014/05/03/00/56/basketball-336392_1280.jpg'],
    ['word' => 'TREE', 'image' => 'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg'],
];

$score = 0;
$message = '';
$currentWord = '';
$currentImage = '';
$options = [];

// Get a random word
function getRandomWord($words) {
    return $words[array_rand($words)];
}

// Generate wrong options
function generateOptions($correctWord, $words) {
    $options = [$correctWord];
    $allWords = array_column($words, 'word');
    
    while (count($options) < 4) {
        $randomWord = $allWords[array_rand($allWords)];
        if (!in_array($randomWord, $options)) {
            $options[] = $randomWord;
        }
    }
    
    shuffle($options);
    return $options;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_answer']) && isset($_POST['correct_word'])) {
        $userAnswer = $_POST['user_answer'];
        $correctWord = $_POST['correct_word'];
        
        if ($userAnswer === $correctWord) {
            $score = isset($_POST['score']) ? $_POST['score'] + 10 : 10;
            $message = "Correct! +10 points";
        } else {
            $score = isset($_POST['score']) ? $_POST['score'] : 0;
            $message = "Incorrect! The correct word is $correctWord";
        }
    }
}

// Get a random word for the quiz
$wordData = getRandomWord($words);
$currentWord = $wordData['word'];
$currentImage = $wordData['image'];
$options = generateOptions($currentWord, $words);
?>

<div class="spelling-quiz module-container">
    <h1>Spelling Quiz</h1>
    <p class="module-description">Look at the image and choose the correct spelling!</p>
    
    <?php if ($message): ?>
        <div class="message <?php echo strpos($message, 'Correct') !== false ? 'correct' : 'incorrect'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
    <div class="score">Score: <?php echo $score; ?></div>
    
    <div class="question-container">
        <img src="<?php echo $currentImage; ?>" alt="Word Image" class="word-image">
        
        <form method="POST" class="spelling-options">
            <?php foreach ($options as $option): ?>
                <button type="submit" name="user_answer" value="<?php echo $option; ?>" class="spelling-option">
                    <?php echo $option; ?>
                </button>
            <?php endforeach; ?>
            
            <input type="hidden" name="correct_word" value="<?php echo $currentWord; ?>">
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
        updateHighScore('spelling', currentScore);
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