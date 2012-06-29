<?php
$this->breadcrumbs=array(
	'Meetings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Meeting', 'url'=>array('index')),
	array('label'=>'Create Meeting', 'url'=>array('create')),
	array('label'=>'View Meeting', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Meeting', 'url'=>array('admin')),
);
?>

<h1>Update Meeting <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>