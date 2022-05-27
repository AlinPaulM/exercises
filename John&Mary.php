<?php

// check if the strings 'John' and 'Mary' appear the same nr of times in $string, case insensitively
function johnMary(string $string) : bool
{
    $string1 = $string;
    $string2 = $string;
    $cnt1 = 0;
    $cnt2 = 0;
    while(($pos = stripos($string1, 'john')) !== false) {
        $cnt1++;
        $string1 = substr($string1, $pos+4);
    }

    while(($pos = stripos($string2, 'mary')) !== false) {
        $cnt2++;
        $string2 = substr($string2, $pos+4);
    }
    
    return $cnt1 == $cnt2;
}

echo johnMary("John&Mary") ? "True" : "False";