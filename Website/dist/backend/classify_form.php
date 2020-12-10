<!-- /*!
 * xRayAID
 * backend/classify_form.php
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */ -->

 <?php  if ($classifyOK == 1): ?>
    <script>
        content = document.getElementById("main-classify-window")
        content.parentNode.removeChild(content);
    </script>
<?php  endif ?>

<div id="upload">
    <form method="post" enctype="multipart/form-data" name="imageUpload" id="classifyForm" onsubmit="return uploading_msg()" action="<?php echo $_SERVER['PHP_SELF']; ?>">  
        <div class="mt-4 ml-5 mr-5 align-items-center">
        Selecione a Imagem que Deseja Realizar Upload

        <div class="custom-file mt-2">
            <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload" required accept=".png, .jpg, .jpeg">
            <label class="custom-file-label" for="fileToUpload" id="fileUploadText"></label>
        </div>
        </div>
        <div class="mt-3">
            <input type="submit" class="btn btn-primary js-scroll-trigger" style="padding: 0.6rem 1.2rem;"
                value="Enviar" name="submit">
        </div>
    </form>
<div>
<div id="loader-submit" class="lock-modal"> 
    <div class='text-center font-weight-light font-weight-bold mt-4' style='color:#548b87; font-size:0.9em'> 
            Aguarde... Estamos Processando sua Imagem! 
    </div>
    <div class="loader mt-2">
        <div class="loader__hexagon loader__hexagon--value"></div>
        <div class="loader__hexagon loader__hexagon--value"></div>
        <div class="loader__hexagon loader__hexagon--value"></div>
    </div>
</div>

<script>
/* Filling Image Text Box with image name */ 
const inputElement = document.getElementById('fileToUpload');

window.onload = function ()
{  
    if ($(window).width() > 500) 
        document.getElementById('fileUploadText').innerText = "Max 10MB"
}

inputElement.addEventListener('change', function(e) 
{   
    if ($(window).width() > 500) 
        document.getElementById('fileUploadText').innerText = inputElement.value.replace(/^.*[\\\/]/, '')
    else
    {
        document.getElementById('fileUploadText').innerText = 'OK'
        document.getElementById('fileUploadText').classList.add("text-left")
    }
});

/* Print Loading image */
function uploading_msg()
{
    var img = document.forms["imageUpload"]["fileToUpload"].value;

    if (img == "") {
        return false;
    }
    else
    {
        /* Make form invisible */
        document.getElementById("upload").style.visibility = "hidden";

        /* Make loader visible */
        document.getElementById("loader-submit").style.visibility = "visible";
        
        return true;
    }
}
</script>
