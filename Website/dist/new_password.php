<!-- /*!
 * xRayAID
 * new_password.php
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
                                        <h3 class="text-center font-weight-light my-4">Nova Senha</h3>
                                    </div>
                                    <div class="card-body">
                                    <div class="small mb-3 text-muted text-center">
                                        Digite a sua nova senha.
                                    </div>
                                        <form method="post">
                                            <?php include('backend/errors.php'); ?>
                                            <div class="form-row">
                                                <script>
                                                    var check = function () 
                                                    {
                                                        if (document.getElementById('exampleInputPassword1').value != document.getElementById('exampleInputPassword2').value)  
                                                        {
                                                            document.getElementById('message').style.color = 'red';
                                                            document.getElementById('message').innerHTML = 'As senhas estão diferentes';
                                                        }
                                                        else
                                                        { 
                                                            document.getElementById('message').innerHTML = "";
                                                        }
                                                    }
                                                </script>
                                                <div class="col-md-6">
                                                    <label for="exampleInputPassword1">Nova Senha</label>
                                                    <input class="form-control" id="exampleInputPassword1"
                                                        type="password" name="password_1" placeholder="Digite sua senha"
                                                        required pattern=".{8,}" required title="No mínimo 8 characteres">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleInputPassword1">Confirmação de Senha</label>
                                                    <input class="form-control" id="exampleInputPassword2"
                                                        type="password" name="password_2"
                                                        placeholder="Confirme sua senha" required onfocusout='check();'>
                                                    <span id='message'></span>
                                                </div>
                                            </div>

                                            <!-- Captcha -->
                                            <div class="text-xs-center mt-3 mb-2">
                                                <div class="g-recaptcha" data-sitekey="6Lc1YroZAAAAAFWMc_mC5PQU89fT31NhPxjg0ZTp"></div>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-block"
                                                name="new_password">Trocar Senha</button>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">

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