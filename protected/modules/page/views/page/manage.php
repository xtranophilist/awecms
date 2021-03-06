<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Pages') => array('/page'),
    Yii::t('app', 'Manage'),
);
if (!isset($this->menu) || $this->menu === array())
    $this->menu = array(
        array('label' => Yii::t('app', 'All Pages'), 'url' => array('/page')),
        array('label' => Yii::t('app', 'Create New Page'), 'url' => array('/page/page/create')),
        array('label' => Yii::t('app', 'Manage Pages')),
        array('label' => Yii::t('app', 'All Contents'), 'url' => array('/page/page/content')),
    );
?>

<h1>
    <?php echo Yii::t('app', 'Manage'); ?> <?php echo Yii::t('app', 'Pages'); ?>
</h1>

<?php
if (count($page->search()->data)) {
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'page-grid',
        'dataProvider' => $page->search(),
        'filter' => $page,
        'columns' => array(
            'title',
            array(
                'name' => 'user_id',
                'value' => 'isset($data->user->username)?$data->user->username:"N/A"'
            ),
            'status',
            'created_at',
            'modified_at',
//            'comment_status',
//            array(
//                'class' => 'JToggleColumn',
//                'name' => 'tags_enabled',
//                'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
//                'model' => get_class($page),
//                'htmlOptions' => array('style' => 'text-align:center;min-width:60px;')
//            ),
            'views',
            array(
                'class' => 'CButtonColumn',
            ),
        ),
    ));
} else {
    echo Yii::t('app', 'No results found!');
}