
<?php
session_start();
//var_dump ($_SESSION);
$bdd = new PDO("mysql:host=localhost; dbname=messagerie; charset=utf8;","root","");
$recupMessages = $bdd->query(<<<SQL
SELECT * FROM (
   SELECT * FROM messages 
   WHERE when_sent>= "{$_SESSION['when_logged_php']}"
     
   ORDER BY id DESC 
) Var1
ORDER BY id ASC;
SQL
);
while ($message = $recupMessages->fetch()){
	?>

	<div class= "message" >
		<?="<Strong>",$message ['pseudo'],"</Strong>"," ","<font size='1.6'>",$message ['when_sent'],"</font>"," :", "<br>",$message['message'],"<br>"; ?>
		<!--<h4><?//=$message ['pseudo'];?></h4>-->
		
		<!--<div123><p><?//=$message['message'];?></p></div123>-->
		
	</div>
	<?php

}

?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" load.css" />
	<title>chat multilangue load</title>
	<meta charset="utf-8">
	
</head>

<body>

</body>
</html>