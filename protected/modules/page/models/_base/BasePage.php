<?php

/**
 * This is the model base class for the table "page".
 *
 * Columns in table "page" available as properties of the model:

 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $content
 * @property string $status
 * @property string $created_at
 * @property string $modified_at
 * @property integer $parent_id
 * @property integer $order
 * @property string $type
 * @property string $comment_status
 * @property integer $tags_enabled
 * @property string $permission
 * @property string $password
 * @property integer $views
 * @property string $layout
 * @property integer $slug_id
 *
 * Relations of table "page" available as properties of the model:
 * @property Slug $slug
 * @property User $user
 * @property Page $parent
 * @property Page[] $pages
 * @property Category[] $categories
 */
abstract class BasePage extends CActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'page';
    }

    public function rules() {
        return array(
            array('title', 'required'),
            array('user_id, content, status, parent_id, order, comment_status, tags_enabled, permission, password, layout', 'default', 'setOnEmpty' => true, 'value' => null),
            array('user_id, parent_id, order, tags_enabled, views, slug_id', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 255),
            array('status', 'length', 'max' => 9),
            array('type, comment_status, permission, password', 'length', 'max' => 20),
            array('layout', 'length', 'max' => 100),
            array('content', 'safe'),
            array('id, user_id, title, content, status, created_at, modified_at, parent_id, order, type, comment_status, tags_enabled, permission, password, views, layout', 'safe', 'on' => 'search'),
        );
    }

    public function __toString() {
        return (string) $this->title;
    }

    public function behaviors() {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created_at',
                'updateAttribute' => 'modified_at',
            ),
            'page-behavior' => array('class' => 'PageBehavior'),
            'activerecord-relation' => array('class' => 'EActiveRecordRelationBehavior'),
            'tags' => array('class' => 'ETaggableBehavior'),
        );
    }

    public function relations() {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'parent' => array(self::BELONGS_TO, 'Page', 'parent_id'),
            'pages' => array(self::HAS_MANY, 'Page', 'parent_id'),
            'categories' => array(self::MANY_MANY, 'Category', 'page_nm_category(page_id, category_id)'),
            'slug' => array(self::BELONGS_TO, 'Slug', 'slug_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'modified_at' => Yii::t('app', 'Modified At'),
            'parent_id' => Yii::t('app', 'Parent'),
            'order' => Yii::t('app', 'Order'),
            'type' => Yii::t('app', 'Type'),
            'comment_status' => Yii::t('app', 'Comment Status'),
            'tags_enabled' => Yii::t('app', 'Tags Enabled'),
            'permission' => Yii::t('app', 'Permission'),
            'password' => Yii::t('app', 'Password'),
            'views' => Yii::t('app', 'Views'),
            'layout' => Yii::t('app', 'Layout'),
            'slug' => Yii::t('app', 'Slug'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('modified_at', $this->modified_at, true);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('order', $this->order);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('comment_status', $this->comment_status, true);
        $criteria->compare('tags_enabled', $this->tags_enabled);
        $criteria->compare('permission', $this->permission, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('views', $this->views);
        $criteria->compare('layout', $this->layout, true);

        return new CActiveDataProvider(get_class($this), array(
                    'criteria' => $criteria,
                ));
    }

}