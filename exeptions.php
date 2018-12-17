
<?php

function exceptionHandler($exception ) {
    $time = date("Y-m-d H:i:s");
    $exept = "Time " . $time . "\n";
    $exept .= get_class($exception).  "\n";
    $exept .= $exception->getMessage() . "\n";
    $exept .= 'Stack trace: ' . $exception->getTraceAsString() . "\n";
    $exept .= 'thrown in ' . $exception->getFile() . ' on line ' . $exception->getLine() . "\n";
    $exept .="\n". "\n". "\n";
    error_log( $exept, 3, "/OSPanel/domains/errors_func/exeptions.log");

}

set_exception_handler('exceptionHandler');


function myExample($a, $b){
    if ($a == 0 || $b == 0){
        throw new Exception('Невозможно совершить операцию деления, один из параметров равен нулю');
        //trigger_error('Невозможно совершить операцию деления, один из параметров равен нулю',E_USER_ERROR);
    }

    if(is_string($a) || is_string($b) ){
        throw new Exception('Один из параметров не является числом, и будет заменен на 1');

    }

    if(is_float($a) || is_float($b)){
        throw new Exception('Один из параметров принадлежит к типу float и будет округлен в сторону к нулю');

    }

}


try {
    myExample(5,0);
}   catch (Exception $e) {
    echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
}
