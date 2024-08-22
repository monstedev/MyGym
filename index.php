<?php
include './partials/header.php';
?>

<aside>
    <div class="top">
        <a href="<?php echo ROOT__URL ?>index.php">
            <div class="logo">
                <h2>My<span class="text-primary">Gym</span></h2>
            </div>
        </a>
        <div class="close" id="close-btn">
            <span class="material-icons-sharp">close</span>
        </div>
    </div>

    <div class="sidebar">
        <a href="<?php echo ROOT__URL ?>index.php" class="active">
            <span class="material-icons-sharp">home</span>
            <h3>Home</h3>
        </a>
        <a href="<?php echo ROOT__URL ?>dashboard.php">
            <span class="material-icons-sharp">grid_view</span>
            <h3>Dashboard</h3>
        </a>
    </div>
</aside>

<main>
    <h1>My Schedules</h1>

    <div class="schedules">
        <?php
        $sql = "SELECT w.*, 
                       (SELECT SUM(e.duration + e.rest) FROM exercises e JOIN workout_exercises we ON e.id = we.exercise_id WHERE we.workout_id = w.id) AS duration
                FROM workouts w";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="schedule">';
                echo '  <div class="row">';
                echo '      <div class="infos">';
                echo '          <h2 class="text-primary">' . htmlspecialchars($row['name']) . '</h2>';
                echo '          <div class="informations">';
                echo '              <div class="info">';
                echo '                  <h3>Duration: </h3><span class="primary">' . htmlspecialchars(round($row['total_duration'] / 60)) . ' min</span>';
                echo '              </div>';
                echo '              <div class="info">';
                echo '                  <h3>Exercises: </h3> <span class="primary">' . htmlspecialchars($row['exercises_count']) . '</span>';
                echo '              </div>';
                echo '              <div class="info">';
                echo '                  <h3>Goal: </h3> <span class="primary">' . htmlspecialchars($row['goal']) . '</span>';
                echo '              </div>';
                echo '          </div>';
                echo '      </div>';
                echo '      <div class="img">';
                echo '          <img src="' . htmlspecialchars($row['image_url']) . '" alt="Workout Image">';
                echo '      </div>';
                echo '  </div>';

                echo '  <div class="row">';
                echo '      <div class="buttons">';
                echo '          <a class="btn" href="' . ROOT__URL . 'start.php?id=' . $row['id'] . '">Start</a>';
                echo '          <a class="btn" href="' . ROOT__URL . 'view.php?id=' . $row['id'] . '">View</a>';
                echo '      </div>';
                echo '  </div>';
                echo '</div>';
            }
        } else {
            echo '<p class="notfound">No workouts found.</p>';
        }
        ?>
    </div>

</main>

</body>

</html>