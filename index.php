<?php include('include/head-inc.php'); ?>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div id="all">
<?php include('include/header-inc.php'); ?>


<div id="corps">
<?php include('include/menu-inc.php'); ?>
<?php include('include/sql-inc.php'); ?>

<h1><img src="img/liste.png" alt="Liste des verbes irréguliers"/></h1> <!-- Police : Learning Curve 56px -->
<p align="center"><a target="_blank" href="doc/verbes_irreguliers.pdf">Télécharger le PDF</a></p>
<?php
$all = $bdd->query('SELECT * FROM verbe ORDER BY verbe_inf');
echo "<center><table id='tabscores'><tr><th>Infitif</th><th>Prétérit</th><th>Participe Passé</th><th>Traduction</th></tr>";
    // On affiche chaque entrée une à une
    while ($all2 = $all->fetch())
    {
		echo "<tr><td align='left'>to ".$all2['verbe_inf']."</td><td align='left'>".$all2['verbe_pret']."</td><td align='left'>".$all2['verbe_pp']."</td><td align='left'>".$all2['verbe_trad']."</td></tr>";
	}
	echo "</table></center>";
 ?>

</div>


<?php include('include/footer-inc.php'); ?>
</div>
</body>
</html>