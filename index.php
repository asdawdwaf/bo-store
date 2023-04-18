<?php	
require_once("bloqueio.php");
$atualdados = json_decode(file_get_contents("bot/resource/conf.json"));
?>


<!DOCTYPE html>
<html>
<head>
	<title>Configurar seu StoreBot - PladixOficial</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" >
</head>
<body style="background-image: url('https://www.creativeworldindia.com/static/images/home/home.gif')">
<br>

<div id="alert" class="alert alert-success alert-dismissible fade show col-md-6" style="left: 15px;" role="alert">
  Dados Atualizados !
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<center class="content text-left col-md-auto">
	<div class="card" >
	  <div class="card-header">
	    <b>Configurações atuais:</b>
	  </div>
	  <div class="card-body">
	    
	    <p class="card-text"><b>ID do Proprietário:</b> <?php echo $atualdados->dono?></p>
	    <p class="card-text"><b>Token do Bot:</b> <?php echo file_get_contents('bot/token.txt')?></p>
	    <p class="card-text"><b>Boas-vindas do Bot:</b> <?php echo $atualdados->welcome?></p>
	    <p class="card-text"><b>Usuário do Dono:</b> <?php echo $atualdados->userDono?></p>
	    <p class="card-text"><b>Usuário/Link do Grupo:</b> <?php echo $atualdados->usergrupo?></p>
	    <p class="card-text"><b>Link do Suporte:</b> <?php echo $atualdados->suporte?></p>
	    <p class="card-text"><b>Manutenção do Bot:</b> <?php echo $atualdados->manutencao?></p>
	    <p class="card-text"><b>Token MercadoPago:</b> <?php echo $atualdados->mercadopago?></p>
	    <p class="card-text"><b>Link do Checker:</b> <?php echo $atualdados->checker?></p>


	  </div>
	</div>
	<br>
	<div class="card">
		<div class="card-header">
			<b>Modificar dados:</b>
		</div>
		<div class="card-body">
			<label for="id_telegram">ID do Proprietário:</label>
			<input type="text"name="id_telegram" id="id_telegram" class="form-control col-4" value="<?php echo $atualdados->dono?>">

			<label for="username">Usuário do Dono:</label>
			<input type="text"name="username" id="username" class="form-control col-4" value="<?php echo $atualdados->userDono?>">
			
			<label for="usergrupo">Usuário/Link do Grupo:</label>
			<input type="text"name="usergrupo" id="usergrupo" class="form-control col-4" value="<?php echo $atualdados->usergrupo?>">

            <label for="manutencao">Modo de manutenção (true/false):</label>
			<input type="text"name="manutencao" id="manutencao" class="form-control col-4" value="<?php echo $atualdados->manutencao?>">
			
			<label for="suporte">Link do Suporte:</label>
			<input type="text"name="suporte" id="suporte" class="form-control col-4" value="<?php echo $atualdados->suporte?>">
			
			<label for="mercadopago">Token MercadoPago:</label>
			<input type="text"name="mercadopago" id="mercadopago" class="form-control col-4" value="<?php echo $atualdados->mercadopago?>">
			
			<label for="checker">Link do Checker:</label>
			<input type="text"name="checker" id="checker" class="form-control col-4" value="<?php echo $atualdados->checker?>">
			
			<label for="tokenbpt">Token do Bot:</label>
			<input type="text"name="tokenbpt" id="tokenbpt" class="form-control col-4" value="<?php echo file_get_contents('bot/token.txt')?>">
			<br>
			<button type="button" class="btn btn-dark" id="salva">Salvar alterações!</button>

		</div>
	</div>
	<br>
	<div class="card">
		<div class="card-header">
			<b>Configurações avançadas:</b>
		</div>
		<div class="card-body">
			
			<a class="btn btn-dark" href = "bot/setwebhook.php">Iniciar</a>
			<a class="btn btn-dark" href = "bot/usuarios.json">Visualizar Usuários</a>
			<a class="btn btn-dark" href = "#">Visualizar Logs</a>

		</div>
	</div>
	<br><br>

</center>



<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://kit.fontawesome.com/4b324138d1.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>

<script type="text/javascript">
	$("#alert").fadeOut(0);
	$("#salva").click(function () {
		
		$.ajax({
			url: "./atr.php/",
			type: "GET",
			data:{
				id_telegram: $("#id_telegram").val(),
				username: $("#username").val(),
				tokenbot: $("#tokenbpt").val(),
				usergrupo: $("#usergrupo").val(),
				manutencao: $("#manutencao").val(),
				suporte: $("#suporte").val(),
				checker: $("#checker").val(),
				mercadopago: $("#mercadopago").val(),
			},success:function(data){
				$("#alert").fadeIn(0);
			}

		});
	});	
</script>

</body>

</html>