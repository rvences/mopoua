<?php

namespace backend\modules\nomina\models;

/**
 * This is the model class for table "cattipopd".
 *
 * @property integer $id
 * @property string $clave
 * @property string $concepto
 * @property string $tipo
 * @property string $descripcion
 *
 * @property Nompercepciondeduccion[] $nompercepciondeduccions
 */
class Cattipopd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cattipopd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['concepto'], 'required'],
            [['descripcion'], 'string'],
            [['clave'], 'string', 'max' => 10],
            [['concepto'], 'string', 'max' => 255],
            [['tipo'], 'string', 'max' => 20],
            [['clave'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clave' => 'Clave',
            'concepto' => 'Concepto',
            'tipo' => 'Tipo',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNompercepciondeduccions()
    {
        return $this->hasMany(Nompercepciondeduccion::className(), ['clave_tipopd' => 'clave']);
    }

    public static function gettipopd () {
        return array(
            'BASE' => 'Salario Base (+)',
            'COMPLEMENTO' => 'Complemento Salarial, antiguedad, conocimientos especiales, turno nocturno (+)',
            'EXTRA' => 'Horas Extraordinarias (+)',
            'GRATIFICACION' => 'Gratificaciones extraordinarias (+)',
            'DEVENGOS' => 'Retenciones Fiscales (-)',
            'OTROS' => 'Indemnización, despidos, suspensiones, ceses, prendas de trabajo'
        );
    }
}



/*
 * Salario Diario Integrado
 *  http://www.fundacionunam.org.mx/humanidades/que-es-el-salario-integrado-y-como-se-calcula/
 *  Para saber cuánto es del SDI, se suman los 365 días del año, más quince días de aguinaldo, más 1.5 días.
 *  Esto último es el resultado de la multiplicación de 6 días de vacaciones por 25% de la prima vacacional.
 *  365 días del año
 *  15 días de aguinaldo
 *  1.5 días (6 días por 0.25= 1.5)
 *  La suma de estos días es 381.5
 *  Este resultado se divide entre 365 días y se obtiene 1.0452 = el factor de integración mínimo,
 * */


/**
 * Dias al año 365
 * Quincenas = 24
 * Pagar 15.20, inclusive para cuando descuentes días y consideres la parte proporcional del domingo te será mas practico.
 */