<!doctype html>
<html lang="en">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <meta charset="UTF-8">
    <title>Document</title>

    <!--styles-->
    <link rel="stylesheet" href="<?=admin_public_url('styles/main.css')?>">
    <link rel="stylesheet" href="<?=admin_public_url('vendor/jquery.tagsinput/jquery.tagsinput-revisited.min.css')?>">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!--scripts-->

    <script src="<?=admin_public_url('scripts/jquery-1.12.2.min.js')?>"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?=admin_public_url('vendor/jquery.tagsinput/jquery.tagsinput-revisited.min.js')?>"></script>
    <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=izmmivax90my4rxysd79loexycahp0k0hixass33j2a6ajvp"></script>
    
    <script>
    var api_url = '<?= admin_url('api') ?>';
    var app_url = '<?= site_url('app/') ?>';
    </script>
    <script src="<?=admin_public_url('scripts/admin.js')?>"></script>
    <script src="<?=admin_public_url('scripts/api.js')?>"></script>
</head>
<body>

<div class="success-msg">
    <a href="#" class="success-close-btn"><i class="fa fa-times"></i></fa-times></a>
    <div></div>
</div>

<!-- Admin girişi var ise gösterilecek kısım -->
<?php if (session('user_rank') && session('user_rank') != 3): ?>

    <!--navbar-->
    <div class="navbar">
        <ul dropdown>
            <li>
                <a href="#">
                    <span class="fa fa-home"></span>
                    <span class="title">
                        <?=settings('title')?>
                    </span>
                </a>
            </li>
            <li>
                <a href="<?= admin_url('logout') ?>">
                    <span class="fa fa-home"></span>
                    <span class="title">
                        Çıkış Yap
                    </span>
                </a>
            </li>

            <!-- <li>
                <a href="#">
                    <span class="fa fa-comment"></span>
                    1
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="fa fa-plus"></span>
                    <span class="title">New</span>
                </a>
                <ul>
                    <li>
                        <a href="#">
                            New Post
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            New Page
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            New Category
                        </a>
                    </li>
                </ul>
            </li> -->

        </ul>
    </div>

    <!--sidebar-->
    <div class="sidebar">

        <ul>
            <?php foreach ($menus as $menu_url => $menu): if(!permission($menu_url, 'show')) continue; ?>
            <li class="<?= (route(1) == $menu_url) || isset($menu['submenus'][route(1)]) ? 'active': null?>"> 

                <a href="<?=admin_url($menu_url) ?>">
                    <span class="fa fa-<?= $menu['icon']; ?>"></span>
                    <span class="title"><?= $menu['title']; ?></span>
                </a>

                <?php if(isset($menu['submenus'])): ?>
                <ul class="sub-menu">
                    <?php foreach ($menu['submenus'] as $submenu_url => $submenu_title): ?>
                    <li>
                        <a href="<?= admin_url($submenu_url); ?>"><?=$submenu_title;?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

            </li>
            <?php endforeach; ?>

            <li class="line">
                <span></span>
            </li>
        </ul>



        <a href="#" class="collapse-menu">
            <span class="fa fa-arrow-circle-left"></span>
            <span class="title">
                Collapse menu
            </span>
        </a>

    </div>

    <!--content-->
    <div class="content">

        <?php if (isset( $error )): ?>
            <div class="message error box-">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <?php if (isset( $success )): ?>
            <div class="message error box-">
                <?= $success ?>
            </div>
        <?php endif; ?>


<?php endif; ?>
<!-- /Admin girişi var ise gösterilecek kısım -->