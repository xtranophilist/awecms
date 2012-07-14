<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Categories') => array('index'),
    Yii::t('app', $model->name),
);
if (!isset($this->menu) || $this->menu === array()) {
    $this->menu = array(
        array('label' => Yii::t('app', 'Update'), 'url' => array('update', 'id' => $model->id)),
        array('label' => Yii::t('app', 'Delete'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
        array('label' => Yii::t('app', 'Create'), 'url' => array('create')),
        array('label' => Yii::t('app', 'Manage'), 'url' => array('admin')),
            /* array('label'=>Yii::t('app', 'List') , 'url'=>array('index')), */
    );
}
?>

<h1><?php echo $model->name; ?></h1>
<?php echo $model->description; ?>

<?php if (count($model->pages)) { ?>
    <h2><?php echo CHtml::link(Yii::t('app', Awecms::pluralize('Sub-Page', 'Pages', count($model->pages))), array('/page/page')); ?></h2>
    <ul>
        <?php
        if (is_array($model->pages))
            foreach ($model->pages as $foreignobj) {

                echo '<li>';
                echo CHtml::link($foreignobj->title, array('/page/page/view', 'id' => $foreignobj->id));
            }
        ?></ul>
<?php } ?>