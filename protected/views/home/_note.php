<?php
/* @var $this NoteController */
/* @var $data Note */
?>

<?php if (Yii::app()->user->getState('is_admin')) echo CHtml::checkBox('deleteNote[' . $data->id . ']'); ?>

<?php echo CHtml::image($data->typeIcon, 'note icon', array('class' => 'note-icon')); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
<?php echo CHtml::link(CHtml::encode($data->title), array('noteDetails/index', 'id'=>$data->id)); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('course_id')); ?>:</b>
<?php echo CHtml::encode($data->course->name); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('student_id')); ?>:</b>
<?php echo CHtml::encode($data->student->username); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('upload_timestamp')); ?>:</b>
<?php // TO-DO: set locale ?>
<?php echo CHtml::encode(strftime('%A, %e %B %Y, %T', strtotime($data->upload_timestamp))); ?>
<br />