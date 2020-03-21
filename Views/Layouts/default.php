<!doctype html>
<head>
    <meta charset="utf-8">
    <title>MVC Test Task</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <style>
        body {
            padding-top: 5rem;
        }
        .starter-template {
            padding: 3rem 1.5rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= WEBROOT ?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <?php if (isset($_SESSION["admin_id"]) && $_SESSION["admin_id"]): ?>
                        <a class="nav-link" href="<?= WEBROOT ?>site/logout">Logout <span class="sr-only">(current)</span></a>
                    <?php else: ?>
                        <a class="nav-link" href="<?= WEBROOT ?>site/login">Login <span class="sr-only">(current)</span></a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>

    <main role="main" class="container">
        <?php
        use \Tamtamchik\SimpleFlash\Flash;
        // Rendering all flash
        $output = flash()->display();
        echo $output;
        ?>
        <div class="starter-template">
            <?php
            echo $content_for_layout;
            ?>
        </div>
    </main>
</body>
</html>
