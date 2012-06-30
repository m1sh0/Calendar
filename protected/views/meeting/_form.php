<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'meeting-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
          $this->widget('CJuiDateTimePicker',array(
                'model'=>$model, 
                'attribute'=>'date', 
				'value'=>$model->date,
                 'language'=>'en-AU',
				 'options'=>array(
					'dateFormat' => 'yy-mm-dd',
            )));
        ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'place'); ?>
		<?php echo $form->textField($model,'place',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'place'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'participants'); ?>
	    <?php $this->widget('CAutoComplete', array(
			    'model'=>$model,
			    'attribute'=>'participants',
			    'url'=>array('/contact/suggest'),
			    'multiple'=>true,
			    'htmlOptions'=>array('size'=>50),
		    )); ?>
		<?php echo $form->error($model,'participants'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model,'category_id',CHtml::listData(Category::model()->findAll(),'id','name',''),array(
			'empty'=>'--please select--',
			)); ?> 
		<?php echo $form->error($model,'category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'note'); ?>
		<?php echo $form->textArea($model,'note',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'note'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
