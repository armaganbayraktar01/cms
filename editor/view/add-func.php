<?php require editor_view('static/header'); ?>



<?php

if (isset($_POST['submit'])){

    $controller_funcName = $_POST['add-page'];
    $pageDir = $_POST['pageDir'];


    if ($pageDir == 'admin'){
        add_controller_func($pageDir, $controller_funcName);
    }elseif ($pageDir == 'app'){
        add_controller_func($pageDir, $controller_funcName);
    }else{
        add_controller_func($pageDir, $controller_funcName);
    }
        
    echo $controller_funcName . '.php eklendi.';
    header('Location:' . editor_url('add-page'));
    exit;
}

?>


<div class="box-">
    <h1>Fonksiyon ekle</h1>
</div>

<div class="clear" style="height: 10px;"></div>

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

