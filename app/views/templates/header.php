<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $params['title']; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= BASE_URL; ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= BASE_URL; ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php if ($params['userdata']['role_user'] === '0' || $params['userdata']['role_user'] === 0) : ?>
            <?= \Inventaris\Core\Ardent::loadSpesificViews("templates.user.sidebar", $params) ?>
        <?php elseif ($params['userdata']['role_user'] === '1' || $params['userdata']['role_user'] === 1) : ?>
            <?= \Inventaris\Core\Ardent::loadSpesificViews("templates.petugas.sidebar", $params) ?>
        <?php else : ?>
            <?= \Inventaris\Core\Ardent::loadSpesificViews("templates.admin.sidebar", $params) ?>
        <?php endif; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?= \Inventaris\Core\Ardent::loadSpesificViews("templates.topbar", $params); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">