<?php

# Site meta bilgileri 
    $meta = [
        'site_title' => settings('title'),
        'site_desc' => settings('description'),
        'site_keyw' => settings('keywords')
    ];

# // Site meta bilgileri 

# post işlemleri 
    
    if (post('submit')) {
        $user_name = post('user_name');
        $user_password = post('user_password');
    }


    if (!$user_name) {
        $error = 'Kullanıcı adı boş bırakılamaz.';
    } elseif (!$user_password) {
        $error = 'Şifre boş bırakılamaz.';
    } else {

        # Veritabanında üye kayıtlı mı Kontrolü 

            $row_users = User::userExist($user_name); //classes/user.php içindeki User classı


            if($row_users){
                # Üyenin Veritabanındaki şifresi ile girdiği şifrenin Kontrolü 
                    $user_password_hash = $row_users['user_password'];
                    $password_verify = password_verify($user_password, $user_password_hash);

                    if ($password_verify) {
                        $success = $user_name . ' giriş başarılı. Yönlendiriliyorsunuz.';
                       
                        User::userLogin($row_users); //user.php içindeki user classı

                        header('Refresh:2; url=' . site_url());

                    }else {
                        $error = 'Şifreniz hatalı. Lütfen tekrar deneyin.';
                    }

                # //Üyenin Veritabanındaki şifresi ile girdiği şifrenin Kontrolü 
            }else {
                $error = $user_name . ' adında bir kullanıcı veritabanımızda kayıtlı değildir.';
            }
        # //Veritabanında üye kayıtlı mı Kontrolü 
    }

require view('login');
?>