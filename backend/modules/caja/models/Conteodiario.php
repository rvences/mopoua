<?php

namespace backend\modules\caja\models;

use Yii;

/**
 * This is the model class for table "conteodiario".
 *
 * @property integer $id
 * @property string $username
 * @property integer $inal1
 * @property integer $inal2
 * @property integer $inal3
 * @property integer $inal4
 * @property integer $inal5
 * @property integer $inal6
 * @property integer $inal7
 * @property integer $inal8
 * @property integer $inal9
 * @property integer $inal10
 * @property integer $inal11
 * @property integer $inal12
 * @property integer $inal13
 * @property integer $inal14
 * @property integer $inal15
 * @property integer $inal16
 * @property integer $iext1
 * @property integer $iext2
 * @property string $fapertura
 * @property integer $cnal1
 * @property integer $cnal2
 * @property integer $cnal3
 * @property integer $cnal4
 * @property integer $cnal5
 * @property integer $cnal6
 * @property integer $cnal7
 * @property integer $cnal8
 * @property integer $cnal9
 * @property integer $cnal10
 * @property integer $cnal11
 * @property integer $cnal12
 * @property integer $cnal13
 * @property integer $cnal14
 * @property integer $cnal15
 * @property integer $cnal16
 * @property integer $cext1
 * @property integer $cext2
 * @property string $fcierre
 * @property string $montoapertura
 * @property string $montocierre
 * @property integer $arqueo_id
 *
 * @property Arqueo $arqueo
 */
class Conteodiario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conteodiario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'default', 'value' =>  Yii::$app->user->identity->username],
            [['inal1', 'inal2', 'inal3', 'inal4', 'inal5', 'inal6', 'inal7', 'inal8', 'inal9', 'inal10', 'inal11', 'inal12', 'inal13', 'inal14', 'inal15', 'inal16', 'iext1', 'iext2', 'cnal1', 'cnal2', 'cnal3', 'cnal4', 'cnal5', 'cnal6', 'cnal7', 'cnal8', 'cnal9', 'cnal10', 'cnal11', 'cnal12', 'cnal13', 'cnal14', 'cnal15', 'cnal16', 'cext1', 'cext2', 'arqueo_id'], 'integer'],
            [['fapertura', 'fcierre'], 'safe'],
            [['montoapertura', 'montocierre'], 'number'],
            [['username'], 'string', 'max' => 255],
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
            'inal1' => 'Inal1',
            'inal2' => 'Inal2',
            'inal3' => 'Inal3',
            'inal4' => 'Inal4',
            'inal5' => 'Inal5',
            'inal6' => 'Inal6',
            'inal7' => 'Inal7',
            'inal8' => 'Inal8',
            'inal9' => 'Inal9',
            'inal10' => 'Inal10',
            'inal11' => 'Inal11',
            'inal12' => 'Inal12',
            'inal13' => 'Inal13',
            'inal14' => 'Inal14',
            'inal15' => 'Inal15',
            'inal16' => 'Inal16',
            'iext1' => 'Iext1',
            'iext2' => 'Iext2',
            'fapertura' => 'Fapertura',
            'cnal1' => 'Cnal1',
            'cnal2' => 'Cnal2',
            'cnal3' => 'Cnal3',
            'cnal4' => 'Cnal4',
            'cnal5' => 'Cnal5',
            'cnal6' => 'Cnal6',
            'cnal7' => 'Cnal7',
            'cnal8' => 'Cnal8',
            'cnal9' => 'Cnal9',
            'cnal10' => 'Cnal10',
            'cnal11' => 'Cnal11',
            'cnal12' => 'Cnal12',
            'cnal13' => 'Cnal13',
            'cnal14' => 'Cnal14',
            'cnal15' => 'Cnal15',
            'cnal16' => 'Cnal16',
            'cext1' => 'Cext1',
            'cext2' => 'Cext2',
            'fcierre' => 'Fcierre',
            'montoapertura' => 'Montoapertura',
            'montocierre' => 'Montocierre',
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
