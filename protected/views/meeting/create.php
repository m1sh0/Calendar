<?php
$this->breadcrumbs=array(
	'Meetings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Meeting', 'url'=>array('index')),
	array('label'=>'Manage Meeting', 'url'=>array('admin')),
);
?>

<h1>Create Meeting</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>