<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: /login.php');
    exit;
}

include '../includes/header.php';
require_once '../config/database.php';

$videos = [
    [
        'id' => 'DR-cfDsHCGA',
        'title' => 'Learn Numbers',
        'description' => 'Count from 1 to 10 with fun animations!'
    ],
    [
        'id' => 'tRNy2i75tCc',
        'title' => 'Learn the Alphabet',
        'description' => 'ABC song with colorful letters'
    ],
    [
        'id' => 'EemjeA2Djjw',
        'title' => 'Learn Colors',
        'description' => 'Basic colors with examples'
    ],
    [
        'id' => 'DEHBrmZxAf8',
        'title' => 'Learn Shapes',
        'description' => 'Basic shapes for kids'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        
        .video-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }
        
        .video-card:hover {
            transform: translateY(-5px);
        }
        
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
        }
        
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .video-info {
            padding: 15px;
        }
        
        .video-title {
            font-size: 1.2em;
            margin: 0 0 10px 0;
            color: #333;
        }
        
        .video-description {
            color: #666;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="videos-section">
        <h2>Educational Videos</h2>
        
        <div class="video-grid">
            <?php foreach ($videos as $video): ?>
                <div class="video-card">
                    <div class="video-container">
                        <iframe 
                            src="https://www.youtube.com/embed/<?php echo htmlspecialchars($video['id']); ?>?rel=0" 
                            title="<?php echo htmlspecialchars($video['title']); ?>"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="video-info">
                        <h3 class="video-title"><?php echo htmlspecialchars($video['title']); ?></h3>
                        <p class="video-description"><?php echo htmlspecialchars($video['description']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>