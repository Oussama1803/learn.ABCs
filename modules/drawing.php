<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: /login.php');
    exit;
}

include '../includes/header.php';

$drawingPrompts = [
    "Draw a happy sun",
    "Draw a house with a garden",
    "Draw your favorite animal",
    "Draw a beautiful flower",
    "Draw a rainbow",
    "Draw a funny face",
    "Draw a tree with fruits",
    "Draw a butterfly"
];

$currentPrompt = $drawingPrompts[array_rand($drawingPrompts)];
?>

<div class="drawing-container">
    <h2>Drawing Fun!</h2>
    <div class="drawing-prompt">
        <h3>Today's Challenge:</h3>
        <p><?php echo $currentPrompt; ?></p>
    </div>
    
    <div class="tools">
        <button onclick="setColor('red')" class="color-btn red">Red</button>
        <button onclick="setColor('blue')" class="color-btn blue">Blue</button>
        <button onclick="setColor('green')" class="color-btn green">Green</button>
        <button onclick="setColor('yellow')" class="color-btn yellow">Yellow</button>
        <button onclick="clearCanvas()" class="clear-btn">Clear</button>
        <button onclick="saveDrawing()" class="save-btn">Save Drawing</button>
    </div>
    
    <canvas id="drawingCanvas" width="800" height="600"></canvas>
</div>

<script>
const canvas = document.getElementById('drawingCanvas');
const ctx = canvas.getContext('2d');
let isDrawing = false;
let currentColor = 'black';

function setColor(color) {
    currentColor = color;
}

function clearCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function saveDrawing() {
    const image = canvas.toDataURL('image/png');
    const link = document.createElement('a');
    link.download = 'my-drawing.png';
    link.href = image;
    link.click();
}

canvas.addEventListener('mousedown', startDrawing);
canvas.addEventListener('mousemove', draw);
canvas.addEventListener('mouseup', stopDrawing);
canvas.addEventListener('mouseout', stopDrawing);

function startDrawing(e) {
    isDrawing = true;
    draw(e);
}

function draw(e) {
    if (!isDrawing) return;
    
    const rect = canvas.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    
    ctx.lineWidth = 5;
    ctx.lineCap = 'round';
    ctx.strokeStyle = currentColor;
    
    ctx.lineTo(x, y);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(x, y);
}

function stopDrawing() {
    isDrawing = false;
    ctx.beginPath();
}
</script>