<?php
    include_once "../../include/dbcon.php";

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../../admin/?q=course&error=Invalid+request');
        exit();
    }

    // Get form data
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $course = intval($_POST['course']);

    if (empty($title)) {
        header("Location: ../../admin/?e=course&id=" . encryptSt($id) . "&error=Title+are+required+fields.");
        exit();
    }

    // Update or Insert
    if (!empty($id)) {
        $sql = "UPDATE course_module SET title = ? WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si",$title, $id);
        
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../../admin/?e=course_module&id=" . encryptSt($id) . "&success=Course+updated+successfully!");
            exit();
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    } else {
        $sql = "INSERT INTO course_module (title, course_id) VALUES (?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $title, $course);
        if ($stmt->execute()) {
            $new_id = $conn->insert_id;
            $stmt->close();
            header("Location: ../../admin/?e=course_module&id=" . encryptSt($new_id) . "&success=Course+created+successfully!");
            exit();
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    }

    $conn->close();
?>