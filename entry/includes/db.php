<?php

require "/var/www/u0679512/data/www/fiery-site.ml/src/app/RedBeanPHP/rb-mysql.php";
R::setup( 'mysql:host=localhost;dbname=u0679512_library',
    'u0679512_library', '12345Qwerty' );

session_start();