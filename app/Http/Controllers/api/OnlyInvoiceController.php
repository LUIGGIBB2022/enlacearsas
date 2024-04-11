<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\cliente;
use App\Models\detalledefactura;
use App\Models\factura;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class OnlyInvoiceController extends Controller
{
    public function OnlyClient(Request $request):JsonResponse
    {
        $contador = 0;
        if (isset($request->dataclientes))
        {
            return response()->json(
                [
                 'status'           => '200',
                 'msg'              => 'Salida Exitosa Clientes',
                ],Response::HTTP_ACCEPTED);

            $clientes   = $request->dataclientes;

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
            return response()->json(
                [
                 'status'           => '200',
                 'msg'              => 'Salida Exitosa',
                ],Response::HTTP_ACCEPTED);
        }
    }

    public function OnlyInvoice(Request $request):JsonResponse
    {


        $contador = 0;
        if (isset($request->datafactura))
        {
            $facturas        = $request->datafactura;
            $xcuantos        = count($facturas);

            foreach ($facturas as $factura)
            {
                $contador++;
                $numerofactura  = $factura['numerofactura'];
                $prefijo        = $factura['prefijo'];
                $tipodcto       = $factura['tipodocumento'];
                $fechafac       = $factura['fechafactura'];
                $fecha          = Carbon::parse($factura['fechafactura']);
                $nit            = $factura['nit'];
                $sucursal       = $factura['sucursal'];
                $lapso          = $fecha->format('Y') . $fecha->format('m');
                $totalfactura   = $factura['valorfactura'] + $factura['valoriva'] +  $factura['valoradicional'] -
                                  $factura['retencion'] - $factura['reteiva'] - $factura['reteica'] - $factura['dsctosproductos'] -
                                  $factura['dsctosadicionales'];

                $reg_fact       = factura::updateOrCreate(['numerodefactura'=>$numerofactura, 'prefijo'=>$prefijo, 'tipodedocumento' => $tipodcto,'fechafactura' => $fechafac],
                [
                    'horashabitacion'      => $factura['horahabitac'],
                    'fechavencimiento'     => $factura['fechavencimiento'],
                    'cufe'                 => is_Null($factura['textoiva'])?"":$factura['textoiva'],
                    'habitacion'           => is_null($factura['habitacion'])?"":$factura['habitacion'],
                    'fechadeentrada'       => $factura['fechaentradah'],
                    'fechadesalida'        => $factura['fechaentradah'],
                    'lapso'                => $lapso,
                    'numerodepedido'       => $factura['npedido'],
                    'numerodecompra'       => $factura['nocompra'],
                    'nit'                  => $factura['nit'],
                    'sucursal'             => $factura['sucursal'],
                    'nombreventa'          => is_null($factura['nombreventa'])?"":$factura['nombreventa'],
                    'paciente'             => is_null($factura['paciente'])?"":$factura['paciente'],
                    'propina'              => $factura['propina'],
                    'valorfactura'         => $factura['valorfactura'],
                    'descuentosproductos'  => $factura['dsctosproductos'],
                    'descuentosadicionales'=> $factura['dsctosadicionales'],
                    'ventasexentas'        => $factura['ventasexentas'],
                    'ventagravadas'        => $factura['ventasgravadas'],
                    'valoradicional'       => $factura['valoradicional'],
                    'flete'                => $factura['flete'],
                    'retefuente'           => $factura['retencion'],
                    'reteiva'              => $factura['reteiva'],
                    'valoriva'             => $factura['valoriva'],
                    'reteica'              => $factura['reteica'],
                    'otrasret1'            => $factura['otrasretenciones1'],
                    'otrasret2'            => $factura['otrasretenciones2'],
                    'otrasret3'            => $factura['otrasretenciones3'],
                    'otrasret4'            => $factura['otrasretenciones4'],
                    'otrasret5'            => $factura['otrasretenciones5'],
                    'valordescuento1'      => 0,
                    'valordescuento2'      => 0,
                    'valordescuento3'      => 0,
                    'numerodecompra'       => 0,
                    'numeroderegistros'    => $factura['valorreteivatj'],
                    'totalfactura'         => $totalfactura,
                    'costodeventa'         => $factura['costodeventa'],
                    'tipodefactura'        => $factura['tipofactura'],
                    'centrooper'           => $factura['centrooper'],
                    'proyecto'             => is_null($factura['proyecto'])?"":$factura['proyecto'],
                    'sproyecto'            => is_null($factura['sproyecto'])?"":$factura['sproyecto'],
                    'estado'               => $factura['estado'],
                    'estado01'             => $factura['estado01'],
                    'estado02'             => $factura['estado02'],
                    'estado03'             => $factura['estado03'],
                    'usuario_created'      => $factura['usuc_audi'],
                    'usuario_updated'      => $factura['usum_audi'],
                     //-- Actualizar Campos obligatorios
                    'clientesid'            => 1,
                    'vendedorid'            => 1,
                    'horadefactura'         => $factura['horafactura'],
                    'cuenta'                => is_null($factura['cuenta'])?"":$factura['cuenta'],
                    'centro'                => is_null($factura['centro'])?"":$factura['centro'],
                    'scentro'               => is_null($factura['scentro'])?"":$factura['scentro'],
                    'actividad'             => is_null($factura['actividad'])?"":$factura['actividad'],
                    'observaciones'         => is_null($factura['observaciones'])?"":$factura['observaciones'],
                    'nitarrendatario'       => is_null($factura['nitarrendatario'])?"":$factura['nitarrendatario'],
                    'sucursalarrendatario'  => is_null($factura['sucursalarrendatario'])?"":$factura['sucursalarrendatario'],
                    'propiedad'             => is_null($factura['propiedad'])?"":$factura['propiedad'],
                    'contrato'              => "",
                    'caja'                  => is_null($factura['caja'])?"":$factura['caja'],
                    'cajero'                => is_null($factura['cajero'])?"":$factura['cajero'],
                    'mesa'                  => is_null($factura['mesa'])?"":$factura['mesa'],
                    'mesero'                => is_null($factura['mesero'])?"":$factura['mesero'],
                    'conceptodeinterface'   => "",
                    'lista'                 => $factura['lista'],
                    'plan'                  => is_null($factura['plan'])?"":$factura['plan'],
                    'transportador'         => is_null($factura['transportador'])?"":$factura['transportador'],
                    'placa'                 => is_null($factura['placa'])?"":$factura['placa'],
                    'tipodepago'            => is_null($factura['tipodepago'])?"":$factura['tipodepago'],
                    'numerodedocumento'     => is_null($factura['numerodocumento'])?"":$factura['numerodocumento'],
                    'valordelpago'          => is_null($factura['valordelpago'])?0:$factura['valordelpago'],
                    'valorotrodocumento'    => is_null($factura['valordelpago'])?0:$factura['valordelpago'],
                    'documentodian'         => is_null($factura['valorotrodocumento'])?0:$factura['valorotrodocumento'],
                    'tecnico'               => is_null($factura['vendedor'])?"":$factura['vendedor'],
                    'profesional'           => "",
                    'codigodedescuento'     => is_null($factura['codigodedescuentos'])?"":$factura['codigodedescuentos'],
                    'tipodecliente'         => is_null($factura['tipocliente'])?"":$factura['tipocliente'],
                    'rutadeventa'           => is_null($factura['ruta'])?"":$factura['ruta'],
                    'zonadeventa'           => is_null($factura['zona'])?"":$factura['zona'],
                    'vendedor'              => is_null($factura['vendedor'])?"":$factura['vendedor'],
                    'kilometraje'           => is_null($factura['kilometraje'])?0:$factura['kilometraje'],
                    'numerodelreparto'      => is_null($factura['nreparto'])?0:$factura['nreparto'],
                    'montodelrecaudo'       => is_null($factura['recaudosrepartos'])?0:$factura['recaudosrepartos'],
                    'saldoencartera '       => is_null($factura['saldoencartera'])?0:$factura['saldoencartera'],
                ]);

                // $numerofactura  = $factura['numerofactura'];
                // $prefijo        = $factura['prefijo'];
                // $tipodcto       = $factura['tipodocumento'];
                // $facturasID     = $reg_fact->FacturasID;
                // $clientes       = cliente::where('nit',$nit)->where('sucursal',$sucursal)->first();
                // $clientesID     = $clientes->clientesID;
                // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                // detalledefactura::where('detalledefacturas.numerodefactura',"=",$numerofactura)
                // ->where('detalledefacturas.tipodedocumento',"=",$tipodcto)
                // ->where('detalledefacturas.prefijo',"=",$prefijo)
                // ->update(['detalledefacturas.FacturasID' => $facturasID, 'detalledefacturas.ClientesID' => $clientesID]);
                // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            }
       }



        return response()->json(
            [
             'status'           => '200',
             'msg'              => 'Salida Exitosa',
            ],Response::HTTP_ACCEPTED);
    }
}
