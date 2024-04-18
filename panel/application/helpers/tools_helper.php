<?php

function convertToSeo($text)
{
    $turkish = array("ç","Ç","ğ","Ğ","ü","Ü","ö","Ö","ı","İ","ş","Ş",".",",","!","'","/","?","\"","*","=","|","{","}","[","]","(",")"," ");
    $convert = array("c","c","g","g","u","u","o","o","i","i","s","s","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-", "-");

    return strtolower(str_replace($turkish, $convert, $text));
}