<?php
require_once("cnf/cfg.php");
session_start();
$content = "";
if (isset($_REQUEST['contenu'])) {
	$content = $_REQUEST['contenu'];
}
if($content == "auth") {
	if(isset($_SESSION["delice"])) {
		$val = $_SESSION["delice"];
		$list = explode(":", $val);
		if(!is_array($list)) {
			unset($_SESSION['delice']);
			echo "c=-1&unset";
		} else {
			if(count($list) != 7) {
				unset($_SESSION['delice']);
				echo "c=-1&count";
			} else {
				$winner = $list[0];
				$nom = $list[1];
				$prenom = $list[2];
				$age = $list[3];
				$tel = $list[4];
				$email = $list[5];
				$cin = $list[6];
				if($winner != 0) {
					unset($_SESSION['delice']);
					echo "c=-1";
				} else {
					$link = mysqli_connect($dbhost, $dbuser, $dbpass);
					if (!$link) {
						die('Impossible de se connecter : ' . mysqli_error());
					}
					// Rendre la base de données $dbname, la base courante
					$dbln = mysqli_select_db($link, $dbname);
					if (!$dbln) {
						die ('Impossible de sélectionner la base de donn&eacute;es : ' . mysqli_error());
					}
					$query = "SELECT COUNT(id) AS w FROM players WHERE cin = '$cin'";
					$res = mysqli_query($link, $sql) or die ("Impossible d'executer la requete 1");
					$resultat = mysqli_fetch_object($res);
					if($resultat->w > 0) {
						$_SESSION["delice"] = "1:".$nom.":".$prenom.":".$age.":".$tel.":".$email.":".$cin;
						echo "c=-1";
					} else {
						$_SESSION["delice"] = $resultat->w.":".$nom.":".$prenom.":".$age.":".$tel.":".$email.":".$cin;
						echo "c=1";
					}
					echo "c=".$winner;
				}
			}
		}
	} else {
		echo "c=-1&notset";
	}
}
if($content == "form") {
	$nom = trim($_REQUEST["nom"]);
	$prenom = trim($_REQUEST["prenom"]);
	$age = trim($_REQUEST["age"]);
	$tel = trim($_REQUEST["tel"]);
	$email = trim($_REQUEST["email"]);
	$cin = trim($_REQUEST["cin"]);
	if(strlen($nom) <= 3) {
		echo "f=2";
	} else if(strlen($prenom) <= 3) {
		echo "f=3";
	} else if($age <0 || $age > 120) {
		echo "f=4";
	} else if(strlen($tel) != 8) {
		echo "f=5";
	} else if(!preg_match("/^[2|5|9]+([0-9]*)$/", $tel)) {
		echo "f=5";
	} else if(!preg_match('`^[[:alnum:]]([-_.]?[[:alnum:]])+_?@[[:alnum:]]([-.]?[[:alnum:]])+\.[a-z]{2,6}$`',$email)) {
		echo "f=6";
	} else if(strlen($cin) != 8) {
		echo "f=7";
	} else if(!preg_match("/^([0-9]*)$/", $cin)) {
		echo "f=7";
	} else {
		$link = mysqli_connect($dbhost, $dbuser, $dbpass);
		if (!$link) {
			die('Impossible de se connecter : ' . mysqli_error());
		}
		// Rendre la base de données $dbname, la base courante
		$dbln = mysqli_select_db($link, $dbname);
		if (!$dbln) {
			die ('Impossible de sélectionner la base de donn&eacute;es : ' . mysqli_error());
		}
		$sql = "SELECT COUNT(id) AS w FROM players WHERE cin = '$cin'";
		$res = mysqli_query($link, $sql) or die ("Impossible d'executer la requete 1");
		$resultat = mysqli_fetch_object($res);
		if($resultat->w > 0) {
			$_SESSION["delice"] = "1:".$nom.":".$prenom.":".$age.":".$tel.":".$email.":".$cin;
			echo "f=-1";
		} else {
			$_SESSION["delice"] = $resultat->w.":".$nom.":".$prenom.":".$age.":".$tel.":".$email.":".$cin;
			echo "f=1";
		}
	}
}

if($content == "winner") {
	if(isset($_SESSION["delice"])) {
		$val = $_SESSION["delice"];
		$list = explode(":", $val);
		if(!is_array($list)) {
			unset($_SESSION['delice']);
			echo "c=-1";
		} else {
			if(count($list) != 7) {
				unset($_SESSION['delice']);
				echo "c=-1";
			} else {
				$winner = $list[0];
				$nom = $list[1];
				$prenom = $list[2];
				$age = $list[3];
				$tel = $list[4];
				$email = $list[5];
				$cin = $list[6];
				if($winner != 0) {
					echo "c=-1";
				} else {
					$link = mysqli_connect($dbhost, $dbuser, $dbpass);
					if (!$link) {
						die('Impossible de se connecter : ' . mysqli_error());
					}
					// Rendre la base de données $dbname, la base courante
					$dbln = mysqli_select_db($link, $dbname);
					if (!$dbln) {
						die ('Impossible de sélectionner la base de donn&eacute;es : ' . mysqli_error());
					}

					$sql = "INSERT INTO players (cin, nom, prenom, age, tel, email, createdat) VALUES ('$cin', '$nom', '$prenom', '$age', '$tel', '$email', NOW())";
					$res = mysqli_query($link, $sql) or die ("Impossible d'executer la requete 2");
					unset($_SESSION['delice']);
					echo "c=1";
				}
			}
		}
	} else {
		echo "c=-1";
	}
}


?>