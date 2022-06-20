<?php
include './config.php';
$app = new app();
login::loginPage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= url::myurl().'/'.$app->logo?>">
    <link rel="icon" type="image/png" href="<?= url::myurl().'/'.$app->logo?>">
    <?= $app->setTitle('Login')?>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <?= includes::LoginCss(); ?>
<body class="bg-gray-100">
    <nav
        class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent mt-4">
        <div class="container">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white h3"
                href="#">
                Rosx Edu
            </a>           
        </div>
    </nav>
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('assets/img/curved-images/curved9.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                       <img src='<?=url::myurl() ?>/web_assets/transperent.png' height='150' width='180' class='img-fluid m-0' alt='RoborosX Edu'>
                        <h4 class="text-white mb-2 mt-2"> <?= $app->name; ?> <br> ERP Login</h4>
                        <p class="text-lead text-white">Powered by RoborosX Omni Tech Solutions LLP.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header mt-4 text-gradient text-center text-dark pt-4">
                            <h3>Please Sign in</h3>
                        </div>
                        <div class="card-body">
                            <form role="form" action="/Auth/login" method="post" class="text-start">
                                <div class="mb-3">
                                    <label for="">Username : </label>
                                    <input type="text" name="username" class="form-control" id="Username" placeholder="Username">
                                </div>
                                <div class="mb-3">
                                    <label for="">Password : </label>
                                    <input type="password" name="password" class="form-control" id="Password"  placeholder="Password ">
                                </div>
                                <input type="hidden" name="ip_addr" value="<?= $_SERVER['REMOTE_ADDR'] ?>">
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">Sign in</button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer py-5">
        <div class="container">
            
            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">
                        Copyright &copy; 2022 made with <i class="text-danger fa fa-heart"></i> by <a class="text-primary " href="https://roborosx.com" target="_blank">RoborosX Omni Tech Solutions LLP</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    
    <?= includes::LoginJs(); ?>
    <script src="https://buttons.github.io/buttons.js"></script>
</body>

</html>