<?php 
	$todays_date = date("Y-m-d H:m:s"); 
	$today = strtotime($todays_date); 
	$expiration_date = strtotime($data->date); 
	if ($expiration_date > $today) { 
		$class = ""; 
	} else { 
		$class = "exp"; 
	}
	
?>
<div class="view <?php echo $class; ?>">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('place')); ?>:</b>
	<?php echo CHtml::encode($data->place); ?>
	<br />
	
	<?php
		$id = $data->category_id;
		$category = Category::model()->find('id = :id', array('id'=>$id));?>
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::encode($category->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('note')); ?>:</b>
	<?php echo CHtml::encode($data->note); ?>
	<br />

</div>
