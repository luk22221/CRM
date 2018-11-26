<nav>
<?php
 echo "<p>Zalogowany jako ".$_SESSION['user'].'! [ <a href="../config/logout.php">Wyloguj się!</a> ]</p>'; ?><a href="../account_settings.php">ustawienia konta</a>
<div class="pudlo">
	<div class="logo">
		<a href="/"><img src="", alt="logo"/></a></div>
		<div class="circle">
			<div class="burger-icon"></div>
		</div>
		<div id="menu">
			<ul>
				<li><a href="../index.php">Strona główna</a></li>
				<li><a href="../clients.php">Klienci</a></li>
				<?php if (($_SESSION['privilege'])== 1) {?>
					<li><a href="../admin/management.php">Zarządzaj użytkownikami</a></li>
				<?php } ?>
			</ul>
		</div>
		<div class="clear")></div>
</div>
</nav>
