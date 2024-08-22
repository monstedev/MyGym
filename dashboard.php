<?php
include './partials/header.php';

// Esegui la query di aggiornamento manuale
$sql = "UPDATE workouts w
        LEFT JOIN (
            SELECT workout_id, COUNT(*) AS exercises_count, SUM(duration + rest) AS total_duration
            FROM exercises
            GROUP BY workout_id
        ) e ON w.id = e.workout_id
        SET w.exercises_count = IFNULL(e.exercises_count, 0),
            w.total_duration = IFNULL(e.total_duration, 0)";
$connection->query($sql);

// Aggiungi un nuovo esercizio
if (isset($_POST['add_exercise'])) {
    $workout_id = $connection->real_escape_string($_POST['id']);
    $exercise_name = $connection->real_escape_string($_POST['exercise_name']);
    $duration = $connection->real_escape_string($_POST['duration']);
    $rest = $connection->real_escape_string($_POST['rest']);

    $sql = "INSERT INTO exercises (name, duration, rest, workout_id) VALUES ('$exercise_name', '$duration', '$rest', '$workout_id')";
    if ($connection->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Elimina esercizio
if (isset($_POST['delete_exercise'])) {
    $exercise_id = $connection->real_escape_string($_POST['exercise_id']);
    $workout_id = $connection->real_escape_string($_POST['workout_id']);

    $sql = "DELETE FROM exercises WHERE id = '$exercise_id' AND workout_id = '$workout_id'";
    if ($connection->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Aggiorna l'esercizio
if (isset($_POST['update_exercise'])) {
    $exercise_id = $connection->real_escape_string($_POST['exercise_id']);
    $workout_id = $connection->real_escape_string($_POST['workout_id']);
    $exercise_name = $connection->real_escape_string($_POST['exercise_name']);
    $duration = $connection->real_escape_string($_POST['duration']);
    $rest = $connection->real_escape_string($_POST['rest']);

    $sql_update = "UPDATE exercises SET name='$exercise_name', duration='$duration', rest='$rest' WHERE id='$exercise_id' AND workout_id='$workout_id'";
    if ($connection->query($sql_update) === FALSE) {
        echo "Error updating exercise: " . $connection->error;
    }
}

// Elimina la scheda
if (isset($_POST['delete_schedule'])) {
    $schedule_id = $connection->real_escape_string($_POST['schedule_id']);
    $sql = "DELETE FROM workouts WHERE id = '$schedule_id'";
    if ($connection->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

    $sql = "DELETE FROM exercises WHERE workout_id = '$schedule_id'";
    if ($connection->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Aggiorna i dettagli della scheda
if (isset($_POST['update_schedule'])) {
    $schedule_id = $connection->real_escape_string($_POST['schedule_id']);
    $name = $connection->real_escape_string($_POST['name']);
    $goal = $connection->real_escape_string($_POST['goal']);
    $image_url = $connection->real_escape_string($_POST['image_url']);

    $sql = "UPDATE workouts SET name = '$name', goal = '$goal', image_url = '$image_url' WHERE id = '$schedule_id'";
    if ($connection->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}
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
        <a href="<?php echo ROOT__URL ?>dashboard.php" class="active">
            <span class="material-icons-sharp">grid_view</span>
            <h3>Dashboard</h3>
        </a>
    </div>
</aside>

<main>
    <h1>Dashboard</h1>

    <div class="schedules dashboard_schedules">
        <?php
        $sql = "SELECT * FROM workouts ORDER BY id DESC";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
        ?>
                <form method="POST" action="dashboard.php">
                    <div class="schedule">
                        <div class="row">
                            <div class="infos">
                                <h2><input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>"></h2>

                                <div class="informations">
                                    <div class="info">
                                        <h3>Duration: </h3>
                                        <span class="primary"><?php echo htmlspecialchars(round($row['total_duration'] / 60)); ?> min</span>
                                    </div>
                                    <div class="info">
                                        <h3>Exercises: </h3>
                                        <span class="primary"><?php echo htmlspecialchars($row['exercises_count']); ?></span>
                                    </div>
                                    <div class="info">
                                        <h3>Goal: </h3>
                                        <span class="primary"><input type="text" name="goal" value="<?php echo htmlspecialchars($row['goal']); ?>"></span>
                                    </div>
                                    <div class="info">
                                        <h3>Image URL: </h3>
                                        <span class="primary"><input type="text" name="image_url" value="<?php echo htmlspecialchars($row['image_url']); ?>"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="img">
                                <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="exercises">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Duration</th>
                                            <th>Rest</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql_exercises = "SELECT * FROM exercises WHERE workout_id = '$id'";
                                        $result_exercises = $connection->query($sql_exercises);

                                        if ($result_exercises->num_rows > 0) {
                                            while ($exercise = $result_exercises->fetch_assoc()) {
                                        ?>
                                                <form method="POST" action="dashboard.php">
                                                    <tr id="withtd">
                                                        <td>
                                                            <input type="hidden" name="exercise_id" value="<?php echo $exercise['id']; ?>">
                                                            <input type="hidden" name="workout_id" value="<?php echo $id; ?>">
                                                            <input type="text" name="exercise_name" placeholder="Exercise Name" value="<?php echo htmlspecialchars($exercise['name']); ?>" id="name" required>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="duration" placeholder="Duration (s)" value="<?php echo htmlspecialchars($exercise['duration']); ?>" required> s
                                                        </td>
                                                        <td>
                                                            <input type="number" name="rest" placeholder="Rest (s)" value="<?php echo htmlspecialchars($exercise['rest']); ?>" required> s
                                                        </td>
                                                        <td>
                                                            <button type="submit" name="update_exercise" class="btn">Update</button>
                                                        </td>
                                                        <td>
                                                            <button type="submit" name="delete_exercise" class="btn danger" formnovalidate>Delete</button>
                                                        </td>
                                                    </tr>
                                                </form>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>No exercises found</td></tr>";
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="add-exercise">
                                <h3>Add Exercise</h3>
                                <div class="buttons">
                                    <input type="text" name="exercise_name" placeholder="Exercise Name" required>
                                    <input type="number" name="duration" placeholder="Duration (s)" required>
                                    <input type="number" name="rest" placeholder="Rest (s)" required>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <button type="submit" name="add_exercise" class="btn primary">Add</button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="buttons">
                                <input type="hidden" name="schedule_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="update_schedule" class="btn" formnovalidate>Update</button>
                                <button type="submit" name="delete_schedule" class="btn danger" formnovalidate>Delete</button>
                            </div>
                        </div>
                    </div>
                </form>
        <?php
            }
        } else {
            echo '<p class="notfound">No schedules found.</p>';
        }
        ?>
    </div>
    <a href="<?php ROOT__URL ?>add_schedule.php" class="btn add">Add Schedule</a>
</main>

</body>

</html>