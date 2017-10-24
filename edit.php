<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	$pengumuman = array (
				'makul' => $_POST['makul'],
				'jam' => $_POST['jam'],
				'pengumuman' => $_POST['pengumuman'],
				'dosen' => $_POST['dosen']
			);
	
	// checking empty fields
	$errorMessage = '';
	foreach ($pengumuman as $key => $value) {
		if (empty($value)) {
			$errorMessage .= $key . ' field is empty<br />';
		}
	}
			
	if ($errorMessage) {
		// print error message & link to the previous page
		echo '<span style="color:red">'.$errorMessage.'</span>';
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";	
	} else {
		//updating the 'users' table/collection
		$db->users->update(
						array('_id' => new MongoId($id)),
						array('$set' => $pengumuman)
					);
		
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
} // end if $_POST
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = $db->pengumuman->findOne(array('_id' => new MongoId($id)));

$makul = $result['makul'];
$jam = $result['jam'];
$pengumuman = $result['pengumuman'];
$dosen = $result['dosen'];
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>mata kuliah</td>
				<td><input type="text" name="makul" value="<?php echo $makul;?>"></td>
			</tr>
			<tr> 
				<td>jam</td>
				<td><input type="text" name="jam" value="<?php echo $jam;?>"></td>
			</tr>
			<tr> 
				<td>pengumuman</td>
				<td><input type="text" name="pengumuman" value="<?php echo $pengumuman;?>"></td>
			</tr>
			<tr> 
				<td>dosen</td>
				<td><input type="text" name="dosen" value="<?php echo $dosen;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
