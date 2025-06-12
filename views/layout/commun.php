<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>public/style/style.css">
    <meta name="description" content="<?= $description ?>">
    <title><?= $title ?></title>
</head>

<body class="d-flex flex-column min-vh-100">


    <?php require_once('./views/layout/navbar.php') ?>

    <main class="flex-fill">
        <div class="container mt-4">
            <?= $content ?>
        </div>
    </main>

    <footer class="border-top border-black p-4 mt-auto">
        <?php require_once('./views/layout/footer.php') ?>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>