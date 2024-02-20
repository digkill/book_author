<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $title
 * @property string $year_issue
 * @property string $description
 * @property string $isbn
 * @property string|null $photo_cover
 * @property int $creator_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $creator
 */
class Book extends ActiveRecord
{
    public $authorList = [];
    public $imageFile = null;

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function () {
                    return date('Y-m-d H:i:s');
                },
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'creator_id',
                'updatedByAttribute' => false,
                'attributes' => [
                    Model::EVENT_BEFORE_VALIDATE => ['creator_id'],
                ]
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'year_issue', 'description', 'isbn', 'authorList'], 'required'],
            [['description'], 'string'],
            [['creator_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'year_issue', 'photo_cover'], 'string', 'max' => 255],
            [['isbn'], 'string', 'max' => 20],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'year_issue' => Yii::t('app', 'Year Issue'),
            'description' => Yii::t('app', 'Description'),
            'isbn' => Yii::t('app', 'Isbn'),
            'authorList' => Yii::t('app', 'Author'),
            'photo_cover' => Yii::t('app', 'Photo Cover'),
            'creator_id' => Yii::t('app', 'Creator ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function afterSave($insert, $changedAttributes): void
    {
        parent::afterSave($insert, $changedAttributes);

        array_map(function ($authorId) {
            $author = Author::findOne($authorId);
            if ($author) {
                $this->link('authors', $author);
            }
        }, $this->authorList);

        Yii::$app->session->setFlash('success', 'Запись сохранена');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::class, ['id' => 'creator_id']);
    }

    /**
     * {@inheritdoc}
     * @return BookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BookQuery(get_called_class());
    }

    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable('books_authors', ['book_id' => 'id']);
    }
}
