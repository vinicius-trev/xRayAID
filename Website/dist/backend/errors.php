<!-- /*!
 * xRayAID
 * backend/errors.php
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */ -->

 <!-- Print errors obtained from PHP server -->
<?php  if (count($errors) > 0) : ?>
    
<div class="text-center font-weight-light" style="color:red; font-size:0.9em">
    <?php foreach ($errors as $error) : ?>
    <p><?php echo $error ?></p>
    <?php endforeach ?>
</div>

<?php  endif ?>