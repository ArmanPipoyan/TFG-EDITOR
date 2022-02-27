<?php
session_start();

// Get the access token from github if it's not already set
if (isset($_SESSION['access_token'])) {
    $curl_url = "https://github.com/login/oauth/access_token";
    $params = array(
        'client_id'=>'8f808ec545de8d67461f',
        'client_secret'=> '723ccde9455179ffc343a003c60ec6a78bac26de',
        'code'=> '26765b4a620aca2e9e34 '
    );
    $curl_url = $curl_url . '?' . http_build_query($params);
    $ch = curl_init($curl_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    $response = curl_exec($ch);
    curl_close($ch);
    $_SESSION['access_token'] = $response['access_token'];
}

// With the access token now we are able to commit the file
$data_array = array(
    'message'=>'image',
    'content'=> base64_encode("demo.txt"),
    'committer'=> array(
        'name'=>'ArmanPipoyan',
        'email' => 'arman.pipoyan26@gmail.com'
    )
);

$curl_url = "https://api.github.com/repos/ArmanPipoyan/jupyter_notebook/contents/demo.txt";
$token = "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";
$curl_token_auth = 'Authorization: token ' . $token;
$ch = curl_init($curl_url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'User-Agent: $username', $curl_token_auth));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_array));

$response = curl_exec($ch);
curl_close($ch);
$response = json_decode($response);

print_r ($response);
return $response;