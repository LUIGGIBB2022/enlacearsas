<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\centrodeoperacion;
use App\Models\cliente;
use App\Models\detalledefactura;
use App\Models\factura;
use App\Models\movimientosdeinventario;
use App\Models\producto;
use App\Models\saldosdeinventario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


use function PHPUnit\Framework\isNull;

class VentasController extends Controller
{
    public function UpdateSales(Request $request):JsonResponse
    {

        $contador = 0;
        if (isset($request->clientes))
        {
            $clientes   = $request->clientes;

            foreach ($clientes as $dato)
            {
              $nit          =   $dato['nit'];
              $sucursal     =   $dato['sucursal'];
              $reg_clientes = cliente::updateOrCreate(['nit'=>$nit,'sucursal'=>$sucursal],
              [
                'nit'                   => $dato['nit'],
                'sucursal'              => $dato['sucursal'],
                'nombreprimero'         => !is_null($dato['nombreprimero'])?$dato['nombreprimero']:"",
                'nombresegundo'         => !is_null($dato['nombresegundo'])?$dato['nombresegundo']:"",
                'apellidosegundo'       => !is_null($dato['apellidosegundo'])?$dato['apellidosegundo']:"",
                'apellidoprimero'       => !is_null($dato['apellidoprimero'])?$dato['apellidoprimero']:"",
                'nombrecompleto'        => !is_null($dato['nombrecompleto'])?$dato['nombrecompleto']:"",
                'razonsocial'           => !is_null($dato['razonsocial'])?$dato['razonsocial']:"",
                'direccion'             => !is_null($dato['direccion'])?$dato['direccion']:"",
                'telefono'              => !is_null($dato['telefono'])?$dato['telefono']:"",
                'email'                 => !is_null($dato['emailf'])?$dato['emailf']:"",
                'codigo'                => !is_null($dato['codigo'])?$dato['codigo']:"",
                'empresa'               => !is_null($dato['empresa'])?$dato['empresa']:"",
                'dv'                    => !is_null($dato['dv'])?$dato['dv']:"",
                'barrio'                => !is_null($dato['barrio'])?$dato['barrio']:"",
                'segmento'              => !is_null($dato['segmento'])?$dato['segmento']:"",
                'rutadeventa'           => !is_null($dato['ruta'])?$dato['ruta']:"",
                'zonadeventa'           => !is_null($dato['zona'])?$dato['zona']:"",
                'tipodecliente'         => !is_null($dato['tipocliente'])?$dato['tipocliente']:"",
                'lista'                 => !is_null($dato['lista'])?$dato['lista']:"",
                'vendedor'              => !is_null($dato['vendedor'])?$dato['vendedor']:"",
                'ciudad'                => !is_null($dato['ciudad'])?$dato['ciudad']:"",
                'categoria01'           => "",
                'categoria02'           => "",
                'matriculamercantil'    => !is_null($dato['matriculamercantil'])?$dato['matriculamercantil']:"",
                'obligacionesfiscales'  => !is_null($dato['rutobligaciones'])?$dato['rutobligaciones']:"",
                'tipoderegimen'         => !is_null($dato['ruttiporegimen'])?$dato['ruttiporegimen']:0,
                'zonapostal'            => !is_null($dato['zonapostal'])?$dato['zonapostal']:"",
                'contacto'              => !is_null($dato['contacto'])?$dato['contacto']:"",
                'fechadenacimiento'     => !is_null($dato['fechacumpleano'])?$dato['fechacumpleano']:"0001-01-01",
                'local'                 => !is_null($dato['localf'])?$dato['localf']:"",
                'codigoprestador'       => !is_null($dato['codigoprestador'])?$dato['codigoprestador']:"",
                'fechaultimopago'       => !is_null($dato['fechaultimopago'])?$dato['fechaultimopago']:"0001-01-01",
                'fechaultimacompra'     => !is_null($dato['fechaultimacompra'])?$dato['fechaultimacompra']:"0001-01-01",
                'fechadecreacion'       => !is_null($dato['fechadecreacion'])?$dato['fechadecreacion']:"0001-01-01",
                'fechafinaldecontrato'  => !is_null($dato['fechadefinaldecontrato'])?$dato['fechadefinaldecontrato']:"0001-01-01",
                'rutafoto'              => !is_null($dato['rutafoto'])?$dato['rutafoto']:"",
                'rutafirma'             => !is_null($dato['rutafirma'])?$dato['rutafirma']:"",
                'numerodecontrato'      => !is_null($dato['numerodecontrato'])?$dato['numerodecontrato']:"",
                'propiedad'             => !is_null($dato['propiedad'])?$dato['propiedad']:"",
                'tipodepropiedad'       => !is_null($dato['tipopropiedad'])?$dato['tipopropiedad']:0,
                'tipodearrendatario'    => !is_null($dato['tipoarrendatario'])?$dato['tipoarrendatario']:0,
                'ivapropietario'        => !is_null($dato['ivapropietario'])?$dato['ivapropietario']:0,
                'porcentajedeincremento' => !is_null($dato['porcentajedeincremento'])?$dato['porcentajedeincremento']:0,
                'tipoclienteinmobiliaria' => !is_null($dato['tipoclienteinmobiliaria'])?$dato['tipoclienteinmobiliaria']:0,
                'idlocal'               => !is_null($dato['localf'])?$dato['localf']:"",
                'ocupacion'             => !is_null($dato['ocupacion'])?$dato['ocupacion']:"",
                'nacionalidad'          => !is_null($dato['nacionalidad'])?$dato['nacionalidad']:"",
                'observaciones'         => !is_null($dato['observaciones'])?$dato['observaciones']:"",
                'proyecto'              => !is_null($dato['proyecto'])?$dato['proyecto']:"",
                'sproyecto'             => "",
                'centrooper'            => !is_null($dato['centrooper'])?$dato['centrooper']:"",
                'direcciondeentrega'    => "",
                'telefonodeentrega'     => "",
                'ciudaddeentrega'       => "",
                'contactodeentrega'     => "",
                'cuenta'                => "",
                'centro'                => "",
                'scentro'               => "",
                'latitud'               => 0,
                'longitud'              => 0,
                'estado'                => $dato['estado'],
                'estado1'               => 1,
                'segmento'              => !is_null($dato['segmento'])?$dato['segmento']:"",
                'actividadeconomica'    => !is_null($dato['actividadeconomica'])?$dato['actividadeconomica']:"",
                'regimenfiscal'         => !is_null($dato['ruttiporegimen'])?$dato['ruttiporegimen']:"",
                'canon'                 => $dato['canon'],
                'administracion'        => $dato['administracion'],
                'porcentaje'            => $dato['porcentaje'],
                'iva'                   => $dato['iva'],
                'cupodecartera'         => !is_null($dato['cupocartera'])?$dato['cupocartera']:0,
                'plazodecartera'        => !is_null($dato['diasplazo'])?$dato['diasplazo']:0,
                'declararenta'          => !is_null($dato['tipodeclarante'])?$dato['tipodeclarante']:0,
                'diascontrol'           => 0,
                'puntos'                => $dato['canon'],
                'manejapuntos'          => $dato['tipopropiedad'],
                'puntosacumulados'      => $dato['administracion'],
                'retencionautomatica'   => $dato['retencionesautomaticas'],
                'usuario_created'       => $dato['usuariocreated'],
                'usuario_updated'       => $dato['usuarioupdated'],
              ]);
            }
        }

       $contador = 0;
       if (isset($request->detalle))
       {
            $detalles         = $request->detalle;
            $xcuantos         = count($detalles);
            $contador = 0;
            $fechadesde = "";
            $fechahasta = "";
            foreach ($detalles as $detalle)
            {
                $fechadesde     =  $contador==0?$detalle['fechafactura']:$fechadesde;
                $fechahasta     = $detalle['fechafactura'];
                $contador++;
                $numerofactura  = $detalle['numerofactura'];
                $prefijo        = $detalle['prefijo'];
                $tipodcto       = $detalle['tipodocumento'];
                $nit            = $detalle['nit'];
                $producto       = $detalle['producto'];
                $bodega         = $detalle['bodega'];
                $idregistro     = $detalle['idregistro'];
                $cantidad1      = $detalle['peso']>0?$detalle['peso']:0;
                $cantidad1      = $detalle['unidades']>0?$detalle['unidades']:$cantidad1;

                $reg_detf      = detalledefactura::updateOrCreate(['numerodefactura'=>$numerofactura, 'prefijo'=>$prefijo, 'nit' => $nit,'producto' => $producto,'bodega'=>$bodega,'idregistro'=>$idregistro],
                [
                    'numerofactura'         => $detalle['numerofactura'],
                    'prefijo'               => $detalle['prefijo'],
                    'tipodedocumento'       => $detalle['tipodocumento'],
                    'nit'                   => $detalle['nit'],
                    'sucursal'              => $detalle['sucursal'],
                    'fechadefactura'        => $detalle['fechafactura'],
                    'fechadevencimiento'    => $detalle['vencimiento'],
                    'tipodemovimiento'      => is_null($detalle['tipomvto'])?"":$detalle['tipomvto'],
                    'producto'              => $detalle['producto'],
                    'descripcion'            => is_null($detalle['descripcion'])?"":$detalle['descripcion'],
                    'producto2'             => is_null($detalle['codigoterminado'])?"":$detalle['codigoterminado'],
                    'bodega'                => $detalle['bodega'],
                    'lote'                  => is_null($detalle['lote'])?"":$detalle['lote'],
                    'cantidad'              => $detalle['cantidad'],
                    'cantidad1'             => $cantidad1,
                    'valorventa'            => $detalle['valor'],
                    'costopromedio'         => $detalle['costopromedio'],
                    'porcentajeiva'         => $detalle['ivaproducto'],
                    'descuento1'            => $detalle['descuento1'],
                    'descuento2'            => $detalle['descuento2'],
                    'descuento3'            => $detalle['descuento3'],
                    'valordescuento1'       => $detalle['vdescuento1'],
                    'valordescuento2'       => $detalle['vdescuento2'],
                    'valordescuento3'       => $detalle['vdescuento3'],
                    'idregistro'            => $detalle['idregistro'],
                    'impoconsumo'           => $detalle['impoconsumo'],
                    'concepto'              => $detalle['concepto'],
                    'cptoclase'             => $detalle['cptoclase'],
                    'serial'                => is_null($detalle['serial'])?"":$detalle['serial'],
                    'garantia'              => is_null($detalle['garantia'])?"":$detalle['garantia'],
                    'tipodecliente'         => is_null($detalle['tipocliente'])?"":$detalle['tipocliente'],
                    'rutadeventa'           => is_null($detalle['ruta'])?"":$detalle['ruta'],
                    'zonadeventa'           => is_null($detalle['zona'])?"":$detalle['zona'],
                    'centrooper'            => $detalle['centrooper'],
                    'proyecto'              => is_null($detalle['proyecto'])?"":$detalle['proyecto'],
                    'sproyecto'             => is_null($detalle['sproyecto'])?"":$detalle['sproyecto'],
                    'cuenta'                => is_null($detalle['cuenta'])?"":$detalle['cuenta'],
                    'centro'                => is_null($detalle['centro'])?"":$detalle['centro'],
                    'scentro'               => is_null($detalle['scentro'])?"":$detalle['scentro'],
                    'vendedor'              => is_null($detalle['vendedor'])?"":$detalle['vendedor'],
                    'tecnico'               => is_null($detalle['vendedor'])?"":$detalle['vendedor'],
                    'propiedad'             => "",
                    'vehiculo'              => is_null($detalle['placa'])?"":$detalle['placa'],
                    'estado'                => is_null($detalle['estado'])?0:$detalle['estado'],
                    'estado01'              => is_null($detalle['estado01'])?0:$detalle['estado01'],
                    'estado02'              => is_null($detalle['estado02'])?0:$detalle['estado02'],
                    'estado03'              => is_null($detalle['estado03'])?0:$detalle['estado03'],
                    'usuario_created'       => $detalle['usuariocreated'],
                    'usuario_updated'       => $detalle['usuarioupdated'],
                ]);
                // return response()->json(
                //     [
                //     'status'   => '200OK',
                //     'msg'      => 'Salida Pre Exitosa',
                //     'msg2'      => $contador,
                //     ],Response::HTTP_ACCEPTED);
                //}
            }
        }

        $contador = 0;
        if (isset($request->facturas))
        {
            $facturas        = $request->facturas;
            $xcuantos         = count($facturas);

            foreach ($facturas as $factura)
            {
                $contador++;
                $numerofactura  = $factura['numerofactura'];
                $prefijo        = $factura['prefijo'];
                $tipodcto       = $factura['tipodocumento'];
                $fechafac       = $factura['fechafactura'];
                $nit            = $factura['nit'];
                $sucursal       = $factura['sucursal'];

                $clientes       = cliente::where('nit',$nit)->where('sucursal',$sucursal)->first();
                $clientesID     = $clientes->clientesID;

                $reg_fact       = factura::updateOrCreate(['numerodefactura'=>$numerofactura, 'prefijo'=>$prefijo, 'tipodedocumento' => $tipodcto,'fechafactura' => $fechafac],
                [
                        //$regfacturas = new factura;
                    'numerodefactura'      => $factura['numerofactura'] ,
                    'tipodedocumento'      => $factura['tipodocumento'] ,
                    'prefijo'              => $factura['prefijo'],
                    'fechafactura'         => $factura['fechafactura'],
                    'horashabitacion'      => $factura['nrodehoras'],
                    'fechavencimiento'     => $factura['vencimiento'],
                    'cufe'                 => is_Null($factura['cufe'])?"":$factura['cufe'],
                    'habitacion'           => is_null($factura['habitacion'])?"":$factura['habitacion'],
                    'fechadeentrada'       => $factura['fechaentrada'],
                    'fechadesalida'        => $factura['fechasalida'],
                    'lapso'                => $factura['lapso'],
                    'numerodepedido'       => $factura['npedido'],
                    'numerodecompra'       => $factura['nocompra'],
                    'nit'                  => $factura['nit'],
                    'sucursal'             => $factura['sucursal'],
                    'nombreventa'          => is_null($factura['nombreventa'])?"":$factura['nombreventa'],
                    'paciente'             => is_null($factura['paciente'])?"":$factura['paciente'],
                    'propina'              => $factura['propina'],
                    'valorfactura'         => $factura['valorfactura'],
                    'descuentosproductos'  => $factura['dsctosprod'],
                    'descuentosadicionales'=> $factura['dsctosadic'],
                    'ventasexentas'        => $factura['ventasexen'],
                    'ventagravadas'        => $factura['ventasgrav'],
                    'valoradicional'       => $factura['valoradicional'],
                    'flete'                => $factura['flete'],
                    'retefuente'           => $factura['retencion'],
                    'reteiva'              => $factura['reteiva'],
                    'valoriva'             => $factura['valoriva'],
                    'reteica'              => $factura['reteica'],
                    'otrasret1'            => $factura['otrasret1'],
                    'otrasret2'            => $factura['otrasret2'],
                    'otrasret3'            => $factura['otrasret3'],
                    'otrasret4'            => $factura['otrasret4'],
                    'otrasret5'            => $factura['otrasret5'],
                    'valordescuento1'      => 0,
                    'valordescuento2'      => 0,
                    'valordescuento3'      => 0,
                    'numerodecompra'       => 0,
                    'numeroderegistros'    => $factura['numregistros'],
                    'totalfactura'         => $factura['totalfactura'],
                    'costodeventa'         => $factura['costodeventa'],
                    'tipodefactura'        => $factura['tipofactura'],
                    'centrooper'           => $factura['centrooper'],
                    'proyecto'             => is_null($factura['proyecto'])?"":$factura['proyecto'],
                    'sproyecto'            => is_null($factura['sproyecto'])?"":$factura['sproyecto'],
                    'estado'               => $factura['estado'],
                    'estado01'             => $factura['estado01'],
                    'estado02'             => $factura['estado02'],
                    'estado03'             => $factura['estado03'],
                    'usuario_created'      => $factura['usuariocreated'],
                    'usuario_updated'      => $factura['usuarioupdated'],
                     //-- Actualizar Campos obligatorios
                    'clientesid'            => $clientesID,
                    'vendedorid'            => 1,
                    'horadefactura'         => $factura['horafactura'],
                    'cuenta'                => is_null($factura['cuenta'])?"":$factura['cuenta'],
                    'centro'                => is_null($factura['centro'])?"":$factura['centro'],
                    'scentro'               => is_null($factura['scentro'])?"":$factura['scentro'],
                    'actividad'             => is_null($factura['actividad'])?"":$factura['actividad'],
                    'observaciones'         => is_null($factura['observaciones'])?"":$factura['observaciones'],
                    'nitarrendatario'       => is_null($factura['nitarrendat'])?"":$factura['nitarrendat'],
                    'sucursalarrendatario'  => is_null($factura['sucarrendat'])?"":$factura['sucarrendat'],
                    'propiedad'             => is_null($factura['propiedad'])?"":$factura['propiedad'],
                    'contrato'              => "",
                    'caja'                  => is_null($factura['caja'])?"":$factura['caja'],
                    'cajero'                => is_null($factura['cajero'])?"":$factura['cajero'],
                    'mesa'                  => is_null($factura['mesa'])?"":$factura['mesa'],
                    'mesero'                => is_null($factura['mesero'])?"":$factura['mesero'],
                    'conceptodeinterface'   => "",
                    'lista'                 => $factura['lista'],
                    'plan'                  => is_null($factura['planf'])?"":$factura['planf'],
                    'transportador'         => is_null($factura['transportador'])?"":$factura['transportador'],
                    'placa'                 => is_null($factura['placa'])?"":$factura['placa'],
                    'tipodepago'            => is_null($factura['tipodepago'])?"":$factura['tipodepago'],
                    'numerodedocumento'     => is_null($factura['numerodocumento'])?"":$factura['numerodocumento'],
                    'valordelpago'          => is_null($factura['valordelpago'])?"":$factura['valordelpago'],
                    'valorotrodocumento'    => is_null($factura['valordelpago'])?"":$factura['valordelpago'],
                    'documentodian'         => is_null($factura['valorotrodcto'])?"":$factura['valorotrodcto'],
                    'tecnico'               => is_null($factura['vendedor'])?"":$factura['vendedor'],
                    'profesional'           => "",
                    'codigodedescuento'     => is_null($factura['codigodctos'])?"":$factura['codigodctos'],
                    'tipodecliente'         => is_null($factura['tipocliente'])?"":$factura['tipocliente'],
                    'rutadeventa'           => is_null($factura['ruta'])?"":$factura['ruta'],
                    'zonadeventa'           => is_null($factura['zona'])?"":$factura['zona'],
                    'vendedor'              => is_null($factura['vendedor'])?"":$factura['vendedor'],
                    'kilometraje'           => is_null($factura['kilometraje'])?0:$factura['kilometraje'],
                    'numerodelreparto'      => is_null($factura['nreparto'])?0:$factura['nreparto'],
                    'montodelrecaudo'       => is_null($factura['recaudosrepartos'])?0:$factura['recaudosrepartos'],
                    'saldoencartera '       => is_null($factura['saldocartera'])?0:$factura['saldocartera'],
                ]);

                $numerofactura  = $factura['numerofactura'];
                $prefijo        = $factura['prefijo'];
                $tipodcto       = $factura['tipodocumento'];
                $facturasID     = $reg_fact->FacturasID;
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                detalledefactura::where('detalledefacturas.numerodefactura',"=",$numerofactura)
                ->where('detalledefacturas.tipodedocumento',"=",$tipodcto)
                ->where('detalledefacturas.prefijo',"=",$prefijo)
                ->update(['detalledefacturas.FacturasID' => $facturasID, 'detalledefacturas.ClientesID' => $clientesID]);
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            }
       }

       $contador = 0;
       if (isset($request->detinventario))
       {
           $detalles = $request->detinventario;
           foreach ($detalles as $detalle)
           {
               $fechamvto       = $detalle['fechamvto'];
               $idregistro      = $detalle['idregistro'];
               $consecutivo     = $detalle['cnsnumero'];
               $concepto        = $detalle['concepto'];
               $tipodocumento   = $detalle['tipodocumento'];
               $producto        = $detalle['producto'];
               $bodega          = $detalle['bodega'];
               $idregistro      = $detalle['idregistro'];
               $nit             = $detalle['nit'];
               $cantidad1       = $detalle['peso']>0?$detalle['peso']:0;
               $cantidad1       = $detalle['unidad']>0?$detalle['unidad']:$cantidad1;
               $reg_fact        = movimientosdeinventario::updateOrCreate(['fechamovimiento'=>$fechamvto, 'consecutivo'=>$consecutivo, 'tipodedocumento' => $tipodocumento,
                                 'concepto' => $concepto,'nit' => $nit, 'producto'=>$producto,'bodega'=>$bodega,'idregistro'=>$idregistro],
                    [
                        'fechamovimiento'       => $fechamvto,
                        'consecutivo'           => $consecutivo,
                        'tipodedocumento'       => !is_null($tipodocumento)?$tipodocumento:"",
                        'nit'                   => $nit,
                        'sucursal'              => !is_null($detalle['sucursal'])?$detalle['sucursal']:"",
                        'nit2'                  => !is_null($detalle['nit2'])?$detalle['nit2']:"",
                        'sucursal2'             => !is_null($detalle['sucursal2'])?$detalle['sucursal2']:"",
                        'concepto'              => $detalle['concepto'],
                        'cptoclase'             => $detalle['cptoclase'],
                        'lapso'                 => $detalle['lapso'],
                        'facturadecompra'       => 0,
                        'iddocumento'           => $detalle['documento'],
                        'prefijo'               => !is_null($detalle['prefijo'])?$detalle['prefijo']:"",
                        'placa'                 => !is_null($detalle['vehiculo'])?$detalle['vehiculo']:"",
                        'producto'              => !is_null($detalle['producto'])?$detalle['producto']:"",
                        'bodega'                => !is_null($detalle['bodega'])?$detalle['bodega']:"",
                        'lote'                  => !is_null($detalle['lote'])?$detalle['lote']:"",
                        'descripcion'           => $detalle['nombre'],
                        'ordendecompra'         => $detalle['ordent'],
                        'cuenta'                => !is_null($detalle['cuenta'])?$detalle['cuenta']:"",
                        'centro'                => !is_null($detalle['centro'])?$detalle['centro']:"",
                        'scentro'               => !is_null($detalle['scentro'])?$detalle['scentro']:"",
                        'centrooper'            => !is_null($detalle['centrooper'])?$detalle['centrooper']:"",
                        'actividad'             => !is_null($detalle['actividad'])?$detalle['actividad']:"",
                        'tipodemovimiento'      => $detalle['tipomov'],
                        'cantidad'              => $detalle['cantidad'],
                        'cantidad1'             => $cantidad1,
                        'valor'                 => $detalle['valor'],
                        'valorventa'            => $detalle['valorventa'],
                        'costoreal'             => $detalle['costoreal'],
                        'valornetorealizable'   => $detalle['valornetorealizable'],
                        'descuento1'            => $detalle['descuento1'],
                        'descuento2'            => $detalle['descuento2'],
                        'descuento3'            => $detalle['descuento3'],
                        'ivaproducto'           => $detalle['iva'],
                        'lotemedicamento'       => !is_null($detalle['lotemedicamento'])?$detalle['lotemedicamento']:"",
                        'fechadevencimiento'    => $detalle['fechavencimiento'],
                        'impoconsumo'           => $detalle['impoconsumo'],
                        'estado'                => $detalle['estado'],
                        'estado01'              => $detalle['estado01'],
                        'estado02'              => $detalle['estado02'],
                        'estado03'              => $detalle['estado03'],
                        'idregistro'            => $detalle['idregistro'],
                        'usuario_created'       => $detalle['usuariocreated'],
                        'usuario_updated'       => $detalle['usuarioupdated'],
                    ]);
           }
       }

       $contador = 0;
       if (isset($request->saldos))
       {
           $saldos      = $request->saldos;
           $fecha       = Carbon::now();
           $ano         = $fecha->format('Y');
           foreach ($saldos as $dato)
           {
              $producto         = $dato['codigo'];
              $bodega           = !is_null($dato['bodega'])?$dato['bodega']:"";
              $lote             = !is_null($dato['lote'])?$dato['lote']:"";
              $anoproc          = $ano;
              $regproducto      = producto::where('codigo', $producto)->first();
              $idproducto       = !isset($regproducto->productoID)?0:$regproducto->productoID;

              DB::statement('SET FOREIGN_KEY_CHECKS=0;');
              saldosdeinventario::updateOrCreate(['anodeproceso'=>$anoproc, 'producto'=>$producto, 'bodega' => $bodega,
              'lote' => $lote],
              [
                  'cantidad'        => $dato['cantidad'],
                  'cantidad1'       => $dato['cantidad2'],
                  'costopromedio'   => $dato['costopromedio'],
                  'ultimocosto'     => $dato['ultimocosto'],
                  'saldoanterior'   => $dato['saldoanterior'],
                  'saldoanterior1'  => $dato['saldoanterior2'],
                  'costop00'        => $dato['costop00'],
                  'costop01'        => $dato['costop01'],
                  'costop02'        => $dato['costop02'],
                  'costop03'        => $dato['costop03'],
                  'costop04'        => $dato['costop04'],
                  'costop05'        => $dato['costop05'],
                  'costop06'        => $dato['costop06'],
                  'costop07'        => $dato['costop07'],
                  'costop08'        => $dato['costop08'],
                  'costop09'        => $dato['costop09'],
                  'costop10'        => $dato['costop10'],
                  'costop11'        => $dato['costop11'],
                  'costop12'        => $dato['costop12'],
                  'ProductoID'      => $idproducto,
                  'usuario_created' => $dato['usuariocreated'],
                  'usuario_updated' => $dato['usuarioupdated'],
              ]);
              DB::statement('SET FOREIGN_KEY_CHECKS=1;');
           }
       }

       $contador = 0;
       if (isset($request->centrooper))
       {
          $centros  = $request->centrooper;

          foreach ($centros as $centro)
          {
            $codigo   = $centro['codigo'];
            centrodeoperacion::updateOrCreate(["codigo" =>$codigo],
            [
               'nombre'           => $centro['descripcion'],
               'direccion'        => "",
               'telefono'         => "",
               'centro'           => "",
               'scentro'          => "",
               'estado'           => $centro['estado'],
               'usuario_created'  => $dato['usuariocreated'],
               'usuario_updated'  => $dato['usuarioupdated'],
            ]);
          }
       }

       return response()->json(
       [
        'status'   => '200 OK',
        'msg'      => 'Salida Pre Exitosa',
       ],Response::HTTP_ACCEPTED);
    }

    public function ConsolidatedSalesCenter(Request $request):JsonResponse
    {
        return response()->json(
            [
             'status'   => '200',
             'msg'      => 'Ventas Consolidadas 2024',
            ],Response::HTTP_ACCEPTED);
    }
}
