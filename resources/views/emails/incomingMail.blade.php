<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Correo de Ejemplo</title>
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
                                    <td style="color: #646464; font-family: 'Inter', sans-serif; font-size: 24px; text-align: center;">
                                        <b>¡Que emoción! TU pedido llegará pronto</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 20px 20px 30px 20px; color: #646464; font-family: 'Inter', sans-serif; font-size: 16px; line-height: 20px;">
                                        Hola, {{ $mailData['order']['name'] }}, tu pedido ha sido enviado a través de nuestro currier. Si no vas a estar, recuerda que alguien mayor de edad lo puede recibir, mostrando los datos de envio para verificiar la compra.
                                    </td>
                                </tr>
                                <tr>

                                  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin: auto;">
                                      <tr>
                                          <td style="padding: 20px 0; text-align: center;">
                                              <!-- Contenedor de la barra de progreso -->
                                              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                  <tr>
                                                      <!-- Primer círculo (resaltado) -->
                                                      <td style="width: 25%; text-align: center;" >
                                                          <div style="display: flex; text-align: center; margin-left:40%;">
                                                          <div style="display: inline-block; width: 30px; height: 30px; border-radius: 50%; background-color: #900D0D; color: white; line-height: 30px; font-family: 'Inter', sans-serif;">
                                                              1

                                                          </div>
                                                          <div style="background:#900D0D; width:63%; height:5px; margin-top:11px;"></div>
                                                          </div>
                                                          <div>
                                                          <div style="margin-top: 10px; color: #646464; font-family: 'Inter', sans-serif; font-size: 14px;">
                                                              Recibido

                                                          </div>

                                                          </div>
                                                      </td>
                                                      <td style="width: 25%; text-align: center;">
                                                          <div style="display: flex; text-align: center;">
                                                          <div style="background:#900D0D; width:40%; height:5px; margin-top:11px;"></div>
                                                          <div style="display: inline-block; width: 30px; height: 30px; border-radius: 50%; background-color: #900D0D; color: white; line-height: 30px; font-family: 'Inter', sans-serif;">
                                                              2
                                                          </div>
                                                          <div style="background:#900D0D; width:40%; height:5px; margin-top:11px;"></div>
                                                          </div>
                                                          <div style="margin-top: 10px; color: #646464; font-family: 'Inter', sans-serif; font-size: 14px;">
                                                              En proceso

                                                      </td>
                                                      <td style="width: 25%; text-align: center;">
                                                          <div style="display: flex; text-align: center;">
                                                              <div style="background:#900D0D; width:40%; height:5px; margin-top:11px;"></div>
                                                              <div style="display: inline-block; width: 30px; height: 30px; border-radius: 50%; background-color: #900D0D; color: white; line-height: 30px; font-family: 'Inter', sans-serif;">
                                                                  3
                                                              </div>
                                                              <div style="background:#dddddd; width:40%; height:5px; margin-top:11px;"></div>
                                                          </div>
                                                          <div style="margin-top: 10px; color: #900D0D; font-family: 'Inter', sans-serif; font-size: 14px;  font-weight: bolder;">
                                                              En camino
                                                          </div>
                                                      </td>
                                                      <td style="width: 25%; text-align: center;">
                                                          <div style="display: flex; text-align: center;">
                                                              <div style="background:#dddddd; width:40%; height:5px; margin-top:11px;"></div>
                                                              <div style="display: inline-block; width: 30px; height: 30px; border-radius: 50%; background-color: #dddddd; color: #646464; line-height: 30px; font-family: 'Inter', sans-serif;">
                                                                  4
                                                              </div>

                                                          </div>
                                                          <div style="margin-top: 10px; color: #646464; font-family: 'Inter', sans-serif; font-size: 14px;">
                                                              Entregado
                                                          </div>
                                                      </td>
                                                  </tr>
                                              </table>
                                          </td>
                                      </tr>
                                  </table>
                                  <div style="display:grid; padding: 20px 20px 0px 20px; font-family: 'Inter', sans-serif;">
                                    <div style="border-bottom: 1px solid #cccccc; padding-bottom:3px; margin-bottom:15px">
                                        <h6 style="margin: 0; font-size: 18px; font-weight: bold;">{{ $mailData['shipping']['name'] }}</h6>
                                    </div>
                                    @if ($mailData['deliveryOrders'])
                                        @if ($mailData['shipping']['price'] > 0)
                                            <div>{{ $mailData['deliveryOrders']['address'] }}, {{ $mailData['deliveryOrders']['reference'] }}</div>
                                            <div>{{ $mailData['deliveryOrders']['district'] }}, {{ $mailData['deliveryOrders']['city'] }} </div>
                                            <div>{{ $mailData['deliveryOrders']['state'] }}, {{ $mailData['deliveryOrders']['country'] }}.</div>
                                        @else
                                            <div>{!! $mailData['shipping']['title'] !!}</div>
                                        @endif
                                        <div><b>Recibido por:</b> {{ $mailData['deliveryOrders']['name'] }} {{ $mailData['deliveryOrders']['last_name'] }}</div>
                                    @else
                                        @if ($mailData['shipping']['price'] > 0)
                                        <div>{{ $mailData['order']['address'] }}, {{ $mailData['order']['reference'] }}</div>
                                        <div>{{ $mailData['order']['district'] }}, {{ $mailData['order']['city'] }} </div>
                                        <div>{{ $mailData['order']['state'] }}, {{ $mailData['order']['country'] }}.</div>
                                        @else
                                        <div>{{ $mailData['shipping']['description'] }}</div>
                                        @endif
                                        <div><b>Recibido por:</b> {{ $mailData['order']['name'] }} {{ $mailData['order']['last_name'] }}</div>

                                    @endif

                                  </div>
                                  <div style="display:grid; padding: 20px 20px 0px 20px;font-family: 'Inter', sans-serif;">
                                    <div style="border-bottom: 1px solid #cccccc; padding-bottom:3px; margin-bottom:15px">
                                        <h6 style="margin: 0; font-size: 18px; font-weight: bold;">Para la entrega</h6>
                                    </div>
                                    <div>
                                        <p style="margin:0;">Te pedimos tu nombre y número de DNI. Y al momento de la entrega sacaremos una foto de tu pedido.</p>
                                    </div>

                                  </div>
                                  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin: auto; font-family: 'Inter', sans-serif; color:#646464">
                                      <tr>
                                          <td style="padding: 20px;">
                                              <div style="display:flex; border-bottom: 1px solid #cccccc">
                                                  <p style="font-size: 18px; font-weight: bold; margin-bottom:5px">Detalles de su pedido:</p>
                                                  <p style="font-size: 18px; margin-bottom:5px; margin-left:auto;">Pedido N° 00{{ $mailData['order']->id }}</p>
                                              </div>
                                              <!-- Contenedor principal -->
                                              @foreach ($mailData['cartItems'] as $item)
                                              <div style="display: flex;">
                                                  <!-- Imagen del producto -->
                                                  <a href="" style="display: inline-block; width: 94px; height: 94px; margin:15px 15px 15px 0px;">
                                                    <img style="position: absolute;" src="{{ (asset('storage').'/'.$item->src ?? '') }}" alt="">
                                                    <img src="https://lodomens.com/storage/{{$item->productImage }}" alt="{{ $item->name }}" style="width: 94px; height: 94px; object-fit: cover; border: 2px solid {{ $item->hex }}; border-radius: 3px;">
                                                  </a>

                                                  <!-- Detalles del producto -->
                                                  <div style="display:flex; width:100%;">
                                                      <div style="margin: 15px 0px 0px 0px">
                                                          <h6 style="margin: 0; font-size: 18px; font-weight: bold;">{{ $item->name }}</h6>
                                                          <p style="margin: 15px 0 0; font-size: 14px;">Precio unidad: {{session('currency')}}{{ $item->sell_price }}</p>
                                                          <p style="margin: 5px 0 0; font-size: 14px;">Color:  {{ $item->color }}</p>
                                                          <p style="margin: 5px 0 0; font-size: 14px;">Marca:  {{ $item->brand }}</p>
                                                      </div>
                                                      <div style="margin-top: 15px; text-align:right; margin-left:auto;">
                                                          <p style="margin: 0px 0px 5px 0px; font-size: 16px; font-weight: bold;">{{session('currency')}} {{ $item->qtn*$item->sell_price }}</p>
                                                          <p style="margin: 38px 0 0; font-size: 14px;">Cantidad: {{ $item->qtn }}</p>
                                                          <p style="margin: 5px 0 0; font-size: 14px; white-space: nowrap;">SKU: {{ $item->sku }}</p>
                                                      </div>
                                                  </div>
                                              </div>
                                              @endforeach
                                          </td>

                                      </tr>
                                  </table>
                                  <div style="font-family: 'Inter', sans-serif; color:#646464; margin-bottom:30px; padding-left: 20px; padding-right:20px" >
                                      <div style="display:flex; border-top: 1px solid #cccccc;">
                                          <p style="margin-bottom: 0px; font-size:18px">Sub-Total</p>
                                          <p style="margin-bottom: 0px; font-size:18px; margin-left:auto;">{{session('currency')}}  {{ $mailData['order']['total'] }}</p>
                                      </div>
                                      <div style="display:flex;">
                                          <p style="margin: 5px 0px 0 0; font-size:18px">Envio - <span style="font-size:14px">{{ $mailData['shipping']['price'] == 0 ?   $mailData['shipping']['name'] : 'Envio a domicilio' }}</span></p>
                                          <p style="margin: 5px 0 0 0; font-size:18px; margin-left:auto;">{{session('currency')}}  {{ $mailData['shipping']['price'] }}</p>
                                      </div>
                                      <div style="display:flex; font-weight: bold;">
                                          <p style="margin: 15px 0 0 0; font-size:20px">Total:</p>
                                          <p style="margin: 15px 0 0 0; font-size:20px; margin-left:auto;">{{session('currency')}}  {{ number_format($mailData['shipping']['price']+$mailData['order']['total'],2) }}</p>
                                      </div>
                                    </div>
                                </tr>

                                <tr>
                                    <td>
                                        <!-- Botón de llamada a la acción -->
                                        <a href="https://lodomens.com/panel/compras?open={{ $mailData['order']->id }}" style="color: white; background-color: #900D0D; text-decoration: none; padding: 10px 20px; font-family: 'Inter', sans-serif; border-radius: 5px;display:flex; margin:auto; width:fit-content; margin-bottom: 30px;">Ir a mis compras</a>
                                    </td>
                                </tr>


                            </table>
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





</body>
</html>
