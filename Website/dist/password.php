<!-- /*!
 * xRayAID
 * password.php
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */ -->

 <?php include('backend/password_server.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>xRayAID - Recovery</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous">
    </script>
</head>

<body>
    <div id="navbar_div">

    </div>
    <header>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6  align-self-center">
                                <div class="card shadow-lg border-0 rounded-lg mt-6">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Recuperar Senha</h3>
                                    </div>
                                    <div class="card-body">
                                    <div class="small mb-3 text-muted text-center">
                                        Digite seu email, assim, enviaremos um link para recuperar sua senha.
                                    </div>
                                        <form method="post" action="password.php">
                                            <?php include('backend/errors.php'); ?>
                                            <?php include('backend/success.php'); ?>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email</label>
                                                <input class="form-control" type="text" name="email" placeholder="Digite seu email" required>
                                            </div>

                                             <!-- Captcha -->
                                             <div class="text-xs-center mt-3 mb-2">
                                                <div class="g-recaptcha" data-sitekey="6Lc1YroZAAAAAFWMc_mC5PQU89fT31NhPxjg0ZTp"></div>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-block "
                                                name="pass_reset">Recuperar</button>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small">
                                            <a href="login.php">Já possui uma conta? Realize o login</a>
                                        </div>
                                        <div class="small">
                                            <a href="register.php">Ainda não possui uma conta? Realize o cadastro</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </main>
            </div>
            <div id="page-footer">
                
            </div>
        </div>
    </header>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="js/authentication_resize.js"></script>

    <!-- reCaptcha -->
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</body>

</html>