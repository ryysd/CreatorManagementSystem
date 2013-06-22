<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('Project', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Add %s', __('Project')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('project_status_id', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('deadline', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('title', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('remark');
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Projects')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Project Statuses')), array('controller' => 'project_statuses', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Project Status')), array('controller' => 'project_statuses', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Order Lines')), array('controller' => 'order_lines', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Order Line')), array('controller' => 'order_lines', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>