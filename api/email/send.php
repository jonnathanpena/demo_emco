<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get posted data
$data = json_decode(file_get_contents('php://input'), true);

$info = array($data);
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// the message
$msg = "<strong>Estimado Superusuario</strong><br/>";
$msg .= "El usuario <strong> ". $info[0]["usuario"] ." </strong> solicita de su aprobación por un monto de <strong>$". $info[0]["valor_solicitud"] ." </strong><br/>";
$msg .= "por motivos de  <strong> ". $info[0]["justificacion"] ." </strong> a la fecha ". $info[0]["fecha"] ."<br/>";
$msg .= "<a href='http://proconty.com/demo/SGI_Emco/'>Ver</a>";

$message = "
<html>
<body>
".$msg."
</body>
</html>
";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("info@proconty.com","Aprobación presupuesto ".$info[0]["transaccion"],$msg, $headers);
?>
