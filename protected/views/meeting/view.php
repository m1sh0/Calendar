<?php
$this->breadcrumbs=array(
	'Meetings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Meeting', 'url'=>array('index')),
	array('label'=>'Create Meeting', 'url'=>array('create')),
	array('label'=>'Update Meeting', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Meeting', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Meeting', 'url'=>array('admin')),
);
?>

<h1>View Meeting #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'date',
		'place',
		'category_id',
		'note',
	),
)); ?>

<h2>Participants</h2>
<?php 

$connection=Yii::app()->db;
$sql="SELECT contact_id FROM contact_meeting WHERE meeting_id=".$model->id;
$dataReader=$connection->createCommand($sql)->query();

foreach($dataReader as $row) {
    $contact = Contact::model()->findByPk($row["contact_id"]);
    
    echo '<a href="/contact/view/'.$contact->id.'">'.$contact->name.' '.$contact->surname."</a><br />";
}

?>
