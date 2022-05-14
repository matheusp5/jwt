<?php

require 'vendor/autoload.php';

use Firebase\JWT\JWT;

if (isset($_POST['CreateToken'])) {

    $Cliente = new stdClass();
    $Cliente->id = 35480964;
    $Cliente->UserToken = 905732043564827;

    $Token = new stdClass();
    $Token->public = file_get_contents("http://localhost/JWT/Key/public.pem");
    $Token->private = file_get_contents("http://localhost/JWT/Key/private.pem");

    $payload = [
        "InformationAccount" => [
            "ID" => $Cliente->id,
            "UserToken" => $Cliente->UserToken
        ],
        "InfomationJWT" => [
            "Open" => date("d-m-Y H:i:s"),
            "Expire" => date('d-m-Y H:i:s', strtotime('+1 days'))
        ]
    ];

    $TokenJWT = JWT::encode($payload, $Token->private, 'RS256');
    $informationCookie = setcookie("UserTOKEN", $TokenJWT);

    if ($informationCookie) {
        if (isset($_COOKIE['UserTOKEN'])) {
            echo "Authentic Games";
        } else {
            throw new ErrorException("Token Error on Cookie");
        }
    } else {
        throw new Exception("Stoped Token Error");
    }

    header("Location: Logado.php");

    #$decoded = JWT::decode($jwt, new Key($Token->public, 'RS256'));
    #$decoded_array = (array) $decoded;
    #echo "Decode:\n" . print_r($decoded_array, true) . "\n";
}
?>

<form action="" method="post">
    <input type="submit" name="CreateToken">
</form>