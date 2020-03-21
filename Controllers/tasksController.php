<?php

class tasksController extends Controller
{
    function index($success = 0)
    {
        require(ROOT . 'Models/Task.php');

        $tasks = new Task();
        $page = $_GET['page'] ?? 1;
        $perPage = 3;
        $offset = ($page - 1) * $perPage;
        $totalRows = $tasks->totalRows();
        $totalPages = ceil($totalRows / $perPage);

        if ($success == 1) {
            flash()->success('Task Successfully Added!');
        }

        $this->set([
            'tasks' => $tasks->showAllTasks($perPage, $offset),
            'totalPages' => $totalPages,
            'page' => $page,
        ]);
        $this->render("index");
    }

    function datatable($queryString = null)
    {
        require(ROOT . 'Helpers/ssp.class.php');

        $columns = [
            ['db' => 'id', 'dt' => 'id'],
            ['db' => 'username', 'dt' => 'username'],
            ['db' => 'email', 'dt' => 'email'],
            ['db' => 'text', 'dt' => 'text'],
            ['db' => 'is_completed', 'dt' => 'is_completed'],
        ];

        if (substr($queryString, 0, 1) === '?') {
            $queryString = substr($queryString, 1);
        }

        parse_str($queryString, $data);

        echo json_encode(
            SSP::simple($data, Database::getBdd(), 'tasks', 'id', $columns)
        );
        exit;
    }

    function create()
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $text = $_POST['text'] ?? '';

            if (!$username) {
                $errors[] = 'Username required.';
            }

            if (!$email) {
                $errors[] = 'Email required.';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }

            if (!$text) {
                $errors[] = 'Text required.';
            }

            if ($errors) {
                $error = implode('<br />', $errors);
            } else {
                require(ROOT . 'Models/Task.php');

                $task = new Task();

                if ($task->create($username, $email, $text)) {
                    header("Location: " . WEBROOT . "tasks/index/1");
                }
            }
        }

        if ($error) {
            flash()->error($error);
        }

        $this->set([
            'task' => [
                'username' => $username ?? '',
                'text' => $text ?? '',
                'email' => $email ?? '',
            ],
        ]);
        $this->render("create");
    }

    function edit($id = null)
    {
        require(ROOT . 'Models/Task.php');
        $task = new Task();
        $error = '';

        if (!isset($_SESSION["admin_id"]) || !$_SESSION["admin_id"]) {
            $error = "You don't have permission to edit this page";
        } elseif (!$id) {
            $error = 'Something went wrong';
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $text = $_POST['text'] ?? '';

            if (!$text) {
                $error = 'Text required.';
            } elseif ($task->edit($id, $text, (int)$_POST['is_completed'])) {
                header("Location: " . WEBROOT . "tasks/index");
            } else {
                $error = 'Something went wrong';
            }
        }

        if ($error) {
            flash()->error($error);
        }

        $this->set([
            'task' => $task->showTask($id),
            'error' => (bool)$error,
        ]);
        $this->render("edit");
    }

    function delete($id = null)
    {
        if (!isset($_SESSION["admin_id"]) || !$_SESSION["admin_id"]) {
            require(ROOT . 'Models/Task.php');

            $task = new Task();
            if ($task->delete($id)) {

            }
        }

        header("Location: " . WEBROOT . "tasks/index");
    }
}
