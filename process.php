<?php
require_once 'db_connect.php';

// Add new goal
if (isset($_POST['add_goal'])) {
    $goal_text = $conn->real_escape_string($_POST['goal_text']);
    $goal_type = $conn->real_escape_string($_POST['goal_type']);
    
    $sql = "INSERT INTO goals (goal_text, goal_type, completed) VALUES ('$goal_text', '$goal_type', 0)";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Mark goal as completed
if (isset($_POST['check_goal'])) {
    $goal_id = $conn->real_escape_string($_POST['goal_id']);
    
    $sql = "UPDATE goals SET completed = 1 WHERE id = $goal_id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Mark goal as not completed
if (isset($_POST['uncheck_goal'])) {
    $goal_id = $conn->real_escape_string($_POST['goal_id']);
    
    $sql = "UPDATE goals SET completed = 0 WHERE id = $goal_id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Delete goal
if (isset($_POST['delete_goal'])) {
    $goal_id = $conn->real_escape_string($_POST['goal_id']);
    
    $sql = "DELETE FROM goals WHERE id = $goal_id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Redirect to index if accessed directly
header("Location: index.php");
exit();
?>