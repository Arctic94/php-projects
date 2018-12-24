<?php
	$mysqli = new MySqli('localhost','root','sql','foroabierto');
	if(isset($_POST['btnEnviar']))
	{
		$usuario=$_POST['txtNombre'];
		$password=$_POST['txtpass'];
		
		
		$sql ="select * from usuarios where usuario='".$usuario."'";
		
		$result = $mysqli->query($sql);
		$registro=$result->fetch_array();
		
		if( $usuario == $registro[0] && $password == $registro[1] && $registro[6]==0)
	{ 	session_start();
		$_SESSION["Tipo"]="U";
		$_SESSION["Nombre"]=$registro[0];
		header("location:foro_usuario.php"); 
	}
elseif(  $usuario == $registro[0] && $password == $registro[1] && $registro[6]==1 )
	{   session_start();
		$_SESSION["Tipo"]="A";
		$_SESSION["Nombre"]=$registro[0];
		header("location:foro_admin.php"); 
	}
else
	{ 
		header("location:index.php?m=Usuario no valido");
	}
		
		
	}
	
	
?>

