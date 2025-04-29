<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}
include '../includes/header.php';

// Array of animals with their images (using online images)
$animals = [
    ['name' => 'Lion', 'image' => 'https://cdn.pixabay.com/photo/2018/07/31/22/08/lion-3576045_1280.jpg'],
    ['name' => 'Elephant', 'image' => 'https://cdn.pixabay.com/photo/2016/11/14/04/45/elephant-1822636_1280.jpg'],
    ['name' => 'Giraffe', 'image' => 'https://cdn.pixabay.com/photo/2019/07/27/06/21/giraffe-4366005_1280.jpg'],
    ['name' => 'Zebra', 'image' => 'https://images.unsplash.com/photo-1526319238109-524eecb9b913?q=80&w=2024&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
    ['name' => 'Tiger', 'image' => 'https://cdn.pixabay.com/photo/2015/12/18/13/46/tiger-1098607_1280.jpg'],
    ['name' => 'Monkey', 'image' => 'https://cdn.pixabay.com/photo/2019/07/24/14/17/monkey-4360298_1280.jpg'],
    ['name' => 'Penguin', 'image' => 'https://cdn.pixabay.com/photo/2016/09/29/16/40/king-penguin-1703294_1280.jpg'],
    ['name' => 'Kangaroo', 'image' => 'https://images.unsplash.com/photo-1551270988-87c5ea57cdfe?q=80&w=1995&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
    ['name' => 'Koala', 'image' => 'https://cdn.pixabay.com/photo/2013/01/14/12/21/koala-74908_1280.jpg'],
    ['name' => 'Donkey', 'image' => 'https://images.unsplash.com/photo-1568495732369-3a3f5b5290dd?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
    ['name' => 'honey Badger', 'image' => 'https://plus.unsplash.com/premium_photo-1661895046602-74112473e72e?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
    ['name' => 'Dolphin', 'image' => 'https://cdn.pixabay.com/photo/2013/11/01/11/13/dolphin-203875_1280.jpg']
];

// Array of countries with their flags (using online images)
$countries = [
    ['name' => 'Palestine', 'image' => 'https://upload.wikimedia.org/wikipedia/commons/0/00/Flag_of_Palestine.svg'],
    ['name' => 'Morocco', 'image' => 'https://upload.wikimedia.org/wikipedia/commons/2/2c/Flag_of_Morocco.svg'],
    ['name' => 'United States', 'image' => 'https://images.unsplash.com/photo-1581024013650-28295fd60327?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
    ['name' => 'Canada', 'image' => 'https://media.istockphoto.com/id/171263903/photo/canadian-flag-with-nice-satin-texture.jpg?s=2048x2048&w=is&k=20&c=DuEIS1Pl7BE7BI_-aNFiU6dgZ6bZpOAPD8GcET4gbDA='],
    ['name' => 'United Kingdom', 'image' => 'https://plus.unsplash.com/premium_photo-1674591172569-834e3c928c3d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
    ['name' => 'France', 'image' => 'https://images.unsplash.com/photo-1675855508131-798d42b6f1ee?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
    ['name' => 'Germany', 'image' => 'https://plus.unsplash.com/premium_photo-1674590091046-18f2ad87f344?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
    ['name' => 'Japan', 'image' => 'https://plus.unsplash.com/premium_photo-1675865394925-8ccfb93e2dc8?q=80&w=1925&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
    ['name' => 'Australia', 'image' => 'https://plus.unsplash.com/premium_photo-1675865393568-4bbf930ac1fb?q=80&w=1925&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
    ['name' => 'Brazil', 'image' => 'https://plus.unsplash.com/premium_photo-1674591173482-ffb087662b4d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
    ['name' => 'India', 'image' => 'https://plus.unsplash.com/premium_photo-1674591172888-1184c4170a47?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
    ['name' => 'Mexico', 'image' => 'https://plus.unsplash.com/premium_photo-1674591172745-448b9777dac8?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D']
];
?>

<div class="discovery-container">
    <div class="discovery-header">
        <h1>Discovery Zone</h1>
        <p class="discovery-description">Hover over each image to reveal its name! Learn about animals and countries from around the world.</p>
    </div>
    
    <div class="discovery-tabs">
        <button class="tab-button active" onclick="openTab('animals')">Animals</button>
        <button class="tab-button" onclick="openTab('countries')">Countries</button>
    </div>
    
    <div id="animals" class="tab-content active">
        <h2>Animal Kingdom</h2>
        <div class="learning-grid">
            <?php foreach ($animals as $animal): ?>
                <div class="learning-card">
                    <img src="<?php echo $animal['image']; ?>" alt="Animal" class="learning-image">
                    <div class="learning-name"><?php echo $animal['name']; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div id="countries" class="tab-content">
        <h2>World Countries</h2>
        <div class="learning-grid">
            <?php foreach ($countries as $country): ?>
                <div class="learning-card">
                    <img src="<?php echo $country['image']; ?>" alt="Country" class="learning-image">
                    <div class="learning-name"><?php echo $country['name']; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <a href="../index.php" class="check-button">Back to Home</a>
</div>

<script>
function openTab(tabName) {
    // Hide all tab contents
    var tabContents = document.getElementsByClassName("tab-content");
    for (var i = 0; i < tabContents.length; i++) {
        tabContents[i].classList.remove("active");
    }
    
    // Remove active class from all tab buttons
    var tabButtons = document.getElementsByClassName("tab-button");
    for (var i = 0; i < tabButtons.length; i++) {
        tabButtons[i].classList.remove("active");
    }
    
    // Show the selected tab content and mark its button as active
    document.getElementById(tabName).classList.add("active");
    event.currentTarget.classList.add("active");
}
</script>

<?php include '../includes/footer.php'; ?>