<?php

// mysql://bcdf0b90bee309:4adcb88f@us-cdbr-east-04.cleardb.com/heroku_e73e215699bf695?reconnect=true
// usuario : bcdf0b90bee309
// pass : 4adcb88f
// host : us-cdbr-east-04.cleardb.com

$host = 'us-cdbr-east-04.cleardb.com';
$usuario = 'bcdf0b90bee309';
$pass = '4adcb88f';
$database = 'heroku_e73e215699bf695';

$con = new mysqli($host, $usuario, $pass, $database);
if ($con->connect_error) {
  echo $error->$con->connect_error;
}
