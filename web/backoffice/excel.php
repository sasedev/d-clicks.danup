<?php
/*
 * Created on 08 nov. 2008
 * by Salah Abdelkader Seif Eddine
 * using PHPeclipse
 */
session_start();
if(!isset($_SESSION["alogged"])) {
	header("Location: login.php");
	exit(0);
}
require_once("../cnf/cfg.php");
$link = mysqli_connect($dbhost, $dbuser, $dbpass);
if (!$link) {
	die('Impossible de se connecter : ' . mysqli_error());
}

// Rendre la base de données $dbname, la base courante
$dbln = mysqli_select_db($link, $dbname);
if (!$dbln) {
	die ('Impossible de sélectionner la base de donn&eacute;es : ' . mysqli_error());
}
header('Content-type: application/excel');
$filename = "rapport_danup_pechemelba_du_".date('Y-m-j_H-i-s').".xls";
header('Content-Disposition: attachment; filename="'.$filename.'"');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administration du Jeu D&eacute;lice Danup Peche-Melba</title>
<style type="text/css">
body.admin {
	margin-top: 0px;
	font-family:Tahoma,Arial,sans-serif;
	font-size: 12px;
	color:black;
	background-color:white;
}

.Error {

	font-family: Tahoma,Arial,sans-serif;
	font-size: 13px;
	color: #E327B1;
	font-weight: bold;
}
input.admin {
	color:black;
	background-color:white;
	font-family:Tahoma,Arial,sans-serif;
	font-size: 12px;
	width: 150px;
}

select.admin {
	color:black;
	background-color:white;
	font-family:Tahoma,Arial,sans-serif;
	font-size: 12px;
	width: 150px;
}

h1.admin {
	font-family:Tahoma,Arial,sans-serif;
	color:white;
	background-color:#525D76;
	font-size:22px;
}

h2.admin {
	font-family:Tahoma,Arial,sans-serif;
	color:white;
	background-color:#525D76;
	font-size:16px;
}

h3.admin {
	font-family:Tahoma,Arial,sans-serif;
	color:white;
	background-color:#525D76;
	font-size:14px;
}

h4.admin {
	font-family:Tahoma,Arial,sans-serif;
	color:white;
	background-color:#525D76;
	font-size:12px;
}

b.admin {
	font-family:Tahoma,Arial,sans-serif;
	color:white;
	background-color:#525D76;
}

a.admin {
	color : black;
	font-size: 12px;
}

hr.admin {
	color : #525D76;
}

tr.admin {
	background-color: #eeeeee;
}

th.admin {
	background-color: #eeeeee;
}

td.a1 {
	background-color: #cccccc;
}

td.a2 {
	background-color: #aaaaaa;
}
td.txtbg {
	background-color: white;
}
</style>
</head>

<body class="admin">
<table align="center" width="750" >

<tr class="admin"  valign="top">
	<td colspan="8" height="69px" style="">
		<img src="http://www.jeudanup-monoprix.com/backoffice/images/bkoffice_01.jpg" alt="D-Clicks" border="0" />
	</td>
</tr>
<tr class="admin"  valign="top">
	<td colspan="8">&nbsp;</td>
</tr>
<tr class="admin"  valign="top">
	<td colspan="8">&nbsp;</td>
</tr>
<tr class="admin"  valign="top">
	<td colspan="8">&nbsp;</td>
</tr>
<tr class="admin"  valign="top">
	<td colspan="8">&nbsp;</td>
</tr>
<tr class="admin"  valign="top">
	<td align="right" class="a1" colspan="2">Nombre d'inscrits : &nbsp;</td>
	<td class="a2"> &nbsp;
<?php
$sql = "SELECT COUNT(*) AS j FROM players";
$rs = mysqli_query($link, $sql);
$row = mysqli_fetch_object($rs);
echo $row->j;
$j = $row->j;
?>
	</td>
	<td align="left" width="50%" colspan="7"> &nbsp;
	</td>
</tr>
<?php
if($j > 0) {
?>
<tr>
	<td colspan="8">&nbsp;</td>
</tr>
<tr>
	<td class="a2" colspan="8" align="center">Liste des inscrits&nbsp;</td>
</tr>
<tr class="admin">
	<td align="center" class="a1">
	id
	</td>
	<td align="center" class="a1">
	cin
	</td>
	<td align="center" class="a1">
	nom
	</td>
	<td align="center" class="a1">
	prenom
	</td>
	<td align="center" class="a1">
	age
	</td>
	<td align="center" class="a1">
	gsm
	</td>
	<td align="center" class="a1">
	email
	</td>
	<td align="center" class="a1">
	date ajout
	</td>
</tr>
<?php
$sql = "SELECT * FROM players";
$rs = mysqli_query($link, $sql);
while($row = mysqli_fetch_object($rs)) {
?>
<tr class="admin">
	<td align="center">
	<?php echo $row->id; ?>
	</td>
	<td align="center">
	<?php echo $row->cin; ?>
	</td>
	<td align="center">
	<?php echo $row->nom; ?>
	</td>
	<td align="center">
	<?php echo $row->prenom; ?>
	</td>
	<td align="center">
	<?php echo $row->age; ?>
	</td>
	<td align="center">
	<?php echo $row->tel; ?>
	</td>
	<td align="center">
	<?php echo $row->email; ?>
	</td>
	<td align="center">
	<?php echo $row->createdat; ?>
	</td>
</tr>
<?php
}
}
?>
</table>
</body>
</html>