<?php include('include/head-inc.php'); ?>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div id="all">
<?php include('include/header-inc.php'); ?>


<div id="corps">
<?php include('include/menu-inc.php'); ?>

<h1><img src="img/about.png" alt="À propos du site..."/></h1> <!-- Police : Learning Curve 56px -->
<div id="about">
<h2><img src="img/presentation.png" alt="Présentation"/></h2>
<p>L'idée de la création de ce site est née le jeudi 6 octobre 2011, dans un train (l'ennui quotidien). Après une journée de cours sur le développement Web et un devoir d'anglais le lendemain, il n'en fallait pas moins pour prendre une feuille de papier et commencer à griphoner la structure d'un futur site destiné à l'<b>entraînement aux verbes irréguliers</b> en Anglais.</p>
<p>Debut de la programmation dans la nuit du jeudi, poursuivie le vendredi après-midi et enfin terminée le samedi. Ce site a été <b>programmé en trois jours</b>, testé en quelques quarts d'heures pour finalement être <b>mis en ligne</b> dans la nuit du 08 au <b>09 octobre 2011</b>.</p>
<p>Il est ensuite prévu une semaine de beta-test afin de corriger les erreurs éventuelles qu'il pourrait y avoir.</p>
<br/>

<h2><img src="img/fonctionnement.png" alt="Fonctionnement"/></h2>
<p>Le site utilise une base de données regroupant les verbes et leurs différentes formes. Un questionnaire est généré en choisissant des verbes à l'infinitif aléatoirement dans la base de données. L'utilisateur doit alors compléter les différentes formes de ces verbes.</p>
<p>Une fois terminé, il valide le formulaire et celui-ci est alors traité grâce à un algorithme de comparaison en PhP qui suit le barème ci-après :</p>
<p><table><tr><td><u><a name="bareme">Barème :</a></u></td><td></td></tr>
<tr><td></td><td>- <font color="#FF0000">0 point</font> : 2 à 3 fautes dans la ligne</td></tr>
<tr><td></td><td>- <font color="#FFA200">0.5 point</font> : 1 faute dans la ligne</td></tr>
<tr><td></td><td>- <font color="#0DB74B">1 point</font> : Aucune faute dans la ligne</td></tr></table>
<p>L'utilisateur peut à tout moment choisir un nom, ou un pseudo en l'entrant dans la case prévue en haut à droite du site. Il peut rester anonyme s'il le souhaite. Une fois le test corrigé, le nom et les résultats de l'utilisateur sont enregistrés dans la base de données et son visibles sur <a href="scores.php">la page des scores</a>.</p>

<table id="tabpb"><tr><th width="320px"><font color="green"><a name="pb_connus">Problèmes rencontrés :</a></font></th><th width="320px"><font color="red">Solutions apportées</font></th></tr>
<tr><td>Obtenir un tirage aléatoire des verbes pour générer un test</td><td>Utilisation de la fonction SQL : ORDER BY rand()</td></tr>
<tr><td>Propositions du navigateur lorsque l'on remplit un champs de verbe que l'on a déjà remplit auparavant :<br/><img border=1 src="img/pb_form.png" /> </td><td>Ajouter l'option : autocomplete="off"<br/>dans les "input" concernés pour<br/> désactiver cette option</td></tr>
<tr><td>Le respect de la casse lors de la comparaison entre 2 chaînes en PhP peut engendrer des fautes lors de la correction d'un test si l'utilisateur à utiliser des majuscules</td><td>Les chaînes entrées par l'utilisateur sont converties en minuscules grace à la fonction strtolower()</td></tr>
<tr><td>Les verbes avec 2 réponses justes possibles<br/> (ex : was/were)</td><td>On utilise la fonction explode() pour séparer les 2 mots puis on les compare au mot qu'à tapé l'utilisateur.<br/>Ainsi, dans l'exemple donné, les entrées valide pour le prétérit de "be" sont "was", "were" et "was/were"</td></tr>
<tr><td>Les dangers des failles XSS</td><td>Toutes les variables affichées et qui ont été au préalable entrées par un utilisateur sont affichées via la fonction htmlspecialchars() qui ignore le code html qui aurait pu être inséré dans ces variables</td></tr>
<tr><td>Lorsque le verbe "tirer" est demandé, il n'y a actuellement aucun moyen de savoir si c'est le verbe "shoot" ou "draw" qui est demandé</td><td rowspan="2">Verbes concernés écartés<br/>du tirage au sort des 20 verbes du test</td></tr>
<tr><td>Idem pour<br/>"sentir" avec "feel" et "smell"<br/>"jeter/lancer" avec "throw" et "cast"</td><td></tr>
</table>

<br/>


<h2><img src="img/developpeur.png" alt="Le développeur"/></h2>
<p><table><ul><tr><td colspan="2"><li>Étudiant en <b>Informatique de Gestion</b></li></td></tr>
<tr><td width="55"><li>Option :</td><td> Développeur d'applications</li></td></tr>
<tr><td><li>Lycée :</td><td> <b>Benjamin Franklin</b> - Orléans - France</li></td></tr>

<tr><td colspan="2"><li><a href="contact.php">Le contacter</a></li></td></tr>
</table></p>
<br/>

</div>
</div>

<?php include('include/footer-inc.php'); ?>
</div>
</body>
</html>