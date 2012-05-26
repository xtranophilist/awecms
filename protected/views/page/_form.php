<div class="form">
    <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
    </p>

    <?php
    $form=$this->beginWidget('CActiveForm', array(
    'id'=>'page-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    ));

    echo $form->errorSummary($model);
    ?>
    
        <div class="row">
            <?php echo $form->labelEx($model,'user_id'); ?>
            <?php echo $form->dropDownList($model, 'user', CHtml::listData(User::model()->findAll(),'id', 'username')); ?>
            <?php echo $form->error($model,'user_id'); ?>
        </div><!-- row -->
        
        <div class="row">
            <?php echo $form->labelEx($model,'title'); ?>
            <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'title'); ?>
        </div><!-- row -->
        
        <div class="row">
            <?php echo $form->labelEx($model,'content'); ?>
            <?php $this->widget('EMarkitupWidget', array(
                        'model' => $model,
                        'attribute' => 'content',
                        ));; ?>
            <?php echo $form->error($model,'content'); ?>
        </div><!-- row -->
        
        <div class="row">
            <?php echo $form->labelEx($model,'status'); ?>
            <?php echo CHtml::activeDropDownList($model, 'status', array(
			'published' => Yii::t('app', 'Published') ,
			'trashed' => Yii::t('app', 'Trashed') ,
			'draft' => Yii::t('app', 'Draft') ,
			'closed' => Yii::t('app', 'Closed') ,
)); ?>
            <?php echo $form->error($model,'status'); ?>
        </div><!-- row -->
        
        <div class="row">
            <?php echo $form->labelEx($model,'parent_id'); ?>
            <?php echo $form->dropDownList($model, 'parent', CHtml::listData(Page::model()->findAll(),'id', 'title')); ?>
            <?php echo $form->error($model,'parent_id'); ?>
        </div><!-- row -->
        
        <div class="row">
            <?php echo $form->labelEx($model,'order'); ?>
            <?php echo $form->textField($model,'order'); ?>
            <?php echo $form->error($model,'order'); ?>
        </div><!-- row -->
        
        <div class="row">
            <?php echo $form->labelEx($model,'type'); ?>
            <?php echo $form->textField($model,'type',array('size'=>20,'maxlength'=>20)); ?>
            <?php echo $form->error($model,'type'); ?>
        </div><!-- row -->
        
        <div class="row">
            <?php echo $form->labelEx($model,'comment_status'); ?>
            <?php echo $form->textField($model,'comment_status',array('size'=>20,'maxlength'=>20)); ?>
            <?php echo $form->error($model,'comment_status'); ?>
        </div><!-- row -->
        
        <div class="row">
            <?php echo $form->labelEx($model,'tags_enabled'); ?>
            <?php echo $form->checkBox($model,'tags_enabled'); ?>
            <?php echo $form->error($model,'tags_enabled'); ?>
        </div><!-- row -->
        
        <div class="row">
            <?php echo $form->labelEx($model,'permission'); ?>
            <?php echo $form->textField($model,'permission',array('size'=>20,'maxlength'=>20)); ?>
            <?php echo $form->error($model,'permission'); ?>
        </div><!-- row -->
        
        <div class="row">
            <?php echo $form->labelEx($model,'password'); ?>
            <?php echo $form->passwordField($model,'password',array('size'=>20,'maxlength'=>20)); ?>
            <?php echo $form->error($model,'password'); ?>
        </div><!-- row -->
        
        <div class="row">
            <?php echo $form->labelEx($model,'views'); ?>
            <?php echo $form->textField($model,'views'); ?>
            <?php echo $form->error($model,'views'); ?>
        </div><!-- row -->
        <div class="row nm_row">
<label for="zeros"><?php echo Yii::t('app', 'Zeros'); ?></label>
<?php echo \CHtml::checkBoxList('Page[zeros]', array_map('Awecms::getPrimaryKey',$model->zeros),
            CHtml::listData(Zero::model()->findAll(),'id', 'name'),
            array('attributeitem' => 'id', 'checkAll' => 'Select All')); ?></div>

    <?php
        echo CHtml::submitButton(Yii::t('app', 'Save'));
echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			'submit' => 'javascript:history.go(-1)'));
$this->endWidget(); ?>
</div> <!-- form -->