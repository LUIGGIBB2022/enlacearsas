<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\detalledefactura;
use App\Models\factura;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class OnlyInvoiceController extends Controller
{
    public function OnlyInvoice(Request $request):JsonResponse
    {
        $contador = 0;
        if (isset($request->datafatura))
        {
            $facturas        = $request->datafactura;
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
                $lapso          = $fechafac->format('Y')->$fechafac->format('m');
                $totalfactura   = $factura['valorfactura'] + $factura['valoriva'] + $factura['valorfactura'] + $factura['valoradicional'] -
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
                    'saldoencartera '       => is_null($factura['saldocartera'])?0:$factura['saldocartera'],
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
