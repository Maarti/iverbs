<?php include('include/head-inc.php'); ?>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div id="all">
<?php include('include/header-inc.php'); ?>


<div id="corps">
<?php include('include/menu-inc.php'); ?>

<h1><img src="img/about.png" alt="� propos du site..."/></h1> <!-- Police : Learning Curve 56px -->
<div id="about">
<h2><img src="img/presentation.png" alt="Pr�sentation"/></h2>
<p>L'id�e de la cr�ation de ce site est n�e le jeudi 6 octobre 2011, dans un train (l'ennui quotidien). Apr�s une journ�e de cours sur le d�veloppement Web et un devoir d'anglais le lendemain, il n'en fallait pas moins pour prendre une feuille de papier et commencer � griphoner la structure d'un futur site destin� � l'<b>entra�nement aux verbes irr�guliers</b> en Anglais.</p>
<p>Debut de la programmation dans la nuit du jeudi, poursuivie le vendredi apr�s-midi et enfin termin�e le samedi. Ce site a �t� <b>programm� en trois jours</b>, test� en quelques quarts d'heures pour finalement �tre <b>mis en ligne</b> dans la nuit du 08 au <b>09 octobre 2011</b>.</p>
<p>Il est ensuite pr�vu une semaine de beta-test afin de corriger les erreurs �ventuelles qu'il pourrait y avoir.</p>
<br/>

<h2><img src="img/fonctionnement.png" alt="Fonctionnement"/></h2>
<p>Le site utilise une base de donn�es regroupant les verbes et leurs diff�rentes formes. Un questionnaire est g�n�r� en choisissant des verbes � l'infinitif al�atoirement dans la base de donn�es. L'utilisateur doit alors compl�ter les diff�rentes formes de ces verbes.</p>
<p>Une fois termin�, il valide le formulaire et celui-ci est alors trait� gr�ce � un algorithme de comparaison en PhP qui suit le bar�me ci-apr�s :</p>
<p><table><tr><td><u><a name="bareme">Bar�me :</a></u></td><td></td></tr>
<tr><td></td><td>- <font color="#FF0000">0 point</font> : 2 � 3 fautes dans la ligne</td></tr>
<tr><td></td><td>- <font color="#FFA200">0.5 point</font> : 1 faute dans la ligne</td></tr>
<tr><td></td><td>- <font color="#0DB74B">1 point</font> : Aucune faute dans la ligne</td></tr></table>
<p>L'utilisateur peut � tout moment choisir un nom, ou un pseudo en l'entrant dans la case pr�vue en haut � droite du site. Il peut rester anonyme s'il le souhaite. Une fois le test corrig�, le nom et les r�sultats de l'utilisateur sont enregistr�s dans la base de donn�es et son visibles sur <a href="scores.php">la page des scores</a>.</p>

<table id="tabpb"><tr><th width="320px"><font color="green"><a name="pb_connus">Probl�mes rencontr�s :</a></font></th><th width="320px"><font color="red">Solutions apport�es</font></th></tr>
<tr><td>Obtenir un tirage al�atoire des verbes pour g�n�rer un test</td><td>Utilisation de la fonction SQL : ORDER BY rand()</td></tr>
<tr><td>Propositions du navigateur lorsque l'on remplit un champs de verbe que l'on a d�j� remplit auparavant :<br/><img border=1 src="img/pb_form.png" /> </td><td>Ajouter l'option : autocomplete="off"<br/>dans les "input" concern�s pour<br/> d�sactiver cette option</td></tr>
<tr><td>Le respect de la casse lors de la comparaison entre 2 cha�nes en PhP peut engendrer des fautes lors de la correction d'un test si l'utilisateur � utiliser des majuscules</td><td>Les cha�nes entr�es par l'utilisateur sont converties en minuscules grace � la fonction strtolower()</td></tr>
<tr><td>Les verbes avec 2 r�ponses justes possibles<br/> (ex : was/were)</td><td>On utilise la fonction explode() pour s�parer les 2 mots puis on les compare au mot qu'� tap� l'utilisateur.<br/>Ainsi, dans l'exemple donn�, les entr�es valide pour le pr�t�rit de "be" sont "was", "were" et "was/were"</td></tr>
<tr><td>Les dangers des failles XSS</td><td>Toutes les variables affich�es et qui ont �t� au pr�alable entr�es par un utilisateur sont affich�es via la fonction htmlspecialchars() qui ignore le code html qui aurait pu �tre ins�r� dans ces variables</td></tr>
<tr><td>Lorsque le verbe "tirer" est demand�, il n'y a actuellement aucun moyen de savoir si c'est le verbe "shoot" ou "draw" qui est demand�</td><td rowspan="2">Verbes concern�s �cart�s<br/>du tirage au sort des 20 verbes du test</td></tr>
<tr><td>Idem pour<br/>"sentir" avec "feel" et "smell"<br/>"jeter/lancer" avec "throw" et "cast"</td><td></tr>
</table>

<br/>


<h2><img src="img/developpeur.png" alt="Le d�veloppeur"/></h2>
<p><table><ul><tr><td colspan="2"><li>�tudiant en <b>Informatique de Gestion</b></li></td></tr>
<tr><td width="55"><li>Option :</td><td> D�veloppeur d'applications</li></td></tr>
<tr><td><li>Lyc�e :</td><td> <b>Benjamin Franklin</b> - Orl�ans - France</li></td></tr>

<tr><td colspan="2"><li><a href="contact.php">Le contacter</a></li></td></tr>
</table></p>
<br/>

</div>
</div>

<?php include('include/footer-inc.php'); ?>
</div>
</body>
</html>