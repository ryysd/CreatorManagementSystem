<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('OrderLine', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Edit %s', __('Order Line')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('project_id', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('title', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('user_id');
				echo $this->BootstrapForm->input('illust_id');
				echo $this->BootstrapForm->input('order_status_id', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('comment_id');
				echo $this->BootstrapForm->input('commnet_modified', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('deadline', array(
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
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('OrderLine.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('OrderLine.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Order Lines')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Projects')), array('controller' => 'projects', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Project')), array('controller' => 'projects', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Order Statuses')), array('controller' => 'order_statuses', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Order Status')), array('controller' => 'order_statuses', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Comments')), array('controller' => 'comments', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Comment')), array('controller' => 'comments', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Illusts')), array('controller' => 'illusts', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Illust')), array('controller' => 'illusts', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>