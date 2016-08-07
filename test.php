<?php include('include/head-inc.php'); ?>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div id="all">
<?php include('include/header-inc.php'); ?>


<div id="corps">
<?php
include('include/menu-inc.php');
include('include/sql-inc.php');

echo '<h1><img src="img/test.png" alt="Test !"/></h1>';
$liste="";
if(isset($_GET['type']))
{
	if($_GET['type']=="trad")
	{
		$i=1;
		$all = $bdd->query('SELECT * FROM verbe WHERE verbe_id <> 25 AND verbe_id <> 81 AND verbe_id <> 88 AND verbe_id <> 116 AND verbe_id <> 14 AND verbe_id <> 30 ORDER BY rand() LIMIT 0,20');

		echo '<center><form method="POST" action="corrige.php"><table><tr><th width="20px" align="right"><span class="number">#</span></th><th>Infinitif</th><th>Prétérit</th><th>Part. Passé</th><th>Traduction</th></tr>';
		while($all2 = $all->fetch())
		{
			if($i<11)	// Pour les 10 premiers verbes, on propose l'infinitif anglais
			{
				echo '<tr><td align="right"><span class="number">'.$i.'</span></td><td align="left">to '.$all2['verbe_inf'].'</td>';
				echo '<td align="left"><input type="text" name="pret'.$all2['verbe_id'].'" autocomplete="off" maxlength="20" size="10"></td>';
				echo '<td align="left"><input type="text" name="pp'.$all2['verbe_id'].'" autocomplete="off" maxlength="20" size="10"></td>';
				echo '<td align="left"><input type="text" name="trad'.$all2['verbe_id'].'" autocomplete="off" maxlength="20" size="10"></td></tr>';
				$i = $i + 1;
				$liste = $liste.$all2['verbe_id']."/";
			}
			else	// Pour les 10 derniers verbes, on propose l'infinitif français
			{
				echo '<tr><td align="right"><span class="number">'.$i.'</span></td><td>to <input type="text" name="inf'.$all2['verbe_id'].'" autocomplete="off" maxlength="20" size="10"></td>';
				echo '<td align="left"><input type="text" name="pret'.$all2['verbe_id'].'" autocomplete="off" maxlength="20" size="10"></td>';
				echo '<td align="left"><input type="text" name="pp'.$all2['verbe_id'].'" autocomplete="off" maxlength="20" size="10"></td>';
				echo '<td align="left">'.$all2['verbe_trad'].'</td></tr>';
				$i = $i + 1;
				$liste = $liste.$all2['verbe_id']."/";
			}

		}
		echo '<input type="hidden" value="'.$liste.'" name="liste">';
		echo '</table><br/><input type="submit" name="validTest" value="Rendre la copie"></center></form>';

	}
	else if($_GET['type']=="perso")
	{
		echo '<center>Ce type de test n\'est pas encore disponible...<br/><a href="test.php?type=trad">Faire un test traditionnel !</a></center>';
	}
	else
	{
		echo "<center>Type de test inexistant.</center>";
	}
}
else
{
	echo '<center><ul><li><a href="test.php?type=trad">Test traditionnel</a> : 10 verbes anglais, 10 verbes français</li>';
	echo '<li><a href="test.php?type=perso">Test personnalisé</a> : Choix du nombre de verbes <blink>[À venir]</blink></li></ul><br/>';
}
?>

</div>


<?php include('include/footer-inc.php'); ?>
</div>
</body>
</html>