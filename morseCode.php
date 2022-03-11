<?php

/*
Today's challenge is about English.
We want you to write a program that converts Morse code to English text and English text to Morse code. You can choose your favorite programming language to solve the challenge.

As a rule, for every Morse sentence, we should consider a space between morse letters, and three spaces between morse words (" " => " ") (also two spaces in english are equivalent to six spaces in morse ).

If the morse code that is going to be translated is not valid or the spacing is not correct, you should ouput 'Invalid Morse Code Or Spacing'

INPUT
boolean morseToEnglish
^^ true if the given input text is in morse and false if it is in english

string textToTranslate
^^ a string containing the text we wish to translate

OUTPUT
string translatedText
^^ a string containing the input text, translated

EXAMPLE
Input
false,"The wizard quickly jinxed the gnomes before they vaporized."

Output
- .... .   .-- .. --.. .- .-. -..   --.- ..- .. -.-. -.- .-.. -.--   .--- .. -. -..- . -..   - .... .   --. -. --- -- . ...   -... . ..-. --- .-. .   - .... . -.--   ...- .- .--. --- .-. .. --.. . -.. .-.-.-

CONSTRAINTS
0 < nrCharacters <= 100 000
*/
function morseCode(bool $morseToEnglish, string $textToTranslate): string {
    $morse = [
        "a"=>".-",
        "b"=>"-...", 
        "c"=>"-.-.", 
        "d"=>"-..", 
        "e"=>".", 
        "f"=>"..-.", 
        "g"=>"--.", 
        "h"=>"....", 
        "i"=>"..", 
        "j"=>".---", 
        "k"=>"-.-", 
        "l"=>".-..", 
        "m"=>"--", 
        "n"=>"-.", 
        "o"=>"---", 
        "p"=>".--.", 
        "q"=>"--.-", 
        "r"=>".-.", 
        "s"=>"...", 
        "t"=>"-", 
        "u"=>"..-", 
        "v"=>"...-", 
        "w"=>".--", 
        "x"=>"-..-", 
        "y"=>"-.--", 
        "z"=>"--..", 
        "0"=>"-----",
        "1"=>".----", 
        "2"=>"..---", 
        "3"=>"...--", 
        "4"=>"....-", 
        "5"=>".....", 
        "6"=>"-....", 
        "7"=>"--...", 
        "8"=>"---..", 
        "9"=>"----.",
        "."=>".-.-.-",
        ","=>"--..--",
        "?"=>"..--..",
        "/"=>"-..-.",
        " "=>" "
    ];

    // add a space after each morse symbol
    foreach($morse as $key => $symbol)
        $morse[$key] = $symbol.' ';
    
    // initialize the result string
    $s = '';

    if(!$morseToEnglish) {
        $textToTranslate = strtolower($textToTranslate);

        for($i = 0; $i < strlen($textToTranslate); $i++)
            $s .= $morse[$textToTranslate[$i]];

            $s = rtrim($s, ' ');
    } else {
        $morseFlip = array_flip($morse);
        $textToTranslate .= " ";
        
        while(strlen($textToTranslate) > 0) {
            $space = strpos($textToTranslate, ' ', 1);
            $morseLetter = substr($textToTranslate, 0, $space + 1);
            if(!in_array($morseLetter, $morse)) {
                return 'Invalid Morse Code Or Spacing';
            } else {
                $s .= $morseFlip[$morseLetter];
                $textToTranslate = substr($textToTranslate, $space + 1);
            }
        }
    }

    return $s;
}

$str = "- .... .   .-- .. --.. .- .-. -.. ..--..   -.-- . ... --..--   .. -   --.- ..- .. -.-. -.- .-.. -.--   .--- .. -. -..- . -..   .---- -----   --- ..-.   - .... .   --. -. --- -- . ...   -... . ..-. --- .-. .   - .... . -.--   ...- .- .--. --- .-. .. --.. . -.. .-.-.-";
echo $str."<br>";
$morse = morseCode(false, "The wizard? Yes, it quickly jinxed 10 of the gnomes before they vaporized.");
echo $morse."<br>";
if($str == $morse) var_dump(true);

$en = morseCode(true, $morse);
var_dump($en);