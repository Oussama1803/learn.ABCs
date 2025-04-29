// High Score Management
let highScores = {
    math: localStorage.getItem('highScore_math') || 0,
    spelling: localStorage.getItem('highScore_spelling') || 0,
    clock: localStorage.getItem('highScore_clock') || 0
};

// Update high score if current score is higher
function updateHighScore(module, score) {
    score = parseInt(score);
    if (score > highScores[module]) {
        highScores[module] = score;
        localStorage.setItem(`highScore_${module}`, score);
        showReward(score);
        return true; // New high score achieved
    }
    return false; // No new high score
}

// Display high score
function displayHighScore(module) {
    const highScoreContainer = document.createElement('div');
    highScoreContainer.className = 'highscore-container';
    
    highScoreContainer.innerHTML = `
        <div class="highscore-title">High Score</div>
        <div class="highscore-value">${highScores[module]}</div>
    `;
    
    // Find the module container and insert high score at the top
    const moduleContainer = document.querySelector('.module-container');
    if (moduleContainer) {
        moduleContainer.insertBefore(highScoreContainer, moduleContainer.firstChild);
    }
}

// Restart functionality
function addRestartButton() {
    const restartButton = document.createElement('button');
    restartButton.className = 'restart-button';
    restartButton.textContent = 'Restart Quiz';
    restartButton.onclick = function() {
        location.reload(); // Simple reload to restart
    };
    
    // Add to the module container
    const moduleContainer = document.querySelector('.module-container');
    if (moduleContainer) {
        moduleContainer.appendChild(restartButton);
    }
}

// Show reward based on score
function showReward(score) {
    // Create confetti effect
    createConfetti();
    
    // Determine reward tier
    let rewardTier, rewardMessage;
    
    if (score >= 90) {
        rewardTier = 'gold';
        rewardMessage = 'Amazing! You\'re a superstar!';
    } else if (score >= 70) {
        rewardTier = 'silver';
        rewardMessage = 'Great job! You\'re doing fantastic!';
    } else if (score >= 50) {
        rewardTier = 'bronze';
        rewardMessage = 'Good effort! Keep practicing!';
    } else {
        rewardTier = 'participant';
        rewardMessage = 'Nice try! You\'ll do better next time!';
    }
    
    // Create reward message
    const rewardContainer = document.createElement('div');
    rewardContainer.className = 'reward-message';
    rewardContainer.innerHTML = `
        <div class="reward-title">🎉 ${rewardMessage} 🎉</div>
        <p>You earned a ${rewardTier} badge!</p>
    `;
    
    // Create reward badge
    const badgeContainer = document.createElement('div');
    badgeContainer.className = 'reward-container';
    
    const badge = document.createElement('div');
    badge.className = 'reward-badge';
    
    // Set badge image based on tier
    const badgeImg = document.createElement('img');
    badgeImg.src = getBadgeImage(rewardTier);
    badge.appendChild(badgeImg);
    
    badgeContainer.appendChild(badge);
    
    // Add to the module container
    const moduleContainer = document.querySelector('.module-container');
    if (moduleContainer) {
        moduleContainer.appendChild(rewardContainer);
        moduleContainer.appendChild(badgeContainer);
    }
}

// Get badge image based on tier
function getBadgeImage(tier) {
    switch(tier) {
        case 'gold':
            return 'https://cdn-icons-png.flaticon.com/512/2583/2583344.png';
        case 'silver':
            return 'https://cdn-icons-png.flaticon.com/512/2583/2583319.png';
        case 'bronze':
            return 'https://cdn-icons-png.flaticon.com/512/2583/2583434.png';
        default:
            return 'https://cdn-icons-png.flaticon.com/512/3176/3176361.png';
    }
}

// Create confetti effect
function createConfetti() {
    const confettiCount = 100;
    const colors = ['#FF6B6B', '#4ECDC4', '#FFE66D', '#FF8E53', '#7A77FF'];
    
    for (let i = 0; i < confettiCount; i++) {
        const confetti = document.createElement('div');
        confetti.className = 'confetti';
        
        // Random position, color, and delay
        confetti.style.left = Math.random() * 100 + 'vw';
        confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        confetti.style.animationDelay = Math.random() * 5 + 's';
        
        document.body.appendChild(confetti);
        
        // Remove confetti after animation
        setTimeout(() => {
            confetti.remove();
        }, 5000);
    }
}

// Add progress bar
function createProgressBar(currentQuestion, totalQuestions) {
    const progressContainer = document.createElement('div');
    progressContainer.className = 'progress-container';
    
    const progressBar = document.createElement('div');
    progressBar.className = 'progress-bar';
    progressBar.style.width = (currentQuestion / totalQuestions * 100) + '%';
    
    progressContainer.appendChild(progressBar);
    
    // Add to the module container
    const moduleContainer = document.querySelector('.module-container');
    if (moduleContainer) {
        moduleContainer.insertBefore(progressContainer, moduleContainer.firstChild.nextSibling);
    }
}

// Update progress bar
function updateProgressBar(currentQuestion, totalQuestions) {
    const progressBar = document.querySelector('.progress-bar');
    if (progressBar) {
        progressBar.style.width = (currentQuestion / totalQuestions * 100) + '%';
    }
}

// Add helper character
function addHelperCharacter() {
    const character = document.createElement('div');
    character.className = 'character';
    
    character.innerHTML = `
        <div class="character-speech">Need help? Click me for a hint!</div>
        <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png" alt="Helper Character">
    `;
    
    document.body.appendChild(character);
    
    character.addEventListener('click', function() {
        const speech = this.querySelector('.character-speech');
        speech.textContent = getRandomHint();
        speech.style.opacity = 1;
        
        setTimeout(() => {
            speech.style.opacity = 0;
        }, 3000);
    });
}

// Get random hint
function getRandomHint() {
    const hints = [
        "Take your time and think carefully!",
        "You're doing great! Keep going!",
        "Try to remember what you've learned!",
        "Look for patterns in the questions!",
        "You can do it! I believe in you!"
    ];
    
    return hints[Math.floor(Math.random() * hints.length)];
}

// Initialize features when document is ready
document.addEventListener('DOMContentLoaded', function() {
    // Determine which module we're in
    const moduleContainer = document.querySelector('.module-container');
    if (!moduleContainer) return;
    
    let moduleType = '';
    
    if (document.querySelector('.math-quiz')) {
        moduleType = 'math';
    } else if (document.querySelector('.spelling-container')) {
        moduleType = 'spelling';
    } else if (document.querySelector('.clock-quiz')) {
        moduleType = 'clock';
    }
    
    if (moduleType) {
        displayHighScore(moduleType);
        addRestartButton();
        addHelperCharacter();
    }
});