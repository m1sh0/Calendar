<?php
$this->breadcrumbs=array(
	'Meetings',
);

$this->menu=array(
	array('label'=>'Create Meeting', 'url'=>array('create')),
	array('label'=>'Manage Meeting', 'url'=>array('admin')),
);
?>

<h1>Meetings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
