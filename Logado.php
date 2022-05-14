<?php

require 'vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/*
if (!isset($_COOKIE['UserTOKEN'])) {
    header("Location: JWT.php");
}
*/ 

$Token = new stdClass();
$Token->public = file_get_contents("http://localhost/JWT/Key/public.pem");
$Token->private = file_get_contents("http://localhost/JWT/Key/private.pem");

$Client = new stdClass();
$Client->ClientToken = $_COOKIE['UserTOKEN'];


$ProcessToken = JWT::decode($Client->ClientToken, new Key($Token->public, 'RS256'));
echo "<pre>";
print_r($ProcessToken);
echo $ProcessToken->InformationAccount->UserToken;
