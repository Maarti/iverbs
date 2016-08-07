<?php include('include/head-inc.php'); ?>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div id="all">
<?php include('include/header-inc.php'); ?>


<div id="corps">
<?php
include('include/menu-inc.php');
include('include/sql-inc.php');

echo '<h1><img src="img/correction.png" alt="Correction" /></h1>';
echo '<center><a target="_blank" href="about.php#bareme">Voir le bar�me</a></center><br/>';

if(isset($_POST['validTest'])) // Si on arrive sur cette page en ayant bien valider un test
{
	$note=0;								//initialisation de la note du test
	$liste = explode("/", $_POST['liste']);	// On r�cup�re la variable contenant l'ordre des 20 verbes demand�s, puis on la divise en un tableau � 20 entr�es

	echo "<center><table id='tabcorrige'><tr><th>Infinitif</th><th>Pr�t�rit</th><th>Participe Pass�</th><th>Traduction</th><th class='noteligne' width='50px'></th></tr>";

	for ($i=0; $i<10; $i++) // Pour les 10 premi�res r�ponses (= traduction � partir de l'infinitif anglais)
	{
		if(isset($_POST['pret'.$liste[$i]])) // On traite les verbes envoy�s dans le BON ORDRE (tels qu'ils ont �t� donn� dans le test)
		{
			$info = $bdd->query("SELECT * FROM verbe WHERE verbe_id=$liste[$i]");	//On s�lectionne les infos du verbe en cours de traitement (ainsi que les r�ponse donn�es) puis on les stock dans variables faciles d'acc�s pour les comparer
			$info2 = $info->fetch();

			$pret1 = strtolower($_POST['pret'.$liste[$i]]); // strtolower() permet de convertir la chaine (entr�e par l'utilisateur) en minuscules, afin que la casse ne pose pas de probl�me pour la comparaison des cha�nes
			$pp1 = strtolower($_POST['pp'.$liste[$i]]);
			$trad1 = strtolower($_POST['trad'.$liste[$i]]);

			$pret2 = $info2['verbe_pret'];
			$pp2 = $info2['verbe_pp'];
			$trad2 = $info2['verbe_trad'];
			$inf2 = $info2['verbe_inf'];

			$check=100;	// initialisation de la variable check qui nous permet d'�valuer chaque ligne

			echo "<tr>";
			echo "<td><b>".$inf2."</b></td>"; // INFINITIF

				// PRETERIT
				if(preg_match_all('/\//', $pret2,$out)) //S'il y a un slash (= si le verbe concern� poss�de 2 r�ponses justes possibles)
				{
					$pretExplode= explode("/", $pret2);
					if($pret1 == $pretExplode[0] OR $pret1 == $pretExplode[1] OR $pret1 == $pret2) // On recherche si le mot tap� est dans la chaine
					{
						echo '<td><font color="green">';	// Oui : on affiche la bonne r�ponse de l'utilisateur en vert
						echo htmlspecialchars($pret1);
						echo '</font></td>';
					}
					else	// Non : On affiche la mauvaise r�ponse en rouge, puis la correction
					{
						$check=$check-33; // on retire 0.33 pts pour cette ligne (sert � l'�valuation)
						if($pret1 == "")
						{
							echo '<td><img src="img/cross.png" title="Vous n\'avez pas r�pondu" />';	// Si l'utilisateur n'avait pas remplit la case, on affiche une croix
						}
						else
						{
							echo '<td><font color="RED">';	// Sinon on affiche sa mauvaise r�ponse en rouge
							echo htmlspecialchars($pret1);
							echo '</font>';
						}
						echo ' <img src="img/right-arrow.png" height="10px" width="16px" alt="=>" /> '.$pret2.'</td>';	// Puis la correction
					}
				}
				else // Sinon, il n'y a pas de slash (= verbe poss�dant une seule r�ponse juste possible)
				{
					if($pret1 == $pret2) // On compare simplement les 2 chaines
					{
						echo '<td><font color="green">'; // Si elles sont identiques on affiche le r�sultat en vert
						echo htmlspecialchars($pret1);
						echo '</font></td>';
					}
					else
					{
						$check=$check-33;
						if($pret1 == "")
						{
							echo '<td><img src="img/cross.png" title="Vous n\'avez pas r�pondu" />';	// Si l'utilisateur n'a rien remplit on affiche la croix
						}
						else
						{
							echo '<td><font color="RED">'; // Sinon on affiche sa mauvaise r�ponse en rouge
							echo htmlspecialchars($pret1);
							echo '</font>';
						}
						echo ' <img src="img/right-arrow.png" height="10px" width="16px" alt="=>" /> '.$pret2.'</td>'; // Puis la correction
					}
				}

				// PARTICIPE PASS�
				if($pp1 == $pp2) // Ici, inutile de tester la pr�sence du slash car aucun participe pass� n'en poss�de
				{
					echo '<td><font color="green">'.htmlspecialchars($pp1).'</font></td>';
				}
				else
				{
					$check=$check-33;
					if($pp1 == "")
					{
						echo '<td><img src="img/cross.png" title="Vous n\'avez pas r�pondu" />';
					}
					else
					{
						echo '<td><font color="RED">'.htmlspecialchars($pp1).'</font>';
					}
					echo ' <img src="img/right-arrow.png" height="10px" width="16px" alt="=>" /> '.$pp2.'</td>';
				}

				// TRADUCTION
				if(preg_match_all('/\//', $trad2,$out)) // M�me principe que le test pour le preterit
				{
					$tradExplode= explode("/", $trad2);
					if($trad1 == $tradExplode[0] OR $trad1 == $tradExplode[1] OR $trad1 == $trad2)
					{
						echo '<td><font color="green">'.htmlspecialchars($trad1).'</font></td>';
					}
					else
					{
						$check=$check-33;
						if($trad1 == "")
						{
							echo '<td><img src="img/cross.png" title="Vous n\'avez pas r�pondu" />';
						}
						else
						{
							echo '<td><font color="RED">'.htmlspecialchars($trad1).'</font>';
						}
						echo ' <img src="img/right-arrow.png" height="10px" width="16px" alt="=>" /> '.$trad2.'</td>';
					}
				}
				else
				{
					if($trad1 == $trad2)
					{
						echo '<td><font color="green">'.htmlspecialchars($trad1).'</font></td>';
					}
					else
					{
						$check=$check-33;
						if($trad1 == "")
						{
							echo '<td><img src="img/cross.png" title="Vous n\'avez pas r�pondu" />';
						}
						else
						{
							echo '<td><font color="RED">'.htmlspecialchars($trad1).'</font>';
						}
						echo ' <img src="img/right-arrow.png" height="10px" width="16px" alt="=>" /> '.$trad2.'</td>';
					}
				}

			//Notation
			if($check>75)
			{
				$noteligne=1;
			}
			else if($check>50 AND $check<75)
			{
				$noteligne=0.5;
			}
			else
			{
				$noteligne=0;
			}
			$note=$note+$noteligne;

			echo '<td class="noteligne"><img src="img/mark'.$noteligne.'.png" alt="'.$noteligne.'" /></td></tr>';

		}
	}

	//################## M�me principe ici pour les 10 derniers verbes, sauf qu'on traite cette fois l'infinitif anglais et pas la traduction ! ##################################
	for ($i=10; $i<20; $i++) // Pour les 10 derni�res r�ponses (= traduction � partir de l'infinitif fran�ais)
	{
		if(isset($_POST['pret'.$liste[$i]]))
		{
			$info = $bdd->query("SELECT * FROM verbe WHERE verbe_id=$liste[$i]");
			$info2 = $info->fetch();

			$pret1 = strtolower($_POST['pret'.$liste[$i]]);
			$pp1 = strtolower($_POST['pp'.$liste[$i]]);
			$inf1 = strtolower($_POST['inf'.$liste[$i]]);

			$pret2 = $info2['verbe_pret'];
			$pp2 = $info2['verbe_pp'];
			$trad2 = $info2['verbe_trad'];
			$inf2 = $info2['verbe_inf'];

			$check=100;

			echo "<tr>";

				// INFINITIF
				if($inf1 == $inf2)
				{
					echo '<td><font color="green">'.htmlspecialchars($inf1).'</font></td>';
				}
				else
				{
					$check=$check-33;
					if($inf1 == "")
					{
						echo '<td><img src="img/cross.png" title="Vous n\'avez pas r�pondu" />';
					}
					else
					{
						echo '<td><font color="RED">'.htmlspecialchars($inf1).'</font>';
					}
					echo ' <img src="img/right-arrow.png" height="10px" width="16px" alt="=>" /> '.$inf2.'</td>';
				}

				// PRETERIT
				if(preg_match_all('/\//', $pret2,$out))
				{
					$pretExplode= explode("/", $pret2);
					if($pret1 == $pretExplode[0] OR $pret1 == $pretExplode[1] OR $pret1 == $pret2)
					{
						echo '<td><font color="green">'.htmlspecialchars($pret1).'</font></td>';
					}
					else
					{
						$check=$check-33;
						if($pret1 == "")
						{
							echo '<td><img src="img/cross.png" title="Vous n\'avez pas r�pondu" />';
						}
						else
						{
							echo '<td><font color="RED">'.htmlspecialchars($pret1).'</font>';
						}
						echo ' <img src="img/right-arrow.png" height="10px" width="16px" alt="=>" /> '.$pret2.'</td>';
					}
				}
				else
				{
					if($pret1 == $pret2)
					{
						echo '<td><font color="green">'.htmlspecialchars($pret1).'</font></td>';
					}
					else
					{
						$check=$check-33;
						if($pret1 == "")
						{
							echo '<td><img src="img/cross.png" title="Vous n\'avez pas r�pondu" />';
						}
						else
						{
							echo '<td><font color="RED">'.htmlspecialchars($pret1).'</font>';
						}
						echo ' <img src="img/right-arrow.png" height="10px" width="16px" alt="=>" /> '.$pret2.'</td>';
					}
				}

				// PARTICIPE PASS�
				if($pp1 == $pp2)
				{
					echo '<td><font color="green">'.htmlspecialchars($pp1).'</font></td>';
				}
				else
				{
					$check=$check-33;
					if($pp1 == "")
					{
						echo '<td><img src="img/cross.png" title="Vous n\'avez pas r�pondu" />';
					}
					else
					{
						echo '<td><font color="RED">'.htmlspecialchars($pp1).'</font>';
					}
					echo ' <img src="img/right-arrow.png" height="10px" width="16px" alt="=>" /> '.$pp2.'</td>';
				}

			echo "<td><b>".$trad2."</b></td>"; // TRADUCTION

			//Notation
			if($check>75)
			{
				$noteligne=1;
			}
			else if($check>50 AND $check<75)
			{
				$noteligne=0.5;
			}
			else
			{
				$noteligne=0;
			}
			$note=$note+$noteligne;

			echo '<td class="noteligne"><img src="img/mark'.$noteligne.'.png" alt="'.$noteligne.'" /></td></tr>';
		}
	}
	//#####################FIN traitement 10 derniers verbes###################################

	echo '</table></center>';
	?>
	<br/>
	<div id="notefinale">
	<p>Ta note : <span id="noterouge"><?php echo $note; ?></span><span id="notetotale">/20</span></p>
	<?php
	if($note == 20)
	{
		echo '<p>Amazing! You are perfectly bilingual!</p>';
		echo '<br/><iframe width="560" height="315" src="http://www.youtube.com/embed/_N4DMW5NWsE?rel=0" frameborder="0" allowfullscreen></iframe>';
	}
	else if ($note > 17)
	{
		echo '<p>F�licitation !<br/>Tu approches de la perfection...</p>';
		echo '<img src="img/bilingue.jpg" height="342px" width="400px" alt="Norman - Bilingue" />';
	}
	else if ($note > 12)
	{
		echo '<p>Bravo !<br/>Tu es pr�t(e) pour la prochaine interro ;)</p>';
	}
	else if ($note >10)
	{
		echo '<p>Assez-bien, ne reste pas sur tes acquis.<br/><a href="test.php">Continue � t\'entra�ner !</a></p>';
	}
	else if ($note >8)
	{
		echo '<p>Passable, tu devrais mieux apprendre les verbes avant de t\'entra�ner � nouveau.</p>';
	}
	else if ($note >3)
	{
		echo '<p>Tu manques s�rieusement de connaissances !<p>';
	}
	else if ($note >0)
	{
		echo '<p>La prochaine fois allume ton �cran pour faire le test ! >.<</p>';
	}
	else if ($note ==0)
	{
		echo '<p>�a t\'amuse de valider un formulaire vide ? :)';
	}
	?>
	<br/>
	<p><a href="scores.php">Consulter les scores</a></p><br/>
	</div>

	<?php
	if (isset($_SERVER["REMOTE_ADDR"]))
	{
		$ip=$_SERVER["REMOTE_ADDR"];
	}
	else
	{
		$ip="000.0.0.0";
	}

	if (isset($_SESSION['name']))
	{
		$nom = $_SESSION['name'];
	}
	else
	{
		$nom = 'Anonyme';
	}
	$score = $bdd->prepare('INSERT INTO scores(scores_name, scores_mark, scores_type, scores_ip) VALUES(:name, :mark, :type, :ip)');
	$score->execute(array(
	':name' => $nom,
	':mark' => $note,
	':type' => '1',
	':ip' => $ip
	));
	?>






<?php
}
else // Si on arrive sur cette page sans avoir valider de test (directement par l'url) afficher un message d'erreur. ( -> Evite les erreurs sql)
{
	echo '<center><p>Vous n\'avez pas effectu� de test.<br/><a href="test.php">Retour au menu test.</a></p></center>';
}
?>
<center><p>Merci de signaler toute erreur ou bug que vous rencontrez en utilisant <br/><a href="contact.php">le formulaire de contact</a>.</p></center>
</div>


<?php include('include/footer-inc.php'); ?>
</div>
</body>
</html>