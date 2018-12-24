<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>index</title>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<script src="js/validacion1a.js"></script>
</head>

<body id="b_index">
<h2 class="centro"> <?php if(isset($_GET["m"])){ echo $_GET["m"]; }?> </h2>
<form name="form1" id="form1" method="post" enctype="multipart/form-data" action="valida_login.php" >
<h1>
<table align="center" id="index">
<tr>
<div>
  <td><label class="label" for="txtNombre"> Nombre </label></td>
  <td><input type="text" name="txtNombre" id="txtNombre" /></td>
</div>
</tr>
<tr>
<div>
  <td><label class="label" for="txtpass"> Clave</label></td>
  <td><input type="password" name="txtpass" id="txtpass" /></td>
</div>
</tr>
<tr>
<td colspan="2">
<div class="centro">
  <input type="submit" name="btnEnviar" id="btnEnviar" value="Enviar" />
  <input type="reset" name="btnLimpiar" id="btnLimpiar" value="Limpiar" />
</div>

<div id="pallao">
	<a href="registro.php"><input type="button" id="publicar" value="Registrate!" /></a>
</div>
</td>
</tr>
</table>
</h1>
</form>
</body>
</html>