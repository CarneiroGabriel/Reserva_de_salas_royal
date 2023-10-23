<!doctype html>
<html lang="pt-br" class="fullscreen-bg">

<head>
	<title>Criar Conta | Agenda</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">

	<link rel="stylesheet" href="assets/css/main.css">

	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="assets/img/logo3.png" alt="Aniger" style="max-width:250px"></div>
								<p class="lead">Sistema de Reservas de Salas</p>
							</div>
							<div class="row">
								<form method="POST" class="form-auth-small" action="create.php">
									<div class="form-group">
										<label for="signin-email" class="control-label sr-only">Email</label>
										<input class="form-control" name="login" id="exampleInputEmail1" type="text" placeholder="Email">
									</div>
									<div class="form-group">
										<label for="signin-email" class="control-label sr-only">Nome</label>
										<input class="form-control" name="nome" id="exampleInputEmail1" type="text" placeholder="Nome">
									</div>
									<div class="form-group">
										<label for="signin-password" class="control-label sr-only">Senha</label>
										<input class="form-control" name="senha" id="exampleInputPassword1" type="password" placeholder="Senha">
									</div>
									<div class="form-group">
										<label for="repeat-password" class="control-label sr-only">Repita a senha</label>
										<input class="form-control" name="senha2" id="exampleInputPassword1" type="password" placeholder="Repita a senha">
									</div>
									
									<div>
										<button type="submit" class="btn btn-primary btn-lg btn-block">Criar Conta</button>
									</div>
									<div class="bottom">
										<span class="helper-text"><i class="fa fa-lock"></i> <a href="login.php">Já tem conta ? </a></span>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="">Sistema de Reservas de Salas</h1>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>