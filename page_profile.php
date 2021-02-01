<?php
session_start();
include_once 'functions.php';
if (is_not_logged_in()) {
    redirect_to('page_login.php');
    exit();
}
// если есть GET['id'] переходим на профиль по GET['id'] иначе по id авторизованного пользователя
$id = isset($_GET['id']) ? intval($_GET['id']) : $_SESSION['user']['id'];
$user = get_user_by_id($id);
$name = $user['name']?$user['name']:"";
$email = $user['email']?$user['email']:"";
$phone = $user['phone']?$user['phone']:"";
$job_title = $user['job_title']?$user['job_title']:"";
$address = $user['address']?$user['address']:"";
$status = $user['status']?$user['status']:"";
$vk = $user['vk']?$user['vk']:"";
$telegram = $user['telegram']?$user['telegram']:"";
$instagram = $user['instagram']?$user['instagram']:"";
$img = $user['img']?$user['img']:"";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Профиль пользователя</title>
    <meta name="description" content="Chartist.html">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
    <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-regular.css">
</head>
<body class="mod-bg-1 mod-nav-link">
<?php include 'nav_component.php' ?>
<main id="js-page-content" role="main" class="page-content mt-3">
    <?php
    if (isset($_SESSION['success'])) {
        display_flash_message("success");
    }
    if (isset($_SESSION['danger'])) {
        display_flash_message("danger");
    }
    ?>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-user'></i> <?= $name ?>
        </h1>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xl-6 m-auto">
            <!-- profile summary -->
            <div class="card mb-g rounded-top">
                <div class="row no-gutters row-grid">
                    <div class="col-12">
                        <div class="d-flex flex-column align-items-center justify-content-center p-4">
                            <img src="<?= $img ?>"
                                 class="rounded-circle shadow-2 img-thumbnail" alt="">
                            <h5 class="mb-0 fw-700 text-center mt-3">
                                <?= $name ?>
                                <small class="text-muted mb-0"><?= $address ?></small>
                            </h5>
                            <div class="mt-4 text-center demo">
                                <a href="javascript:void(0);" class="fs-xl" style="color:#C13584">
                                    <i class="fab fa-instagram"><?= $instagram ?></i>
                                </a>
                                <a href="javascript:void(0);" class="fs-xl" style="color:#4680C2">
                                    <i class="fab fa-vk"><?= $vk ?></i>
                                </a>
                                <a href="javascript:void(0);" class="fs-xl" style="color:#0088cc">
                                    <i class="fab fa-telegram"><?= $telegram ?></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-3 text-center">
                            <a href="tel:<?= $phone ?>" class="mt-1 d-block fs-sm fw-400 text-dark">
                                <i class="fas fa-mobile-alt text-muted mr-2"></i> <?= $phone ?></a>
                            <a href="mailto:oliver.kopyov@marlin.ru" class="mt-1 d-block fs-sm fw-400 text-dark">
                                <i class="fas fa-mouse-pointer text-muted mr-2"></i> <?= $email ?></a>
                            <address class="fs-sm fw-400 mt-4 text-muted">
                                <i class="fas fa-map-pin mr-2"></i> <?= $address ?>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>

<script src="js/vendors.bundle.js"></script>
<script src="js/app.bundle.js"></script>
<script>

    $(document).ready(function () {

    });

</script>
</html>