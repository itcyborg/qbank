<?php

    include 'Initialize.php';

    $setup=new Initialize();

    if($res=Initialize::init()){
        die(var_dump($res));
    }else{
        die('Config not set');
    }


