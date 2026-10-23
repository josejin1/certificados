<?php
require_once __DIR__."/correo_config.php";
function enviarCertificado($c, $ruta) {
 if (empty($c['correo']) || !filter_var($c['correo'], FILTER_VALIDATE_EMAIL)) return [false, 'Correo vacío o no válido'];
 if (!is_file($ruta)) return [false, 'El archivo del certificado no existe'];
 $to=$c['correo']; $subject='Certificado de aprobación - Procuraduría General del Estado';
 $nombre=mb_strtoupper(trim($c['nombre'].' '.$c['apellido']), 'UTF-8');
 $programa=$c['programa'];
 $body="Estimado/a {$nombre}:\r\n\r\nLa Procuraduría General del Estado le hace llegar adjunto su certificado correspondiente al programa {$programa}.\r\n\r\nPuede verificar su autenticidad mediante el código QR incluido en el certificado.\r\n\r\nSaludos cordiales,\r\n".NOMBRE_REMITENTE;
 $boundary='=_PGE_'.md5(uniqid((string)mt_rand(), true));
 $headers="From: ".NOMBRE_REMITENTE." <".CORREO_REMITENTE.">\r\n";
 $headers.="MIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"{$boundary}\"";
 $message="--{$boundary}\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\r\n\r\n{$body}\r\n";
 $filename=basename($ruta); $data=chunk_split(base64_encode(file_get_contents($ruta)));
 $message.="--{$boundary}\r\nContent-Type: image/jpeg; name=\"{$filename}\"\r\nContent-Transfer-Encoding: base64\r\nContent-Disposition: attachment; filename=\"{$filename}\"\r\n\r\n{$data}\r\n--{$boundary}--";
 $ok=@mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $headers);
 return $ok ? [true, 'Correo aceptado por el servidor local'] : [false, 'Falló mail(). Revise la configuración de correo del servidor.'];
}
?>