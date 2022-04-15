<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle; ?></title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <script defer src="/assets/js/bootstrap.bundle.js"></script>
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
</head>

<body style="height: 100vh;">
    <?= $this->renderSection('content'); ?>
</body>

</html>