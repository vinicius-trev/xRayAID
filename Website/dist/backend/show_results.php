<!-- /*!
 * xRayAID
 * backend/show_results.php
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */ -->

 <?php 
if(!isset($_SESSION['username']))
{
   header("Location: ./");
   exit;
}

 include("backend/update_information.php");
 $classifyOK = $_SESSION['classifyOK'];
 $pneumonia_probability = $_SESSION['pneumonia_probability']; 
 $annotations = $_SESSION['annotations'];
 $feedback = $_SESSION['feedback'];
 $_SESSION['download_original'] = $_SESSION['original']; 
 $_SESSION['download_heatmap'] = $_SESSION['heatmap']; 
?>
<?php  if ($classifyOK == 1): ?>

    <!-- 
        * Calling xRayAID API to GET heatmap image
    -->    
    <!-- Exibiting Probability -->
    <div class="col-md-13 mb-4">
              <div class="card border-left-primary border-bottom-primary border-right-primary shadow">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                        <i class="fas fa-percentage fa-2x text-gray-500"></i>
                    </div>
                    <div class="col mr-2">
                      <div class="small font-weight-bold text-primary text-uppercase mb-1 text-center">ESTATÍSTICAS</div>
                      <div class="mb-0 small text-uppercase text-gray-800 text-center">Probabilidade de Pneumonia: <spam class="font-weight-bolder"> <?php echo $pneumonia_probability ?>% </spam></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

    <div class="row">
        <!-- Exibiting Original Image -->
        <div class="col-lg-6 mb-2">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-light small">IMAGEM ORIGINAL</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-angle-double-down text-light"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                            <div class="dropdown-header">Informações Gerais:</div>
                            <button class="dropdown-item btn dropdown-font shadow-none" data-toggle="modal" data-target="#informationsModel">Atualizar Informações</button>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-header">Ações Para Esta Imagem:</div>
                            <button class="dropdown-item btn dropdown-font shadow-none" onclick="checkFilterURL('filter', '')">Visualizar Filtro</button>
                            <button class="dropdown-item btn dropdown-font shadow-none" onclick="checkFilterURL('original', '')">Visualizar Original</button>
                            <a class="dropdown-item btn dropdown-font shadow-none" id='download_original' onclick="downloadOriginal()" href="">Efetuar Download</a>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="informationsModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title title-font text-gray-800" id="exampleModalLabel">Informações Adicionais</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <iframe name="addinformation" class="d-none"></iframe>
                                    <form method="post" name="addInfo" id="adittionalText" target="_parent" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <h5 class="modal-title title-font text-gray-800 mb-2" id="exampleModalLabel">Anotações</h5>                  
                                            <label for="textAnnotations" class="title-font">Descreva aqui suas anotações sobre a radiografia!</label>
                                            <textarea class="form-control" id="textAnnotations" rows="5" style="resize: none;" name="annotations" maxlength="1000"><?php echo $annotations ?></textarea>
                                            
                                            <h5 class="modal-title title-font text-gray-800 mb-2 mt-4" id="exampleModalLabel">Feedback</h5>
                                            <label for="textFeedback" class="title-font">Deixe um Feedback para nossa classificação!</label>
                                            <textarea class="form-control" id="textFeedback" rows="5" style="resize: none;" name="feedback" maxlength="1000"><?php echo $feedback ?></textarea>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <input type="submit" class="btn btn-primary" value="Salvar" name="additionalInfo"></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row h-75">
                    <div class="col-12 align-self-center">
                        <div class="card-body-img black">
                            <!-- Load Image from PHP Variable here -->
                            <img data-enlargable style="cursor: zoom-in" src="<?php echo  $_SESSION['download_original'] ?>" class="img-fluid"  id="original"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Exibiting Heatmap Image -->
        <div class="col-lg-6 mb-2">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-light small">MAPA DE CALOR</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-angle-double-down text-light"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                            <div class="dropdown-header">Informações Gerais:</div>
                            <button class="dropdown-item btn dropdown-font shadow-none" data-toggle="modal" data-target="#informationsModel">Atualizar Informações</button>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-header">Ações Para Esta Imagem:</div>
                            <button class="dropdown-item btn dropdown-font shadow-none" onclick="checkFilterURL('', 'filter')">Visualizar Filtro</button>
                            <button class="dropdown-item btn dropdown-font shadow-none" onclick="checkFilterURL('', 'original')">Visualizar Original</button>
                            <a class="dropdown-item btn dropdown-font shadow-none" href="" onclick="downloadHeatmap()" id="download_heatmap">Efetuar Download</a>
                        </div>
                    </div>
                </div>
                <div class="row h-75">
                    <div class="col-12 align-self-center">
                        <div class="card-body-img black">
                            <!-- Load Heatmap from API here -->
                            <img data-enlargable style="cursor: zoom-in" src="<?php echo $_SESSION['download_heatmap'] ?>" class="img-fluid" id="heatmap"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 align-items-center text-center mb-2">
            <button onclick="location.href='backend/download.php';" class="button btn btn-primary ml-2 mr-2 btn-show">
                <spam class="small" >DOWNLOAD CLASSIFICAÇÃO COMPLETA</spam>
            </button>
        </div>

        <div class="col-lg-12 align-items-center text-center mb-4">
            <button onclick="location.href='..' + location.pathname + (location.pathname.includes('classify') ? '?cls' : '?back');" class="button btn btn-primary ml-2 mr-2 mt-3 btn-show">
                <spam class="small">VOLTAR</spam>
            </button>
        </div>
    </div>

    <script>
        var original = true;
        var heatmap = true;
        function checkFilterURL(original_param, heatmap_param)
        {
            /* Analyze original image parameters */
            if(original_param=="filter")
            { 
                var src = "<?php echo $_SESSION['original_lab'] ?>"
                original = false;
                document.getElementById("original").src=src;
            }
            else if(original_param=="original")
            {
                var src = "<?php echo $_SESSION['original'] ?>"
                original = true;
                document.getElementById("original").src=src;
            }

            /* Analyze heatmap image parameters */
            if(heatmap_param=="filter")
            {
                var src = "<?php echo $_SESSION['heatmap_lab'] ?>"
                heatmap = false
                document.getElementById("heatmap").src=src;
            }
            else if(heatmap_param=="original")
            {
                var src = "<?php echo $_SESSION['heatmap'] ?>"
                heatmap = true
                document.getElementById("heatmap").src=src;
            }
        }

        function downloadOriginal()
        {
            if(original)
            {
                var download = "<?php echo("Original-" . $_SESSION['classification_id'] . substr(finfo_buffer(finfo_open(),  $_SESSION['original'], FILEINFO_MIME_TYPE), 10));?>"
                var href = "<?php echo  $_SESSION['original']?>"
                document.getElementById("download_original").download = download 
                document.getElementById("download_original").href = href 
            }
            else
            {
                var download = "<?php echo("Original-Filter-" . $_SESSION['classification_id'] . substr(finfo_buffer(finfo_open(),  $_SESSION['original_lab'], FILEINFO_MIME_TYPE), 10));?>"
                var href = "<?php echo  $_SESSION['original_lab']?>"
                console.log(download)
                document.getElementById("download_original").download = download 
                document.getElementById("download_original").href = href 
            }
        }

        function downloadHeatmap()
        {
            if(heatmap)
            {
                var download = "<?php echo("Heatmap-" . $_SESSION['classification_id'] . substr(finfo_buffer(finfo_open(),  $_SESSION['heatmap'], FILEINFO_MIME_TYPE), 10));?>"
                var href = "<?php echo  $_SESSION['heatmap']?>"
                document.getElementById("download_heatmap").download = download 
                document.getElementById("download_heatmap").href = href 
            }
            else
            {
                var download = "<?php echo("Heatmap-Filter-" . $_SESSION['classification_id'] . substr(finfo_buffer(finfo_open(),  $_SESSION['heatmap_lab'], FILEINFO_MIME_TYPE), 10));?>"
                var href = "<?php echo  $_SESSION['heatmap_lab']?>"
                console.log(download)
                document.getElementById("download_heatmap").download = download 
                document.getElementById("download_heatmap").href = href 
            }
        }
    </script>
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-zoom.js"></script>
<?php  endif ?>