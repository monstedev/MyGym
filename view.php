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
        <a href="<?php echo ROOT__URL ?>index.php">
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
    <div class="view">
        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM workouts WHERE id=$id";
        $result = $connection->query($sql);
        $workout = $result->fetch_assoc();

        echo '<h2>' . htmlspecialchars($workout['name']) . '</h2>';
        echo '<p>Duration: ' . round($workout['total_duration'] / 60) . ' min</p>';
        echo '<p>Exercises: ' . htmlspecialchars($workout['exercises_count']) . '</p>';
        ?>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Exercise Name</th>
                    <th>Duration</th>
                    <th>Rest</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_exercises = "SELECT * FROM exercises WHERE workout_id = $id";
                $result_exercises = $connection->query($sql_exercises);

                if ($result_exercises->num_rows > 0) {
                    $i = 1;
                    while ($row = $result_exercises->fetch_assoc()) {
                        echo '<tr>';
                        echo '  <td>' . $i++ . '</td>';
                        echo '  <td>' . htmlspecialchars($row['name']) . '</td>';
                        echo '  <td>' . htmlspecialchars($row['duration']) . 's</td>';
                        echo '  <td>' . htmlspecialchars($row['rest']) . 's</td>';
                        echo '</tr>';
                    }
                } else {
                    echo "<tr><td colspan='4'>No exercises found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</main>

</body>

</html>