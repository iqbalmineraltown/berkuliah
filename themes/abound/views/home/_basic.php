<?php
/* @var $this HomeController */
/* @var $model Note */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-form',
)); ?>

	<?php echo $form->textField($model,'title',array(
		'size' => 60,
		'maxlength' => 128,
		'class' => 'search-query span10',
		'placeholder' => 'Cari judul',
	)); ?>

<?php $this->endWidget(); ?>