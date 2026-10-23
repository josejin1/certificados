<?php
require "config.php";
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $nombre=trim($_POST["nombre"]??""); $apellido=trim($_POST["apellido"]??""); $ci=trim($_POST["ci"]??"");
 $correo=trim($_POST["correo"]??""); $programa=trim($_POST["programa"]??""); $fecha=$_POST["fecha_emision"]??date("Y-m-d");
 if(!$nombre||!$apellido||!$programa) die("Complete los campos obligatorios.");
 if($correo && !filter_var($correo,FILTER_VALIDATE_EMAIL)) die("El correo electrónico no es válido.");
 $codigo="PGE-".date("Y")."-".strtoupper(bin2hex(random_bytes(4)));
 $s=$conexion->prepare("INSERT INTO certificados(nombre,apellido,ci,correo,programa,fecha_emision,codigo) VALUES(?,?,?,?,?,?,?)");
 $s->bind_param("sssssss",$nombre,$apellido,$ci,$correo,$programa,$fecha,$codigo);$s->execute();header("Location: generar.php?id=".$s->insert_id);exit;
}
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Certificado individual</title><style>body{font-family:Arial;background:#eee;padding:30px}.box{max-width:600px;margin:auto;background:#fff;padding:30px;border-radius:12px}label{display:block;font-weight:bold;margin-top:14px}input{width:100%;box-sizing:border-box;padding:11px;margin-top:5px}button,a{display:inline-block;margin-top:20px;padding:12px 18px;background:#9b741c;color:#fff;border:0;border-radius:6px;text-decoration:none}</style></head><body><div class="box"><a href="index.php">← Menú</a><h2>Generar certificado individual</h2><form method="post"><label>Nombre *</label><input name="nombre" required><label>Apellido *</label><input name="apellido" required><label>C.I.</label><input name="ci"><label>Correo electrónico</label><input type="email" name="correo" placeholder="participante@correo.com"><label>Programa *</label><input name="programa" value="GESTIÓN PÚBLICA Y DEFENSA LEGAL DEL ESTADO" required><label>Fecha de emisión</label><input type="date" name="fecha_emision" value="<?=date('Y-m-d')?>" required><button>GENERAR CERTIFICADO</button></form><p>Después de generar el archivo podrá enviarlo desde el listado.</p></div></body></html>