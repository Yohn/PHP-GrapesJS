<div class="hold-transition login-page">
    <?php
     $login = new UsersClass();
     $level = new AccessLevel();
     $forgotuser = new SendData();
    $menu = 1;
    if ($login->isLoggedIn() === true) {
 ?>
 <script>
    window.location.replace("<?php echo SITE_PATH; ?>profile/user-profile");
        </script>
<?php
    } else {
        include_once 'views/forgotUsername.php';
    }
    ?>
    </div>
   
