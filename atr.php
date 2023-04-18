<?php

$idtelegram = $_GET['id_telegram'];
$username = $_GET['username'];
$token = $_GET['tokenbot'];
$usergrupo = $_GET['usergrupo'];
$manutencao = $_GET['manutencao'];
$suporte = $_GET['suporte'];
$mercadopago = $_GET['mercadopago'];
$checker = $_GET['checker'];

$atualdados = json_decode(file_get_contents("bot/resource/conf.json")  , true);

$atualdados['dono'] = trim($idtelegram);

$atualdados['userDono'] = trim($username);

$atualdados['usergrupo'] = trim($usergrupo);

$atualdados['manutencao'] = trim($manutencao);

$atualdados['suporte'] = trim($suporte);

$atualdados['mercadopago'] = trim($mercadopago);

$atualdados['checker'] = trim($checker);

$dsalva = json_encode($atualdados,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT );
$salva = file_put_contents('bot/resource/conf.json', $dsalva);

file_put_contents("bot/token.txt", trim($token));