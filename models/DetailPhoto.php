<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_photo".
 *
 * @property int $id
 * @property int $detail_id
 * @property int $photo
 *
 * @property Detail $detail
 */
class DetailPhoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['detail_id', 'photo'], 'required'],
            [['detail_id'], 'integer'],
            [['photo'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => Detail::class, 'targetAttribute' => ['detail_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'detail_id' => 'Detail ID',
            'photo' => 'Фотография',
        ];
    }

    /**
     * Gets query for [[Detail]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetail()
    {
        return $this->hasOne(Detail::class, ['id' => 'detail_id']);
    }

    public function upload()
    {
        if ($this->validate()) {
            $path = 'uploads/' . Yii::$app->security->generateRandomString() . '.' . $this->photo->extension;
            $this->photo->saveAs($path);
            return $path;
        } else {
            return false;
        }
    }
}
