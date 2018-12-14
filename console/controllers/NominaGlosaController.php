<?php

namespace console\controllers;

use backend\modules\nomina\models\FechasPago;
use backend\modules\nomina\models\MovimientoDiario;
use backend\modules\nomina\models\Nompercepciondeduccion;
use backend\modules\nomina\models\Nomina;
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
        $hoy = $fecha->getTimestamp();

        // Selecciona y marca la nomina a procesar
        $procesando = self::procesaNomina(2);
        if ( $procesando) {
            self::setNominaDuplicados($procesando['id']);
            $colaboradores = self::getColaboradores($procesando['temporalidad_pago_id']);


            foreach ( $colaboradores as $key => $colaborador) {
                self::setNominaxPuesto($procesando['id'], $colaborador, $procesando['temporalidadPago']['multiplicador'], $hoy);
                self::setMovimientoxDia($procesando['id'], $colaborador, $hoy);
                self::setNomina($procesando['id'], $colaborador, $hoy);
            }
        }
    }

    private static function setNomina($nominaId, $colaborador, $hoy) {
        $nominaGlosa = NominaGlosa::find()
            ->where(['=', 'colaborador_id' ,$colaborador['id']])
            ->andWhere(['<>','verificador', 'DUP'])
            ->andWhere(['=','fechas_pago_id' , $nominaId])
            ->asArray()->all();


        $salario = (float)0;
        echo "\n " . $colaborador['nombre'] ;
        foreach ($nominaGlosa as $key => $glosa) {
            $salario += (float)$glosa['percepcion'] - (float)$glosa['deduccion'] + (float)$glosa['pk'] - (float)$glosa['creditos'];

            echo  "\n " .$salario . "PE " . $glosa['percepcion'] . ' DE ' . $glosa['deduccion'] . 'PK ' . $glosa['pk'] . ' CR ' . $glosa['creditos'];
        }


        $nominaUsuario = New Nomina();
        $nominaUsuario->fecha_pago_id = $nominaId;
        $nominaUsuario->salario_neto = (float)$salario;
        $nominaUsuario->colaborador_id = $colaborador['id'];
        $nominaUsuario->colaborador = $colaborador['nombre'] . ' ' . $colaborador['apaterno'] . ' ' . $colaborador['amaterno'];
        $nominaUsuario->puesto_id = $colaborador['puesto_id'];
        $nominaUsuario->puesto = $colaborador['puesto']['puesto'];
        $nominaUsuario->created_at = $hoy;
        $nominaUsuario->forma_pago = $colaborador['forma_pago'];
        if ($colaborador['forma_pago'] == 'TARJETA') {
            $nominaUsuario->numero_cuenta = $colaborador['numero_cuenta'];
        }
        $nominaUsuario->save();



    }

    /**
     * @param $nominaId - Id de la nomina que se va a procesar
     * @param $colaborador - Array con la informacion del colaborador para obtener la nomina de acuerdo a su puesto
     * @param $hoy - Fecha en que se realice el registro de la nomina por puesto
     */
    private static function setMovimientoxDia($nominaId, $colaborador, $hoy) {

        $diarios = MovimientoDiario::find()
            ->joinWith('movimientoNomina')
            ->where([
                'colaborador_id' => $colaborador['id'],
                'aplicado_en_nomina' => 0
            ])->asArray()->all();

        foreach ($diarios as $key3 => $diario) {
            $nominaGlosaColaborador = new NominaGlosa();
            $nominaGlosaColaborador->colaborador_id = $colaborador['id'];
            $nominaGlosaColaborador->puesto_id = $colaborador['puesto_id'];
            $nominaGlosaColaborador->fechas_pago_id = $nominaId;
            $nominaGlosaColaborador->created_at = $hoy;
            $nominaGlosaColaborador->verificador = 'OK';
            $nominaGlosaColaborador->concepto = $diario['movimiento_fecha'] . ' : ' . $diario['movimientoNomina']['movimiento'];
            $nominaGlosaColaborador->deduccion = 0;
            $nominaGlosaColaborador->pk = 0;
            $nominaGlosaColaborador->creditos = 0;
            $nominaGlosaColaborador->percepcion = 0;


            print_r($diario);
            echo "<br>";

            if ($diario['movimientoNomina']['clave'] == 'DE') {
                $nominaGlosaColaborador->tipo_movimiento  =  'DEDUCCION';
                $nominaGlosaColaborador->deduccion = (float)$diario['monto'];
            }
            if ($diario['movimientoNomina']['clave'] == 'PK') {
                $nominaGlosaColaborador->tipo_movimiento  =  'LOCAL';
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

    /**
     * @param $nominaId - Id de la nomina que se va a procesar
     * @param $colaborador - Array con la informacion del colaborador para obtener la nomina de acuerdo a su puesto
     * @param $diasLaborados - Multiplicador de los días laborados xDia = 1 xQuincena  =15.2
     * @param $fechaProcesadoNomina - Fecha en que se realice el registro de la nomina por puesto
     */
    private static function setNominaxPuesto($nominaId, $colaborador, $diasLaborados, $fechaProcesadoNomina) {
        $percepciones = Nompercepciondeduccion::find()->select(['clave_tipopd', 'monto'])
            ->joinWith('claveTipopd')
            ->where([
                'puesto_id' => $colaborador['puesto_id'
                ]])->asArray()->all();

        foreach ($percepciones as $key2 => $percepcion) {
            //print_r($percepcion);
            // INSERTANDO LOS DATOS DE LA NOMINA
            $nominaGlosaColaborador = New NominaGlosa();
            $nominaGlosaColaborador->colaborador_id = $colaborador['id'];
            $nominaGlosaColaborador->puesto_id = $colaborador['puesto_id'];
            $nominaGlosaColaborador->tipo_movimiento  =  $percepcion['clave_tipopd'];
            $nominaGlosaColaborador->deduccion = 0;
            $nominaGlosaColaborador->pk = 0;
            $nominaGlosaColaborador->creditos = 0;
            $nominaGlosaColaborador->percepcion = (float)( $percepcion['monto']) * (float)( $diasLaborados);
            $nominaGlosaColaborador->fechas_pago_id = $nominaId;
            $nominaGlosaColaborador->created_at = $fechaProcesadoNomina;
            $nominaGlosaColaborador->concepto = $percepcion['claveTipopd']['concepto'];
            $nominaGlosaColaborador->verificador = 'OK';
            $nominaGlosaColaborador->save();
        }
    }

    /**
     * Si se llega a duplicar una misma fecha de pago, esta se marca como duplicada en la Glosa
     * Se marcan como duplicados los que ya se encuentren registrados con anterioridad con la misma fecha de pago
     * @param $nomina_id
     * @todo VERIFICAR MAS ADELANTE QUE NO SE DUPLIQEN FECHAS Y NO SOLO LOS IDS
     */
    private static function setNominaDuplicados ($nomina_id) {
        NominaGlosa::updateAll(['verificador' => 'DUP'], ' fechas_pago_id = ' . $nomina_id);
    }

    /**
     * Obtiene el listado de los colaboradores que coinciden con la temporalidad de pago ( Semana, Quincena, ... )
     * @param $temporalidad
     */
    private static function getColaboradores($temporalidad) {

        // Seleccionando la nomina a procesar
        // $temp = Colaboradores::find()->select(['id', 'puesto_id', 'temporalidad_pago_id', 'nombre', 'apaterno', 'amaterno', 'forma_pago', 'numero_cuenta'])->where(['activo' => 1, 'temporalidad_pago_id' => $temporalidad])->asArray()->createCommand();
        //        echo $temp->sql;
        return Colaboradores::find()->select(['colaboradores.id', 'puesto_id', 'puesto', 'temporalidad_pago_id', 'nombre', 'apaterno', 'amaterno', 'forma_pago', 'numero_cuenta'])
            ->joinWith('puesto')
            ->where([
            'activo' => 1,
            'temporalidad_pago_id' => $temporalidad
        ])->asArray()->all();
    }

    /**
     * Estableciendo el estado en el que se encuentra el CRON
     * @param int $estado_proceso
     * @return array|null|void|\yii\db\ActiveRecord
     */
    private static function procesaNomina ($estado_proceso = 2) {

        // Seleccionando la nomina a procesar
        // $temp = FechasPago::find()->select(['fechas_pago.id', 'de', 'hasta', 'temporalidad_pago_id', 'estado_proceso'])
        //            ->joinWith('temporalidadPago')
        //            ->where(['estado_proceso' => 1])->asArray()->createCommand();
        //        echo $temp->sql;
        $nomina = FechasPago::find()->select(['fechas_pago.id', 'de', 'hasta', 'temporalidad_pago_id', 'estado_proceso'])
            ->joinWith('temporalidadPago')
            ->where(['estado_proceso' => 1])->asArray()->one();

        if ($nomina) {
            $nomina_actualiza = FechasPago::find()->where(['id' => $nomina['id']])->one();
            if ($nomina_actualiza) {
                $nomina_actualiza->estado_proceso = $estado_proceso;
                $nomina_actualiza->save();
                return $nomina;
            }
        } else {
            return;
        }
    }


    public function actionIndex_ori() {

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

        echo "\n Se actualiza la nomina ";


        $colaboradores = Colaboradores::find()->select(['id', 'puesto_id', 'temporalidad_pago_id', 'nombre', 'apaterno', 'amaterno', 'forma_pago', 'numero_cuenta'])->where([
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

        echo "\n Se marcan como duplicados los que ya se encuentren registrados con anterioridad con la misma fecha de pago";

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
                $nominaGlosaColaborador->verificador = 'OK';
                $nominaGlosaColaborador->save();
            }

            echo "\n Se registran las nominas basicas";

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
                $nominaGlosaColaborador->verificador = 'OK';
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

            echo "\n Se registran los movimiento sdiarios";



            // Insertando la Nomina por usuario


            $nominaGlosa = NominaGlosa::find()
                ->where(['=', 'colaborador_id' ,$colaborador['id']])
                ->andWhere(['<>','verificador', 'DUP'])
                ->andWhere(['=','fechas_pago_id' , $nomina['id']])
                ->asArray()->all();

            $salario = (float)0;
            echo "\n " . $colaborador['nombre'] ;
            foreach ($nominaGlosa as $key => $glosa) {
                $salario += (float)$glosa['percepcion'] - (float)$glosa['deduccion'] - (float)$glosa['pk'] - (float)$glosa['creditos'];

                echo  "\n " .$salario . "PE " . $glosa['percepcion'] . ' DE ' . $glosa['deduccion'] . 'PK ' . $glosa['pk'] . ' CR ' . $glosa['creditos'];
            }
            $nominaUsuario = New Nomina();
            $nominaUsuario->fecha_pago_id = $nomina['id'];
            $nominaUsuario->salario_neto = (float)$salario;
            $nominaUsuario->colaborador_id = $colaborador['id'];
            $nominaUsuario->colaborador = $colaborador['nombre'] . ' ' . $colaborador['apaterno'] . ' ' . $colaborador['amaterno'];
            $nominaUsuario->puesto_id = $colaborador['puesto_id'];
            $nominaUsuario->forma_pago = $colaborador['forma_pago'];
            if ($colaborador['forma_pago'] == 'TARJETA') {
                $nominaUsuario->numero_cuenta = $colaborador['numero_cuenta'];
            }
            $nominaUsuario->save();




        }

        // update movimiento_diario set aplicado_en_nomina = 1 where  movimiento_fecha <'2018-10-16' and id <50;

        //  select c.nombre, c.apaterno, p.puesto, n.tipo_movimiento, n.percepcion, n.deduccion, n.creditos, n.concepto, n.pk  from nomina_glosa as n join colaboradores as c on (n.colaborador_id = c.id) join catpuestos as p on (c.puesto_id = p.id);

        /*

        select c.nombre, c.apaterno, p.puesto, n.tipo_movimiento, n.percepcion, n.deduccion, n.creditos, n.concepto, n.pk  from nomina_glosa as n join colaboradores as c on (n.colaborador_id = c.id) join catpuestos as p on (c.puesto_id = p.id)
        INTO OUTFILE '/mnt/c/Projects/mopoua/mopopua.csv'
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n';
         */

        echo "Nomina Desglosada";
    }

    public function actionMail($to) {
        echo "Sending mail to " . $to;
    }

}