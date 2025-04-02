<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmación de reclamaciones</title>
</head>
<body style="margin: 0; padding: 0;">
    <!-- Contenedor principal -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 10px 0 30px 0;">
                <!-- Contenedor del contenido -->
                <table border="0" cellpadding="0" cellspacing="0" width="600" style="display: flex; margin: auto;border: 1px solid #cccccc; border-collapse: collapse;">
                    <tr>
                        <td align="center" style="padding:0">
                            <!-- Logo o imagen de encabezado -->
                            <img src="https://lodomens.com/image/lodomens/Banner_para_correos.png" alt="Lodomens" width="95%" style="display: block; margin: 12px" />
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 20px 40px 20px 40px;">
                            <!-- Contenido del correo -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #646464; font-family: 'Inter', sans-serif; font-size: 24px;">
                                        <b>¡Hola! {{ $mailData['name'] }} se notifico su reclamado</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 20px 0 30px 0; color: #646464; font-family: 'Inter', sans-serif; font-size: 16px; line-height: 20px;">
                                        Hemos recibido su mensaje con éxito, en la brevedad posible estaremos procesandolo. Le estaremos enviando en los proximos días los detalles del proceso, muchas gracias.
                                    </td>
                                </tr>
                                <tr>
                                  <td bgcolor="#404040" style="padding: 10px">
                                      <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                          <tr>
                                              <td style="color: #ffffff; font-family: 'Inter', sans-serif; font-size: 14px; text-align:center;" width="100%">
                                                  &copy; {{ date('Y') }} <a href="#" style="color: #ffffff;">Nubesita Estudio.</a> Todos los derechos reservados.<br/>

                                              </td>

                                          </tr>
                                      </table>
                                  </td>
                              </tr>

                            </table>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>





</body>
</html>
