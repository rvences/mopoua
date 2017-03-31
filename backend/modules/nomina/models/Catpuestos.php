<?php

namespace backend\modules\nomina\models;

/**
 * This is the model class for table "catpuestos".
 *
 * @property integer $id
 * @property string $puesto
 * @property string $requisitos
 * @property string $funciones
 * @property string $habilidades
 * @property string $conocimientos
 * @property string $tipo_colaborador
 * @property integer $plazas
 *
 * @property Colaboradores[] $colaboradores
 * @property Nompercepciondeduccion[] $nompercepciondeduccions
 */
class Catpuestos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catpuestos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['puesto'], 'required'],
            [['puesto', 'tipo_colaborador', 'plazas'], 'required'],
            [['requisitos', 'funciones', 'habilidades', 'conocimientos'], 'string'],
            [['puesto'], 'string', 'max' => 10],
            [['puesto'], 'unique'],
            [['plazas'], 'integer'],
            [['puesto'], 'string', 'max' => 50],
            [['tipo_colaborador'], 'string', 'max' => 20],
            [['puesto', 'tipo_colaborador'], 'unique', 'targetAttribute' => ['puesto', 'tipo_colaborador'], 'message' => 'The combination of Puesto and Tipo Colaborador has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'puesto' => 'Puesto',
            'requisitos' => 'Requisitos',
            'funciones' => 'Funciones',
            'habilidades' => 'Habilidades',
            'conocimientos' => 'Conocimientos',
            'tipo_colaborador' => 'Tipo Colaborador',
            'plazas' => 'Plazas disponibles',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColaboradores()
    {
        return $this->hasMany(Colaboradores::className(), ['puesto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNompercepciondeduccions()
    {
        return $this->hasMany(Nompercepciondeduccion::className(), ['puesto_id' => 'id']);
    }

    public static function getTipocolaborador () {
        return array (
            'A PRUEBA' => 'A PRUEBA',
            'BASE' => 'BASE - TITULAR',
            'ESTUDIANTE' => 'ESTUDIANTE',
            'EVENTUAL' => 'EVENTUAL',
            'TEMPORADA' => 'TEMPORADA'
        );
    }
}
