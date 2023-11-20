<?php
include("session.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluye las clases de PHPMailer
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mensaje = "El resumen de su compra";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        // Obtiene la información del carrito
        $productos = $_SESSION['carrito'];
        $total = 0;

        // Obtén la cantidad de productos del carrito
        $cantidadProductos = 0;
        foreach ($productos as $producto) {
            if (isset($producto['cantidad'])) {
                $cantidadProductos += $producto['cantidad'];
            }
        }

        // Construye un mensaje con los detalles de la compra, incluyendo la cantidad de productos
        $mensaje = "Detalle de la compra:\n\n";
        $mensaje .= "<ul>"; // Inicia la lista no ordenada
        foreach ($productos as $producto) {
            $nombre = $producto['nombre'];
            $precio = $producto['precio'] * $cantidadProductos;

            // Agrega la información del producto al mensaje
            $mensaje .= "<li>Producto: $nombre</li>";
            $mensaje .= "<li>Cantidad: $cantidadProductos</li>";
            $mensaje .= "<li>Precio Total: $precio</li><br>";

            $total += $precio;
        }
        $mensaje .= "</ul>"; // Cierra la lista no ordenada
        $mensaje .= "Total: $" . $total; // Agrega el total al mensaje

        require_once 'Library/tcpdf.php';

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Brayan Rodriguez');
        $pdf->SetTitle('Resumen de compra: ');


        // set default header data
        $pdf->SetHeaderData(
            PDF_HEADER_LOGO,
            PDF_HEADER_LOGO_WIDTH,
            PDF_HEADER_TITLE . '',
            PDF_HEADER_STRING,
            array(0, 64, 255),
            array(0, 64, 128)
        );
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // Set default font subsetting mod
        $pdf->setFontSubsetting(true);

        // Set font
        $pdf->SetFont('dejavusans', '', 14, '', true);

        // Add a page
        $pdf->AddPage();

        // Set some content to print
        $html = <<<EOD
        <h1 style="text-align: center; margin-top: 50px;">Gracias por comprar en <a href=""
        style="text-decoration:none;background-color:#BDE0DC;color:white;">&nbsp;
        <span style="color:black;">Kiddo</span><span style="color:white;">Sound</span>&nbsp;</a>!</h1>
        <i style="text-align: center; display: block; margin-bottom: 20px;">Resumen de su compra.</i>
        
        <p>$mensaje</p>

        EOD;

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // Add image and text in the header

        $pdf->SetXY(25, 10);
        $pdf->Write(0, 'kiddoSound', '', 0, 'C', true, 0, false, false, 0);

        $pdf->Output($_SERVER['DOCUMENT_ROOT'] . '/Proyecto/Resumen.pdf', 'F');

        if (isset($_POST['correo_destino']) && !empty($_POST['correo_destino'])) {
            try {
                $mail = new PHPMailer(true);

                // Configuración del servidor SMTP (Gmail en este caso)
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'brayitanrodri4@gmail.com';
                $mail->Password = 'lulrvasrntqfepfk';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Configura el remitente y el destinatario
                $correo_destino = filter_var($_POST['correo_destino'], FILTER_SANITIZE_EMAIL);
                $mail->setFrom('brayitanrodri4@gmail.com', 'KiddoSound'); // Remitente
                $mail->addAddress($correo_destino); // Destinatario


                $mail->Subject = 'Recibo de compra';
                $mail->isHTML(false);
                $mail->Body = 'Le adjuntamos el PDF de su compra, gracias por comprar en KiddoSound 😎😎';

                $mail->addAttachment($_SERVER['DOCUMENT_ROOT'] . '/Proyecto/Resumen.pdf');


                $mail->send();


                echo '<p class="alert-success">Pago exitoso. El correo con los detalles de la compra y el PDF se ha enviado a ' . $correo_destino . '.</p>';
            } catch (Exception $e) {
                echo '<p class="alert-error">Error al enviar el correo: ' . $mail->ErrorInfo . '</p>';
            }
        } else {
            echo '<p class="alert-error">El campo de correo electrónico no está definido. Asegúrate de proporcionar una dirección de correo electrónico.</p>';
        }
    } else {
        $mensaje = "El carrito está vacío. No se pudo procesar el pago.";
    }    

       
   
}
?>
<link rel="stylesheet" href="correo.css">
<form action="" method="post">
    <label for="correo_destino">Dirección de Correo:</label>
    <input type="email" id="correo_destino" name="correo_destino" required>
    <br>
    <input type="submit" value="Enviar Correo">
</form>
<p>
    <?php echo $mensaje; ?>
</p>
