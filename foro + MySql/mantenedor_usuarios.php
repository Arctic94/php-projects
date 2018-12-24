<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<title> usuarios </title>
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
		$tipo_usu=$_POST['cbotipo'];
		
		$sql ="insert into usuarios values ('$usuario','$clave','$nombre','$apellido','$imagen', '$nacionalidad', '$tipo_usu')";
		$agregar = $mysqli->query($sql);
		if($agregar)
		{
			move_uploaded_file($_FILES['imagen']['tmp_name'],"imagenes/".$imagen);
		}
	}
	////ELIMINAR////
	if(isset($_GET['usuario']))
	{
		$usuario = $_GET['usuario'];
		$sql = "delete from usuarios where usuario = '$usuario'";
	
	$eliminar = $mysqli->query($sql);
	}
	////MODIFICAR////
	if(isset($_POST['modificar']))
	{
		$usuario=$_POST['td_usuario'];
		$clave=$_POST['td_clave'];
		$nombre=$_POST['td_nombre'];
		$apellido=$_POST['td_apellido'];
		$imagen=$_FILES['archivo']['name'];
		$nacionalidad=$_POST['td_nacionalidad'];
		$tipo_usu=$_POST['td_administrador'];
		$sql ="update usuarios set clave='$clave',nombre='$nombre',apellido='$apellido',imagen='$imagen',nacionalidad='$nacionalidad',administrador='$tipo_usu' where usuario='$usuario'";
		$modificar = $mysqli->query($sql);
		if($modificar)
		{
			move_uploaded_file($_FILES['archivo']['tmp_name'],"imagenes/".$imagen);
		}
	}
?>
	<body>
	<?php if(isset($_GET["m"])){ echo $_GET["m"]; }?>
		<form name="form1" id="form1" method="post" action="mantenedor_usuarios.php" enctype="multipart/form-data">
			<table border="1" >
				<tr>
					<td style="vertical-align:top; background-color:#E0E6F8;"" align="center" width="100">
			
						<a href="mantenedor_usuarios.php" > Usuarios </a></br></br>
						<?php
						session_start();
						if(isset($_SESSION["Nombre"]) || $_SESSION["Tipo"] != "A")
							{ 
								$pagina = "foro_admin.php";
								
							}
						?>
						<a href="<?php echo $pagina; ?>" > Foro </a></br></br>
						<a href="cerrar_sesion.php"> Salir </a>
		
					</td>
					<td>
						<table id="mantencion_usuarios" align="center">
							<tr>
								<td colspan="2" align="center" style="background-color:#E0E6F8;" >
									MANTENCION USUARIOS
								</td>
							</tr>
							<tr>
								<td><label for="txtusu">Usuario:</label></td>
								<td colspan="2"><input type="text" name="txtusu" size="20" id="txtusu"/></td>
							</tr>
							<tr>
								<td><label for="txtclave">Clave:</label></td>
								<td colspan="2"><input type="text" name="txtclave" size="20" id="txtclave"/></td>
							</tr>
							<tr>
								<td><label for="txtnom">Nombre:</label></td>
								<td colspan="2"><input type="text" name="txtnom" size="20" id="txtnom"/></td>
							</tr>
							<tr>
								<td><label for="txtape">Apellido:</label></td>
								<td colspan="2"><input type="text" name="txtape" size="20" id="txtape"/></td>
							</tr>
							<tr>
								<td><label for="imagen">Imagen:</label></td>
								<td><input type="file" name="imagen" id="imagen" /></td>
							</tr>
							<tr>
								<td><label for="txtnac">Nacionalidad:</label></td>
								<td colspan="2"><input type="text" name="txtnac" size="20" id="txtnac"/></td>
							</tr>
							<tr>
								<td><label for="cbotipo">Tipo usuario:</label></td>
								<td colspan="2"><select name="cbotipo" id="cbotipo">
									<option value="0">Usuario</option>
									<option value="1">Administrador</option>
									</select></td>
							</tr>
							<tr>
								<td colspan="3" align="center">
									<input type="submit" name="grabar" value="CREAR USUARIO"/>
								</td>
							</tr>
						</table>
						</br>
						<table id="lista" border="1" >
							<tr align="center">
								<td>Usuario</td>
								<td>Clave</td>
								<td>Nombre</td>
								<td>Apellido</td>
								<td>Imagen</td>
								<td>Nacionalidad</td>
								<td>Administrador</td>
								<td><b>ELIMINAR</b></td>
								<td><b>MODIFICAR</b></td>
							</tr>
							<?php
								$sql="select * from usuarios";
								$result = $mysqli->query($sql);
								
								while($registro=$result->fetch_assoc()) 
								{
							?>
							<tr>
							  <td><label><?php echo $registro['usuario'];?></label></td> 
							  <td><input type="text" disabled size="15" id="td_clave" name="td_clave" value="<?php echo $registro['clave'];?>"/></td> 
							  <td><input type="text" disabled size="15" id="td_nombre" name="td_nombre" value="<?php echo $registro['nombre'];?>"/></td> 
							  <td><input type="text" disabled size="15" id="td_apellido" name="td_apellido" value="<?php echo $registro['apellido'];?>"/></td> 
							  <td align="center"><img src="imagenes/<?php echo $registro['imagen']; ?>" width="170"></img>
							  
							  <td><input type="text" disabled size="15" id="td_nacionalidad" name="td_nacionalidad" value="<?php echo $registro['nacionalidad'];?>"/></td> 
							  <td><select disabled name="td_administrador" id="td_administrador">
							  <?php
								if($registro['administrador']=='0')
								{
							  ?>
									<option value="0" >Administrador</option>
									<option value="1" selected>Usuario</option>
									</select>
							  <?php
								}
								else
								{
								?>
									<option value="0" selected>Administrador</option>
									<option value="1" >Usuario</option>
									</select>
							  <?php
								}
							  ?>
							  </td>
							  <td align="center">
								<a href="mantenedor_usuarios.php?usuario=<?php echo $registro['usuario'];?>"><input type="button" value="Eliminar" /></a>
							  </td>
							  <td align="center">
								<a href="modificar_usuarios.php?usuario=<?php echo $registro['usuario'];?>"><input type="button" value="Modificar" /></a>
								
							  </td>
							</tr>  
							  <?php
								}
							?>
						</table>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>