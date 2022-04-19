<?php

function redirect_location($query=null, $params=null) : void
{
    $header = "/index.php";
    $params_string = "";

    if (!empty($query)) {
        $params_string = "?query=$query";
        foreach ($params as $param => $value) {
            $params_string .= "&$param=$value";
        }
    }

    header("Location:$header$params_string");
}
