<?php

ini_set('display_errors', 0);
error_reporting(0);

include_once("../conexao.php");


$color = '#3A87AD';
$sala = $_POST['nome_sala']; //valor
$sala2 = $_GET['salaget'];
$sala_title = $_POST['sala_tilte'];
$salaget2 = '0';


$erro =  isset($_GET['erro']) ? $_GET['erro'] : $erro;


session_start();

if (isset($_SESSION['log']) == false) {
	echo ("<script>window.location = '../login.php';</script>");
}
$users = $_SESSION['user'];


if ($sala == NULL) {

	$salaget = $sala2;
} elseif ($sala2 == NULL) {

	$salaget = $sala;
}


if ($sala == NULL) {

	$salaget2 = $sala2;
} else {

	$salaget2 = $sala;
}

if ($sala != NULL) {
	$result_events = "SELECT * FROM events where sala = '$sala'";
	$resultado_events = mysqli_query($conn, $result_events);

	$sql = "SELECT * FROM `salas` WHERE valor = '$sala'";
	$result = mysqli_query($conn, $sql);
	$salaInfo = $result->fetch_assoc();
} elseif ($sala2 != NULL) {
	$result_events = "SELECT * FROM events where sala = '$sala2'";
	$resultado_events = mysqli_query($conn, $result_events);

	$sql = "SELECT * FROM `salas` WHERE valor = '$sala2'";
	$result = mysqli_query($conn, $sql);
	$salaInfo = $result->fetch_assoc();
}

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Sistema de Reservas de Salas </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="icon" href="assets/img/favicon.png">

	<link href='css/fullcalendar.min.css' rel='stylesheet' />
	<link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
	<link href='css/personalizado.css' rel='stylesheet' />
	<script src='js/jquery.min.js'></script>
	<script src='js/bootstrap.min.js'></script>
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar.js'></script>
	<script src='locale/pt-br.js'></script>
	


	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


	<script>

		// Call addInput() function on button click
		function addInput(){
			var new_chq_no = parseInt($('#convidados_input').val())+1;
			var new_input='<input type="text" id="convidados" class="form-control" name="convidados"  placeholder="convidado@royalcargo.com.br">';
			$('#convidados').append(new_input);
			$('#convidados_input').val(new_chq_no)
		}



		$(document).ready(function() {
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				defaultDate: Date(),
				navLinks: true, // can click day/week names to navigate views
				editable: true,
				eventLimit: true, // allow "more" link when too many events
				eventClick: function(event) {

					$('#visualizar #id').text(event.id);
					$('#visualizar #id').val(event.id);
					$('#visualizar #title').text(event.title);
					$('#visualizar #title').val(event.title);
					$('#visualizar #start').text(event.start.format('DD/MM/YYYY HH:mm:ss'));
					$('#visualizar #start').val(event.start.format('DD/MM/YYYY HH:mm:ss'));
					$('#visualizar #end').text(event.end.format('DD/MM/YYYY HH:mm:ss'));
					$('#visualizar #end').val(event.end.format('DD/MM/YYYY HH:mm:ss'));
					$('#visualizar #color').val(event.color);
					$('#visualizar #user').text(event.user);
					$('#visualizar #user').val(event.user);
					$('#visualizar #nomeResponsavel').text(event.nomeResponsavel);
					$('#visualizar #nomeResponsavel').val(event.nomeResponsavel);
					$('#visualizar #id_index').text(event.id_index);
					$('#visualizar #id_index').val(event.id_index);
					$('#visualizar #serie').text(event.serie);
					$('#visualizar #serie').val(event.serie);
					$('#visualizar #limpeza').text(event.limpeza);
					$('#visualizar #limpeza').val(event.limpeza);

					localStorage.setItem('index_value', $('#id_index').val())
					localStorage.setItem('serie', $('#serie').val())
					$('#visualizar').modal('show');
					return false;


				},

				selectable: true,
				selectHelper: true,
				select: function(start, end) {
					$('#cadastrar #start').val(moment(start).format('DD/MM/YYYY'));
					$('#cadastrar #end').val(moment(end).format('DD/MM/YYYY'));
					$('#cadastrar').modal('show');
				},
				events: [
					<?php
					while ($row_events = mysqli_fetch_array($resultado_events)) {

						if ($row_events['limpeza'] == 1) {
							$limpeza = 'O espaço será entregue limpo';
						} else if ($row_events['limpeza'] == 2) {
							$limpeza = 'Limpeza é por conta da Royal';
						} else if ($row_events['limpeza'] == 2) {
							$limpeza = 'Limpeza será paga pelos colaboradores';
						} else {
							$limpeza = 'Não Aplicavel';
						}

					?> {
							id: '<?php echo $row_events['id']; ?>',
							title: '<?php echo $row_events['title']; ?>',
							start: '<?php echo $row_events['start']; ?>',
							end: '<?php echo $row_events['end']; ?>',
							color: '<?php echo $row_events['color']; ?>',
							user: '<?php echo $row_events['user']; ?>',
							nomeResponsavel: '<?php echo $row_events['NomeResponsavel']; ?>',
							id_index: '<?php echo $row_events['id_index']; ?>',
							limpeza: '<?= $limpeza ?>'
						},
					<?php


					}
					?>
				]
			});
		});

		//Mascara para o campo data e hora
		function DataHora(evento, objeto) {
			var keypress = (window.event) ? event.keyCode : evento.which;
			campo = eval(objeto);
			if (campo.value == '00/00/0000 00:00:00') {
				campo.value = ""
			}

			caracteres = '0123456789';
			separacao1 = '/';
			separacao2 = ' ';
			separacao3 = ':';
			conjunto1 = 2;
			conjunto2 = 5;
			conjunto3 = 10;
			conjunto4 = 13;
			conjunto5 = 16;
			if ((caracteres.search(String.fromCharCode(keypress)) != -1) && campo.value.length < (19)) {
				if (campo.value.length == conjunto1)
					campo.value = campo.value + separacao1;
				else if (campo.value.length == conjunto2)
					campo.value = campo.value + separacao1;
				else if (campo.value.length == conjunto3)
					campo.value = campo.value + separacao2;
				else if (campo.value.length == conjunto4)
					campo.value = campo.value + separacao3;
				else if (campo.value.length == conjunto5)
					campo.value = campo.value + separacao3;
			} else {
				event.returnValue = false;
			}
		}
	</script>

	<style>
		.fc-today .fc-day-number {

			text-align: center;
			width: 25px;
			background-color: #f35958;
			color: #fff;
			border-radius: 35%;

		}
	</style>

</head>

<body>


	<div id="wrapper">

		<?php include "topo.php"; ?>



		<?php include "menu_lateral.php"; ?>

		<div class="main">
			<!-- MAIN CONTENT -->

			<?php if ($erro == 3) { ?>

				<!--Aviso de  sucesso -->
				<div class="alert alert-success show" role="alert">
					<b>Reserva</b> feita com sucesso!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

			<?php } else if ($erro == 1) { ?>

				<!--Aviso de  erro -->
				<div class="alert alert-danger show" role="alert">
					Ouve um erro na Reserva!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

			<?php } else if ($erro == 2) { ?>

				<!--Aviso de  erro -->
				<div class="alert alert-warning show" role="alert">
					O horario da reserva ja esta marcaco,<b> favor marcar outro!</b>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php } else if ($erro == 4) { ?>
				<!--Aviso de  erro -->
				<div class="alert alert-warning show" role="alert">
					O horario da reserva foi marcaco,<b> Espere a confimação da reserva!</b>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php } ?>


			<div class="main-content">
				<div class="container-fluid">

					<div class="">



						<div class="">

							<p>VOC&Ecirc; EST&Aacute; EM: <a href="../index.php">Home / </a> <a href="../index.php" class="">Agenda</a> <a>/
									<?php
									$result_sala2 = "SELECT * FROM salas where valor = '$salaget2'";
									$resultado_sala2 = mysqli_query($conn, $result_sala2);
									while ($row_sala2 = mysqli_fetch_array($resultado_sala2)) {
										$sala_title2 = $row_sala2['titulo'];
										$id_sala2 = $row_salas2['id'];
										$descricao_sala2 = $row_salas22['descricao'];
										$localizacao_sala2 = $row_salas2['localizacao'];
										$lugares_sala2 = $row_salas2['lugares'];
										$telefone_sala2 = $row_salas2['telefone'];
										$skype_sala2 = $row_salas2['skype'];
										$teams_sala2 = $row_salas2['teams'];
										$permissao = $row_salas2['permissao'];

										echo "$sala_title2";
										echo $permissao;
									}

									?>



								</a> </p>


							<div id='calendar'></div>

						</div>


						<!-- MODAL DE CANCELAMENTO DE EDIÇÃO DE EVENTOS -->

						<div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title text-center"> <i class="far fa-calendar-alt"></i> Dados da Reserva - <span id="title"></spam>
										</h4>
									</div>




									<div class="modal-body">
										<div class="visualizar">
											<div class="container">
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-5">
														<dl class="dl-horizontal">
															<dt>ID da Reserva</dt>
															<dd id="id"></dd>
															<dt>Titulo da Reseva</dt>
															<dd id="title"></dd>
															<dt>Inicio da Reserva</dt>
															<dd id="start"></dd>
															<dt>Fim da Reserva</dt>
															<dd id="end"></dd>
															<dt>Responsavel</dt>
															<dd><span id="nomeResponsavel"></dd>
															<dt>Usuario</dt>
															<dd><span id="user"></dd>
															<?php if ($salaInfo['permissao'] == 1) { ?>
																<dt>Limpeza</dt>
																<dd><span id="limpeza"></dd>
															<?php } ?>
														</dl>
													</div>
													<div class="col-md-1"></div>
												</div>
											</div>





											<?php echo " 
												<div class='container'>
													<div class='row justify-content-center'>

														<div class='col-md-1' style='padding-left:125px;'></div>

														<div class='col-md-1'>
																		<button class='btn btn-canc-vis btn-warning'>Editar</button>
														</div>
														
															<div class='col-md-3'>	
																		<form class='form-inline' action='cancelar-reuniao.php' method='post'>
																		<input type='hidden' name='id' id='id'>
																		<input type='hidden' name='id_index' id='id_index'>
																		<input type='hidden' name='nome_sala' value='$salaget'>
																		<input type='hidden' name='user' id='user'>
																		<input type='hidden' name='start' id='start'>
																		<button type='submit' class='btn btn-danger'>Cancelar Reunião</button>
																		<label>&nbsp;&nbsp;</label>
											
															</div>
													
														</div>
													</div>
													
													
													<div class=''>
													<label>&nbsp;&nbsp;</label><br>
													<input type='checkbox' class='form-check-input' name='index' value='sim'>
													<label class='form-check-label' for='exampleCheck1'>Cancelamento de reserva recorrente.</label>
												</div>
												
												</form>
												";
											?>

										</div>

										<div class="form">
											<form class="form-horizontal" method="POST" action="proc_edit_evento.php">
												<div class="form-group">
													<label for="inputEmail3" class="col-sm-2 control-label">Título</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" name="title" id="title" placeholder="Título da Reunião" required>
													</div>
												</div>

												<input type="hidden" name="color" value="<?php echo "$color"; ?>">
												<input type="hidden" name="nome_sala" value="<?php echo "$salaget"; ?>">
												<input type="hidden" name="nomeResponsavel" id="nomeResponsavel">

												<div class="form-group">
													<label for="inputEmail3" class="col-sm-2 control-label">Data Inicial</label>
													<div class="col-sm-4">
														<input type="text" class="form-control" name="start" id="start" onKeyPress="DataHora(event, this)" required>
													</div>


												</div>
												<div class="form-group">
													<label for="inputEmail3" class="col-sm-2 control-label">Data Final</label>
													<div class="col-sm-4">
														<input type="text" class="form-control" name="end" id="end" onKeyPress="DataHora(event, this)" required>
													</div>

												</div>
												<input type="hidden" class="form-control" name="id" id="id">

												<input type="hidden" class="form-control" name="user" id="user">
												<div class="form-group">
													<div class="col-sm-offset-2 col-sm-10">
														<button type="button" class="btn btn-canc-edit btn-danger">Cancelar</button>
														<button type="submit" class="btn btn-primary">Salvar Alterações</button>
													</div>
												</div>
											</form>

										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- MODAL DE CANCELAMENTO DE EDIÇÃO DE EVENTOS -->









						<!-- MODAL DE CADASTRO DE EVENTOS -->
						<div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title text-center"><i class="far fa-calendar-alt"></i> Cadastrar reserva em: <?php echo "$sala_title2"; ?> </h4>
									</div>


									<div class="modal-body">
										<form class="form-horizontal" method="POST" action="proc_cad_evento.php">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-2 control-label">Titulo</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="title" placeholder="Titulo da Reunião" required>
												</div>
											</div>
											<input type="hidden" name="color" value="<?php echo "$color"; ?>">
											<input type="hidden" name="user" value="	<?php echo "$users"; ?>">

											<div class="form-group">
												<label for="inputEmail3" class="col-sm-2 control-label">Data Inicial</label>
												<div class="col-sm-3">
													<input type="datetime" class="form-control" name="start" id="start" onKeyPress="DataHora(event, this)" required>
												</div>
												<div class="col-sm-3">
													<input type="time" name="hora_start" value="" class="form-control" required>

												</div>
											</div>
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-2 control-label">Data Final</label>
												<div class="col-sm-3">
													<input type="text" class="form-control" name="end" id="start" onKeyPress="DataHora(event, this)" required>
												</div>
												<div class="col-sm-3">
													<input type="time" name="hora_end" value="" class="form-control" required>

													<input type="hidden" class="form-control" name="user" value="<?php echo "$users"; ?>">
													<input type="hidden" name="nome_sala" value="<?php echo "$salaget"; ?>">
												</div>
											</div>

											<?php if ($salaInfo['permissao'] != 1) { ?>

												<div class="form-group">

													<div class="form-group">
														<label for="Recorrencia" class="mx-1 col-sm-2">Recorrencia</label>
														<div class="col-sm-3">
															<select name="recorrencia" class=" form-control " id="Recorrencia">
																<option selected value="">Não repete</option>
																<option value="7">Repetir Reserva Semanalmente.</option>
																<option value="30">Repetir Reserva Mensalmente.</option>
																<option value="365">Repetir Reserva Anualmente.</option>
															</select>
														</div>
														<div class="col-sm-3">
															<input type="text" class=" form-control" name="quant"  placeholder="Numero de Retições">

														</div>
													</div>

													<div >
													
														<label for="inputEmail3" class="col-sm-2 control-label">Convidados</label>
														<div class="col-sm-10" id="convidados">
															 <input type="text" id="convidados_input" class="form-control" name="convidados"  placeholder="convidado@royalcargo.com.br">
															 <button class="btn btn-sm btn-primary" onclick="addInput()" type="button" >+</button>
														</div>

													</div>
													



													<div class="col-sm-offset-2 col-sm-10 my-3">

													<?php
												}
												if ($salaInfo['permissao'] == 1) {
													?>
														<input type="hidden" name="reserva" value="1">
														<button type="button" class="form-control" style="background-color:#004A74; color:white;" data-toggle="modal" data-target="#termoDeUso">Adicionar</button>




													<?php
												} else {
													?>
														<input type="hidden" name="reserva" value="0">
														<input type="hidden" name="limpeza" value="0">
														<button type="submit" class="form-control submit" style="background-color:#004A74; color:white;">Adicionar</button>

										</form>

									<?php } ?>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- MODAL DE CADASTRO DE EVENTOS -->


				<!-- Modal Termo de Uso -->
				<div class="modal " id="termoDeUso" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h3 class="modal-title" id="TituloModalLongoExemplo">POLÍTICA E TERMO DE UTILIZAÇÃO DO ESPAÇO GOURMET</h3>
								<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<h4>Política</h4>
								<p>O Espaço Gourmet é um espaço destinado à realização de eventos sociais e corporativos. Para garantir a segurança e o conforto dos usuários, bem como a preservação do patrimônio, é necessário seguir as regras estabelecidas neste documento.Termo de Responsabilidade: Ao realizar a reserva do Espaço Gourmet, o responsável pelo evento declara estar ciente e concordar com as seguintes condições:</p>
								<h4>Regras</h4>
								<p>1.1 A Royal não se responsabiliza por objetos deixados no interior do espaço durante ou após a realização do evento;<br>
									1.2 É proibido o uso de fogos de artifício, materiais inflamáveis, fumaça ou qualquer outro elemento que possa colocar em risco a integridade física dos usuários ou causar danos ao patrimônio;<br>
									1.3 É proibido o consumo de bebidas alcoólicas por menores de 18 anos de idade, bem como o fornecimento de bebidas alcoólicas para pessoas visivelmente embriagadas;<br>
									1.4 É proibido a circulação de qualquer pessoa entre as estações de trabalho ou salas de diretores e reuniões. Ficando limitado o evento apenas ao espaço gourmet e banheiros;<br>
									1.5 É expressamente proibido sair ou consumir qualquer tipo de bebida fora do espaço gourmet durante happy hours;<br>
									1.6 É proibido o uso de drogas ilícitas e cigarros nas dependências da Royal Cargo do Brasil, inclusive banheiros e lajes técnicas;<br>
									1.7 O horário permitido para o evento é a partir das 18:00h e o horário máximo para o término do evento é até a meia noite (00h).<br>
									1.8 Não é permitido mais que 30 pessoas em Happy Hours no espaço gourmet.<br>
									1.9 Proibido jogar lixo ou qualquer objeto pela janela;
									<hr>
								<h4>Responsabilidades:</h4>
								1) Me responsabilizo em passar aos demais participantes as regras de utilização e prezar pelo cumprimento delas;<br>
								2) Me responsabilizo pela integralidade das instalações, móveis, objetos de decoração, eletrônicos, eletrodomésticos, louças, talheres e demais utensílios que guarnecem o espaço gourmet, me comprometendo a entregar todos os itens recebidos em perfeito estado;<br>
								3) Em caso de extravio ou dano de algum dos itens, me comprometo a custear seu conserto ou substituição.<br>
								4) Me responsabilizo em manter o número de usuários compatível com a capacidade do espaço, que é de 30 pessoas, tendo ciência que se caso o número de participantes for maior que a capacidade máxima, o happy hour deverá ocorrer em outro local.<br>
								5) Me comprometo em custear a taxa de limpeza no valor de R$250,00, sendo pagos até 1 dia antes do evento ou entregar o espaço devidamente limpo, organizado, sem restos de comida e sem louça suja na pia. Se a limpeza for custeada pela Royal Cargo do Brasil, deverá ser informado ao time administrativo junto com a aprovação do superior;<br>
								6) Me comprometo a não deixar restos de comida em cima das bancadas e pia, descartando devidamente ou guardando na geladeira o que estiver apenas em boas condições, conforme a regra;<br>
								7) Me responsabilizo em cumprir o horário de utilização do espaço gourmet para happy hour, que é das 18h até as 00h.<br>
								8) Me comprometo em fechar as janelas, desligar os aparelhos eletrônicos (Ar-Condicionado, TV, Som) e desligar as luzes de todo o escritório ao término do evento.<br>
								9) Caso eu contrate uma equipe terceirizada, como por exemplo, cozinheiros e músicos, assumo a responsabilidade de fornecer ao setor administrativo os nomes e CPFs dos contratados para que possam ser liberados na portaria. Fico ciente de que, caso não forneça essas informações<br>
								corretamente, os contratados poderão ser impedidos de acessar o local.<br>
								10) Comprometo-me a utilizar descansos de panela ou panos de prato para colocar panelas e travessas quentes nas bancadas e pia, evitando assim possíveis manchas irreversíveis na superfície.<br>
								11) Comprometo-me a não permitir que copos e garrafas de bebidas sejam colocados em cima de<br>
								móveis de madeira, a fim de preservar a integridade dos móveis e evitar danos permanentes.</p>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" required>
									<label class="form-check-label" for="defaultCheck1">
										Li e Aceitos os Termos
									</label>
								</div>
								<div class="form-group">
									<label for="exampleFormControlSelect1">Selecione como será feita a limpeza do espaço</label>
									<select required name="limpeza" class="form-control" id="exampleFormControlSelect1">
										<option selected disabled hidde value="">Selecione a opção</option>
										<option value="1">O espaço será entregue limpo</option>
										<option value="2">Limpeza é por conta da Royal</option>
										<option value="3">Limpeza será paga pelos colaboradores</option>
									</select>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
								<button type="submit" class="btn btn-primary">Adicionar</button>
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>

			<?php include "../include_modal_info.php"; ?>

			<!-- Envia as Informações para o modal de informaçãoes -->
			<script type="text/javascript">
				$('#exampleModal1').on('show.bs.modal', function(event) {
					var button = $(event.relatedTarget) // Button that triggered the modal
					var recipient = button.data('whatever')
					var recipientdescricao = button.data('whateverdescricao')
					var recipientlocalizacao = button.data('whateverlocalizacao')
					var recipientlugares = button.data('whateverlugares')

					var recipienttelefone = button.data('whatevertelefone')
					var recipientskype = button.data('whateverskype')
					var recipientteams = button.data('whateverteams')

					// Extract info from data-* attributes
					// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
					// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
					// modal.find('.modal-body input').val(recipient)
					var modal = $(this)
					modal.find('#recipient-id').val(recipient)
					modal.find('.modal-title').text('Informações: ' + recipient)

					modal.find('#recipient-descricao').val(recipientdescricao)
					modal.find('#recipient-descricao').text(' ' + recipientdescricao)

					modal.find('#recipient-localizacao').val(recipientlocalizacao)
					modal.find('#recipient-localizacao').text(' ' + recipientlocalizacao)

					modal.find('#recipient-lugares').val(recipientlugares)
					modal.find('#recipient-lugares').text(' ' + recipientlugares)

					modal.find('#recipient-telefone').val(recipienttelefone)
					modal.find('#recipient-telefone').text(' ' + recipienttelefone)

					modal.find('#recipient-skype').val(recipientskype)
					modal.find('#recipient-skype').text(' ' + recipientskype)

					modal.find('#recipient-teams').val(recipientteams)
					modal.find('#recipient-teams').text(' ' + recipientteams)




				})
			</script>

			<script>
				$('.btn-canc-vis').on("click", function() {
					$('.form').slideToggle();
					$('.visualizar').slideToggle();
				});
				$('.btn-canc-edit').on("click", function() {
					$('.visualizar').slideToggle();
					$('.form').slideToggle();
				});
			</script>

</body>

</html>