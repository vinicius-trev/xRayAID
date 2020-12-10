<?php
/*!
 * xRayAID
 * backend/logout_server.php
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */

session_start();
session_destroy();
header('Location: ../');
exit;

?>