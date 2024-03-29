<?php
$this->breadcrumbs=array(
	'Meetings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Meeting', 'url'=>array('index')),
	array('label'=>'Create Meeting', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('meeting-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Meetings</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of <b>each text field</b> of your search values to specify how the comparison should be done.
</p>

<p>
<b>Please for dates follow this example ">2012-6-30 15:36".</b>
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'meeting-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'date',
		'place',
		'category_id',
		'note',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
