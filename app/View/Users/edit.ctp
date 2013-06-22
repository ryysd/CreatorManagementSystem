<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('User', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Edit %s', __('User')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('name', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('email', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('password', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('authority_id', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('order_line_id', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->hidden('id');
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Authorities')), array('controller' => 'authorities', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Authority')), array('controller' => 'authorities', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Order Lines')), array('controller' => 'order_lines', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Order Line')), array('controller' => 'order_lines', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>