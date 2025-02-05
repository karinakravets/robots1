<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property int $platform_id
 * @property string $name
 * @property string $icon
 * @property string|null $comment
 * @property string $date_created
 * @property string|null $date_close
 * @property int $user_id
 *
 * @property Document[] $documents
 * @property Platform $platform
 * @property ProjectDetail[] $projectDetails
 * @property User $user
 */
class Project extends \yii\db\ActiveRecord
{

    public const SCENARIO_CREATE = 'create';
    public const SCENARIO_UPDATE = 'update';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['platform_id', 'name', 'icon'], 'required'],
            [['platform_id', 'user_id'], 'integer'],
            [['date_created', 'date_close'], 'safe'],
            [['name', 'comment'], 'string', 'max' => 255],
            [['icon'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['platform_id'], 'exist', 'skipOnError' => true, 'targetClass' => Platform::class, 'targetAttribute' => ['platform_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function scenarios() {
        $scenario = [];
        $scenario[self::SCENARIO_CREATE] = ['platform_id', 'name', 'comment', 'icon'];
        $scenario[self::SCENARIO_UPDATE] = $scenario[self::SCENARIO_CREATE];
        unset($scenario[self::SCENARIO_UPDATE][3]);
        return $scenario;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'platform_id' => 'Платформа',
            'name' => 'Название',
            'icon' => 'Иконка',
            'comment' => 'Комментарий',
            'date_created' => 'Дата открытия',
            'date_close' => 'Дата закрытия',
            'user_id' => 'Консультант',
        ];
    }

    /**
     * Gets query for [[Documents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::class, ['project_id' => 'id']);
    }

    /**
     * Gets query for [[Platform]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlatform()
    {
        return $this->hasOne(Platform::class, ['id' => 'platform_id']);
    }

    /**
     * Gets query for [[ProjectDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectDetails()
    {
        return $this->hasMany(ProjectDetail::class, ['project_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function upload()
    {
        if ($this->validate()) {
            $path = 'uploads/' . Yii::$app->security->generateRandomString() . '.' . $this->icon->extension;
            $this->icon->saveAs($path);
            return $path;
        } else {
            return false;
        }
    }
}
