<?php

/*
For an array with n elements, a = (a1, a2, a3, … , an), find the maximum possible sum of a contiguous subarray. If the maximum element is bigger than the sum, return that element.

INPUT
int[] a

OUTPUT
int maximum_sum

CONSTRAINTS
1 <= n <= 10^6
-10^3 <= ai <= 10^3

EXAMPLE
Input
[-2,1,-3,4,-1,2,1,-5,4]

Output
6
*/
function maxSumOfSubarray(array $a): ?int {
    $maxsum = max($a);

    for($i = 2; $i <= count($a); $i++) { // pairs of 2+
        for($j = 0; $j <= count($a) - $i; $j++) { // from pos 0 up to pos
            $sum = array_sum(array_slice($a, $j, $i));
            if($sum > $maxsum) $maxsum = $sum;
        }
    }

    return $maxsum;
}