<h1><center>Papan Pengumuman Dosen Akakom<img src="logo.jpg" height="100" width="100"></center></h1>
<?php
//including the database connection file
include_once("config.php");

// select data in descending order from table/collection "users"
$result = $db->pengumuman->find()->sort(array('_id' => -1));
?>

<html>
<head>	
	<title>Homepage</title>
</head>

<body>
<a href="add.html">tambah pengumuman</a><br/><br/>

	<table width='80%' border=0>

	<tr bgcolor='#CCCCCC'>
		<td>mata kuliah</td>
		<td>jam</td>
		<td>pengumuman</td>
		<td>dosen</td>
		<td></td>
	</tr>
	<?php 	
	foreach ($result as $res) {
		echo "<tr>";
		echo "<td>".$res['makul']."</td>";
		echo "<td>".$res['jam']."</td>";
		echo "<td>".$res['pengumuman']."</td>";
		echo "<td>".$res['dosen']."</td>";	
		echo "<td><a href=\"edit.php?id=$res[_id]\">Edit</a> | <a href=\"delete.php?id=$res[_id]\" onClick=\"return confirm('yakin akan dihapus ?')\">Hapus</a></td>";		
	}
	?>
	</table>
</body>
</html>
