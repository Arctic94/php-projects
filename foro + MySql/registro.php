<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<title> USUARIOS </title>
		<link rel="stylesheet" href="estilo.css" />
	</head>
	<?php
	$mysqli = new MySqli('localhost','root','sql','foroabierto');
	////AGREGAR////
	if(isset($_POST['grabar']))
	{
		$usuario=$_POST['txtusu'];
		$clave=$_POST['txtclave'];
		$nombre=$_POST['txtnom'];
		$apellido=$_POST['txtape'];
		$imagen=$_FILES['imagen']['name'];
		$nacionalidad=$_POST['txtnac'];
		//$tipo_usu=$_POST['cbotipo'];
		
		$sql ="insert into usuarios values ('$usuario','$clave','$nombre','$apellido','$imagen', '$nacionalidad', '0')";
		$agregar = $mysqli->query($sql);
		if($agregar)
		{
			move_uploaded_file($_FILES['imagen']['tmp_name'],"imagenes/".$imagen);
		}
		header("location:index.php?m=Usuario creado");
	}	
?>

	<body id="a">
		<form name="form1" id="form1" method="post" action="registro.php" enctype="multipart/form-data">
			<table id="a" align="center">
				<tr>
					
					<td>
						<table id="mantencion_usuarios">
							<tr align="center">
								<td>
								</h1>
									<b>Registro</b>
									</h1>
								</td>
							</tr>
							<tr>
								<td><label for="txtusu">Usuario:</label></td>
								<td colspan="2"><input type="text" name="txtusu" id="txtusu"/></td>
							</tr>
							<tr>
								<td><label for="txtclave">Clave:</label></td>
								<td colspan="2"><input type="text" name="txtclave" id="txtclave"/></td>
							</tr>
							<tr>
								<td><label for="txtnom">Nombre:</label></td>
								<td colspan="2"><input type="text" name="txtnom" id="txtnom"/></td>
							</tr>
							<tr>
								<td><label for="txtape">Apellido:</label></td>
								<td colspan="2"><input type="text" name="txtape" id="txtape"/></td>
							</tr>
							<tr>
								<td><label for="imagen">Imagen:</label></td>
								<td><input type="file" name="imagen" id="imagen" /></td>
							</tr>
							<tr>
								<td><label for="txtnac">Nacionalidad:</label></td>
								<td colspan="2"><input type="text" name="txtnac" id="txtnac"/></td>
							</tr>
							
							<tr>
								<td colspan="3" align="center">
									<input type="submit" name="grabar" value="Crear cuenta"/>
								</td>
							</tr>
						</table>
						
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>