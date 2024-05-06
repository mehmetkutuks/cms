<?php

function convertToSeo($text)
{
    $turkish = array("ç","Ç","ğ","Ğ","ü","Ü","ö","Ö","ı","İ","ş","Ş",".",",","!","'","/","?","\"","*","=","|","{","}","[","]","(",")"," ");
    $convert = array("c","c","g","g","u","u","o","o","i","i","s","s","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-", "-");

    return strtolower(str_replace($turkish, $convert, $text));
}


function getFileName($id)
{

    $CI = get_instance();
    $CI->load->model('product_image_model');
    $fileName = $CI->product_image_model->get(
        array(
            "id" => $id
        )
    );

    return $fileName;
}