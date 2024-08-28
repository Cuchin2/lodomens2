{{--  <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div>
    <div style="display: flex;">
    <img height="100px" width="100px" src="https://lodomens.com/image/lodomens/Favicon_LodoMens.ico"
    style="margin:auto;"
    </div>
    </div>
    <!-- Barra de progreso -->
    <div style="width: 85%; height: 120px; background-color: #b07d7d; border-radius: 10px; display: flex; justify-content: center;">
        <div style="position: relative; width: 88%; display: flex;">
          <ul style="width: 100%; list-style: none; counter-reset: step; display: flex; justify-content: space-between; padding-inline-start: 0px;">
            <li style="position: relative; width: 20px; height: 20px; border-radius: 4px; background-color: #c99; cursor: pointer; z-index: 2; display: flex; justify-content: center;">
              <span style="position: absolute; top: 130%; color: #fff; font-size: 0.875rem; white-space: nowrap;">Pagado</span>
              <span style="font-size: 0.875rem; color: #633;">1</span>
            </li>
            <li style="position: relative; width: 20px; height: 20px; border-radius: 4px; background-color: #c99; cursor: pointer; z-index: 2; display: flex; justify-content: center;">
              <span style="position: absolute; top: 130%; color: #fff; font-size: 0.875rem; white-space: nowrap;">En proceso</span>
              <span style="font-size: 0.875rem; color: #633;">2</span>
            </li>
            <li style="position: relative; width: 20px; height: 20px; border-radius: 4px; background-color: #c99; cursor: pointer; z-index: 2; display: flex; justify-content: center;">
              <span style="position: absolute; top: 130%; color: #fff; font-size: 0.875rem; white-space: nowrap;">En camino</span>
              <span style="font-size: 0.875rem; color: #633;">3</span>
            </li>
            <li style="position: relative; width: 20px; height: 20px; border-radius: 4px; background-color: #c99; cursor: pointer; z-index: 2; display: flex; justify-content: center;">
              <span style="position: absolute; top: 130%; color: #fff; font-size: 0.875rem; white-space: nowrap;">Entregado</span>
              <span style="font-size: 0.875rem; color: #633;">4</span>
            </li>
          </ul>
          <div style="position: absolute; width: 99%; height: 3px; overflow-x: hidden; background-color: #fdd;">
            <div style="position: absolute; height: 3px; background-color: #fbb;"></div>
          </div>
        </div>
      </div>

    <!-- Información adicional -->
    <div style="color: #a4a4a4;">
        <p>{{ $mailData['email'] }}</p>
        <p>{{ $mailData['name'] }}</p>
        <p>Número de orden: {{ $mailData['order'] }}</p>
        <p>{{ $mailData['subject'] }}</p>

    </div>


    @foreach ($mailData['cartItems'] as $item)
        <p>Nombre: {{ $item->name }}</p>
        <p>SKU: {{ $item->sku }}</p>
        <img height="100px" width="100px" src="https://lodomens.com/storage/{{$item->productImage }}" alt="">
        <p>Marca: {{ $item->brand }}</p>
        <p>Cantidad: {{ $item->qtn }}</p>
        <p>Precio: {{ $item->sell_price }}</p>
        <p>Color: {{ $item->color }}</p>
    @endforeach
</body>
</html>
  --}}

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
                          <td align="center" bgcolor="#404040" style="padding: 40px 0 30px 0;">
                              <!-- Logo o imagen de encabezado -->
                              <img src="https://lodomens.com/image/lodomens/Favicon_LodoMens.ico" alt="Lodomens" width="100" height="100" style="display: block;" />
                          </td>
                      </tr>
                      <tr>
                          <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                              <!-- Contenido del correo -->
                              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                  <tr>
                                      <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
                                          <b>¡Hola! {{ $mailData['order']['name'] }}, {{ $mailData['order']['last_name'] }}</b>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada, eros a aliquet facilisis, arcu turpis elementum elit, et dictum turpis lectus non nulla.
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
                                                            <div style="display: inline-block; width: 30px; height: 30px; border-radius: 50%; background-color: #900D0D; color: white; line-height: 30px; font-family: Arial, sans-serif;">
                                                                1

                                                            </div>
                                                            <div style="background:#900D0D; width:63%; height:7px; margin-top:10px;"></div>
                                                            </div>
                                                            <div>
                                                            <div style="margin-top: 10px; color: #900D0D; font-family: Arial, sans-serif; font-size: 14px; font-weight: bolder;">
                                                                Recibido

                                                            </div>

                                                            </div>
                                                        </td>
                                                        <td style="width: 25%; text-align: center;">
                                                            <div style="display: flex; text-align: center;">
                                                            <div style="background:#900D0D; width:40%; height:7px; margin-top:10px;"></div>
                                                            <div style="display: inline-block; width: 30px; height: 30px; border-radius: 50%; background-color: #dddddd; color: black; line-height: 30px; font-family: Arial, sans-serif;">
                                                                2
                                                            </div>
                                                            <div style="background:#dddddd; width:40%; height:7px; margin-top:10px;"></div>
                                                            </div>
                                                            <div style="margin-top: 10px; color: #000; font-family: Arial, sans-serif; font-size: 14px;">
                                                                En proceso

                                                        </td>
                                                        <td style="width: 25%; text-align: center;">
                                                            <div style="display: flex; text-align: center;">
                                                                <div style="background:#dddddd; width:40%; height:7px; margin-top:10px;"></div>
                                                                <div style="display: inline-block; width: 30px; height: 30px; border-radius: 50%; background-color: #dddddd; color: black; line-height: 30px; font-family: Arial, sans-serif;">
                                                                    3
                                                                </div>
                                                                <div style="background:#dddddd; width:40%; height:7px; margin-top:10px;"></div>
                                                            </div>
                                                            <div style="margin-top: 10px; color: #000; font-family: Arial, sans-serif; font-size: 14px;">
                                                                En camino
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%; text-align: center;">
                                                            <div style="display: flex; text-align: center;">
                                                                <div style="background:#dddddd; width:40%; height:7px; margin-top:10px;"></div>
                                                                <div style="display: inline-block; width: 30px; height: 30px; border-radius: 50%; background-color: #dddddd; color: black; line-height: 30px; font-family: Arial, sans-serif;">
                                                                    4
                                                                </div>

                                                            </div>
                                                            <div style="margin-top: 10px; color: #000; font-family: Arial, sans-serif; font-size: 14px;">
                                                                Entregado
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin: auto; font-family: Arial, sans-serif;">
                                        <tr>
                                            <td style="padding: 20px;">
                                                <!-- Contenedor principal -->
                                                @foreach ($mailData['cartItems'] as $item)
                                                <div style="display: flex;  margin-bottom:30px;">
                                                    <!-- Imagen del producto -->
                                                    <a href="" style="display: inline-block; width: 80px; height: 80px; margin:auto 20px;">
                                                        <img src="https://lodomens.com/storage/{{$item->productImage }}" alt="{{ $item->name }}" style="width: 100%; height: 100%; object-fit: cover; border: 2px solid #900D0D; border-radius: 3px;">
                                                    </a>

                                                    <!-- Detalles del producto -->
                                                    <div style="display:flex; justify-content: space-between;">
                                                        <div style="margin: auto">
                                                            <h6 style="margin: 0; font-size: 16px; font-weight: bold;">{{ $item->name }}</h6>
                                                            <p style="margin: 5px 0 0; font-size: 14px;">Precio unidad: {{session('currency')}}{{ $item->sell_price }}</p>
                                                            <p style="margin: 5px 0 0; font-size: 14px;">Color:  {{ $item->color }}</p>
                                                        </div>
                                                        <div style="margin-top: 28px; margin-left:100px;">
                                                        <p style="margin: 5px 0 0; font-size: 14px;">Cantidad: {{ $item->qtn }}</p>
                                                        <p style="margin: 5px 0 0; font-size: 14px;">SKU: {{ $item->sku }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </td>

                                        </tr>
                                    </table>
                                    <div style="font-family: Arial, sans-serif; margin-bottom:30px; padding-left:20px;" >
                                        <div>
                                            <h6>Sub-Total</h6>
                                        </div>
                                        <div style="display:grid;">
                                            <h6 style="margin: 0; font-size: 16px; font-weight: bold;">{{ $mailData['shipping']['price'] == 0 ?   $mailData['shipping']['name'] : 'Envio a domicilio' }}</h6>

                                            @if ($mailData['deliveryOrders'])
                                                @if ($mailData['shipping']['price'] > 0)
                                                <div>{{ $mailData['deliveryOrders']['address'] }}, {{ $mailData['deliveryOrders']['reference'] }}</div>
                                                <div>{{ $mailData['deliveryOrders']['district'] }}, {{ $mailData['deliveryOrders']['city'] }} </div>
                                                <div>{{ $mailData['deliveryOrders']['state'] }}, {{ $mailData['deliveryOrders']['country'] }}.</div>
                                                @else
                                                <div><b>Dirección:</b> {{ $mailData['shipping']['description'] }}</div>
                                                @endif
                                                <div><b>Recibido por:</b> {{ $mailData['deliveryOrders']['name'] }} {{ $mailData['deliveryOrders']['last_name'] }}</div>
                                            @else
                                                @if ($mailData['shipping']['price'] > 0)
                                                <div>{{ $mailData['order']['address'] }}, {{ $mailData['order']['reference'] }}</div>
                                                <div>{{ $mailData['order']['district'] }}, {{ $mailData['order']['city'] }} </div>
                                                <div>{{ $mailData['order']['state'] }}, {{ $mailData['order']['country'] }}.</div>
                                                @else
                                                <div><b>Dirección:</b> {{ $mailData['shipping']['description'] }}</div>
                                                @endif
                                                <div><b>Recibido por:</b> {{ $mailData['order']['name'] }} {{ $mailData['order']['last_name'] }}</div>

                                            @endif

                                            <div>
                                                @if ($mailData['shipping']['price'] > 0)

                                                   <div class="capitalize"> <b>Tipo de Envio:</b> {{ $mailData['shipping']->spanish() }} </div>
                                                   <div><b> Precio :</b> {{session('currency')}} {{ $mailData['shipping']['price'] }}
                                                       @if ($mailData['shipping']['state'] == 'district')
                                                       <div> {{ $mailData['shipping']['name'] }}</div>
                                                       @else
                                                       <div><b>Currier :</b>{{ $mailData['shipping']['name'] }}</div>
                                                       @endif
                                                @else
                                                   <div style="color:#14995B;"><b>Envio Gratis</b></div>
                                                @endif
                                                    <div style="font-weight: bold;">TOTAL :{{session('currency')}} {{ $mailData['order']['total'] }}</div>
                                               </div>
                                        </div>




                                    </div>
                                  </tr>

                                  <tr>
                                      <td>
                                          <!-- Botón de llamada a la acción -->
                                          <a href="https://lodomens.com/panel/compras?open=1" style="color: white; background-color: #900D0D; text-decoration: none; padding: 10px 20px; font-family: Arial, sans-serif; border-radius: 5px;display:flex; margin:auto; width:fit-content; margin-bottom: 30px;">Ver el estado de la compra</a>
                                      </td>
                                  </tr>


                              </table>
                          </td>
                      </tr>
                      <tr>
                          <td bgcolor="#404040" style="padding: 10px">
                              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                  <tr>
                                      <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px; text-align:center;" width="100%">
                                          &copy; 2024 <a href="#" style="color: #ffffff;">Nubesita Estudio.</a> Todos los derechos reservados.<br/>

                                      </td>
{{--                                        <td align="right" width="25%">
                                          <!-- Enlaces de redes sociales -->
                                          <a href="https://www.facebook.com" style="color: #ffffff;">
                                              <img src="https://via.placeholder.com/24/ffffff/000000?text=F" alt="Facebook" width="24" height="24" style="display: block;" />
                                          </a>
                                          <a href="https://www.twitter.com" style="color: #ffffff;">
                                              <img src="https://via.placeholder.com/24/ffffff/000000?text=T" alt="Twitter" width="24" height="24" style="display: block;" />
                                          </a>
                                      </td>  --}}
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
