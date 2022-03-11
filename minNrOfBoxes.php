<?php

/**
 * Return the minimum number of boxes needed to hold a given number of items

* @param int $items the nr of items to be put into boxes
* @param int $lc the nr of large boxes(1 large box fits 5 items)
* @param int $sc the nr of small boxes(1 small box fits 1 item)
*
* @return integer
*/
function minNrOfBoxes(int $items, int $lc, int $sc) : int {
    $nr = 0;

    if($lc*5 == $items) {
        return $lc;
    } else {
        if($lc*5 > $items) {
            $bigOnes = (int)($items/5);
            $nr += $bigOnes;
            $items -= $bigOnes*5;
        } else if($lc*5 < $items) {
            $nr = $lc;
            $items -= $lc*5;
        }

        if($items <= $sc) {
            $nr += $items;
            return $nr;
        } else {
            return -1; // can't put them all in boxes
        }
    }
}

echo minNrOfBoxes(16, 2, 10);