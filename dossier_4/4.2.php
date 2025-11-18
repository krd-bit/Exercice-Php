<?php

function my_str_contains($haystack, $needle) {
    if (strlen($needle) > strlen($haystack)) {
        return false;
    }

    
    for ($i = 0; $i < strlen($haystack); $i++) {
        $trouve = true;
        
        
        for ($j = 0; $j < strlen($needle); $j++) {
            if (!isset($haystack[$i + $j]) || $haystack[$i + $j] !== $needle[$j]) {
                $trouve = false;
                break;
            }
        }

        if ($trouve) {
            return true;
        }
    }
    return false;
}


var_dump(my_str_contains("hello world", "hello")); 
var_dump(my_str_contains("hello", "hello world")); 

?>