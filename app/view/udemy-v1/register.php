<?php require view('static/header') ?>

<div class="container">
    <div class="row justify-content-md-center mt-4">

        <div class="col-md-4">
            <form action="" method="post">
                <h3 class="mb-3">Kayıt Ol</h3>

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
          
                <div class="form-group">
                    <label for="username">Kullanıcı Adınız</label>
                    <input type="text" class="form-control" name="user_name" value="<?= post('submit') ? post('user_name') : FALSE  ?> " id="username" placeholder="Kullanıcı adınızı yazın..">
                </div>
                <div class="form-group">
                    <label for="email">E-posta Adresiniz</label>
                    <input type="text" class="form-control" name="user_email" value="<?= post('submit') ?  post('user_email') : FALSE ?> " id="email" placeholder="E-posta adresinizi yazın..">
                </div>
                <div class="form-group">
                    <label for="password">Şifreniz</label>
                    <input type="password" class="form-control" name="user_password" id="password" placeholder="*******">
                </div>
                <div class="form-group">
                    <label for="password-again">Şifreniz (Tekrar)</label>
                    <input type="password" class="form-control" name="user_password_a" placeholder="*******">
                </div>

                <input type="hidden" name="submit" value="1">
                <button type="submit" class="btn btn-primary">Kayıt Ol</button>
            </form>
        </div>

<?php require view('static/footer') ?>