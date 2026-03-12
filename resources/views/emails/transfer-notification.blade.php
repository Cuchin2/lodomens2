<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transferencia de Productos</title>
</head>

<body style="margin: 0; padding: 0;">
    <!-- Contenedor principal -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 10px 0 30px 0;">
                <!-- Contenedor del contenido -->
                <table border="0" cellpadding="0" cellspacing="0" width="600"
                    style="display: flex; margin: auto; border: 1px solid #cccccc; border-collapse: collapse;">
                    <tr>
                        <td align="center" style="padding:0">
                            <!-- Logo o imagen de encabezado -->
                            <img src="https://lodomens.com/image/lodomens/Banner_para_correos.png" alt="Lodomens"
                                width="95%" style="display: block; margin: 12px" />
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 20px 40px 20px 40px;">
                            <!-- Contenido del correo -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td
                                        style="color: #646464; font-family: 'Inter', sans-serif; font-size: 24px; text-align: center;">
                                        <b>Notificación de Transferencia de Productos</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 20px 20px 30px 20px; color: #646464; font-family: 'Inter', sans-serif; font-size: 16px; line-height: 20px;">
                                        Se ha realizado una transferencia de productos a la tienda
                                        <strong>{{ $transfer->store->name ?? 'N/A' }}</strong>.
                                    </td>
                                </tr>

                                <!-- Detalles de la transferencia -->
                                <tr>
                                    <td>
                                        <div style="padding: 0 20px; font-family: 'Inter', sans-serif;">
                                            <div
                                                style="border-bottom: 1px solid #cccccc; padding-bottom:3px; margin-bottom:15px">
                                                <h6 style="margin: 0; font-size: 18px; font-weight: bold;">Detalles de
                                                    la transferencia</h6>
                                            </div>
                                            <p style="margin:5px 0"><strong>ID Transferencia:</strong> #{{ $transfer->id
                                                }}</p>
                                            <p style="margin:5px 0"><strong>Usuario que realizó:</strong> {{
                                                $transfer->user->name ?? auth()->user()->name }}</p>
                                            <p style="margin:5px 0"><strong>Observaciones:</strong> {{
                                                $transfer->observations ?? 'Sin observaciones' }}</p>
                                            <p style="margin:5px 0"><strong>Fecha:</strong> {{
                                                $transfer->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Productos transferidos -->
                                <tr>
                                    <td>
                                        <div style="padding: 20px 20px 0 20px; font-family: 'Inter', sans-serif;">
                                            <div
                                                style="border-bottom: 1px solid #cccccc; padding-bottom:3px; margin-bottom:15px">
                                                <h6 style="margin: 0; font-size: 18px; font-weight: bold;">Productos
                                                    transferidos</h6>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                @foreach($transfer->details as $detail)
                                <tr>
                                    <td>
                                        <div
                                            style="display: flex; padding: 0 20px; font-family: 'Inter', sans-serif; color:#646464">
                                            <div
                                                style="display: flex; width:100%; margin-bottom: 15px; border-bottom: 1px solid #f0f0f0; padding-bottom: 10px;">
                                                <!-- Imagen del producto -->
                                                <div style="margin-right: 15px;">
                                                    <img src="https://lodomens.com/storage/{{ $detail->productImage }}"
                                                        alt="{{ $detail->name }}"
                                                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 3px;">
                                                </div>
                                                <!-- Detalles -->
                                                <div style="flex: 1;">
                                                    <h6 style="margin: 0; font-size: 16px; font-weight: bold;">{{
                                                        $detail->name }}</h6>
                                                    <p style="margin: 5px 0; font-size: 14px;">SKU: {{ $detail->sku }}
                                                    </p>
                                                    <p style="margin: 5px 0; font-size: 14px;">Marca: {{ $detail->brand
                                                        }}</p>
                                                    <p style="margin: 5px 0; font-size: 14px;">Color: {{ $detail->color
                                                        }}</p>
                                                </div>
                                                <!-- Cantidad y precio -->
                                                <div style="text-align: right;">
                                                    <p style="margin: 0; font-size: 16px; font-weight: bold;">{{
                                                        $detail->qtn }} unidades</p>
                                                    <p style="margin: 5px 0; font-size: 14px;">Precio: S/ {{
                                                        number_format($detail->sell_price, 2) }}</p>
                                                    <p style="margin: 5px 0; font-size: 14px;">Total: S/ {{
                                                        number_format($detail->qtn * $detail->sell_price, 2) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                                <!-- Total de unidades -->
                                <tr>
                                    <td>
                                        <div style="padding: 20px; font-family: 'Inter', sans-serif;">
                                            <div
                                                style="display: flex; border-top: 2px solid #900D0D; padding-top: 10px;">
                                                <p style="font-size: 18px; font-weight: bold; margin: 0;">Total
                                                    productos transferidos:</p>
                                                <p style="font-size: 18px; font-weight: bold; margin: 0 0 0 auto;">
                                                    {{ $transfer->details->sum('qtn') }} unidades
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Botón de acción -->
                                <tr>
                                    <td align="center" style="padding: 20px;">
                                        <a href="https://lodomens.com/admin/transfer/{{ $transfer->id }}"
                                            style="color: white; background-color: #900D0D; text-decoration: none; padding: 10px 20px; font-family: 'Inter', sans-serif; border-radius: 5px; display: inline-block;">
                                            Ver transferencia
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#404040" style="padding: 10px">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #ffffff; font-family: 'Inter', sans-serif; font-size: 14px; text-align:center;"
                                        width="100%">
                                        &copy; {{ date('Y') }} <a href="#" style="color: #ffffff;">Lodomens</a>. Todos
                                        los derechos reservados.<br />
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
