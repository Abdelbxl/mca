
<?php
session_start();
//echo "<br>";
echo $_SESSION['id'];
echo $_SESSION['pseudo'];
//var_dump ($_SESSION);
$pseudo = $_SESSION['pseudo'];
$bdd = new PDO("mysql:host=localhost; dbname=messagerie; charset=utf8;","root","");
if (isset($_POST['sendWritenMessage'])){
	if (!empty($_POST['message'])){
		$pseudo = htmlspecialchars($_SESSION['pseudo']);
		$message=nl2br(htmlspecialchars($_POST['message']));
		
		$insererMessage = $bdd->prepare('INSERT INTO messages(pseudo,message) VALUES (?,?)');
		$insererMessage -> execute(array($pseudo,$message));
	}else{
		echo "Veuillez completer tous les champs...";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="tochatStyle.css" />
	<title>Messagerie instantanee</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<img src="tablect.png" alt="interface" style="width:44%;">

<button class = "button topbtn" type="submit" name="sendWritenMessage">top button</button>

	<form method = "POST" action = "" align = "center">

		
		
		
		<div class="textAreaInput">
		<textarea name="message" rows="3" cols="52"></textarea>
		</div>
		
		
		<button class = "button button1 " type="submit" name="sendWritenMessage">envoyer</button>
		
		<!--<a class = "button exitSalon " href="rooms.php">quitter salon</a>
		<a href = "disconnection.php">-->
	<!--<button type = "submit" name = "validDiscon">log out</button>-->
		
	</form>
	

	<section id="messages" ></section>
	
	<script>
		setInterval('load_messages()',400);
		function load_messages()
		{
			$('#messages').load('loadMessages.php');	
		}
		$(document).ajaxComplete(function(){
		$('#messages').scrollTop($('#messages').prop('scrollHeight')); /* text focus tjrs en bas */
		});
		
	</script>
	
	
	

	
















<?php
if (isset($_POST['validDiscon'])){
	$conn = mysqli_connect("localhost","root","","messagerie" );
	mysqli_query($conn, "SET NAMES UTF8" );
	
	$query = <<< SQL
				UPDATE users
				SET is_logged=0 
				WHERE pseudo='$pseudo'
SQL;

	mysqli_query($conn, $query );
	mysqli_commit($conn);
	mysqli_close($conn);
	header('Location: disconnection.php');
}

?>
	
</body>

</html>
