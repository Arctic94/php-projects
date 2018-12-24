<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<title> MODIFICAR USUARIO </title>
		<link rel="stylesheet" href="estilo.css" />
	</head>
	<?php
	$mysqli = new MySqli('localhost','root','sql','foroabierto');
	////MODIFICAR////
	if(isset($_POST['modificar']))
	{
		$usuario=$_POST['us'];
		$clave=$_POST['txtclave'];
		$nombre=$_POST['txnom'];
		$apellido=$_POST['txtape'];
		$imagen=$_FILES['imagen']['name'];
		$nacionalidad=$_POST['txtnac'];
		$tipo_usu=$_POST['cbotipo'];
		$sql ="update usuarios set clave='$clave',nombre='$nombre',apellido='$apellido', imagen='$imagen',nacionalidad='$nacionalidad',administrador='$tipo_usu' where usuario='$usuario'";
		$modificar = $mysqli->query($sql);
		if($modificar)
		{
			move_uploaded_file($_FILES['imagen']['tmp_name'],"imagenes/".$imagen);
			header("location:mantenedor_usuarios.php?m=Usuario modificado con exito");
		}
	}
?>
	<body>
		<form name="form2" id="form2" method="post" action="modificar_usuarios.php" enctype="multipart/form-data">
			<table id="modificar_usuario" align="center">
				<?php
					////BUSCAR////
					if(isset($_GET['usuario']))
					{
						$usuario = $_GET['usuario'];
						$sql = "select * from usuarios where usuario = '$usuario'";
					
						$buscar = $mysqli->query($sql);
						$registro_usuario=$buscar->fetch_assoc();
					}
				?>
				<tr>
					<td colspan="2" align="center" style="background-color:#E0E6F8;" >
						MODIFICAR USUARIO
					</td>
				</tr>
				<tr>
					<td><label for="txtusu">Usuario:</label></td><input type="hidden" id="us" name="us" value="<?php echo $registro_usuario['usuario'];?>">
					<td colspan="2"><label name="lblusuario" id="lblusuario" ><?php echo $registro_usuario['usuario'];?></label></td>
				</tr>
				<tr>
					<td><label for="txtclave">Clave:</label></td>
					<td colspan="2"><input type="text" name="txtclave" id="txtclave" value="<?php echo $registro_usuario['clave'];?>"/></td>
				</tr>
				<tr>
					<td><label for="txtnom">Nombre:</label></td>
					<td colspan="2"><input type="text" name="txtnom" id="txtnom" value="<?php echo $registro_usuario['nombre'];?>"/></td>
				</tr>
				<tr>
					<td><label for="txtape">Apellido:</label></td>
					<td colspan="2"><input type="text" name="txtape" id="txtape" value="<?php echo $registro_usuario['apellido'];?>"/></td>
				</tr>
				<tr>
					<td><label for="imagen">Imagen:</label></td>
					<td><input type="file" name="imagen" id="imagen" /></td>
				</tr>
				<tr>
					<td><label for="txtnac">Nacionalidad:</label></td>
					<td colspan="2"><input type="text" name="txtnac" id="txtnac" value="<?php echo $registro_usuario['nacionalidad'];?>"/></td>
				</tr>
				<tr>
					<td><label for="cbotipo">Tipo usuario:</label></td>
					<td colspan="2"><select name="cbotipo" id="cbotipo">
						<?php
								if($registro_usuario['administrador']=='0')
								{
							  ?>
									<option value="0" selected>Administrador</option>
									<option value="1">Usuario</option>
									</select>
							  <?php
								}
								else
								{
								?>
									<option value="0">Administrador</option>
									<option value="1" selected>Usuario</option>
									</select>
							  <?php
								}
							  ?>
							  </td>
				</tr>
				</b>
				<tr>
				<td>
				&nbsp;
				</td>
				</tr>
				<tr align="center">
					<td align="center">
						<input type="submit" name="modificar" value="Modificar"/>
					</td>
					<td align="center">
					<a href="mantenedor_usuarios.php"><input type="button" value="Volver" /></a>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>