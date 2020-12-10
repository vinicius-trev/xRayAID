<?php include('backend/register_server.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>xRayAID - Register</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous">
    </script>
</head>

<body>
    <div id="navbar_div">

    </div>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-6">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Criar uma Conta</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="register.php">
                                        <?php include('backend/errors.php'); ?>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label for="exampleInputName">Usuário</label>
                                                    <input class="form-control" id="exampleInputName" type="text"
                                                        name="username" value="<?php echo $username; ?>"  minlength="3"
                                                        placeholder="Digite seu Usuário" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input class="form-control" id="exampleInputEmail1" type="email"
                                                aria-describedby="emailHelp" name="email" value="<?php echo $email; ?>"
                                                placeholder="Digite seu endereço de email" required>
                                        </div>
                                        <div class="form-group">
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
                                                    <label for="exampleInputPassword1">Senha</label>
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
                                        </div>

                                        <!-- Captcha -->
                                        <div class="text-xs-center mt-3">
                                                <div class="g-recaptcha" data-sitekey="6Lc1YroZAAAAAFWMc_mC5PQU89fT31NhPxjg0ZTp"></div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block"
                                            name="reg_user">Registrar</button>
                                        
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small">
                                        <a href="login.php">Já possui uma conta? Realize o login</a>
                                    </div>
                                    <div class="small mt-1">
                                        <a href="password.php">Esqueceu a senha? Nós ajudamos</a>
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
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/authentication_resize.js"></script>

    <!-- reCaptcha -->
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</body>

</html>