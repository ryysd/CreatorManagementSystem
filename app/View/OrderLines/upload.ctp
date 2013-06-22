<?php echo $this->Form->create('OrderLine', array('type' => 'file')); ?>
<?php echo $this->Form->input('Attachment.0.photo', array('type' => 'file')); ?>
<?php echo $this->Form->hidden('Attachment.0.model', array('value'=>'OrderLine'));?>
<?php echo $this->Form->end(__('Send'));  ?>
