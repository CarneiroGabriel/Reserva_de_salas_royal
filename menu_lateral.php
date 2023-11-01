<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="index.php" class=""><i class="lnr lnr-home"></i> <span>Home</span></a></li>

						<?php
							include("fullcalendar/usuario.php");

							if($userInfo['tipo']== "adm"){
						?>

						<li><a href="usuarios.php" class=""><i class="fa fa-regular fa-users"></i> <span>Usuarios</span></a></li>

						<li><a href="reservasPendentes.php" class=""><i class="fa fa-solid fa-check"></i> <span>Reservas Pendentes</span></a></li>
						

						<?php } ?>


					</ul>
				</nav>
			</div>
		</div>
