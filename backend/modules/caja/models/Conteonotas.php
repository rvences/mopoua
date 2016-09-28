<?php

namespace backend\modules\caja\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
/**
 * This is the model class for table "conteonotas".
 *
 * @property integer $id
 * @property string $username
 * @property string $fconteo
 * @property string $tipo
 * @property string $descripcion
 * @property string $cantidad
 * @property string $formapago
 * @property integer $arqueo_id
 *
 * @property Arqueo $arqueo
 */
class Conteonotas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conteonotas';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['fconteo'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['fconteo'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'default', 'value' =>  Yii::$app->user->identity->username],
            [['fconteo'], 'safe'],
            [['descripcion', 'cantidad'], 'required'],
            [['tipo'], 'safe'],
            [['descripcion'], 'string'],
            [['cantidad'], 'number'],
            [['arqueo_id'], 'integer'],
            [['username', 'tipo'], 'string', 'max' => 255],
            [['arqueo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Arqueo::className(), 'targetAttribute' => ['arqueo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'fconteo' => 'Fconteo',
            'tipo' => 'Tipo',
            'descripcion' => 'Comercio',
            'cantidad' => 'Cantidad',
            'arqueo_id' => 'Arqueo ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArqueo()
    {
        return $this->hasOne(Arqueo::className(), ['id' => 'arqueo_id']);
    }
}
