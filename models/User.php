<?php

namespace app\models;
use yii\web\IdentityInterface;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $password
 * @property int $is_admin
 *
 * @property Project[] $projects
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $password_repeat;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'name', 'surname', 'email', 'password','password_repeat'], 'required'],
            [['is_admin'], 'integer'],
            [['username', 'name', 'surname', 'email', 'password'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            ['email', 'email'],
            [['name', 'surname'], 'match', 'pattern' => '/^[А-Яа-яЁё\- ]+$/u', 'message' => 'Кириллица'],
            ['username', 'match', 'pattern' => '/^[A-Za-z]{6,}$/', 'message' => 'Латиница, не менее 6 символов'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],
            ['password', 'match', 'pattern' => '/^(?=.*[A-Z])(?=.*[\d])(?=.*[a-z])(?=.*[\!\@\#\$\%\^\&\*\(\)\-_\]\[])[a-zA-Z\d\!\@\#\$\%\^\&\*\(\)\-_\]\[]{8,}$/', 'message' => 'По крайней мере одна цифра, буква в верхнем регистре, буква в нижнем регистре, спецсимвол !@#$%^&*()-_][, не менее 8 символов.']

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
            'password_repeat' => 'Подтверждение пароля'
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){}

    public function getId()
    {
        return $this->id;
    }

    public static function findByUsername($username) {
        return static::findOne(['username' => $username]);
    }

    public function getAuthKey(){}

    public function validateAuthKey($authKey) {}

    public function validatePassword($password) {
        return $this->password === $password;
    }

    /**
     * Gets query for [[Projects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::class, ['user_id' => 'id']);
    }

    public static function isAdmin() {
        if (Yii::$app->user->isGuest) return false;
        return boolval(Yii::$app->user->identity->is_admin);
    }

    public static function isConsultant($project) {
        return !Yii::$app->user->isGuest && $project->user_id == Yii::$app->user->identity->id;
    }

}
