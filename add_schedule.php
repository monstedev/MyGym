<?php
include './partials/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $connection->real_escape_string($_POST['name']);
    $goal = $connection->real_escape_string($_POST['goal']);
    $image_url = $connection->real_escape_string($_POST['image_url']);

    $sql = "INSERT INTO workouts (name, goal, image_url) VALUES ('$name', '$goal', '$image_url')";

    if ($connection->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}
?>

<aside>
    <aside>
        <div class="top">
            <a href="<?php echo ROOT__URL ?>index.php">
                <div class="logo">
                    <h2>My<span class="primary">Gym</span></h2>
                </div>
            </a>
            <div class="close" id="close-btn">
                <span class="material-icons-sharp">close</span>
            </div>
        </div>

        <div class="sidebar">
            <a href="<?php echo ROOT__URL ?>index.php">
                <span class="material-icons-sharp">home</span>
                <h3>Home</h3>
            </a>
            <a href="<?php echo ROOT__URL ?>dashboard.php" class="active">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Dashboard</h3>
            </a>
        </div>
    </aside>
</aside>

<main class="add-schedule">
    <div class="add-form">
        <h1>Add New Schedule</h1>
        <form method="POST" action="add_schedule.php">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="goal">Goal</label>
                <input type="text" name="goal" id="goal" required>
            </div>
            <div class="form-group">
                <label for="image_url">Image URL</label>
                <input type="text" name="image_url" id="image_url" required>
            </div>
            <button type="submit" class="btn">Add Schedule</button>
        </form>
    </div>
</main>

</body>

</html>