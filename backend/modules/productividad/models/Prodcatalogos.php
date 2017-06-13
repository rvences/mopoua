<?php

namespace backend\modules\productividad\models;

use Yii;

/**
 * This is the model class for table "prodcatalogos".
 *
 * @property integer $id
 * @property string $campo
 * @property string $descripcion
 * @property integer $activo
 *
 * @property Tareas[] $tareas
 * @property Tareas[] $tareas0
 */
class Prodcatalogos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prodcatalogos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['campo', 'descripcion'], 'required'],
            [['activo'], 'integer'],
            [['campo', 'descripcion'], 'string', 'max' => 20],
            [['campo', 'descripcion'], 'unique', 'targetAttribute' => ['campo', 'descripcion'], 'message' => 'The combination of Campo and Descripcion has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'campo' => 'Campo',
            'descripcion' => 'Descripcion',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareas()
    {
        return $this->hasMany(Tareas::className(), ['estado' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareas0()
    {
        return $this->hasMany(Tareas::className(), ['tipo_actividad' => 'id']);
    }

    /**
     * Lista todos los que sean del campo estado y se encuentren activos
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getEstadoActivo() {
        return Prodcatalogos::find()->where(['activo'=>1])->andWhere(['campo'=> 'estado'])->orderBy('descripcion')->all();
    }

    public static function getTipoactividadActivo() {
        return Prodcatalogos::find()->where(['activo'=>1])->andWhere(['campo'=> 'tipoactividad'])->orderBy('descripcion')->all();
    }

    public static function getEstadoDefecto() {
        $dato = Prodcatalogos::findOne(['campo' => 'estado', 'activo' => 1, 'descripcion' => 'Planeado' ]);
        return $dato->id;
    }


    public static function getEstadoFinalizado() {
        $dato = Prodcatalogos::findOne(['campo' => 'estado', 'activo' => 1, 'descripcion' => 'Realizado' ]);
        return $dato->id;
    }
}
