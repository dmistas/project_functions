<?php
session_start();
include_once 'functions.php';
// если не авторизован, перенаправляем на login
if (!is_not_logged_in()) {
    // если есть GET запрос, получаем пользователя из БД, чтобы подставить значения в форму
    if (isset($_GET['id'])) {
        $edit_user = get_user_by_id(intval($_GET['id']));
    }
    // Проверяем если метод POST
    if (isset($_POST['id'])) {
        // Есть ли права на редактирование
        if (is_admin() || $_POST['id'] == $_SESSION['user']['id']) {
            $edit_user = get_user_by_id(intval($_POST['id']));
            $id = $edit_user['id'];
            $name = isset($_POST['name']) ? $_POST['name'] : $edit_user['name'];
            $job_title = isset($_POST['job_title']) ? $_POST['job_title'] : $edit_user['job_title'];
            $phone = isset($_POST['phone']) ? $_POST['phone'] : $edit_user['phone'];
            $address = isset($_POST['address']) ? $_POST['address'] : $edit_user['address'];
            $is_save_user = edit($id, $name, $job_title, $phone, $address);
            if ($is_save_user) {
                set_flash_message('success', 'Данные сохранены');
                redirect_to("page_profile.php?id=$id");
                exit();
            }
        } else {
            set_flash_message('danger', 'Можно редактировать только свой профиль');
            redirect_to('users.php');
            exit();
        }
    }
} else {
    redirect_to('page_login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="description" content="Chartist.html">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
    <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
</head>
<body>
<?php include 'nav_component.php' ?>
<main id="js-page-content" role="main" class="page-content mt-3">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-plus-circle'></i> Редактировать
        </h1>

    </div>
    <form action="edit.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xl-6">
                <div id="panel-1" class="panel">
                    <div class="panel-container">
                        <div class="panel-hdr">
                            <h2>Общая информация</h2>
                        </div>
                        <div class="panel-content">
                            <!-- username -->
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Имя</label>
                                <input type="text" id="simpleinput" class="form-control" name="name"
                                       value="<?= isset($edit_user['name']) ? $edit_user['name'] : "" ?>">
                                <input type="hidden" name="id"
                                       value="<?= isset($edit_user['id']) ? $edit_user['id'] : "" ?>">
                            </div>

                            <!-- title -->
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Место работы</label>
                                <input type="text" id="simpleinput" class="form-control" name="job_title"
                                       value="<?= isset($edit_user['job_title']) ? $edit_user['job_title'] : "" ?>">
                            </div>

                            <!-- tel -->
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Номер телефона</label>
                                <input type="text" id="simpleinput" class="form-control" name="phone"
                                       value="<?= isset($edit_user['phone']) ? $edit_user['phone'] : "" ?>">
                            </div>

                            <!-- address -->
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Адрес</label>
                                <input type="text" id="simpleinput" class="form-control" name="address"
                                       value="<?= isset($edit_user['address']) ? $edit_user['address'] : "" ?>">
                            </div>
                            <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                <button class="btn btn-warning" type="submit">Редактировать</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>

<script src="js/vendors.bundle.js"></script>
<script src="js/app.bundle.js"></script>
<script>

    $(document).ready(function () {

        $('input[type=radio][name=contactview]').change(function () {
            if (this.value == 'grid') {
                $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-g');
                $('#js-contacts .col-xl-12').removeClassPrefix('col-xl-').addClass('col-xl-4');
                $('#js-contacts .js-expand-btn').addClass('d-none');
                $('#js-contacts .card-body + .card-body').addClass('show');

            } else if (this.value == 'table') {
                $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-1');
                $('#js-contacts .col-xl-4').removeClassPrefix('col-xl-').addClass('col-xl-12');
                $('#js-contacts .js-expand-btn').removeClass('d-none');
                $('#js-contacts .card-body + .card-body').removeClass('show');
            }

        });

        //initialize filter
        initApp.listFilter($('#js-contacts'), $('#js-filter-contacts'));
    });

</script>
</body>
</html>