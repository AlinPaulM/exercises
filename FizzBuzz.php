<?php

// FIZZBUZZ
function run(int $N, int $M): ?string {
    if($N > $M) return null;

    $sequence = '';
    for($i = $N; $i <=$M; ++$i){
        if($i%3 == 0 && $i%5 == 0) $sequence .= 'FizzBuzz';
        else if($i%3 == 0) $sequence .= 'Fizz';
        else if($i%5 == 0) $sequence .= 'Buzz';
        else $sequence .= $i;
        $sequence .= ',';
    }
    $sequence = rtrim($sequence, ',');

    return $sequence;
}