<?php require editor_view('static/header'); ?>



<?php

if (isset($_POST['submit'])){

    $add_pageName = $_POST['add-page'];
    $pageDir = $_POST['pageDir'];

    $addPage = addPage($add_pageName,$pageDir);

    if ($addPage){
        $success =  $add_pageName . '.php eklendi.';
        header('Refresh:2; url=' . URL);
    }
}

?>


<div class="box-">
    <h1>Sayfa Ekle</h1>
</div>

<div class="clear" style="height: 10px;"></div>


<!-- error veya success mesajlarının gösterilmesi -->
<?php if (post('submit')): ?>
    <?php if($error = error()): ?> 
        <div class="alert alert-danger" role="alert"><?= $error ?></div>
    <?php endif; ?>

    <?php if($success = success()): ?> 
        <div class="alert alert-success" role="alert"><?= $success ?></div>
    <?php endif; ?>
<?php endif; ?>

<!-- //error veya success mesajlarının gösterilmesi -->

<div class="box-">
    <form action="" method="post" class="form label">
        <ul>
            <li>
                <label>Sayfa Ekle</label>
                <div class="form-content">
                    <input type="text" name="add-page">
                </div>
            </li>

            <li>
                <label>Klasör Yolu</label>
                <div class="form-content">
                    <select name="pageDir">
                        <option value="admin">Admin</option>
                        <option value="app">App</option>
                        <option value="editor">Editor</option> 
                    </select>
                </div>
            </li>

            <li class="submit">
                <input type="hidden" name="submit" value="1">
                <button type="submit">Kaydet</button>
            </li>
        </ul>
    </form>
</div>



<?php require editor_view('static/footer'); ?>


