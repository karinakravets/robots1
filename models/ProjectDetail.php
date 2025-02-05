<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_detail".
 *
 * @property int $id
 * @property int $project_id
 * @property int $detail_id
 * @property int $count
 *
 * @property Detail $detail
 * @property Project $project
 */
class ProjectDetail extends \yii\db\ActiveRecord
{
    public $missing;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'detail_id', 'count'], 'required'],
            [['project_id', 'detail_id', 'count'], 'integer'],
            ['missing', 'boolean'],
            [['detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => Detail::class, 'targetAttribute' => ['detail_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'detail_id' => 'Деталь',
            'count' => 'Количество',
            'missing' => 'Недостающая',
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

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if (boolval($this->missing)) $this->count *= -1;
        return true;
    }
}
