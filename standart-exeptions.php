<?php

class myExceptions extends Exception {

}


function sum($a, $b){
    if  ($a > $b){
        throw new DomainException ("a должно быть меньше 5");
    }

    if(is_string($a) || is_string($b)){
        throw new InvalidArgumentException('На входе ожидалось число!');
    }

    if($a == $b){
        throw new myExceptions('Переменные не должны быть равны');
    }
}

try {
    $a =5; $b=1;
    sum($a, $b);
    echo $a . "\n";
    echo $b . "\n";
}   catch (\InvalidArgumentException|\DomainException $e) {
            echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
}
echo "<br>";
try {
    $a =5; $b=5;
    sum($a, $b);
    echo $a . "\n";
    echo $b . "\n";
}   catch (myExceptions $e) {
    echo 'Выброшено собственное исключение: ',  $e->getMessage(), "\n";
}