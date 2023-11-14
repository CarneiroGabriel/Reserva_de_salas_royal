<style>
.badge {
  position: absolute;
  top: -10px;
  right: -5px;
  padding: 7px 10px;
  border-radius: 50%;
  background: red;
  color: white;
}
</style>

<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="index.php" class=""><i class="lnr lnr-home"></i> <span>Home</span></a></li>

						<li><a href="minhasReservas.php" class=""><i class="fa fa-list"></i> <span>Minhas Reservas</span></a></li>
						<?php
							include_once("fullcalendar/usuario.php");
							include_once("notificacao.php");

							$notificacao = GetNotifications();
							$alerta = notificacaoAparece($notificacao);


							if($userInfo['tipo']== "adm"){
						?>
						<li><a href="usuarios.php" class=""><i class="fa fa-regular fa-users"></i> <span>Usuarios</span></a></li>

						<li><a href="reservasPendentes.php" class=""><i class="fa fa-solid fa-check"></i> <span>Reservas Pendentes<?= $alerta  ?></span></a></li>

						<?php } ?>


					</ul>
				</nav>
			</div>
		</div>
