<?php
    declare(strict_types=1);

    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../includes/session.php');

    // Get form data
    $name = $_POST['name'] ?? '';
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    $session = Session::getInstance();
    
    // Check if it's an AJAX request
    $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    
    // Basic validation
    if (empty($name) || empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        if ($isAjax) {
            http_response_code(400);
            echo json_encode(['error' => 'All fields are required']);
            exit();
        } else {
            $_SESSION['error'] = 'All fields are required';
            header('Location: ../index.php');
            exit();
        }
    } else if ($password !== $confirm_password) {
        if ($isAjax) {
            http_response_code(400);
            echo json_encode(['error' => 'Password and confirmation do not match']);
            exit();
        } else {
            $_SESSION['error'] = 'Password and confirmation do not match';
            header('Location: ../index.php');
            exit();
        }
    } else {
        $user = User::create('regular', $name, $username, $email, $password);
        if ($user) {
            if ($isAjax) {
                http_response_code(200);
                echo json_encode(['success' => true]);
                exit();
            } else {
                // Set client-side storage variables via JavaScript
                echo '<script>
                    sessionStorage.setItem("signup_success", "true");
                    sessionStorage.setItem("signup_username", "' . addslashes($email) . '");
                    sessionStorage.setItem("signup_password", "' . addslashes($password) . '");
                    window.location.href = "../index.php";
                </script>';
                exit();
            }
        } else {
            if ($isAjax) {
                http_response_code(400);
                echo json_encode(['error' => 'Signup failed. User might already exist.']);
                exit();
            } else {
                $_SESSION['error'] = 'Signup failed';
                header('Location: ../index.php');
                exit();
            }
        }
    }
?>