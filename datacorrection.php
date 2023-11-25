<?php
function datacorrection($word){
    $word = htmlspecialchars($word);
    $word = trim($word);
    $word = stripslashes($word);
    return $word;
}
?>