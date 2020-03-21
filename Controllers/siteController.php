<?php

class siteController extends Controller
{
    function login()
    {
        require(ROOT . 'Models/Admin.php');

        $password = $_POST['password'] ?? '';
        $username = $_POST['username'] ?? '';
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($password && $username) {
                $admin = new Admin();
                $admin = $admin->getAdminByUsername($username);

                if (password_verify($password, $admin['password'])) {
                    $_SESSION["admin_id"] = $admin['id'];
                    $_SESSION["username"] = $admin['username'];

                    header("Location: " . WEBROOT . "tasks/index");
                } else {
                    $error = 'Invalid username or password';
                }
            } else {
                $errors = [];

                if (!$username) {
                    $errors[] = 'Username required.';
                }

                if (!$password) {
                    $errors[] = 'Password required.';
                }

                if ($errors) {
                    $error = implode('<br />', $errors);
                }
            }
        }

        $this->set([
            'username' => $username,
            'error' => $error,
        ]);

        $this->render("login");
    }

    function logout()
    {
        $_SESSION = [];
        session_destroy();
        header("Location: " . WEBROOT . "tasks/index");
        exit;
    }
}
