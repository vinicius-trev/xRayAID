<!-- 
/*!
 * xRayAID
 * index.php
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */ 
-->

<?php include('backend/index_server.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>xRayAID</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top " id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">xRayAID</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#projects">O Projeto</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#signup">Inscrição</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger"
                            href="https://mail.xrayaid.com.br">Webmail</a></li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" id="login">Login</a>
                        <div id="login-responsive">
                            <!-- Login is put here based on JavaScript -->
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container d-flex h-100 align-items-center">
            <div class="mx-auto text-center">
                <h1 class="mx-auto my-0 text-uppercase">xRayAID</h1>
                <h2 class="text-white-50 mx-auto mt-2 mb-5">Plataforma capaz de agilizar a detecção de pneumonia com o
                    uso de Inteligência Artificial.</h2>
                <a class="btn btn-primary js-scroll-trigger" href="#about">Saiba Mais</a>
            </div>
        </div>
    </header>
    <!-- About-->
    <section class="about-section text-center" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="text-white mb-4">Sobre o xRayAID</h2>
                    <p class="text-white-50">
                        O <a class="js-scroll-trigger" href="#page-top">xRayAID</a> consiste em uma ferramenta
                        diagnóstica na área da saúde. Trata-se de uma plataforma capaz de
                        receber radiografias torácicas a fim de agilizar a detecção e localização de pneumonia com o uso
                        de Inteligência Artificial, produzindo um mapa de calor
                        conforme as regiões afetadas pela patologia.
                    </p>
                </div>
            </div>
            <img class="img-fluid" src="assets/img/ipad.png" alt="" />
        </div>
    </section>
    <!-- Projects-->
    <section class="projects-section bg-light" id="projects">
        <div class="container">
            <!-- Featured Project Row-->
            <div class="row align-items-center no-gutters mb-4 mb-lg-5">
                <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="assets/img/example.gif" alt="" />
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="featured-text text-center text-lg-left">
                        <h4>Rápido e Preciso</h4>
                        <br>
                        <p class="text-black-50 mb-0">
                            Foram utilizadas mais de <b> 30.000 imagens </b> para atingir o resultado esperado no nosso
                            modelo de Machine Learning.
                            <br>
                            <br>
                            Com o <a class="js-scroll-trigger" href="#page-top">xRayAID</a> você consegue resultados de
                            especialistas* em segundos.
                        </p>
                        <br>
                        <p class="text-black-50 mb-0 small">
                            *Plataforma dedicada a profissionais da saúde
                        </p>
                    </div>
                </div>
            </div>
            <!-- Project One Row-->
            <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
                <div class="col-lg-6"><img class="img-fluid" src="assets/img/demo-image-01.jpg" alt="" /></div>
                <div class="col-lg-6">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-left">
                                <h4 class="text-white">Faça o Upload</h4>
                                <p class="mb-0 text-white-50">Após autenticar-se, insira sua radiografia na nossa
                                    plataforma. O resultado será exibido em segundos.</p>
                                <hr class="d-none d-lg-block mb-0 ml-0" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project Two Row-->
            <div class="row justify-content-center no-gutters">
                <div class="col-lg-6"><img class="img-fluid" src="assets/img/demo-image-02.jpg" alt="" /></div>
                <div class="col-lg-6 order-lg-first">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-right">
                                <h4 class="text-white">Analise os Resultados</h4>
                                <p class="mb-0 text-white-50">Analise os resultados, auxiliando o seu diagnostico.</p>
                                <p class="mb-0 text-white-50"> Também é possível auxiliar o desenvolvimento da plataforma, retornando
                                    um Feedback sobre o resultado produzido.</p>
                                <hr class="d-none d-lg-block mb-0 mr-0" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Signup-->
    <section class="signup-section" id="signup">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto text-center">
                    <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                    <h2 class="text-white mb-8">Inscreva-se para receber novidades!</h2>
                    <form class="form-inline d-flex js-scroll-trigger" method="post">
                        <input class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" id="inputEmail" type="email" name="subscribe_email"
                            placeholder="Digite seu Email..." required />
                        <button class="btn btn-primary mx-auto" type="submit" name="subscribe">Inscrever-se</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact-->
    <section class="contact-section bg-black">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fab fa-linkedin text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Desenvolvedor</h4>
                            <hr class="my-4" />
                            <div class="small text-black-50"><a
                                    href="https://www.linkedin.com/in/vinicius-trevisan-94994612a/"
                                    target="_blank">Vinicius Trevisan</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Email</h4>
                            <hr class="my-4" />
                            <div class="small text-black-50"><a
                                    href="mailto:contato@xrayaid.com.br">contato@xrayaid.com.br</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-lock text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Políticas</h4>
                            <hr class="my-4" />
                            <div class="small text-black-50">
                                <section>
                                    <!-- Politica de privacidade -->
                                    <a href="#!" id="politica">Política de Privacidade</a> </br>
                                    <div id="text-politica" class="modal">
                                        <div class="modal-content scroll-auto" id="policy-content">
                                            <!-- The policy will be put here based on JavaScript -->
                                        </div>
                                    </div>
                                </section>

                                <section>
                                    <!-- Termos de uso -->
                                    <a href="#!" id="termos">Termos de Uso</a>
                                    <div id="text-termos" class="modal">
                                        <div class="modal-content scroll-auto" id='terms-content'>
                                            <!-- The terms will be put here based on JavaScript -->
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social d-flex justify-content-center">
                <a class="mx-2" href="https://twitter.com/xRayAID1" target="_blank"><i class="fab fa-twitter"></i></a>
                <a class="mx-2" href="https://www.facebook.com/Xrayaid-103520471461120" target="_blank"><i
                        class="fab fa-facebook-f"></i></a>
                <a class="mx-2" href="https://www.instagram.com/xrayaid/" target="_blank"><i
                        class="fab fa-instagram"></i></a>
                <a class="mx-2" href="https://github.com/vinicius-trev/TCC" target="_blank"><i
                        class="fab fa-github"></i></a>
            </div>
        </div>
    </section>


    <!-- Footer-->
    <footer class="footer bg-black small text-center text-white-50">
        <div class="container">Copyright © <a class="js-scroll-trigger" href="#page-top">xRayAID.com.br</a> 2020</div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>

    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Core theme JS-->
    <script src="js/index_script.js"></script>
    <script src="js/politica_script.js"></script>
    <script src="js/termos_script.js"></script>
    <script src="js/login_script.js"></script>
</body>

</html>