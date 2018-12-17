<?php

function userErrorHandler($errno, $errmsg, $filename, $errline){

    if (!(error_reporting() & $errno)) {
         return false;
    }


    $time = date("Y-m-d H:i:s");

    $errortype = array (
        E_USER_ERROR         => 'Пользовательская ошибка',
        E_USER_WARNING       => 'Пользовательское предупреждение',
        E_USER_NOTICE        => 'Пользовательское уведомление',

    );

    $err = "Time " . $time . "\n";
    $err .= "Error code " . $errno . "\n";
    $err .= "Error type " . $errortype[$errno] . "\n";
    $err .= "Error massege " . $errmsg . "\n";
    $err .= "Error file " . $filename . "\n";
    $err .= "Line " . $errline. "\n";
    ob_start();
    debug_print_backtrace();
    $err.= debug_print_backtrace();
    $err.=ob_get_clean();
    $err.="\n". "\n". "\n";


    echo $errortype[$errno]."<br>";
    echo $errmsg."<br>";


    error_log($err, 3, "/OSPanel/domains/errors_func/error.log");
    return true;
}



function myExample($a, $b){
    if ($a == 0 || $b == 0){

        trigger_error('Невозможно совершить операцию деления, один из параметров равен нулю',E_USER_ERROR);
    }

    if(is_string($a) || is_string($b) ){
       trigger_error('Один из параметров не является числом, и будет заменен на 1', E_USER_WARNING);
    }

    if(is_float($a) || is_float($b)){
        trigger_error('Один из параметров принадлежит к типу float и будет округлен в сторону к нулю', E_USER_NOTICE);
    }

}
set_error_handler("userErrorHandler");



//myExample(5,0);
myExample(10, '11');
//myExample(5, 5.1);


