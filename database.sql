-- Crea il database (nome a vosta scelta, da inserire anche su config/constants.php )
CREATE DATABASE IF NOT EXISTS mygym;
USE mygym;

-- Crea la tabella `workouts`
CREATE TABLE IF NOT EXISTS workouts (
	id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    goal VARCHAR(255) DEFAULT NULL,
    image_url VARCHAR(255),
    exercises_count INT DEFAULT 0,
    total_duration INT DEFAULT 0
);

-- Crea la tabella `exercises`
CREATE TABLE IF NOT EXISTS exercises (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    duration INT NOT NULL,
    rest INT NOT NULL,
    workout_id INT,
    FOREIGN KEY (workout_id) REFERENCES workouts(id) ON DELETE CASCADE
);

-- Crea la tabella `workout_exercises`
CREATE TABLE IF NOT EXISTS workout_exercises (
    id INT AUTO_INCREMENT PRIMARY KEY,
    workout_id INT,
    exercise_id INT,
    exercise_duration INT,
    rest_duration INT,
    FOREIGN KEY (workout_id) REFERENCES workouts(id),
    FOREIGN KEY (exercise_id) REFERENCES exercises(id)
);