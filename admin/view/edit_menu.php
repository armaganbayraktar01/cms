<?php require admin_view('static/header'); ?>

<div class="box- menu-container">
    <h2>Menü Düzenle (#<?= $id ?>)</h2>
    <!-- form container -->
        <form action="" method="post">

            <!-- title -->
                <div style="padding-bottom: 10px; max-width: 400px">
                    <input type="text" name="menu_title" value="<?=post('menu_title') ? post('menu_title') : $row_menus['menu_title']?>" placeholder="Menü Başlığı">
                </div>
            <!-- /title -->

            <!-- menu + submenu container - jquery sorter uygulanan kısım -->
                <ul id="menu" class="menu">
                
                    <?php if(is_array($json_menu_content)): ?>
                        <?php foreach($json_menu_content as $key => $jmenu_content): ?>
                            <li>
                                <div class="handle"></div>
                                <!-- Menu -->
                                <div class="menu-item">
                                    <a href="#" class="delete-menu">
                                        <i class="fa fa-times"></i>
                                    </a>
                                    <input type="text" name="title[]" value="<?= $jmenu_content['title'] ?>" placeholder="Menü Adı">
                                    <input type="text" name="url[]"  value="<?= $jmenu_content['url'] ?>" placeholder="Menü Linki">
                                </div>
                                <!-- /Menu -->

                                <!-- Submenu -->
                                <div class="sub-menu">
                                    <ul class="menu">
                                    <?php if(isset($jmenu_content['submenu'])): ?>
                                        <?php foreach ($jmenu_content['submenu'] as $key => $submenu): ?>
                                            <li>
                                                <div class="handle"></div>
                                                 <!-- Submenu -->
                                                <div class="menu-item">
                                                    <a href="#" class="delete-menu">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                    <input type="text" name="sub_title_<?=$key?>[]" value="<?= $submenu['title'] ?>" placeholder="Menü Adı">
                                                    <input type="text" name="sub_url_<?=$key?>[]"  value="<?= $submenu['url'] ?>" placeholder="Menü Linki">
                                                </div>
                                               <!-- Submenu -->
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </ul>
                                </div>
                                <!-- /Submenu -->
                                <a href="#" class="btn add-submenu">Alt Menü Ekle</a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            <!-- /menu + submenu container - jquery sorter uygulanan kısım -->

            <div class="menu-btn">
                <a href="#" id="add-menu" class="btn">Menü Ekle</a>
                <button type="submit" value="1" name="submit">Güncelle</button>
            </div>
        </form>
    <!-- /form container -->
</div>

<!-- menu ekleme işlemleri aşağıdaki scripttedir -->
<script src="<?=admin_public_url('scripts/addmenu.js')?>"></script>

<?php require admin_view('static/footer'); ?>