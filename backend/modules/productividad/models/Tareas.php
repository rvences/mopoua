<?php

namespace backend\modules\productividad\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "tareas".
 *
 * @property integer $id
 * @property integer $asignado_id
 * @property integer $tipoactividad_id
 * @property integer $estado_id
 * @property string $tarea
 * @property string $resultado
 * @property string $fecha_limite
 * @property integer $user_solicita_id
 * @property string $modified
 * @property string $created
 * @property integer $user_realizo_id
 *
 * @property Prodcatalogos $tipoactividad
 * @property User $userSolicita
 * @property User $userRealizo
 * @property Prodcatalogos $estado
 * @property User $asignado
 */
class Tareas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tareas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['asignado_id', 'tipoactividad_id', 'tarea', 'fecha_limite'], 'required'],
            [['asignado_id', 'tipoactividad_id', 'estado_id', 'user_solicita_id', 'user_realizo_id'], 'integer'],
            [['fecha_limite', 'modified', 'created', 'user_solicita_id', 'estado_id'], 'safe'],
            [['tarea', 'resultado'], 'string', 'max' => 255],
            [['tipoactividad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prodcatalogos::className(), 'targetAttribute' => ['tipoactividad_id' => 'id']],
            [['user_solicita_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_solicita_id' => 'id']],
            [['user_realizo_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_realizo_id' => 'id']],
            [['estado_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prodcatalogos::className(), 'targetAttribute' => ['estado_id' => 'id']],
            [['asignado_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['asignado_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'asignado_id' => 'Responsable',
            'tipoactividad_id' => 'Tipo de Actividad',
            'estado_id' => 'Estado',
            'tarea' => 'Tarea',
            'resultado' => 'Resultado',
            'fecha_limite' => 'Fecha Limite',
            'user_solicita_id' => 'User Solicita ID',
            'modified' => 'Finalizado',
            'created' => 'Created',
            'user_realizo_id' => 'Realizado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoactividad()
    {
        return $this->hasOne(Prodcatalogos::className(), ['id' => 'tipoactividad_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSolicita()
    {
        return $this->hasOne(User::className(), ['id' => 'user_solicita_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRealizo()
    {
        return $this->hasOne(User::className(), ['id' => 'user_realizo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado()
    {
        return $this->hasOne(Prodcatalogos::className(), ['id' => 'estado_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsignado()
    {
        return $this->hasOne(User::className(), ['id' => 'asignado_id']);
    }

    public function beforeSave($insert)
    {
        if ( parent::beforeSave($insert) ) {
            if ($this->isNewRecord) {
                $this->user_solicita_id =  Yii::$app->user->identity->id;
                $this->estado_id = Prodcatalogos::getEstadoDefecto();
                $this->created = date('Y-m-d H:i:s');
            }
            if (!empty($this->resultado) ) {
                $this->user_realizo_id =  Yii::$app->user->identity->id;
                $this->estado_id = Prodcatalogos::getEstadoFinalizado();
            }
            $this->modified = date('Y-m-d H:i:s');
            //             [['asignado_id', 'area_apoyo', 'estado', 'tarea', 'fecha_limite', 'user_solicita_id'], 'required'],

            return true;
        }
        return false;
    }
}
