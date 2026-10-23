SISTEMA DE CERTIFICADOS PGE - VERSION 6

NOVEDADES:
- Campo correo en generación individual e importación Excel.
- Listado muestra si el archivo existe (GENERADO/PENDIENTE).
- Estado de correo: ENVIADO/NO ENVIADO.
- Envío individual desde el listado.
- Envío masivo de participantes seleccionados.
- Sin Composer ni vendor/autoload.php.

INSTALACIÓN EN UNA INSTALACIÓN NUEVA:
1. Copie la carpeta al directorio web, por ejemplo /var/www/html/certificados.
2. Ajuste usuario y contraseña MySQL en config.php.
3. Importe base_datos.sql.
4. Instale extensiones PHP requeridas: php-gd php-zip php-xml php-mbstring.
5. Ajuste CORREO_REMITENTE y NOMBRE_REMITENTE en correo_config.php.
6. Configure el servidor para que PHP mail() pueda enviar correos (MTA/relay SMTP). Pruebe primero con una dirección interna.

ACTUALIZAR UNA INSTALACION V5 EXISTENTE:
1. Haga copia de seguridad de la carpeta y la base de datos.
2. Ejecute SOLO UNA VEZ actualizar_bd_v6.sql contra la base certificados.
3. Copie los archivos nuevos/sustituidos conservando su config.php real, plantilla/certificado.jpg y fonts/DejaVuSans.ttf.
4. Ajuste correo_config.php.

EXCEL:
Encabezados: nombre, apellido, ci, correo, programa, fecha_emision.
La columna correo es opcional para importar, pero necesaria para enviar. Use XLSX.

IMPORTANTE SOBRE EL ENVIO:
El sistema marca ENVIADO cuando mail() devuelve éxito, es decir, el servidor local aceptó el mensaje; esto no garantiza que el destinatario lo haya recibido. Para producción configure un relay SMTP autorizado y SPF/DKIM/DMARC según el dominio institucional.

NOTA SOBRE QR:
La generación sigue utilizando el endpoint QR de la versión previa y TU-DOMINIO debe sustituirse por la URL pública real de verificar.php.
