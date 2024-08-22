<?php
include './partials/header.php';
?>

<style>
    main {
        overflow: hidden;
    }
</style>

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
    <h1>Start Schedule</h1>

    <div class="start">
        <?php
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $connection->real_escape_string($_GET['id']);
            $sql = "SELECT * FROM exercises WHERE workout_id = $id";
            $result = $connection->query($sql);
            $exercises = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $exercises[] = $row;
                }
            } else {
                echo "<p>No exercises found for this schedule.</p>";
                exit();
            }
        } else {
            echo "<p>Invalid schedule ID.</p>";
            exit();
        }
        ?>

        <div class="timer_names">
            <span id="exercise-name"><?php echo htmlspecialchars($exercises[0]['name']); ?></span>
            <h2 id="next"></h2>
        </div>

        <span id="timer">00:<?php echo str_pad(htmlspecialchars($exercises[0]['duration']), 2, '0', STR_PAD_LEFT); ?></span>

        <div class="buttons">
            <div class="btn danger" id="stop-btn">Stop</div>
            <div class="btn" id="restart-btn">Restart</div>
        </div>
    </div>

    <audio id="bip-sound" src="bip.mp3" preload="auto"></audio>

</main>

<script>
    let exercises = <?php echo json_encode($exercises); ?>;
    let currentExercise = 0;
    let exerciseTimer;
    let restTimer;
    let isPaused = false;
    let pausedTime = 0;
    let remainingTime;
    let bipSound = document.getElementById('bip-sound');
    let preparationTime = 10;

    function startPreparation() {
        document.getElementById('exercise-name').innerText = "Preparati!";
        preparationTimer = startTimer(preparationTime, startExercise);
    }

    function updateTimerDisplay(time) {
        const minutes = Math.floor(time / 60);
        const seconds = time % 60;
        document.getElementById('timer').innerText = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }

    function updateNextExerciseDisplay() {
        if (currentExercise < exercises.length - 1) {
            document.getElementById('next').innerText = `Next: ${exercises[currentExercise + 1].name}`;
        } else {
            document.getElementById('next').style.display = "none";
        }
    }

    function startTimer(duration, onEnd) {
        remainingTime = duration;
        updateTimerDisplay(remainingTime);

        let interval = setInterval(() => {
            if (!isPaused) {
                if (remainingTime > 0) {
                    remainingTime--;
                    updateTimerDisplay(remainingTime);
                } else {
                    clearInterval(interval);
                    bipSound.play();
                    onEnd();
                }
            }
        }, 1000);

        return interval;
    }

    function startExercise() {
        let duration = exercises[currentExercise].duration;
        document.getElementById('exercise-name').innerText = exercises[currentExercise].name;
        updateNextExerciseDisplay();
        exerciseTimer = startTimer(duration, startRest);
    }

    function startRest() {
        let rest = exercises[currentExercise].rest;
        document.getElementById('exercise-name').innerText = "Rest";
        updateNextExerciseDisplay();
        restTimer = startTimer(rest, () => {
            currentExercise++;
            if (currentExercise < exercises.length) {
                startExercise();
            } else {
                document.getElementById('exercise-name').innerText = "Workout Complete!";
                updateTimerDisplay(0);
                document.getElementById('next').style.display = "none";
            }
        });
    }

    document.getElementById('stop-btn').addEventListener('click', () => {
        if (!isPaused) {
            clearInterval(exerciseTimer);
            clearInterval(restTimer);
            isPaused = true;
            document.getElementById('stop-btn').innerText = "Resume";
        } else {
            isPaused = false;
            document.getElementById('stop-btn').innerText = "Stop";
            if (document.getElementById('exercise-name').innerText === "Rest") {
                restTimer = startTimer(remainingTime, startRest);
            } else {
                exerciseTimer = startTimer(remainingTime, startRest);
            }
        }
    });

    document.getElementById('restart-btn').addEventListener('click', () => {
        clearInterval(exerciseTimer);
        clearInterval(restTimer);
        isPaused = false;
        remainingTime = 0;
        document.getElementById('stop-btn').innerText = "Stop";
        currentExercise = 0;
        startPreparation();
    });

    startPreparation();
</script>

</body>

</html>