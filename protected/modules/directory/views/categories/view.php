<?php
$this->breadcrumbs = array();
$this->breadcrumbs[Yii::t('app', 'Business Directory')] = array('/directory');
$this->breadcrumbs = array_merge($this->breadcrumbs, $model->getHierarchyLinks());

if (!isset($this->menu) || $this->menu === array()) {
    $this->menu = array(
        array('label' => Yii::t('app', 'List All'), 'url' => array('/directory/business')),
        array('label' => Yii::t('app', 'Add New'), 'url' => array('/directory/business/create')),
        array('label' => Yii::t('app', 'Manage All'), 'url' => array('/directory/business/manage')),
        array('label' => Yii::t('app', 'All Categories'), 'url' => array('/directory/categories')),
        array('label' => Yii::t('app', 'Create New Category'), 'url' => array('/directory/categories/create')),
        array('label' => Yii::t('app', 'Manage All Categories'), 'url' => array('/directory/categories/manage')),
        array('label' => Yii::t('app', 'View Category')),
        array('label' => Yii::t('app', 'Update This Category'), 'url' => array('update', 'id' => $model->id)),
        array('label' => Yii::t('app', 'Delete This Category'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    );
}
?>

<?php


$this->renderPartial('_tree', array(
    'items' => $model->tree[0]->children,
    'depth' => 0,
));
?>
<?php
print_r($model->allBusinesses);

echo "haha";

//print_r($model);

if (count($model->businesses)) {
    ?>
    <h2><?php echo Yii::t('app', Awecms::pluralize('Business', 'Businesses', $model->businesses)); ?>:</h2>
    <ul>
        <?php
        if (is_array($model->businesses))
            foreach ($model->businesses as $foreignobj) {

                echo '<li>';
                echo CHtml::link($foreignobj->title, array('/directory/business/view', 'id' => $foreignobj->id));
                echo '</li>';
            }
        ?>
    </ul>
<?php } ?>