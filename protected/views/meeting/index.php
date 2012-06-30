<?php
$this->breadcrumbs=array(
	'Meetings',
);

$this->menu=array(
	array('label'=>'Create Meeting', 'url'=>array('create')),
	array('label'=>'Manage Meeting', 'url'=>array('admin')),
	array('label'=>'24 Meeting', 'url'=>array('daily')),
);
?>

<h1>Next meeting</h1>
<?php 
	$todays_date = date("Y-m-d H:m:s"); 
	$myDataProvider=new CActiveDataProvider(Meeting::model(), array(
    'criteria'=>array(
        'condition'=>'date > now()',
        'order'=>'date ASC',
    ),
	'pagination' => array('pageSize' => 1,),
        'totalItemCount' => 1,

	));?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$myDataProvider,
	'itemView'=>'_view',
)); ?>


<h1>All meetings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
