<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>foro Usuario</title>
<link rel="stylesheet" type="text/css" href="estilo.css" />

</head>

<body>

<?php
session_start();
if(!isset($_SESSION["Nombre"]) || $_SESSION["Tipo"] != "U")
	{ header("location:index.php?m=Su sesion ha caducado");}
?>

<div id="foro">
<br>Bienvenido al foro Usuario 

<?php

echo $_SESSION["Nombre"];

$mysqli = new MySqli('localhost','root','sql','foroabierto');
		
		if(isset($_POST['publicar']))
		{
			$mensaje=$_POST['mensaje'];
			$agrega=$mysqli->query("insert into foro values(null, '".$_SESSION["Nombre"]."', '".date('Y-m-d')."' , '".$mensaje."')");
			
			
		}	
		
		$sql ="select * from foro";
		
		$result = $mysqli->query($sql);
		
		
	
		


?>
</div>
<br>

<form name="form1" id="form1" method="post" enctype="multipart/form-data" action="foro_usuario.php" >

<table border="1" id="izquierda">
	<tr>
		<td width="100" align="center" style="vertical-align:top; background-color:#E0E6F8;" ><a href="cerrar_sesion.php"> Salir </a></td>
		<td width="1000">
			<table border="1">
				<?php while($registro=$result->fetch_array())
				{
					$nacionalidad=$mysqli->query("select nacionalidad,imagen from usuarios where usuario='".$registro[1]."'");
					$resultados=$nacionalidad->fetch_array();
					?>
					<tr>
						<td > <?php echo $registro[1]; ?> </br> <img src="imagenes/<?php echo $resultados[1];  ?>" width="150"></img> </br><?php echo $registro[2]; ?> </br> <?php echo $resultados[0];  ?>  </td> <td width="850" id="color" style="vertical-align:top; text-align:left; background-color:#E0E6F8;"> <?php echo $registro[3]; ?> </td> 
					</tr>
				<?php 
				} 
				?>
				<tr>
					<td colspan="2" style="background-color:#E0E6F8;"><textarea id="mensaje" name="mensaje" placeholder="ESCRIBE TU PUBLICACION..." rows="5" cols="150"></textarea>
					</td>
				</tr>
				<tr id="altura">
					<td colspan="2"><input type="submit" name="publicar" id="publicar" value="Publicar"></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
</body>
</html>