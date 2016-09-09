<?php

namespace backend\modules\mrp\models;

//use Yii;

/**
 * This is the model class for table "unidadmedida".
 *
 * @property integer $id
 * @property string $unidad
 * @property string $descripcion
 * @property string $tipo_unidad
 */
class Unidadmedida extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unidadmedida';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unidad', 'descripcion', 'tipo_unidad'], 'required'],
            [['unidad'], 'string', 'max' => 6],
            [['descripcion'], 'string', 'max' => 30],
            [['tipo_unidad'], 'string', 'max' => 20],
            [['descripcion'], 'unique'],
            [['unidad'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unidad' => 'Unidad',
            'descripcion' => 'Descripcion',
            'tipo_unidad' => 'Tipo Unidad',
        ];
    }

    /**
     * Listado de los tipos de unidad disponibles
     * @return array
     */
    public static function arreglotipounidad() {
        return array('PESO' => 'PESO' ,
            'VOLUMEN' => 'VOLUMEN' ,
            'CANTIDAD' => 'CANTIDAD' ,
            'TEMPERATURA' => 'TEMPERATURA'
        );
    }
}
