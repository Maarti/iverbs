<?php include('include/head-inc.php'); ?>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div id="all">
<?php include('include/header-inc.php'); ?>


<div id="corps">
<?php include('include/menu-inc.php'); ?>
<?php include('include/sql-inc.php'); ?>

<h1><img src="img/scores.png"/></h1>
<p align="center">Voici les 35 derniers scores enregistrés :</p>
<?php
$scores = $bdd->query('SELECT * FROM scores, type WHERE scores.scores_type=type.type_id ORDER BY scores_date DESC LIMIT 0,35');
echo "<center><table id='tabscores'>";

    while ($scores2 = $scores->fetch())
    {
		$j = substr($scores2['scores_date'], 8, 2);
		$m = substr($scores2['scores_date'], 5, 2);
		$a = substr($scores2['scores_date'], 2, 2);
		$h = substr($scores2['scores_date'], 11, 5);

		$date = $j.'/'.$m.'/'.$a.' - '.$h;

		echo "<tr><td align='left' width='150px'>".$date."</td><td align='left' width='150px'><b>".htmlspecialchars($scores2['scores_name'])."</b></td><td align='right' width='50px'><b>".$scores2['scores_mark']."</b>/20</td><td align='right' width='150px'>".$scores2['type_nom']."</td></tr>";
	}
	echo "</table></center>";
 ?>

</div>


<?php include('include/footer-inc.php'); ?>
</div>
</body>
</html>