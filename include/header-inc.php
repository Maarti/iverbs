<div id="header1">

	<div id="bloc-name">

		<?php
		if(isset($_POST['destroyname']))
		{
			echo '<form method="post" action="">Nom&nbsp;<input type="text" name="name" maxlength="20" size=15 value="Anonyme" /><input type="submit" name="validname" value="Ok" /></form>';
		}

		if(isset($_POST['validname']) && isset($_POST['name']))
		{
			$_SESSION['name'] = $_POST['name'];
		}

		if ((isset($_SESSION['name'])) && (!isset($_POST['destroyname'])))
		{
			echo '<form method="post" action="">Nom : <b>';
			echo htmlspecialchars($_SESSION['name']);
			echo '</b>&nbsp;&nbsp;<input type="submit" name="destroyname" value="Changer" /></form>';
		}
		else
		{
			if(!isset($_POST['destroyname']))
			{
				?>
				<form method="post" action="">
				Nom&nbsp;<input type="text" name="name" maxlength="20" size=15 value="Anonyme" />
				<input type="submit" name="validname" value="Ok" />
				</form>
				<?php
			}
		}
		?>
	</div>

</div>

<div id="header2">
</div>