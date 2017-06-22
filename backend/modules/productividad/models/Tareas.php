<?php

namespace backend\modules\productividad\models;

use backend\modules\nomina\models\Colaboradores;
use Yii;
use yii\db\Query;

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
 * @property Colaboradores $userRealizo
 * @property Colaboradores $userSolicita
 * @property Prodcatalogos $estado
 * @property Prodcatalogos $tipoactividad
 * @property Colaboradores $asignado
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
            [['user_realizo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colaboradores::className(), 'targetAttribute' => ['user_realizo_id' => 'id']],
            [['user_solicita_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colaboradores::className(), 'targetAttribute' => ['user_solicita_id' => 'id']],
            [['estado_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prodcatalogos::className(), 'targetAttribute' => ['estado_id' => 'id']],
            [['tipoactividad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prodcatalogos::className(), 'targetAttribute' => ['tipoactividad_id' => 'id']],
            [['asignado_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colaboradores::className(), 'targetAttribute' => ['asignado_id' => 'id']],
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
    public function getUserRealizo()
    {
        return $this->hasOne(Colaboradores::className(), ['id' => 'user_realizo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSolicita()
    {
        return $this->hasOne(Colaboradores::className(), ['id' => 'user_solicita_id']);
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
    public function getTipoactividad()
    {
        return $this->hasOne(Prodcatalogos::className(), ['id' => 'tipoactividad_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsignado()
    {
        return $this->hasOne(Colaboradores::className(), ['id' => 'asignado_id']);
    }

    public function beforeSave($insert)
    {
        if ( parent::beforeSave($insert) ) {
            if ($this->isNewRecord) {
                $this->user_solicita_id =  Yii::$app->user->identity->colaborador_id;
                $this->estado_id = Prodcatalogos::getEstadoDefecto();
                $this->created = date('Y-m-d H:i:s');
            }
            if (!empty($this->resultado) ) {
                $this->user_realizo_id =  Yii::$app->user->identity->colaborador_id;
                $this->estado_id = Prodcatalogos::getEstadoFinalizado();
            }
            $this->modified = date('Y-m-d H:i:s');
            //             [['asignado_id', 'area_apoyo', 'estado', 'tarea', 'fecha_limite', 'user_solicita_id'], 'required'],

            return true;
        }
        return false;
    }

    /**
     * Obtiene el área laboral en la que se encuentra asignado el usuario logueado; y en caso de ser el Administrador User(id) = 1, devuelve 0
     * @return int
     */
    public static function getAreaLaboral () {

        //$identificador['area_id']=0;
        if (Yii::$app->user->identity->id != 1) {
            $identificador = (new Query())
                ->select(['area', 'area_id'])
                ->from('colaboradores')
                ->leftJoin('catpuestos', 'colaboradores.puesto_id = catpuestos.id')
                ->leftJoin('catareapuesto', 'catareapuesto.id = catpuestos.area_id')
                ->where(['colaboradores.id' => Yii::$app->user->identity->colaborador_id])
                ->one();
            return $identificador;
        }
        return 0;
    }
}

//select area, area_id from colaboradores left join catpuestos on colaboradores.puesto_id = catpuestos.id left join catareapuesto on catareapuesto.id = catpuestos.area_id where colaboradores.id = 12;