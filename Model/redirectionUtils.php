<?php

function buildUrl($query=null, $params=null): string {
    $header = "/index.php";
    $params_string = "";

    if (!empty($query)) {
        $params_string = "?query=$query";
        foreach ($params as $param => $value) {
            $params_string .= "&$param=$value";
        }
    }
    return $header.$params_string;
}

function redirectLocation($query=null, $params=null) : void
{
    $url = buildUrl($query, $params);

    header("Location:$url");
}
