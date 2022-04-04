<?php
// 1 word anagrams
function anagrams (array $dict, string $word):array {
    $result = [];

    foreach($dict as $k=>$entry) {
        $entrycp = $entry;

        if(strlen($entry) != strlen($word)) continue;

        for($i = 0; $i < strlen($word); $i++) {
            $pos = strpos($entrycp, $word[$i]);
            if($pos === false) {
                continue 2; // check next entry
            } else {
                $entrycp = substr_replace($entrycp, '', $pos, 1); // remove the 1 letter found at pos $pos
            }
        }
        
        if($entrycp === '') $result[] = $entry;
    }

    return $result;
}

var_dump(anagrams(['sadk', 'east', 'stay', 'stae'], 'seat'));