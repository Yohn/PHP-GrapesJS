<?php
//
//  This application develop by PEPIUOX.
//  Created by : Lab eMotion
//  Author     : PePiuoX
//  Email      : contact@pepiuox.net
//
    $login = new UsersClass();
    $forgotpass = new userForgot();
    if ($login->isLoggedIn() === true) {
 ?>
 <script>
    window.location.replace("<?php echo SITE_PATH; ?>profile/user-profile");
        </script>
<?php
    } else {
        include 'views/forgotPassword.php'; 
    }
    ?>
