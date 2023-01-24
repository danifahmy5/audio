<?php


function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (!function_exists('searchHashtag')) {
    function searchHashtag($string)
    {
        $output = [];
        if (preg_match_all('/#([^\s]+)/', $string, $matches)) {
            $output = $matches[1];
        }
        return $output;
    }
}

function highlight_word($content, $word)
{
    $replace = '<span style="background-color: rgb(240, 255, 0);">' . $word . '</span>'; // create replacement
    $content = str_replace($word, $replace, $content); // replace content

    return $content; // return highlighted data
}

function indexToNumber($index, $page = 1)
{
    return $index + 1 * $page * 10 - 10 + 1;
}

function separateOpenTime($index)
{
    switch ($index) {
        case 0:
            return true;
            break;

        default:
            # code...
            break;
    }
}
