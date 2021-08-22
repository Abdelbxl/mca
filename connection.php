<?php
session_start();
$bdd = new PDO("mysql:host=localhost; dbname=messagerie; charset=utf8;","root","");
if (isset($_POST['validCON']))
{
	if (!empty($_POST['pseudo']) AND !empty($_POST['mdp']))
	{
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mdp=sha1($_POST['mdp']);
		
		$recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo = ? AND mdp = ?');
		$recupUser -> execute(array($pseudo,$mdp));
		
		if ($recupUser->rowCount() > 0)
		{
			//$updateUser = $bdd->prepare('UPDATE users SET in = TRUE WHERE pseudo = "$pseudo" ');
			//$updateUser -> execute(array($user_in));
			
			
			
			$_SESSION['pseudo']=$pseudo;
			$_SESSION['mdp']=$mdp;
			//$isLoggedOrUnlogged=1;
			$_SESSION['id']=$recupUser->fetch()['id'];
			//$_SESSION['pseudo']=$recupUser->fetch()['pseudo'];
			echo $_SESSION['id'];
			echo $pseudo ;
			echo "<br>";
			echo $_SESSION['pseudo'];
			$bool=true;
			$updateUser = $bdd->prepare('UPDATE users SET is_logged = TRUE WHERE pseudo = "$pseudo"');
			$bdd->exec(<<<SQL
			UPDATE users
			SET is_logged=$bool 
			WHERE pseudo='$pseudo'

SQL
)
;
$_SESSION['when_logged_php']= date("Y-m-d H:i:s");

			header ('location:rooms.php');
		}
		else
		{
			echo "mot de passe incorrect...";
		}
	}
	else
	{
		echo "completez tous les champs...";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="connectionStyle.css" />
	<title>connexion</title>
	<meta charset="utf-8">
	
</head>

<body>

<div class="bgImg2">
	<img src="tablect.png" alt="interface" style="width:44%;">
 </div>
 
<div class="titre1">
<p3>isfce</p3><br>
<p3>Chat Multilangues</p3><br>
<p3>Connexion</p3>
</div>

 <div class="formConnection">
	<form method = "POST" action = "" align = "center">
</div>	
	<div class="inputText1">
	<input type="text" name="pseudo" placeholder="Entrez Votre Pseudo" autocomplete="off">
	</div>
	
	<div class="inputText2">
	<input type="password" name="mdp" placeholder="Entrez Votre Password" autocomplete="off">
	</div>
	<br><br>
	<!--<input type="submit" name="envoi" value = "Valider pour chatter">-->
	<div class="inputSubmitbtn1">
		<input type="submit" name="validCON" value= "Valider Votre Connexion">
	</div>
	<div class="linkbtn1">
		<a href="index.html">ESCAPE</a>
	</div>	
	
	</form>
	
</body>
</html>