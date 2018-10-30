<?php

namespace console\controllers;

use backend\modules\nomina\models\FechasPago;
use backend\modules\nomina\models\MovimientoDiario;
use backend\modules\nomina\models\Nompercepciondeduccion;
use yii\console\Controller;
use backend\modules\nomina\models\NominaGlosa;
use backend\modules\nomina\models\Colaboradores;
/**
 * Test controller
 */
class NominaGlosaController extends Controller {

    public function actionIndex() {

        // Fecha en que se inicia el proceso
        $fecha = new \DateTime();
        $fecha = $fecha->getTimestamp();

        // Estado al que se cambia cuando se inicializa el CRON
        $estado_proceso = 2;


        // Nominas a Procesar
        $nomina = FechasPago::find()->select(['fechas_pago.id', 'de', 'hasta', 'temporalidad_pago_id', 'estado_proceso'])
            ->joinWith('temporalidadPago')
            ->where(['estado_proceso' => 1])->asArray()->one();
        // Array
        //(
        //    [id] => 2
        //    [de] => 2018-10-01
        //    [hasta] => 2018-10-15
        //    [temporalidad_pago_id] => 4
        //    [temporalidadPago] => Array
        //        (
        //            [id] => 4
        //            [temporalidad] => POR QUINCENA
        //            [multiplicador] => 15.20
        //        )
        //
        //)

        $nomina_actualiza = FechasPago::find()->where(['id' => $nomina['id']])->one();
        if ($nomina_actualiza) {
            $nomina_actualiza->estado_proceso = $estado_proceso;
            $nomina_actualiza->save();
        }


        $colaboradores = Colaboradores::find()->select(['id', 'puesto_id', 'temporalidad_pago_id', 'nombre'])->where([
            'activo' => 1,
            'temporalidad_pago_id' => $nomina['temporalidad_pago_id']
        ])->asArray()->all();

        // Array
        //(
        //    [0] => Array
        //        (
        //            [id] => 1
        //            [puesto_id] => 1
        //            [temporalidad_pago_id] => 4
        //            [nombre] => ALEJANDRA
        //        )
        //
        //)
        //print_r($colaboradores);

        NominaGlosa::updateAll(['verificador' => 'DUP'], ' fechas_pago_id = ' . $nomina['id']);

        foreach ($colaboradores as $key => $colaborador) {
            $percepciones = Nompercepciondeduccion::find()->select(['clave_tipopd', 'monto'])
                ->joinWith('claveTipopd')
                ->where([
                'puesto_id' => $colaborador['puesto_id'
                ]])->asArray()->all();
            //Array
            //(
            //    [0] => Array
            //        (
            //            [clave_tipopd] => SALARIO1
            //            [monto] => 104.73
            //            [claveTipopd] => Array
            //                (
            //                    [id] => 1
            //                    [clave] => SALARIO1
            //                    [concepto] => Salario Base Bruto
            //                    [tipo] => BASE
            //                    [descripcion] => Salario de acuerdo a su puesto
            //                )
            //        )
            //)
            //print_r($percepciones);

            foreach ($percepciones as $key2 => $percepcion) {
                //print_r($percepcion);
                // INSERTANDO LOS DATOS DE LA NOMINA
                $nominaGlosaColaborador = New NominaGlosa();
                $nominaGlosaColaborador->colaborador_id = $colaborador['id'];
                $nominaGlosaColaborador->puesto_id = $colaborador['puesto_id'];
                $nominaGlosaColaborador->tipo_movimiento  =  $percepcion['clave_tipopd'];
                $nominaGlosaColaborador->percepcion = (float)( $percepcion['monto']) * (float)( $nomina['temporalidadPago']['multiplicador']);
                $nominaGlosaColaborador->fechas_pago_id = $nomina['id'];
                $nominaGlosaColaborador->created_at = $fecha;
                $nominaGlosaColaborador->concepto = $percepcion['claveTipopd']['concepto'];
                $nominaGlosaColaborador->save();
            }

            //  INSERTANDO LOS DATOS DEL MOVIMIENTO DIARIO


            $diarios = MovimientoDiario::find()
                ->joinWith('movimientoNomina')
                ->where([
                    'colaborador_id' => $colaborador['id'],
                    'aplicado_en_nomina' => 0
                ])->asArray()->all();
            //Array
            //(
            //    [0] => Array
            //        (
            //            [id] => 1
            //            [colaborador_id] => 1
            //            [movimiento_fecha] => 2018-10-25
            //            [movimiento_nomina_id] => 3
            //            [movimiento_nomina_info] =>
            //            [monto] => 240.00
            //            [aplicado_en_nomina] => 0
            //            [nomina_glosa_id] =>
            //            [created_at] =>
            //            [created_by] =>
            //            [movimientoNomina] => Array
            //                (
            //                    [id] => 3
            //                    [clave] => DE
            //                    [movimiento] => ANTICIPO DE QUINCENA
            //                    [descripcion] => Anticipo de hasta el 60% de lo laborado
            //                )
            //        )
            //)

            foreach ($diarios as $key3 => $diario) {
                $nominaGlosaColaborador = new NominaGlosa();
                $nominaGlosaColaborador->colaborador_id = $colaborador['id'];
                $nominaGlosaColaborador->puesto_id = $colaborador['puesto_id'];
                $nominaGlosaColaborador->fechas_pago_id = $nomina['id'];
                $nominaGlosaColaborador->created_at = $fecha;
                $nominaGlosaColaborador->concepto = $diario['movimiento_fecha'] . ' : ' . $diario['movimientoNomina']['movimiento'];
                if ($diario['movimientoNomina']['clave'] == 'DE') {
                    $nominaGlosaColaborador->tipo_movimiento  =  'DEDUCCION';
                    $nominaGlosaColaborador->deduccion = (float)$diario['monto'];
                }
                if ($diario['movimientoNomina']['clave'] == 'PK') {
                    $nominaGlosaColaborador->tipo_movimiento  =  'ESTABLECIMIENTO';
                    $nominaGlosaColaborador->pk = (float)$diario['monto'];
                }
                if ($diario['movimientoNomina']['clave'] == 'CR') {
                    $nominaGlosaColaborador->tipo_movimiento  =  'CREDITO';
                    $nominaGlosaColaborador->creditos = (float)$diario['monto'];
                }
                if ($diario['movimientoNomina']['clave'] == 'PE') {
                    $nominaGlosaColaborador->tipo_movimiento  =  'PERCEPCION';
                    $nominaGlosaColaborador->percepcion = (float)$diario['monto'];
                }
                $nominaGlosaColaborador->save();
                #VERIFICAR ERRORES ANTES DE CONTINUAR
                MovimientoDiario::updateAll([
                    'aplicado_en_nomina' => 1,
                    'nomina_glosa_id' => $nominaGlosaColaborador->id
                    ], [
                    'id' => $diario['id']
                ]);


            }
        }




        echo "Nomina Desglosada";
    }

    public function actionMail($to) {
        echo "Sending mail to " . $to;
    }

}