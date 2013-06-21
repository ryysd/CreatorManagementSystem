<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Project');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($project['Project']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Status'); ?></dt>
			<dd>
				<?php echo h($project['Project']['status']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Deadline'); ?></dt>
			<dd>
				<?php echo h($project['Project']['deadline']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Order Detail Id'); ?></dt>
			<dd>
				<?php echo h($project['Project']['order_detail_id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($project['Project']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($project['Project']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Title'); ?></dt>
			<dd>
				<?php echo h($project['Project']['title']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Remark'); ?></dt>
			<dd>
				<?php echo h($project['Project']['remark']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Project')), array('action' => 'edit', $project['Project']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Project')), array('action' => 'delete', $project['Project']['id']), null, __('Are you sure you want to delete # %s?', $project['Project']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Projects')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Project')), array('action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

