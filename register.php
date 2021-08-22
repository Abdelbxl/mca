<?php
session_start();
$eon="";

$bdd = new PDO("mysql:host=localhost; dbname=messagerie; charset=utf8;","root","");
if (isset($_POST['validIns'])){
	
	if (!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mdp=sha1($_POST['mdp']);
		
		$insertUser = $bdd->prepare('INSERT INTO users(pseudo,mdp) VALUES (?,?)');
		$insertUser -> execute(array($pseudo,$mdp));
		
		$recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo = ? AND mdp = ?');
		$recupUser -> execute(array($pseudo,$mdp));
		if ($recupUser->rowCount() > 0){
		$_SESSION['pseudo']=$pseudo;
		$_SESSION['mdp']=$mdp;
		$_SESSION['id']= $recupUser->fetch()['id'];
		}
		echo $_SESSION['id'];
		echo"<div class='textAfterEon1'>";
		$eon="Vous etes bien enregistree dans notre base de donnee";
		echo $eon;
		echo"<br>";
		echo "Maintenant cliquez sur ESCAPE pour vous connectez au chat";
		echo"</div>";
		
	}else{
		echo"<div class='textAfterEon2'>";
		$eon="Veuillez completer tous les champs...";
		echo $eon;
		echo"</div>";
		//header("Cache-Control: no-cache, must-revalidate" );
		//header("Cache-Control: no-cache");
		//header("Pragma: no-cache");
	}
}
?>



<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="registerStyle.css" />
	<title>chat multilangue inscription</title>
	<meta charset="utf-8">
	
</head>

<body>
<div class="bgImg2">
	<img src="tablect.png" alt="interface" style="width:44%;">
</div>

<div class="titre1">

	<div class="line1">
	<p6>isfce</p6>
	</div>

	<div class="line2">
	<p6>Chat Multilangues</p6>
	</div>

	<div class="line3">
	<p6>Inscription</p6>
	</div>

</div>


	<form method = "POST" action = "" align = "center">
		
		<div class="inputText1">
		<input type="text" name="pseudo" placeholder="Entrez Votre Pseudo" autocomplete="off">
		</div>
		
		<div class="inputText2">
		
		
		<input type="password" name="mdp" placeholder=" Entrez Votre Password" autocomplete="off">
		</div>
		
		<div class="inputSubmitbtn1">
		<input type="submit" name="validIns" value= "Valider">
		</div>
		<div class="linkbtn1">
		<a href="index.html">ESCAPE</a>
		</div>
		
		
		
	</form>
</body>
</html>