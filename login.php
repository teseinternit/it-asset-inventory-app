<?php
include "conn.php";
session_start();

if (isset($_POST['employee_id']) && isset($_POST['password'])) {
    function validate($data) {
        return htmlspecialchars(trim($data));
    }

    $employee_id = validate($_POST['employee_id']);
    $password = validate($_POST['password']);

    if (empty($employee_id)) {
        $_SESSION['error'] = "Employee_id is required";
        header("Location: index.php");
        exit();
    } else if (empty($password)) {
        $_SESSION['error'] = "Password is required";
        header("Location: index.php");
        exit();
    } else {
        $stmt = $conn->prepare("SELECT * FROM it_team WHERE employee_id = ?");
        $stmt->bind_param("s", $employee_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['itteam_id'] = $row['itteam_id'];
                $_SESSION['employee_id'] = $row['employee_id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['role'] = $row['role'];
                
                if ($row['role'] === 'Super User') {
                    header("Location: dashboard.php?role=super_user");
                } elseif ($row['role'] === 'User') {
                    header("Location: dashboard.php?role=user");
                } else {
                    header("Location: index.php?error=Unauthorized role");
                }
                exit();
            } else {
                $_SESSION['error'] = "Invalid employee_id or password";
                header("Location: index.php?error=Invalid Employee ID or Password");
                exit();
            }
        } else {
            $_SESSION['error'] = "Invalid employee_id or password";
            header("Location: index.php?error=Invalid Employee ID or Password");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}