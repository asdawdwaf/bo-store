<?php
error_reporting(0);
ignore_user_abort();
$confibot = json_decode(file_get_contents('./resource/conf.json') , true);

function clientes($message){






	$chat_id = $message["chat"]["id"];






	$from_id = $message["from"]["id"];













	$text = strtolower($message['text']);






	preg_match_all('/[a-z-A-Z-0-9]*+/', $text, $args);






	$args = array_values(array_filter($args[0]));






	$cmd = $args[0];













	atualizasaldo($chat_id);













	if ($cmd == 'start'){













		$nome = $message['from']['first_name'];






		$idwel = $message['from']['id'];






		$conf = json_decode(file_get_contents("./resource/conf.json") , true);


   	$clientes = json_decode(file_get_contents("./usuarios.json") , true);






		$saldo = $clientes[$chat_id]['saldo'];










		if ($conf['welcome'] != ""){






			$txt = $conf["welcome"];










$historicocc = json_decode(file_get_contents("./ccsompradas.json") , true);
$totalccs = (sizeof($historicocc[$chat_id]['ccs'])) ? sizeof($historicocc[$chat_id]['ccs']) : 0 ;


			$txt = str_replace("{nome}", $nome, $txt);



			$txt = str_replace("{id}", $idwel, $txt);
			
			
					
			$txt = str_replace("{saldo}", $saldo, $txt);
			
			$txt = str_replace("{compras}", $totalccs, $txt);













		}else{






			$txt = "*Olá $nome, use os comandos abaixo para Interagir comigo!*";






		}






	

	$menu =  ['inline_keyboard' => [






		[['text'=>"💳 Comprar",'callback_data'=>"loja"] , ['text'=>"👤 Informações",'callback_data'=>"menu_infos"] , ['text'=>"⚙️ Dev",'url'=>"{$confibot[suporte]}"]]













	,]];

	$confibot = json_decode(file_get_contents('./resource/conf.json') , true);

	$botoes[] = ['text'=>"💳 Comprar",'callback_data'=>"loja"];

	$botoes[] = ['text'=>"💵 Adicionar Saldo",'callback_data'=>"comprasaldo"];

	$botoes[] = ['text'=>"👤 Informações",'callback_data'=>"menu_infos"];

	$botoes[] = ['text'=>"🧰 Menu Checker",'callback_data'=>"volta_loja"];

	$botoes[] = ['text'=>"👨‍💻 Suporte",'url'=>"{$confibot[suporte]}"];

	$botoes[] = ['text'=>"⚙️ Dev",'url'=>"https://t.me/pladixoficial"];

	$menu['inline_keyboard'] = array_chunk($botoes, 2);
	$confibot = json_decode(file_get_contents('./resource/conf.json') , true);

	$txt = "━━━━━━━━━━━━━━━━━━━━━━
💳 *Olá $nome, seja bem vindo(a) na StoreBot e desde já agradecemos por ter você aqui. :D* 💳 
━━━━━━━━━━━━━━━━━━━━━━
✅ *Cartões são testados  no checker antes de enviar ao cliente!*
👤 *Enviamos material com Nome e CPF!*
💰 *Realize suas recargas com Pix Automático! (/pix)*
💳 *Colhidas diariamente no painel!*
━━━━━━━━━━━━━━━━━━━━━━
ℹ️ *Nosso Grupo Oficial: {$confibot[usergrupo]}*
━━━━━━━━━━━━━━━━━━━━━━
💬 *Está precisando de um suporte? {$confibot[userDono]}*
━━━━━━━━━━━━━━━━━━━━━━";



		bot("sendMessage",array("chat_id"=> $chat_id , "text" => $txt,"reply_markup" =>$menu,"reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown'));






	 






	}if (preg_match("/[0-9]{6}/", $message['text'])){













		buscabin($message);






		die;






	}













	if (preg_match("/[0-9-A-Z]{10}/", $message['text'],$cod)){













		usagift($message,$cod[0]);






		die();






	}













	if ($cmd == "country"){






		selectbase($message);






		die;






	}













	// bot("sendMessage" , array("chat_id" => $chat_id , "text" => $cmd));













}


































function query($msg){






	













	$idquery = $msg['id'];






	$idfrom = $msg['from']['id'];






	$message = $msg['message'];






	$dataquery = $msg['data'];













	$userid = $msg['from']['id'];






	$userid2 = $msg['message']['reply_to_message']['from']['id'];






	$chatid = $msg['message']['chat']['id'];













	if ($userid != $userid2){






		bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Sem permissão!","show_alert"=>false,"cache_time" => 10));






		die();






	}













	if (explode("_", $dataquery)[0] == "volta"){






		$cmd = explode("_", $dataquery)[1];






		$cmd($message);













	}else if (explode("_", $dataquery)[0] == "compracc"){






		$cmd = explode("_", $dataquery)[0];






		$cmd($message,$msg,explode("_", $dataquery)[1]);













	}else if (explode("_", $dataquery)[0] == "altercc"){






		$cmd = explode("_", $dataquery)[0];






		$cmd($message,explode("_", $dataquery)[1],explode("_", $dataquery)[2],$msg);













	}else if (explode("_", $dataquery)[0] == "compramix"){






		$cmd = explode("_", $dataquery)[0];






		$cmd($message,explode("_", $dataquery)[1],explode("_", $dataquery)[2],$msg);













	}else if (explode("_", $dataquery)[0] == "alterValue"){






		$cmd = explode("_", $dataquery)[0];






		$cmd($message,$msg,explode("_", $dataquery)[1],explode("_", $dataquery)[2],explode("_", $dataquery)[3]);













	}else if (explode("_", $dataquery)[0] == "altermix"){






		$cmd = explode("_", $dataquery)[0];






		$cmd($message,$msg,explode("_", $dataquery)[1],explode("_", $dataquery)[2],explode("_", $dataquery)[3]);













	}else if (explode("_", $dataquery)[0] == "comprasearch"){






		$cmd = explode("_", $dataquery)[0];






		$cmd($message,explode("_", $dataquery)[1],explode("_", $dataquery)[2],$msg);













	}else if (explode("_", $dataquery)[0] == "altersaldoe"){






		$cmd = explode("_", $dataquery)[0];






		$cmd($message,$msg,explode("_", $dataquery)[1],explode("_", $dataquery)[2]);













	}else if (explode("_", $dataquery)[0] == "users"){






		$cmd = explode("_", $dataquery)[0];






		$cmd($message,$msg,explode("_", $dataquery)[1],explode("_", $dataquery)[2]);













	}else if (explode("_", $dataquery)[0] == "select"){






		$cmd = explode("_", $dataquery)[0];






		$cmd($message,$msg,explode("_", $dataquery)[1]);













	}else if (explode("_", $dataquery)[0] == "viewcard"){






		$cmd = explode("_", $dataquery)[0];






		$cmd($message,$msg,explode("_", $dataquery)[1],explode("_", $dataquery)[2]);













	}else if (explode("_", $dataquery)[0] == "altercard"){






		$cmd = explode("_", $dataquery)[0];






		$cmd($message,$msg,explode("_", $dataquery)[1],explode("_", $dataquery)[2],explode("_", $dataquery)[3],explode("_", $dataquery)[4]);













	}else if (explode("_", $dataquery)[0] == "compraccs"){






		$cmd = explode("_", $dataquery)[0];






		






		$cmd($message,$msg,explode("_", $dataquery)[1],explode("_", $dataquery)[2],explode("_", $dataquery)[3]);













	}else if (explode("_", $dataquery)[0] == "envia"){






		$cmd = explode("_", $dataquery)[0];






		






		$cmd($message,$msg,explode("_", $dataquery)[1] , explode("_", $dataquery)[2] , explode("_", $dataquery)[3] );













	}else{






		$dataquery($message);






	}






}


































/*alter user*/




















function users($message , $query , $type , $position){




















	






	$chat_id = $message["chat"]["id"];






	$idquery = $query['id'];




















	$users = json_decode(file_get_contents("./usuarios.json"),true);













	






	$chunk = array_chunk($users, 10);













	$tt = sizeof($chunk);




















	if ($type == "prox"){






		if ($chunk[ $position + 1]){






			






			$postio4n = $position +1;






		}else{






			die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Acabou!!!","show_alert"=> false,"cache_time" => 10)));






		}






	}else{






		if ($chunk[ $position - 1]){






			






			$postio4n = $position  - 1;













		}else{






			die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Acabou!!!","show_alert"=> false,"cache_time" => 10)));






		}






	}













	$userss = $chunk[$postio4n];













	$indexs = array_chunk(array_keys($users), 10)[$postio4n];













	$t = sizeof($chunk);













	$d = $postio4n +1;













	$txt .= "<b>✨ LISTA DE USUARIOS DO BOT\n🍃mostrando: $d de $t</b>\n";






	foreach ($userss as $iduser => $value44) {













		$idcarteira = $indexs[$iduser];













		$nome = ($value44['nome'])? $value44['nome'] : "Sem Nome";













		$nome = str_replace(["</>" ], "", $nome);






		$saldo = ($value44['saldo']) ? $value44['saldo'] : 0;













		$dadta = (date("d/m/Y H:s:i" , $value44['cadastro']))? date("d/m/Y H:s:i" , $value44['cadastro']) : "Sem Data";













		$txt .= "\n🧰<b>Id da carteira:</b> {$idcarteira}\n";






		$txt .= "💎<b>Nome: </b>{$nome}\n";






		$txt .= "💰<b>Saldo: </b> {$saldo}\n";






		$txt .= "📅<b>Data Cadastro: </b> {$dadta}\n";













	}













	$menu =  ['inline_keyboard' => [













	[






		['text'=>"<<",'callback_data'=>"users_ant_{$postio4n}"] , ['text'=>">>",'callback_data'=>"users_prox_{$postio4n}"]






	] ,[






		['text'=>"🔙 Voltar",'callback_data'=>"menu"]






	]













	,]];













	bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => $txt,"reply_to_message_id"=> $message['message_id'],  "parse_mode" => "html","reply_markup" =>$menu));


































}




















/*













envia msg para os users 













*/













function envia($message , $query , $opt , $postion ){






	$chat_id = $message["chat"]["id"];






	$dados = json_decode(file_get_contents("./usuarios.json") , true);






	$idquery = $query['id'];






	$msg = file_get_contents("./msgs.txt");













	$t = sizeof(array_chunk(array_keys($dados), 50));













	$json = array_chunk(array_keys($dados), 50)[$postion];






	if (!array_chunk(array_keys($dados), 50)[$postion]){






		die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Todos os usuarios já receberam a mensagem!!!","show_alert"=> false,"cache_time" => 10)));






	}













	$tenviados = 0;






	$tnenviados = 0;






	$usersdell = [];













	$nenv = $postion +1;













	foreach ($json as $value) {













		$sendmessage = bot("sendMessage" , array("chat_id" => $value , "text" => $msg , "parse_mode" => "Markdown" ));













		if (!$sendmessage){






			






			if ($opt == "sim" || $opt == 'sim'){






				delluser($value);






				$usersdell[] = $value;






			}






			$tnenviados++;






		}else{






			$tenviados++;






		}













	}













	$usersap = implode(",", $usersdell);













	$txt .= "<b>✨ Enviando .. !</b>\n\n";






	$txt .= "<b>📩 Msg: {$msg}</b>\n\n";






	$txt .= "<b>🔝 Enviado {$nenv} de {$t} !</b>\n";






	$txt .= "<b>✅ Enviados: {$tenviados}!</b>\n";






	$txt .= "<b>❌ Nao Enviados: {$tnenviados} !</b>\n";






	$txt .= "<b>🗑 Users Apagados: {$usersap}!</b>\n";













	$postio4n = $position++;













	$menu =  ['inline_keyboard' => [






		[ 






			['text'=>"Continuar",'callback_data'=>"envia_{$opt}_{$postio4n}"]






		]






	,]];













	bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => $txt,"reply_to_message_id"=> $message['message_id'],"parse_mode" => 'html',"reply_markup" =>$menu));






}



























/*













	perfil usuario !













*/




















function menu_infos($message){






	$chat_id = $message["chat"]["id"];













	$historicocc = json_decode(file_get_contents("./ccsompradas.json") , true);






	$dados = json_decode(file_get_contents("./usuarios.json") , true);






	$historicosaldo = json_decode(file_get_contents("./salcocomprado.json") , true);






	






	$conf = json_decode(file_get_contents("./resource/conf.json") , true);













	$cliente = $dados[$chat_id];






	$menu =  ['inline_keyboard' => [[],]];






	$result = json_decode(bot("getMe" , array("vel" => "")) , true);






	$userbot = $result['result']['username'];






	$botoes[] = ['text'=>"💳 CCs compradas",'callback_data'=>"ccscompradas"];






	$botoes[] = ['text'=>"💳 Mix comprados",'callback_data'=>"mixscomprados"];






	$botoes[] = ['text'=>"💰 Saldo comprado",'callback_data'=>"saldocomprado"];


	$botoes[] = ['text'=>"🔗 Link de referência",'url'=>"http://t.me/$userbot?start=$chat_id"];



	$botoes[] = ['text'=>"🔙 Voltar",'callback_data'=>"volta_menu"];






	$menu['inline_keyboard'] = array_chunk($botoes, 2);













	$txt = '👤 * Minha conta*'."\n*- Aqui você pode visualizar detalhes da sua conta ou realizar alterações.*\n\n";






	$txt .= "🏷️ *Nome:* {$cliente[nome]}\n";






	$txt .= ($cliente['username']) ? "👤 *User: @{$cliente[username]}*\n": "👤 *User:* sem user\n";






	$txt .= ($cliente['adm'] == "true") ? "✅ *Admin:* Sim\n" : "🚫 *Admin:* Não\n";






	$txt .= ($cliente['cadastro']) ? "🗓️ *Data de cadastro*: ".date("d/m/Y H:i:s" , $cliente['cadastro'])."\n" : "🗓️ *Data de cadastro:* sem registro\n";






	$txt .= "🆔 *ID da carteira:* `$chat_id`\n";






	$txt .= "💰 *Saldo:* {$cliente[saldo]}\n";


	$totalccs = (sizeof($historicocc[$chat_id]['ccs'])) ? sizeof($historicocc[$chat_id]['ccs']) : 0 ;



	$txt .= "\n🛒 *Compras Realizadas:* $totalccs\n";






	$totalccs = (sizeof($historicocc[$chat_id]['ccs'])) ? sizeof($historicocc[$chat_id]['ccs']) : 0 ;






	$txt .= "💳* Unidades compradas:* $totalccs\n";



$result = json_decode(bot("getMe" , array("vel" => "")) , true);






		$userbot = $result['result']['username'];


	$totalmixs = (sizeof($historicocc[$chat_id]['mixs'])) ? sizeof($historicocc[$chat_id]['mixs']) : 0 ;

	$txt .= "💳* Mix comprados:* $totalmixs\n";

	$txt .= "\n🔗 *Link de referência*\n- Convidando novos usuários pelo link abaixo, você recebe um bônus a cada vez que seus referenciados adicionarem saldo no bot.\n";

	$txt .= "\n🔗 *Divulgue o seu link de referência e obtenha valores em dinheiro!* - *http://t.me/$userbot?start=$chat_id*\n";






	bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => $txt,"reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown',"reply_markup" =>$menu));






}



























/*






	ver saldo comprado!






*/




















function saldocomprado($message){






	$saldocomprado = json_decode(file_get_contents("./salcocomprado.json") , true);













	$chat_id = $message["chat"]["id"];






	$b = [];






	$menu =  ['inline_keyboard' => [[],]];






	$b[] = ['text'=>"⬅️",'callback_data'=>"altersaldoe_ant_0"];






	$b[] = ['text'=>"➡️",'callback_data'=>"altersaldoe_prox_0"];






	$b[] = ['text'=>"🔙 Voltar",'callback_data'=>"menu_infos"];






	$menu['inline_keyboard'] = array_chunk($b, 2);













	$txt = "🛍️ *Suas últimas compras de saldo:*\n\n";






	






	if (sizeof($saldocomprado[$chat_id]) <= 0){






		$txt .= "*Não encontramos nenhum tipo de compra realizada por você nesta loja virtual.*\n\n";






		die(bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => $txt,"reply_to_message_id"=> $message['message_id'],  "parse_mode" => 'Markdown',"reply_markup" =>$menu)));






	}













	$dados = $saldocomprado[$chat_id];













	$split = array_chunk($dados, 2);













	$t = sizeof($split);













	$one = $split[0];













	$txt .= "*🔎 Mostrando 1 de {$t}*\n\n";













	foreach ($one as $value) {






		$txt .= "*Codigo:* {$value[codigo]}\n";






		$txt .= "*Valor:* {$value[valor]} (saldo)\n";






		$txt .= "*Expira:* ".date("d/m/Y H:i:s" , $value['datelimite'])."\n";






		$txt .= "*Comprado em:* ".date("d/m/Y H:i:s" , $value['date'])."\n\n";






	}






	$confibot = $GLOBALS[confibot];






	$txt .= "*Está com algum problema/reclamação, entre em contato com: {$confibot[userDono]}*";













	bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => $txt,"reply_to_message_id"=> $message['message_id'],  "parse_mode" => 'Markdown',"reply_markup" =>$menu));




















}













/*






	altera saldo comprado






*/













function altersaldoe($message,$query,$type , $position){













	$dados = json_decode(file_get_contents("./salcocomprado.json") , true);






	$chat_id = $message["chat"]["id"];






	$idquery = $query['id'];













	$txt = "🛍️ *Suas últimas compras de saldo:*\n\n";













	$chunk = array_chunk($dados[$chat_id], 2);













	if ($type == "prox"){






		if ($chunk[ $position + 1]){






			






			$postio4n = $position +1;






		}else{






			die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "➡️ Próxima compra não encontrada!","show_alert"=> false,"cache_time" => 10)));






		}






	}else{






		if ($chunk[ $position - 1]){






			






			$postio4n = $position  - 1;













		}else{






			die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "➡️ Anterior compra não encontrada!","show_alert"=> false,"cache_time" => 10)));






		}






	}













	$dadoscc = $chunk[$postio4n];













	$t = sizeof($chunk);













	$d = $postio4n +1;













	$txt .= "*🔎 Mostrando {$d} de {$t}*\n\n";













	foreach ($dadoscc as $value) {






		$txt .= "*Codigo:* {$value[codigo]}\n";






		$txt .= "*Valor:* {$value[valor]} (saldo)\n";






		$txt .= "*Expira:* ".date("d/m/Y H:i:s" , $value['datelimite'])."\n";






		$txt .= "*Comprado em:* ".date("d/m/Y H:i:s" , $value['date'])."\n\n";






	}






	






	$confibot = $GLOBALS[confibot];






	$txt .= "*Está com algum problema/reclamação, entre em contato com: {$confibot[userDono]}*";













	$b = [];






	$menu =  ['inline_keyboard' => [[],]];






	$b[] = ['text'=>"⬅️",'callback_data'=>"altersaldoe_ant_{$postio4n}"];






	$b[] = ['text'=>"➡️",'callback_data'=>"altersaldoe_prox_{$postio4n}"];






	$b[] = ['text'=>"🔙 Voltar",'callback_data'=>"menu_infos"];






	$menu['inline_keyboard'] = array_chunk($b, 2);













	bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => $txt,"reply_to_message_id"=> $message['message_id'],  "parse_mode" => 'Markdown',"reply_markup" =>$menu));






}




















/*













	ver mixs ksks






*/













function mixscomprados($message){













	$historicocc = json_decode(file_get_contents("./ccsompradas.json") , true);













	$chat_id = $message["chat"]["id"];






	$b = [];






	$menu =  ['inline_keyboard' => [[],]];






	$b[] = ['text'=>"⬅️",'callback_data'=>"altermix_ant_0_ccsompradas"];






	$b[] = ['text'=>"➡️",'callback_data'=>"altermix_prox_0_ccsompradas"];






	$b[] = ['text'=>"🔙 Voltar",'callback_data'=>"menu_infos"];






	$menu['inline_keyboard'] = array_chunk($b, 2);













	$txt = "🛍️ *Últimos pacotes de cartões comprados:*\n\n";






	






	if (sizeof($historicocc[$chat_id]['mixs']) <= 0){






		$txt .= "*Não encontramos nenhum tipo de compra em pacotes de cartões nesta loja virtual.*\n\n";






		die(bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => $txt,"reply_to_message_id"=> $message['message_id'],  "parse_mode" => 'Markdown',"reply_markup" =>$menu)));






	}






	$dados = $historicocc[$chat_id]['mixs'][0];













	$t = sizeof($historicocc[$chat_id]['mixs']);













	$txt .= "*🔎 Mostrando 1 de {$t}*\n\n";






	// $txt .= "*$dados*";






	$txt .= "*{$dados[cc]}*\n\n";













	$txt .= "Mix comprado em: {$dados[date]}\n\n";













	$confibot = $GLOBALS[confibot];






	$txt .= "*Está com algum problema/reclamação, entre em contato com: {$confibot[userDono]}*";






	bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => $txt,"reply_to_message_id"=> $message['message_id'],  "parse_mode" => 'Markdown',"reply_markup" =>$menu));




















	






}













/*






	alter mix 






*/













function altermix($message, $query , $type ,$position , $db ){



























	$dados = json_decode(file_get_contents("./{$db}.json") , true);













	$chat_id = $message["chat"]["id"];






	$txt = "🛍️ *Últimos cartões comprados:*\n\n";






	$idquery = $query['id'];













	$txt = "🛍️ *Últimos pacotes de cartões comprados:*\n\n";




















	if ($type == "prox"){






		if ($dados[$chat_id]['mixs'][ $position + 1]){






			






			$postio4n = $position +1;






		}else{






			die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "➡️ Próxima cc não encontrada!","show_alert"=> false,"cache_time" => 10)));






		}






	}else{






		if ($dados[$chat_id]['mixs'][ $position - 1]){






			






			$postio4n = $position  - 1;













		}else{






			die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Cc anterior nao encontrada.","show_alert"=> false,"cache_time" => 10)));






		}






	}













	$dadoscc = $dados[$chat_id]['mixs'][ $postio4n];













	$t = sizeof($dados[$chat_id]['mixs']);













	$d = $postio4n +1;













	$txt .= "*🔎Mostrando {$d} de {$t}*\n\n";






	$txt .= "*".trim($dadoscc[cc])."*\n\n";






	$txt .= "Mix comprado em: {$dadoscc[date]}\n\n";






	






	$confibot = $GLOBALS[confibot];






	$txt .= "*Está com algum problema/reclamação, entre em contato com: {$confibot[userDono]}*";













	$b = [];






	$menu =  ['inline_keyboard' => [[],]];






	$b[] = ['text'=>"⬅️",'callback_data'=>"altermix_ant_{$postio4n}_ccsompradas"];






	$b[] = ['text'=>"➡️",'callback_data'=>"aaltermix_prox_{$postio4n}_ccsompradas"];






	$b[] = ['text'=>"🔙 Voltar",'callback_data'=>"menu_infos"];






	$menu['inline_keyboard'] = array_chunk($b, 2);













	bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => $txt,"reply_to_message_id"=> $message['message_id'],  "parse_mode" => 'Markdown',"reply_markup" =>$menu));






}













/*






	ver ccs compradas 






*/













function ccscompradas($message){













	$historicocc = json_decode(file_get_contents("./ccsompradas.json") , true);













	$chat_id = $message["chat"]["id"];






	$b = [];






	$menu =  ['inline_keyboard' => [[],]];






	$b[] = ['text'=>"⬅️",'callback_data'=>"alterValue_ant_0_ccsompradas"];






	$b[] = ['text'=>"➡️",'callback_data'=>"alterValue_prox_0_ccsompradas"];






	$b[] = ['text'=>"🔙 Voltar",'callback_data'=>"menu_infos"];






	$menu['inline_keyboard'] = array_chunk($b, 2);













	$txt = "🛍️ *Últimos cartões comprados:*\n\n";






	






	if (sizeof($historicocc[$chat_id]['ccs']) <= 0){






		$txt .= "*Não encontramos nenhum cartão que tenha sido comprado aqui!*\n\n";






		die(bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => $txt,"reply_to_message_id"=> $message['message_id'],  "parse_mode" => 'Markdown',"reply_markup" =>$menu)));






	}






	$dados = $historicocc[$chat_id]['ccs'][0]['cc'];













	$t = sizeof($historicocc[$chat_id]['ccs']);













	$txt .= "*🔎Mostrando 1 de {$t}*\n\n";






	$txt .= "*💳CC:* {$dados[cc]}\n";






	$txt .= "*💳Bandeira:* {$dados[bandeira]}\n";






	$txt .= "*💳Tipo:* {$dados[tipo]}\n";






	$txt .= "*💳Level:* {$dados[nivel]}\n";






	$txt .= "*💳Banco:* {$dados[banco]}\n";






	$txt .= "*💳Pais:* {$dados[pais]}\n\n";













	$dia = $historicocc[$chat_id]['ccs'][0]['date'];






	






	$txt .= "*CC Comprada em:* {$dia}\n\n";













	$confibot = $GLOBALS[confibot];






	$txt .= "*Está com algum problema/reclamação, entre em contato com: {$confibot[userDono]}*";













	bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => $txt,"reply_to_message_id"=> $message['message_id'],  "parse_mode" => 'Markdown',"reply_markup" =>$menu));




















	






}




















/*






	altera cc do perfil






*/






function alterValue($message, $query , $type ,$position , $db ){



























	$dados = json_decode(file_get_contents("./{$db}.json") , true);













	$chat_id = $message["chat"]["id"];






	$txt = "🛍️ *Últimos cartões comprados:*\n\n";






	$idquery = $query['id'];













	$txt = "🛍️ *Suas últimas compras de saldo:*\n\n";




















	if ($type == "prox"){






		if ($dados[$chat_id]['ccs'][ $position + 1]){






			






			$postio4n = $position +1;






		}else{






			die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "➡️ Próxima cc não encontrada!","show_alert"=> false,"cache_time" => 10)));






		}






	}else{






		if ($dados[$chat_id]['ccs'][ $position - 1]){






			






			$postio4n = $position  - 1;













		}else{






			die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Cc anterior nao encontrada.","show_alert"=> false,"cache_time" => 10)));






		}






	}













	$dadoscc = $dados[$chat_id]['ccs'][ $postio4n]['cc'];













	$dia = $dados[$chat_id]['ccs'][ $postio4n]['date'];






	$t = sizeof($dados[$chat_id]['ccs']);













	$d = $postio4n +1;













	$txt .= "*🔎Mostrando {$d} de {$t}*\n\n";






	$txt .= "*💳CC:* {$dadoscc[cc]}\n";






	$txt .= "*💳Bandeira:* {$dadoscc[bandeira]}\n";






	$txt .= "*💳Tipo:* {$dadoscc[tipo]}\n";






	$txt .= "*💳Level:* {$dadoscc[nivel]}\n";






	$txt .= "*💳Banco:* {$dadoscc[banco]}\n";






	$txt .= "*💳Pais:* {$dadoscc[pais]}\n\n";






	$dia = $dados[$chat_id]['ccs'][ $postio4n]['date'];






	$txt .= "*CC Comprada em:* {$dia}\n\n";













	$confibot = $GLOBALS[confibot];






	$txt .= "*Está com algum problema/reclamação, entre em contato com: {$confibot[userDono]}*";






	













	$b = [];






	$menu =  ['inline_keyboard' => [[],]];






	$b[] = ['text'=>"⬅️",'callback_data'=>"alterValue_ant_{$postio4n}_ccsompradas"];






	$b[] = ['text'=>"➡️",'callback_data'=>"alterValue_prox_{$postio4n}_ccsompradas"];






	$b[] = ['text'=>"🔙 Voltar",'callback_data'=>"menu_infos"];






	$menu['inline_keyboard'] = array_chunk($b, 2);













	bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => $txt,"reply_to_message_id"=> $message['message_id'],  "parse_mode" => 'Markdown',"reply_markup" =>$menu));






}













/*













 resgata gift / codigo













*/













function usagift($message, $cod){






	






	$chat_id = $message["chat"]["id"];













	$gifts = json_decode(file_get_contents("./gifts.json") , true);






	$users = json_decode(file_get_contents("./usuarios.json") , true);






	$saldocomprado = json_decode(file_get_contents("./salcocomprado.json") , true);













	$menu =  ['inline_keyboard' => [[['text'=>"🔙 Voltar",'callback_data'=>"volta_loja"]],]];













	if (!$gifts[$cod]){






		die(bot("sendMessage" , array("chat_id" => $chat_id , "text" => "❌ *O código inserido não existe em nosso banco de dados da loja virtual, tente novamente com um código válido.*" , "reply_to_message_id" => $message['message_id'],"parse_mode" => "Markdown")));






	}






	






	$dg = $gifts[$cod];






	$valor = $dg['valor'];













	if ($dg['used'] == "true"){






		die(bot("sendMessage" , array("chat_id" => $chat_id , "text" => "❌ *Poxa!, sentimos muito mas este código já se encontra resgatado, tente novamente um código que não esteja usado e faça o bom uso de suas compras.*" , "reply_to_message_id" => $message['message_id'],"parse_mode" => "Markdown")));






	}













	// $date = strtotime("now");






	$date = strtotime("+1 week");






	$date1 = strtotime("now");













	$users[$chat_id]['saldo'] = $users[$chat_id]['saldo'] + $valor;






	$users[$chat_id]['dataLimite'] = $date;













	$saldocomprado[$chat_id][] = array("valor" => $valor , "datelimite" => $date , "date" => $date1 , "codigo" => $cod );













	$dsalva = json_encode($users,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT );






	$salva = file_put_contents('./usuarios.json', $dsalva);













	if ($salva){






		$gifts[$cod]['used'] = "true";






		$gifts[$cod]['cliente'] = $chat_id;













		$dsalva = json_encode($gifts,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT );






		$salva = file_put_contents('./gifts.json', $dsalva);






		// atualiza o historico de compradas 






		$dsalva2 = json_encode($saldocomprado,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT );






		$salva = file_put_contents('./salcocomprado.json', $dsalva2);








		$txt = "✅ *Parabéns! O saldo de $valor foi adicionado com sucesso em sua conta.*
🆙 *Desejamos boas compras, e que você continue compartilhando e comprando em nossa loja virtual para as continuarmos de pé, obrigado!*";




		bot("sendMessage" , array("chat_id" => $chat_id , "text" => "$txt" , "reply_to_message_id" => $message['message_id'],"parse_mode" => "Markdown"));






	}else{






		die(bot("sendMessage" , array("chat_id" => $chat_id , "text" => "❌ *Não conseguimos resgatar este código, possivelmente o sistema está com falhas ou o código já se encontra resgatado/inválido para esta loja virtual.*" , "reply_to_message_id" => $message['message_id'],"parse_mode" => "Markdown")));






	}













}




















/*






	compra saldo






*/













function comprasaldo($message){






	$chat_id = $message["chat"]["id"];






	$confibot = $GLOBALS[confibot];






	$nome = $message['reply_to_message']['from']['first_name'];













	$txt = "💰 *Comprar saldo* 💰\n\n❌ *Pix Automático desativado para manutenção.* ❌\n\nPara adicionar saldo na store,você deve contatar o dono {$confibot[userDono]}__\n\n";






	$txt .= "✅ *Aceito as seguintes formas de pagamento:*\n• Mercado Pago\n• PIX\n• Boleto\n• Lotérica\n\n✅ Pagar por Pix E-mail: *pladixoficialpag@gmail.com*\n\n";






	$txt .= "⚠️ *Por motivos de segurança seu saldo tem validade de 1 semana*!";



$confibot = $GLOBALS[confibot];
$valor = "1";
$host = $_SERVER["HTTP_HOST"];
$access_token = "{$confibot[mercadopago]}";
$chave = md5(uniqid());
$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => "https://api.mercadopago.com/checkout/preferences?access_token=$access_token",
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_HTTPHEADER => array(
'content-type:application/json'),
CURLOPT_POSTFIELDS => '{"items":[{"title":"@StoreBotV3 - '.$chat_id.'","currency_id":"BRL","quantity":1,"unit_price":'.$valor.'}],"back_urls":{"success":"https://pladix.live/pagamentos/","failure":"https://pladix.live/pagamentos/","pending":"https://pladix.live/pagamentos/notificacao.php","external_reference":"'.$chave.'"}'));
$request = curl_exec($ch); 
$dados = json_decode($request, true);
$init_point = $dados["init_point"];
$init_point = str_replace("\/", "\/", $init_point);
if(strpos($request, '"init_point":"')) {
$txt = "✅ *Geramos automaticamente um valor fixo de R$1,00 para adição de saldo em nossa store, por favor realize o pagamento abaixo pelo link de pagamento pelo método (Pix) e aguarde alguns instantes para ser liberado o seu novo saldo!*

🔄 *Clique aqui para realizar o pagamento: $init_point*

✔️ *Tempo de liberação: 5 minutos...*";
/*$txt = "ℹ️ *Você está adicionado saldo na StoreBot pela Forma de Pagamento (Pix)*

🔴 *Status do Pix: Tente novamente mais tarde, estamos em manutenção.*

✅ `O pix é a nova melhor forma de pagamento para adição de saldo na StoreBot e será de forma rápida e fácil, você vai apenas copiar o código que será gerado e realizar o pagamento que após isso já será feito a liberação do seu valor em saldo aqui em nossa loja virtual.`

⚠ *Para continuar você precisa informar um valor igual ou superior a 15, por exemplo: /recarga 15*

⚙ `Após isso será processado o valor escolhido e você receberá na próxima mensagem um código do cópia-cola do Pix para pagar, esperamos que não reste dúvidas e ótimo progresso a nós!`";*/
//bot("sendMessage" , array("chat_id" => $chat_id , "text" => "$txt" , "reply_to_message_id" => $message['message_id'],"parse_mode" => "Markdown"));
}else{
die(bot("sendMessage" , array("chat_id" => $chat_id , "text" => "*Desculpe, ocorreu um erro interno!*" , "reply_to_message_id" => $message['message_id'],"parse_mode" => "Markdown")));
}






	/*$menu =  ['inline_keyboard' => [






		[['text'=>"🔙 Voltar",'callback_data'=>"volta_menu"] , ['text'=>'🆗 Pague-agora!','url'=>''.$init_point.'']]





	,]];*/


$botoes[] = ['text'=>"🆗 Pague-agora",'url'=>"$init_point"];

$botoes[] = ['text'=>"⌛️ Pix Manual",'url'=>"{$confibot[suporte]}"];

$botoes[] = ['text'=>"🔙 Voltar",'callback_data'=>"volta_menu"];

$menu['inline_keyboard'] = array_chunk($botoes, 2);







bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => "$txt","reply_markup" =>$menu,"reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown' , 'force_reply' => true , "selective" => true));






}




















/*






	search exemplo do search






*/













function search ($message){






	$chat_id = $message["chat"]["id"];






	$nome = $message['reply_to_message']['from']['first_name'];






	$menu =  ['inline_keyboard' => [













		[['text'=>"🔙 Voltar",'callback_data'=>"volta_loja"]]






		,






	]];













	bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => "💳 *Você pode realizar uma busca em nosso banco de dados por uma Bin específica!*\n\n👉 *Use:*\n\n/search (bin)\nExemplo: /search 406669\n\nOu simplesmente envie a bin.\nExemplo: 402934","reply_markup" =>$menu,"reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown' , 'force_reply' => true , "selective" => true));






}




















/*






	busca a bin no json






*/






function buscabin($message){













	$chat_id = $message["chat"]["id"];






	$nome = $message['reply_to_message']['from']['first_name'];






	$pre = preg_match("/[0-9]{6}/", $message['text'],$bin);













	$menu =  ['inline_keyboard' => [













		[]













	,]];






	













	$clientes = json_decode(file_get_contents("./usuarios.json") , true);






	$searchs = json_decode(file_get_contents("./search.json") , true);






	$price = json_decode(file_get_contents("./resource/conf.json") , true)['price'];






	$bin = $bin[0];













	$msgbot = bot("sendMessage",array( "chat_id"=> $chat_id , "text" => "_*Aguarde estou buscando a bin... $bin*_","reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown'));




















	$message_id = json_decode($msgbot , true)['result']['message_id'];













	$ccs = [];






	$country = $clientes[$chat_id]['country'];






	$dir = './ccs/'.$country.'/';













	$itens = scandir($dir);






	






	if ($itens !== false) { 






		foreach ($itens as $item) { 






			$ccs[] =  explode(".", $item)[0];






		}






	}













	$levels = array_values(array_filter($ccs));






	






	$result = [];













	foreach ($levels as $key => $value) {






		$ccs = json_decode(file_get_contents("./ccs/{$country}/{$value}.json") , true);













		foreach ($ccs as $key => $value) {






			if (substr($value['cc'], 0,6) == $bin){






				$value['idcc'] = $key;






				$result[] = $value;






			}






		}






	}













	// bot("editMessageText",array( "message_id" => $message_id  , "chat_id"=> $chat_id , "text" => $result));













	// exit();













	if (empty($result)){






		$confibot = $GLOBALS[confibot];













		die(bot("editMessageText",array( "message_id" => $message_id , "chat_id"=> $chat_id , "text" => "*Não foi encontrado nenhum resultado para a bin $bin, entre em contato com o nosso vendedor e pergunte se há alguma disponivel em seu estoque*, _vendedor:_ *{$confibot[userDono]}*","reply_markup" =>$menu,"reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown')));













	}













	$botoes = [];




















	$dadoscc = $result[0];






	$idcc = $dados['idcc'];






	$level = $dados['nivel'];






	$preco  = ($price[$level]) ? $price[$level] : $price['Default'];













	$saldo = $clientes[$chat_id]['saldo'];













	






	$botoes[] = ['text'=>"⬅️",'callback_data'=>"altercc_ant_0"];






	






	$botoes[] = ['text'=>"➡️",'callback_data'=>"altercc_prox_0"];






	













	$txt .= "*Nível:* _$dadoscc[nivel]_\n\n";






	$bin = substr($dadoscc['cc'], 0,6);






	$txt .= "*Número:*_".$bin.'xxxxxxxxx'."_\n";






	$txt .= "*Validade: *_" . $dadoscc['mes'] .'/'.$dadoscc['ano'] ."_\n";






	$txt .= "*Banco: *_$dadoscc[banco]_\n";






	$txt .= "*País:* BRASIL\n";




















	$searchs[$chat_id] = $result;






	$dsalva = json_encode($searchs,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT );






	$salva = file_put_contents('./search.json', $dsalva);













	$menu['inline_keyboard'] = array_chunk($botoes, 3);













	$menu['inline_keyboard'][] = [['text'=>"🔙 Voltar",'callback_data'=>"volta_loja"]];













	$total = sizeof($result);






		






	bot("editMessageText",array( "message_id" => $message_id  , "chat_id"=> $chat_id , "text" => "*🔎Foi encontrada*  _{$total}_ *ccs com esta bin *_{$bin}_ *no banco de dados!*\n\n$txt","reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown',"reply_markup" =>$menu));




















}




















/*






	






	altera cc do search!






	






*/













function altercc($message,$type , $postion , $query){













	$chat_id = $message["chat"]["id"];






	$nome = $message['reply_to_message']['from']['first_name'];






	$idquery = $query['id'];













	$ccs = json_decode(file_get_contents("./search.json") , true);













	$ccs = $ccs[$chat_id];













	if ($type == "prox"){













		if ($ccs[ $postion + 1 ]){






			$dados = $ccs[ $postion + 1];






			$postio4n = $postion+1;






			






		}else{






			die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Não há próxima cc!!!","show_alert"=> false,"cache_time" => 10)));






		}






	}else{













		if ($ccs[$postion -1 ]){






			$dados = $ccs[ $postion - 1 ];






			$postio4n = $postion -1;






		}else{






			die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Cc anterior nao encontrada.","show_alert"=> false,"cache_time" => 10)));






		}






	}













	













	$dadoscc = $ccs[$postio4n];






	$menu =  ['inline_keyboard' => [[],]];






	$price = json_decode(file_get_contents("./resource/conf.json") , true)['price'];






	$clientes = json_decode(file_get_contents("./usuarios.json") , true);






	$botoes = [];






	$idcc = $dadoscc['idcc'];






	$level = $dadoscc['nivel'];













	$saldo = $clientes[$chat_id]['saldo'];













	$preco  = ($price[$level]) ? $price[$level] : $price['Default'];













	$botoes[] = ['text'=>"⬅️",'callback_data'=>"altercc_ant_{$postio4n}"];













	$botoes[] = ['text'=>"➡️",'callback_data'=>"altercc_prox_{$postio4n}"];






	













	$txt .= "*Nível:* _$dadoscc[nivel]_\n\n";






	$bin = substr($dadoscc['cc'], 0,6);






	$txt .= "*Número:*_".$bin.'xxxxxxxxx'."_\n";






	$txt .= "*Validade: *_" . $dadoscc['mes'] .'/'.$dadoscc['ano'] ."_\n";






	$txt .= "*Banco: *_$dadoscc[banco]_\n";






	$txt .= "*País:* BRASIL\n";











	$menu['inline_keyboard'] = array_chunk($botoes, 3);






	$menu['inline_keyboard'][] = [['text'=>"🔙 Voltar",'callback_data'=>"volta_loja"]];






	$total = sizeof($ccs);






	






	$bin = substr(explode("|", $dados['cc'])[0], 0,6);













	bot("editMessageText",array( "message_id" => $message['message_id']  , "chat_id"=> $chat_id , "text" => "*Mostrando resultado ".($postio4n + 1)." de {$total} da bin {$bin}*\n\n$txt","reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown',"reply_markup" =>$menu));













	// atualiza($chat_id,$bin);













}













/*






	compra cc do search






*/




















function comprasearch ($message , $id , $level , $query){













	$confibot = $GLOBALS[confibot];













	$level = strtolower($level);













	$chat_id = $message["chat"]["id"];






	$nome = $message['reply_to_message']['from']['first_name'];






	$idquery = $query['id'];













	$clientes = json_decode(file_get_contents("./usuarios.json") , true);






	$seach = json_decode(file_get_contents("./search.json") , true);






	$conf = json_decode(file_get_contents("./resource/conf.json") , true);













	$menu =  ['inline_keyboard' => [[],]];






	$menu['inline_keyboard'][] = [['text'=>"🔙 Voltar",'callback_data'=>"volta_loja"]];













	if (!$clientes[$chat_id]){






		die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Usuario sem registro, envie /start para fazer o seu registro!!","show_alert"=> true,"cache_time" => 10)));






	}













	$price = json_decode(file_get_contents("./resource/conf.json") , true)['price'];













	$valor  = ($price[$level]) ? $price[$level] : $price['Default'];




















	$user = $clientes[$chat_id];






	if ($user['saldo'] == 0){






		die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Você não tem saldo suficiente para realizar está compra!\nCompre saldo com o {$confibot[userDono]}!","show_alert"=> true,"cache_time" => 10)));






	} 













	if (empty($level)){






		die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "A cc não foi encontrada!","show_alert"=> false,"cache_time" => 10)));






	}













	if ($valor > $user['saldo']){






		die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Você não tem saldo suficiente para realizar está compra!\nCompre saldo com o {$confibot[userDono]}!","show_alert"=> true,"cache_time" => 10)));






	} 




















	$dadoscc = deletecc($chat_id , $id,$level);













	if (empty($dadoscc)){






		bot("sendMessage" , array("chat_id" => $conf['dono'] , "text" => "A base está sem esta cc's $level !!"));






		die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Desculpe, mas estou sem cc's $level.\n!","show_alert"=> true,"cache_time" => 10)));






		






	}













	if (removesaldo($chat_id , $valor)){






		













		bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Foi descontado $valor do seu saldo!! ","show_alert"=> false,"cache_time" => 10));













		salvacompra($cc,$chat_id,"ccs");













		$saldo = $clientes[$chat_id]['saldo'] - $valor;













		$result = json_decode(bot("getMe" , array("vel" => "")) , true);






		$userbot = $result['result']['username'];













		$txt .= "✨*Detalhes da cc*\n";






		$txt .= "💳*cc: *_".$dadoscc['cc']."_\n";






		$txt .= "📆*mes / ano: *_" . $dadoscc['mes'] .'/'.$dadoscc['ano'] ."_\n";






		$txt .= "🔐*cvv: *_{$dadoscc[cvv]}_\n";






		$txt .= "🏳️*bandeira:* _$dadoscc[bandeira]_\n";






		$txt .= "💠*nivel:* _$dadoscc[nivel]_\n";






		$txt .= "⚜️*tipo:* _$dadoscc[tipo]_\n";






		$txt .= "🏛*banco:* _$dadoscc[banco]_\n";






		$txt .= "🌍*pais:* _$dadoscc[pais]_\n";






		$txt .= "⚠️*Seu saldo:* _{$saldo}_\n";













		$menu =  ['inline_keyboard' => [













			[["text" => "🔄 Comprar novamente" , "url" => "http://telegram.me/$userbot?start=iae"]]













		,]];













		bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => $txt,"reply_markup" =>$menu,"reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown'));













		// $bin = substr(explode("|", $cc['cc'])[0], 0,6);













		// atualiza($chat_id,$bin);













		exit();






	}else{






		die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Ocorreu um erro interno. Por favor, tente novamente!","show_alert"=> false,"cache_time" => 10)));






	}






}






/*






	realiza a venda de um mix !






*/













$nivel = trim($nivel);













function compramix($message,$nivel , $valor,$query){













	$confibot = $GLOBALS[confibot];













	$chat_id = $message["chat"]["id"];






	$nome = $message['reply_to_message']['from']['first_name'];






	$idquery = $query['id'];






	$clientes = json_decode(file_get_contents("./usuarios.json") , true);






	$conf = json_decode(file_get_contents("./resource/conf.json") , true);













	$menu =  ['inline_keyboard' => [













		[]













	,]];



























	$menu['inline_keyboard'][] = [['text'=>"🔙 Voltar",'callback_data'=>"volta_loja"]];













	if (!$clientes[$chat_id]){






		die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Usuario sem registro, envie /start para fazer o seu registro!!","show_alert"=> true,"cache_time" => 10)));






	}






	$user = $clientes[$chat_id];













	if ($user['saldo'] == 0){






		die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Você não tem saldo suficiente para realizar está compra!\nCompre saldo com o {$confibot[userDono]}!","show_alert"=> true,"cache_time" => 10)));






	} 













	if ($valor > $user['saldo']){






		die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Você não tem saldo suficiente para realizar está compra!\nCompre saldo com o {$confibot[userDono]}!","show_alert"=> true,"cache_time" => 10)));






	} 




















	$cc = getmix($nivel);













	if (empty($cc)){






		bot("sendMessage" , array("chat_id" => $conf['dono'] , "text" => "A base esta sem mix $nivel !!"));






		die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Desculpe, mas não consegui pegar está cc.\nProvavelmente estou sem estoque!","show_alert"=> true,"cache_time" => 10)));






		






	}













	if (removesaldo($chat_id , $valor)){













		bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Foi descontado $valor do seu saldo!! ","show_alert"=> false,"cache_time" => 10));













		$lista = explode("\n", $cc);






		foreach ($lista as  $cc) {






			// bot("sendMessage",array( "chat_id"=> $chat_id , "text" => $cc));






			$bin = substr(trim($cc), 0,6);













			$binchk = file_get_contents('https://bincheck.io/bin/'.$bin);













			$ban =  strtoupper(getstr($binchk,'<td style="text-align: left;">','</td>',1));






			$type = strtoupper(getstr($binchk,'style="text-align: left;">','</td>',3));






			$banco = strtoupper(getstr($binchk,'style="text-align: left;">','</td>',5));






			$pais = strtoupper(getstr($binchk,'style="text-align: left;">','</td>',8)); 






			$nivel = str_replace("\t", '', strtoupper(getstr($binchk,'style="text-align: left;">','</td>',4)));













			bot("sendMessage",array( "chat_id"=> $chat_id , "text" => $cc . " - ".trim($ban)." ".trim($type)." ".trim($nivel)." ".trim($banco)." ".trim($pais).""));






		}













	






		salvacompra($cc,$chat_id,"mixs");






		bot("sendMessage",array( "chat_id"=> $chat_id , "text" => "*Compra realizada com sucesso*\n_Obs: problemas relatar ao_ *{$confibot[userDono]}!!*\n_Você pode ver está compra no seu perfil!_","reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown',"reply_markup" =>$menu));













		exit();






	}else{






		die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Ocorreu um error interno , Tente novamente!","show_alert"=> false,"cache_time" => 10)));






	}













	






}



























/*






	realiza a venda de ccs!!






	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






*/













function compraccs($message , $query , $level , $idcc , $band){













	$confibot = $GLOBALS[confibot];






	$chat_id = $message["chat"]["id"];






	$nome = $message['reply_to_message']['from']['first_name'];






	$idquery = $query['id'];













	$clientes = json_decode(file_get_contents("./usuarios.json") , true);






	$conf = json_decode(file_get_contents("./resource/conf.json") , true);













	if (!$clientes[$chat_id]){






		die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "*Você não tem cadastro no bot, envie /start e comece a usar agora mesmo!*","show_alert"=> true,"cache_time" => 10)));






	}













	$user = $clientes[$chat_id];






	$country = $user['country'];






	$saldo = $clientes[$chat_id]['saldo'];






	$ccs = json_decode(file_get_contents("./ccs/{$country}/{$level}.json") , true);






	$valor = ($conf['price'][$level] ? $conf['price'][$level] : $conf['price']['default']);












	if ($user['saldo'] == 0){






		die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Você não tem o valor para realizar esta compra.\nCompre saldo com o {$confibot[userDono]}!","show_alert"=> true,"cache_time" => 10)));






	} 













	if ($valor > $user['saldo']){






		die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "O saldo que você tem está abaixo do valor de compra.\nCompre saldo com o {$confibot[userDono]}!","show_alert"=> true,"cache_time" => 10)));






	} 






	






	foreach ($ccs as $key => $dadoscc) {






		if ($key == $idcc){






			






			break;






		}






	}













	if (removesaldo($chat_id , $valor)){






		






		deletecc($chat_id , $idcc , $level);






		salvacompra($dadoscc , $chat_id , "ccs");













		bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Comprado no valor de $valor com sucesso.","show_alert"=> false,"cache_time" => 10));













		$clientes = json_decode(file_get_contents("./usuarios.json") , true);






		$saldo = $clientes[$chat_id]['saldo'];













		$result = json_decode(bot("getMe" , array("vel" => "")) , true);






		$userbot = $result['result']['username'];













		$txt .= "✅✅✅Compra efetuada com sucesso\n\n";






		$txt .= "Cartao: _".$dadoscc['cc']."_\n";






		$txt .= "Expiracao _" . $dadoscc['mes'] .'/'.$dadoscc['ano'] ."_\n";






		$txt .= "Cvv: _{$dadoscc[cvv]}_\n";






		$txt .= "Bandeira: _$dadoscc[bandeira]_\n";






		$txt .= "Nivel:  _$dadoscc[nivel]_\n\n";






		$txt .= "Nome: _$dadoscc[nome]_\nCpf: _$dadoscc[cpf]_\n\n";
		



		$txt .= "Cartão verificado (Live) ☑️";
		
		
$confibot = $GLOBALS[confibot];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "{$confibot[checker]}?key=pladix&lista=".$dadoscc['cc']."|".$dadoscc['mes']."|".$dadoscc['ano']."|".$dadoscc['cvv'].""); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($ch, CURLOPT_ENCODING, "gzip"); 
curl_setopt($ch, CURLOPT_POST, true); 
//curl_setopt($ch, CURLOPT_POSTFIELDS, 'acao=gerar_pessoa&sexo=H&idade=20&pontuacao=S&cep_estado=&cep_cidade='); 
$chk = curl_exec($ch);
$dados = json_decode($chk, true);
$response = $dados["message"];
if(strpos($chk, 'live')) {
$response = "✅ Cielo: 00 - Transação autorizada com sucesso! Debitado: R$1,00 do cartão.";
} else {
$response = "❌ Cielo: 05 - Cartão não autorizado - Transação negada [05]! Negou: R$1,00 do cartão.";
}

$txt = "✅ *Compra realizada com sucesso!*
- *Saldo após realizar compra: $saldo*

💳 | Produto:
*Número do cartão:* ".$dadoscc['cc']."
*Data de Validade:* ".$dadoscc['mes']."/".$dadoscc['ano']."
*Código de Segurança:* ".$dadoscc['cvv']."
*Formatado:* `".$dadoscc['cc']."|".$dadoscc['mes']."|".$dadoscc['ano']."|".$dadoscc['cvv']."`
*Bandeira:* ".$dadoscc['bandeira']."
*Nivel:* ".$dadoscc['nivel']."

👤 | Incluído Nome + CPF:
*Nome Completo:* `".$dadoscc['nome']."`
*CPF:* `".$dadoscc['cpf']."`
*Data de Nascimento:* SEM INFORMAÇÃO

ℹ️ | Checkagem do cartão:
- *#Retorno - $response*";







		$menu =  ['inline_keyboard' => [













			[["text" => "🔄 Comprar novamente" , "url" => "http://telegram.me/$userbot?start=iae"]]













		,]];













		bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => $txt,"reply_markup" =>$menu,"reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown'));













		die;






	}else{






		bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Foi descontado $valor do seu saldo!! ","show_alert"=> false,"cache_time" => 10));






		die;






	}













}













function altercard($message , $query , $type , $position , $level , $band){













	$confibot = $GLOBALS[confibot];




















	$chat_id = $message["chat"]["id"];






	$nome = $message['reply_to_message']['from']['first_name'];






	$idquery = $query['id'];













	$clientes = json_decode(file_get_contents("./usuarios.json") , true);






	$conf = json_decode(file_get_contents("./resource/conf.json") , true);




















	






	if (!$clientes[$chat_id]){






		die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Usuario sem registro, envie /start para que você possar ser registrado!!","show_alert"=> true,"cache_time" => 10)));






	}













	$user = $clientes[$chat_id];






	$country = $user['country'];






	$saldo = $clientes[$chat_id]['saldo'];






	$ccs = json_decode(file_get_contents("./ccs/{$country}/{$level}.json") , true);













	$cclista = []; 













	$buttons = [];













	foreach ($ccs as $key => $value) {






		if ($value['bandeira'] == $band){






			$value['idcc'] = $key;






			$cclista[] = $value;






		}






	}













	if ($type == "prox"){






		






		if ($cclista[ $position +1]){






			$postio4n = $position +1;






		}else{






			die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Não há próxima cc!","show_alert"=> false,"cache_time" => 10)));






		}













	}else{













		if ($cclista[ $position -1]){






			$postio4n = $position -1;






		}else{






			die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Não há cc anterio!","show_alert"=> false,"cache_time" => 10)));






		}






	}













	$valor = ($conf['price'][$level] ? $conf['price'][$level] : $conf['price']['default']);













	$dadoscc = $cclista[$postio4n];






	$t = $postio4n +1;







	$txt .= "*Nível:* _$dadoscc[nivel]_\n\n";






	$bin = substr($dadoscc['cc'], 0,6);






	$txt .= "*Número:*_".$bin.'xxxxxxxxx'."_\n";






	$txt .= "*Validade: *_" . $dadoscc['mes'] .'/'.$dadoscc['ano'] ."_\n";






	$txt .= "*Banco: *_$dadoscc[banco]_\n";






	$txt .= "*País:* BRASIL\n";



$txt = "🔎 *MOSTRANDO {$t} DE ".sizeof($cclista)." DISPONÍVEIS!*

✨ *DETALHES DO CARTÃO:*

💳 *CARTÃO: ".$bin."xxxxxxxxx*
📆 *MES / ANO: ".$dadoscc['mes']."/".$dadoscc['ano']."*
🔐 *CVV: xxx*

🏳 *BANDEIRA: ".$dadoscc['bandeira']."*
💠 *NIVEL: ".$dadoscc['nivel']."*
⚜ *TIPO: ".$dadoscc['tipo']."*
🏛 *BANCO: ".$dadoscc['banco']."*
🌍 *PAIS: ".$dadoscc['pais']."*

💰 *PRECO: $valor*
⚠ *SEU SALDO: {$saldo}*";







	$menu =  ['inline_keyboard' => [













		[["text" => "✅ Comprar agora!" , "callback_data" => "compraccs_{$level}_{$dadoscc[idcc]}_{$band}"]],






		[["text" => "<<" , "callback_data" => "altercard_ant_{$postio4n}_{$level}_{$band}"] , ["text" => ">>" , "callback_data" => "altercard_prox_{$postio4n}_{$level}_{$band}"]],






		[['text'=>"🔙 Voltar",'callback_data'=>"ccun"]]













	,]];




















	bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => $txt,"reply_markup" =>$menu,"reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown'));




















}













function viewcard($message , $query , $band , $level){













	$confibot = $GLOBALS[confibot];




















	$chat_id = $message["chat"]["id"];






	$nome = $message['reply_to_message']['from']['first_name'];






	$idquery = $query['id'];













	$clientes = json_decode(file_get_contents("./usuarios.json") , true);






	$conf = json_decode(file_get_contents("./resource/conf.json") , true);













	






	if (!$clientes[$chat_id]){






		die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Usuario sem registro, envie /start para fazer o seu registro!!","show_alert"=> true,"cache_time" => 10)));






	}













	$user = $clientes[$chat_id];






	$country = $user['country'];






	$saldo = $clientes[$chat_id]['saldo'];













	$ccs = json_decode(file_get_contents("./ccs/{$country}/{$level}.json") , true);













	$cclista = []; 













	$buttons = [];













	foreach ($ccs as $key => $value) {






		if ($value['bandeira'] == $band){






			$value['idcc'] = $key;






			$cclista[] = $value;






		}






	}




















	$valor = ($conf['price'][$level] ? $conf['price'][$level] : $conf['price']['default']);













	$dadoscc = $cclista[0];






	$txt .= "*Nível:* _$dadoscc[nivel]_\n\n";






	$bin = substr($dadoscc['cc'], 0,6);






	$txt .= "*Número:*_".$bin.'xxxxxxxxx'."_\n";






	$txt .= "*Validade: *_" . $dadoscc['mes'] .'/'.$dadoscc['ano'] ."_\n";






	$txt .= "*Banco: *_$dadoscc[banco]_\n";






	$txt .= "*País:* BRASIL\n";


$txt = "🔎 *MOSTRANDO 1 DE ".sizeof($cclista)." DISPONÍVEIS!*

✨ *DETALHES DO CARTÃO:*

💳 *CARTÃO: ".$bin."xxxxxxxxx*
📆 *MES / ANO: ".$dadoscc['mes']."/".$dadoscc['ano']."*
🔐 *CVV: xxx*

🏳 *BANDEIRA: ".$dadoscc['bandeira']."*
💠 *NIVEL: ".$dadoscc['nivel']."*
⚜ *TIPO: ".$dadoscc['tipo']."*
🏛 *BANCO: ".$dadoscc['banco']."*
🌍 *PAIS: ".$dadoscc['pais']."*

💰 *PRECO: $valor*
⚠ *SEU SALDO: {$saldo}*";



	$menu =  ['inline_keyboard' => [













		[["text" => "✅ Comprar agora!" , "callback_data" => "compraccs_{$level}_{$dadoscc[idcc]}_{$band}"]],






		[["text" => "<<" , "callback_data" => "altercard_ant_0_{$level}_{$band}"] , ["text" => ">>" , "callback_data" => "altercard_prox_0_{$level}_{$band}"]],






		[['text'=>"🔙 Voltar",'callback_data'=>"ccun"]]













	,]];




















	bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => $txt,"reply_markup" =>$menu,"reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown'));






}













function compracc($message,$query,$level){













	$confibot = $GLOBALS[confibot];




















	$chat_id = $message["chat"]["id"];






	$nome = $message['reply_to_message']['from']['first_name'];






	$idquery = $query['id'];













	$clientes = json_decode(file_get_contents("./usuarios.json") , true);






	$conf = json_decode(file_get_contents("./resource/conf.json") , true);













	$menu =  ['inline_keyboard' => [













		[]













	,]];













	$menu['inline_keyboard'][] = [['text'=>"🔙 Voltar",'callback_data'=>"volta_loja"]];













	if (!$clientes[$chat_id]){






		die(bot("answerCallbackQuery",array("callback_query_id" => $idquery , "text" => "Usuario sem registro, envie /start para fazer o seu registro!!","show_alert"=> true,"cache_time" => 10)));






	}













	$user = $clientes[$chat_id];






	$country = $user['country'];






	






	$ccs = json_decode(file_get_contents("./ccs/{$country}/{$level}.json") , true);













	$band = [];






	$buttons = [];













	foreach ($ccs as $key => $value) {






		if (!in_array($value['bandeira'], $band)){






			$band[] = $value['bandeira'];






			$buttons[] = ["text" => $value['bandeira'] , "callback_data" => 'viewcard_'.$value['bandeira'].'_'.$level];






		}






	}













	






	$menu['inline_keyboard'] = array_chunk($buttons , 2);













	$menu['inline_keyboard'][] = [['text'=>"🔙 Voltar",'callback_data'=>"ccun"]];













	$txt = "\n*✅ nivel:* _{$level}_\n*💳 Escolha a bandeira preferida:*";

	$txt = "🛒 |  *Você está realizando uma compra!*

✅ *Foi selecionado o nível:* {$level}
💳 *Por favor selecione uma bandeira abaixo para continuar sua compra:*

ℹ️ *Caso não encontre a sua preferida, entre em contato comigo pelo {$confibot[userDono]}*";













	bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => $txt,"reply_markup" =>$menu,"reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown'));













		






}




















/*













	function loja 






	exibir menu loja virtual













*/






function loja($message){






	$chat_id = $message["chat"]["id"];






	$nome = $message['reply_to_message']['from']['first_name'];






	$menu =  ['inline_keyboard' => [













		[['text'=>"💵 Adicionar saldo",'callback_data'=>"comprasaldo"] , ['text'=>"💳 Unitárias",'callback_data'=>"ccun"]],






		[['text'=>"🔎 Pesquisar bin",'callback_data'=>"search"], ['text'=>"🔀 MIX",'callback_data'=>"ccmix"]],






		[['text'=>"🔙 Voltar",'callback_data'=>"volta_menu"]]













		,






	]];




$clientes = json_decode(file_get_contents("./usuarios.json") , true);
$saldo = $clientes[$chat_id]['saldo'];
$historicocc = json_decode(file_get_contents("./ccsompradas.json") , true);
$totalccskk = (sizeof($historicocc[$chat_id]['ccs'])) ? sizeof($historicocc[$chat_id]['ccs']) : 0 ;
$confibot = json_decode(file_get_contents('./resource/conf.json') , true);


bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => "⬇️ *Olá Seja Bem Vindo! $nome, use o menu abaixo para comprar!*


💳 Clique em *Unitárias* para comprar CC em unidade!

💰 Clique em *Adicionar Saldo* para usar o pix automático/manual!

🎲 Clique em *MIX* para comprar CC em quantidade!!

🔎 Clique em *Pesquisar bin* para procurar CC pela bin!

🧰 Clique em *Menu Checker* para testar os cartões! (Desativado!)


🆘 Problemas/Dúvidas? {$confibot[userDono]}","reply_markup" =>$menu,"reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown'));






	






}




















/*













	function menu






	exibir menu inicial













*/













function menu($message){






	$chat_id = $message["chat"]["id"];






	$nome = $message['reply_to_message']['from']['first_name'];






	$idwel = $message['reply_to_message']['from']['id'];






	$conf = json_decode(file_get_contents("./resource/conf.json") , true);



	$clientes = json_decode(file_get_contents("./usuarios.json") , true);






		$saldo = $clientes[$chat_id]['saldo'];









	if ($conf['welcome'] != ""){






		$txt = $conf["welcome"];










$historicocc = json_decode(file_get_contents("./ccsompradas.json") , true);
$totalccs = (sizeof($historicocc[$chat_id]['ccs'])) ? sizeof($historicocc[$chat_id]['ccs']) : 0 ;


			$txt = str_replace("{nome}", $nome, $txt);



			$txt = str_replace("{id}", $idwel, $txt);
			
			
					
			$txt = str_replace("{saldo}", $saldo, $txt);
			

			$txt = str_replace("{compras}", $totalccs, $txt);













	}else{






		$txt = "*Olá $nome, use os comandos abaixo para Interagir comigo!*";






	}




















	$menu =  ['inline_keyboard' => [






		[['text'=>"💳 Comprar",'callback_data'=>"loja"] , ['text'=>"👤 Informações",'callback_data'=>"menu_infos"] , ['text'=>"⚙️ Dev",'url'=>"{$confibot[suporte]}"]]













	,]];

	$confibot = json_decode(file_get_contents('./resource/conf.json') , true);

	$botoes[] = ['text'=>"💳 Comprar",'callback_data'=>"loja"];

	$botoes[] = ['text'=>"💵 Adicionar Saldo",'callback_data'=>"comprasaldo"];

	$botoes[] = ['text'=>"👤 Informações",'callback_data'=>"menu_infos"];

	$botoes[] = ['text'=>"🧰 Menu Checker",'callback_data'=>"volta_loja"];

	$botoes[] = ['text'=>"👨‍💻 Suporte",'url'=>"{$confibot[suporte]}"];

	$botoes[] = ['text'=>"⚙️ Dev",'url'=>"https://t.me/pladixoficial"];

	$menu['inline_keyboard'] = array_chunk($botoes, 2);


	$txt = "━━━━━━━━━━━━━━━━━━━━━━
💳 *Olá $nome, seja bem vindo(a) na StoreBot e desde já agradecemos por ter você aqui. :D* 💳 
━━━━━━━━━━━━━━━━━━━━━━
✅ *Cartões são testados  no checker antes de enviar ao cliente!*
👤 *Enviamos material com Nome e CPF!*
💰 *Realize suas recargas com Pix Automático! (/pix)*
💳 *Colhidas diariamente no painel!*
━━━━━━━━━━━━━━━━━━━━━━
ℹ️ *Nosso Grupo Oficial: {$confibot[usergrupo]}*
━━━━━━━━━━━━━━━━━━━━━━
💬 *Está precisando de um suporte? {$confibot[userDono]}*
━━━━━━━━━━━━━━━━━━━━━━";





	bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => $txt,"reply_markup" =>$menu,"reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown'));






	






}




















/*













	function ccn 






	exibir menu ccs 













*/




















function ccun($message){






	$chat_id = $message["chat"]["id"];






	$nome = $message['reply_to_message']['from']['first_name'];




















	$menu =  ['inline_keyboard' => [[], ]];













	$openprice = json_decode(file_get_contents("./resource/conf.json") , true);













	$users = json_decode(file_get_contents("./usuarios.json") , true);













	if (!$users[$chat_id]['country']){






		selectbase($message);






		die;






	}






	// selectbase($message);




















	$ccs = [];






	$country = $users[$chat_id]['country'];






	$dir = './ccs/'.$country.'/';













	$itens = scandir($dir);






	






	if ($itens !== false) { 






		foreach ($itens as $item) { 






			$ccs[] =  explode(".", $item)[0];






		}






	}













	$levels = array_values(array_filter($ccs));




















	$butoes = [];













	if (count($levels) == 0){






		$confibot = $GLOBALS[confibot];






		$butoes[] = ['text'=>"🔙 Voltar",'callback_data'=>"volta_loja"];






	    $butoes[] = ['text'=>"🌎 Alterar país",'callback_data'=>"selectbase"];













	    $menu['inline_keyboard'] = array_chunk($butoes , 2);






		bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => "*Desculpe, não temos estoque disponivel para este serviço, por favor entre em contato com o* {$confibot[userDono]}","reply_markup" =>$menu,"reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown'));






		die();






	}




















	foreach ($levels as $value) {




		$butoes[] = ['text'=> "$value | R$5",'callback_data'=>"compracc_{$value}"];






		






	}






	$butoes[] = ['text'=>"🔙 Voltar",'callback_data'=>"volta_loja"];




















	$menu['inline_keyboard'] = array_chunk($butoes , 1);













	$confibot = $GLOBALS[confibot];



$txt = "✨ *Escolha um nivel/level para prosseguir:*

 - STANDARD - 5 R$
 - GOLD - 5 R$
 - AMEX - 5 R$
 - PLATINUM - 5 R$
 - CLASSIC - 5 R$
 - INFINITE - 5 R$
 - BUSINESS - 5 R$
 - ELECTRON - 5 R$
 - CORPORATE T&E - 5 R$
 - ELO - 5 R$
 - PREPAID - 5 R$
 - BLACK - 5 R$
 - STANDARD/PLATINUM - 5 R$
 - INDEFINDO - 5 R$
 - MICRO BUSINESS - 5 R$
 - CORPORATE - 5 R$
 - EXECUTIVE - 5 R$
 - HIPERCARD - 5 R$
 - DISCOVER - 5 R$

✅ *Estoque disponivel de muitos cartões.*";


	bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => "$txt","reply_markup" =>$menu,"reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown'));






	






}



























/*













	function ccn 






	exibir menu mixs













*/




















function ccmix($message){













	$confibot = $GLOBALS[confibot];




















	$chat_id = $message["chat"]["id"];






	$nome = $message['reply_to_message']['from']['first_name'];




















	$menu =  ['inline_keyboard' => [[], ]];













	$openccs = json_decode(file_get_contents("./resource/conf.json") , true);






	$mix = json_decode(file_get_contents("./mix.json") , true);




















	if (count(array_filter($mix)) == 0){






		$menu['inline_keyboard'][] = [['text'=>"🔙 Voltar",'callback_data'=>"volta_loja"]];






		bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => "*Desculpe, não temos estoque disponivel para este serviço, por favor entre em contato com o* {$confibot[userDono]}","reply_markup" =>$menu,"reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown'));






		die();






	}




















	$array = [];






	$tabela = '';













	foreach ($mix as $key => $value) {













		if ($openccs['pricemix'][$key]){






			$valor = $openccs['pricemix'][$key];






		}else{






			$valor = $openccs['pricemix']['default'];






		}













		$tabela .= "\n".'💳 Mix '.strtoupper($key).' --- '.$valor." (saldo)\n";






		$total = sizeof($mix[$key]);






		$array[] = ['text'=>"Mix $key - disponiveis ($total)",'callback_data'=>"compramix_{$key}_$valor"];






	}






	$add = array_chunk($array, 2);






	$menu['inline_keyboard'] = $add;






	$menu['inline_keyboard'][] = [['text'=>"🔙 Voltar",'callback_data'=>"volta_loja"]];













	bot("editMessageText",array( "message_id" => $message['message_id'] , "chat_id"=> $chat_id , "text" => "Está area é resevada para os mix, caso não tenha o mix que você estaja procurando, entre em contato com o nosso vendedor: {$confibot[userDono]}.\n$tabela","reply_markup" =>$menu,"reply_to_message_id"=> $message['message_id'],"parse_mode" => 'Markdown'));






	






}