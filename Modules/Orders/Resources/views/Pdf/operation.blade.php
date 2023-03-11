<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pdf.css') }}">
</head>
<body>
    <header>
        <table>
          <tr>
            <td rowspan="2" style="padding: 0; font-weight: bold;" class="bordecompleto">
                <img src="{{ asset('images/logo_horizontal.png') }}">
            </td>
            <td colspan="3" class="negrita bordecompleto" style="font-size: 14px;">
                <span>ORDEN DE COMPRA</span><br>
                <span>COOPERATIVA DE ENTIDADES DE SALUD DE CORDOBA "COODESCOR"</span>
            </td>
          </tr>
          <tr>
            <td class="bordecompleto">Código</td>
            <td class="bordecompleto">Versión</td>
            <td class="bordecompleto" style="width: 180px">Fecha de Emisión</td>
          </tr>
          <tr>
            <td class="bordecompleto" style="font-weight: bold;">812001561 - 0</td>
            <td class="bordecompleto">FO-400-28</td>
            <td class="bordecompleto">10</td>
            <td class="bordecompleto">23/09/2021</td>
          </tr>
        </table>
        <br>
        <div style="font-size: 11px;">
            <span><b>Favor Cita el No. de la orden de Compra en la Factura</b></span>
        </div>
        <br>
    </header>
    <footer>
        <table>            
            <tr>
                <td style="width: 100px" class="textleft">Condiciones de pago:</td>
                <td style="width: 100px" class="textleft">ANTICIPO</td>
                
                <td style="width: 90px"></td>
                <td style="width: 70px" class="textleft">Plazo:</td>
                <td style="width: 190px" class="textleft">CREDITO A 30 DÍAS</td>                
            </tr>            
        </table>
        <br>
        <table>
            <tr>
                <td style="width: 250px; padding: 5px; border: 1px solid black;" class="negrita">
                    <span>Sitio de entrega</span><br>
                    <span>Cl 28A No. 23 03 (OFICINAS DE COODESCOR)</span>
                </td>
                <td style="width: 40px"></td>
                <td style="width: 260px; padding: 5px; border: 1px solid black;" class="negrita">
                    <span>Tiempo de Entrega</span><br>
                    <span>INMEDIATA</span>
                </td>
            </tr>
          </table>
          <br>
          <br>
          <br>
          <br>
          <br>
          <table style="font-weight: bold;">
            <tr>
                <td style="width: 170px" class="bordesuperior">Revisado</td>
                <td style="width: 20px" ></td>
                <td style="width: 170px" class="bordesuperior">Aprobado</td>
                <td style="width: 20px" ></td>
                <td style="width: 170px" class="bordesuperior">Aceptado</td>
            </tr>
          </table>
          <br>
          <div class="textcenter" style="font-size: 11px;">
            <span>Con la firma de la presente orden declaro bajo la gravedad del juramento que no me encuentro incurso en ninguna de las causales de inhabilidad e
                incompatibilidades consagradas en la Constitución y en la Ley</span><br><br>
            <span>E-MAIL: administrativo@coodescor.org.co</span><br><br>
            <span>Carrera 28ª No. 23-03 Montería - Córdoba Tel: 791 8080 Telefax: (4) 791 8181 - Ventas (4) 791 3030</span>
          </div>
    </footer>        
    <!-- Tablde Ingresos Y Retiros -->
    @for ($i = 1; $i <= $paginas; $i++)
        <table>
            <tr>
                <th class="bordecompleto" style="width: 260px">PROVEEDOR</th>
                <th class="bordecompleto" style="width: 70px">Nit</th>
                <th class="bordecompleto" style="width: 70px">Fecha</th>
                <th class="bordecompleto" style="width: 80px">No. de la O. de C.</th>
                <th class="bordecompleto" style="width: 70px">Pagina</th>                
            </tr>
            <tr>
                <td class="bordecompleto">{{ $order[0]['basic_client_name'] }}</td>
                <td class="bordecompleto">{{ $order[0]['id'] }}</td>
                <td class="bordecompleto">{{ $order[0]['date'] }}</td>
                <td class="bordecompleto">{{ $order[0]['id'] }}</td>
                <td class="bordecompleto">Página {{ $i }} de {{ $paginas }}</td>
            </tr>           
        </table>
        <br>
        <div style="font-size: 11px;">
            <span>C.U: Centro de utilidad para el cual COODESCOR realiza el pedido. Favor realizar una factura por cada CU</span>
        </div>                
        <br>
        <div style="font-size: 11px;">
            <span>Objeto: Sirvase suministrar los siguientes elementos que a continuación se detallan</span>
        </div>
        <br>
        <table>
            <tr>
                <td class="bordecompleto" style="width: 50px">C.U.</td>
                <td class="bordecompleto" style="width: 70px">Unidad</td>
                <td class="bordecompleto" style="width: 50px">Cantidad</td>
                <td class="bordecompleto" style="width: 270px">Descripción</td>
                <td class="bordecompleto" style="width: 70px">Marca</td>
                <td class="bordecompleto" style="width: 70px">Valor Unitario</td>
                <td class="bordecompleto" style="width: 70px">Valor Total</td>
            </tr>
        </table>
        @if ($paginas == 1)        
            <main>
                <table>            
                    @foreach ($detailOrder as $item)
                    <tr>
                        <td style="width: 50px; padding-top: 9px">{{ $item['basic_destination_id'] }}</td>
                        <td style="width: 70px; padding-top: 9px">{{ $item['measure_unitd'] }}</td>
                        <td style="width: 50px; padding-top: 9px">{{ $item['quantity'] }}</td>
                        <td style="width: 270px; padding-top: 9px" class="textleft paddingdetalle">{{ $item['product_name'] }}</td>
                        <td style="width: 70px; padding-top: 9px">{{ $item['brand'] }}</td>
                        <td style="width: 70px; padding-top: 9px" class="textright">{{ number_format($item['price'], 0) }}</td>
                        <td style="width: 70px; padding-top: 9px" class="textright">{{ number_format($item['subtotal'], 0) }}</td>
                    </tr>                
                    @endforeach
                </table>
                <div>
                    <table>
                        <tr style="padding: 5px;">
                            <td rowspan="5" style="text-align: justify; width: 510px; font-size: 12px">
                                <span>{{ $order[0]['observation'] }}</span>
                            </td>
                            <td style="width: 100px; font-weight: bold; font-size: 12px" class="textright">Subtotal</td>
                            <td style="width: 70px; font-size: 12px" class="textright">{{ number_format($order[0]['subtotal'], 0) }}</td>
                        </tr>
                        <tr>
                            <td style="width: 100px; font-weight: bold; font-size: 12px" class="textright">IVA (19%)</td>
                            <td style="width: 70px; font-size: 12px" class="textright">{{ number_format($order[0]['tax_sale'], 0) }}</td>
                        </tr>
                        <tr>
                            <td style="width: 100px; font-weight: bold; ; font-size: 12px" class="textright">TOTAL</td>
                            <td style="width: 70px; font-size: 12px" class="textright">{{ number_format($order[0]['total'], 0) }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </main>
        @endif
        @if ($paginas > 1 )            
            @if ($i <> 2 || $paginas > 2)
            <main style="page-break-after: always;">            
                @php
                    $final = false;
                @endphp
                <table>                    
                    @foreach ($detailOrder as $item)
                    @if ($i == 1 && $loop->iteration <= 16)
                        <tr>
                            <td style="width: 50px; padding-top: 9px">{{ $item['basic_destination_id'] }}</td>
                            <td style="width: 70px; padding-top: 9px">{{ $item['measure_unitd'] }}</td>
                            <td style="width: 50px; padding-top: 9px">{{ $item['quantity'] }}</td>
                            <td style="width: 270px; padding-top: 9px" class="textleft paddingdetalle">{{ $item['product_name'] }}</td>
                            <td style="width: 70px; padding-top: 9px">{{ $item['brand'] }}</td>
                            <td style="width: 70px; padding-top: 9px" class="textright">{{ number_format($item['price'], 0) }}</td>
                            <td style="width: 70px; padding-top: 9px" class="textright">{{ number_format($item['subtotal'], 0) }}</td>
                        </tr>
                        @if ($loop->iteration == 16)
                            @php
                                break;
                            @endphp
                        @endif
                    @endif
                    @endforeach
                    @if ($i > 1)                    
                    @foreach ($detailOrder as $item)                        
                        @if ($paginas > 1 && $loop->iteration > (16 * ($i - 1)) && $loop->iteration <= (16 * ($i)))
                            <tr>
                                <td style="width: 50px; padding-top: 9px">{{ $item['basic_destination_id'] }}</td>
                                <td style="width: 70px; padding-top: 9px">{{ $item['measure_unitd'] }}</td>
                                <td style="width: 50px; padding-top: 9px">{{ $item['quantity'] }}</td>
                                <td style="width: 270px; padding-top: 9px" class="textleft paddingdetalle">{{ $item['product_name'] }}</td>
                                <td style="width: 70px; padding-top: 9px">{{ $item['brand'] }}</td>
                                <td style="width: 70px; padding-top: 9px" class="textright">{{ number_format($item['price'], 0) }}</td>
                                <td style="width: 70px; padding-top: 9px" class="textright">{{ number_format($item['subtotal'], 0) }}</td>
                            </tr>
                            {{-- @if ($loop->last)
                                {{ $final = true; }}
                            @endif --}}
                        @endif
                    @endforeach
                    @endif
                </table>                
            </main>
            @endif            
            @if ($i == $paginas)
            <main style="page-break-after: never;">
                <table>
                    @foreach ($detailOrder as $item)                        
                        @if ($loop->iteration > (16 * ($i - 1)) && $loop->iteration <= (16 * ($i)))
                            <tr>
                                <td style="width: 50px; padding-top: 9px">{{ $item['basic_destination_id'] }}</td>
                                <td style="width: 70px; padding-top: 9px">{{ $item['measure_unitd'] }}</td>
                                <td style="width: 50px; padding-top: 9px">{{ $item['quantity'] }}</td>
                                <td style="width: 270px; padding-top: 9px" class="textleft paddingdetalle">{{ $item['product_name'] }}</td>
                                <td style="width: 70px; padding-top: 9px">{{ $item['brand'] }}</td>
                                <td style="width: 70px; padding-top: 9px" class="textright">{{ number_format($item['price'], 0) }}</td>
                                <td style="width: 70px; padding-top: 9px" class="textright">{{ number_format($item['subtotal'], 0) }}</td>
                            </tr>
                            @if ($loop->last)
                                {{ $final = true; }}
                            @endif
                        @endif
                    @endforeach
                </table>
                @if ($final)                        
                    <div>
                        <table>
                            <tr style="padding: 5px;">
                                <td rowspan="5" style="text-align: justify; width: 510px; font-size: 12px">
                                    <span>{{ $order[0]['observation'] }}</span>
                                </td>
                                <td style="width: 100px; font-weight: bold; font-size: 12px" class="textright">Subtotal</td>
                                <td style="width: 70px; font-size: 12px" class="textright">{{ number_format($order[0]['subtotal'], 0) }}</td>
                            </tr>
                            <tr>
                                <td style="width: 100px; font-weight: bold; font-size: 12px" class="textright">IVA (19%)</td>
                                <td style="width: 70px; font-size: 12px" class="textright">{{ number_format($order[0]['tax_sale'], 0) }}</td>
                            </tr>
                            <tr>
                                <td style="width: 100px; font-weight: bold; ; font-size: 12px" class="textright">TOTAL</td>
                                <td style="width: 70px; font-size: 12px" class="textright">{{ number_format($order[0]['total'], 0) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                @endif    
                
            </main>
            @endif
        @endif        
    @endfor
</body>
</html>