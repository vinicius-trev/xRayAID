<!-- /*!
 * xRayAID
 * backend/success.php
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */ -->

 <!-- Print errors obtained from PHP server -->
 <?php  if (count($success) > 0) : ?>
    
    <div class="text-center font-weight-light" style="color:green; font-size:0.9em">
        <?php foreach ($success as $success) : ?>
        <p><?php echo $success ?></p>
        <?php endforeach ?>
    </div>
    
    <?php  endif ?>