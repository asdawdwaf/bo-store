<?php

// error_reporting(0);

$token = file_get_contents('token.txt');
$dir = str_replace('/setwebhook.php', '/asyn.php', $_SERVER['PHP_SELF']);

if (empty($token)){
	if (!$_GET['token']){
		die("O token informado está inválido!");
	}else{
		$token = $_GET['token'];
	}
}
$server = $_SERVER['SERVER_NAME'];
if (!$_SERVER['HTTP_X_FORWARDED_PROTO'] and $_SERVER['HTTP_X_FORWARDED_PROTO'] != "https" ){
	die("A url do bot deve ser https ");
}

$res = file_get_contents('https://api.telegram.org/bot'.$token.'/setwebhook?url='."https://".$server.$dir);




if ($res){
	if (strpos($res, 'Webhook was set') !==false || strpos($res, 'Webhook is already set')!==false){
		file_put_contents('token.txt', trim($token));
		die("Parabéns! Fizemos a atualização em seu bot e agora ele está online.");
	}else{
		die("Verifique o erro identificado:".json_decode($res,true)['description']);
	}

}else{
	die("O provedor não está com certificado SSL atualizado, por tanto não irá funcionar a StoreBot !");

	echo $res;
}
