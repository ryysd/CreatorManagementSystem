<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Project');?></h2>
		<dl>
			<dt><?php echo __('Title'); ?></dt>
			<dd>
				<?php echo h($project['Project']['title']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Project Status'); ?></dt>
			<dd>
				<?php echo h($project['ProjectStatus']['name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Deadline'); ?></dt>
			<dd>
				<?php echo h($project['Project']['deadline']); ?>
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
			<li><?php echo $this->Html->link(__('New %s', __('Order Line')), array('controller' => 'order_lines', 'action' => 'add', $project['Project']['id'])); ?> </li>
		</ul>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Order Lines')); ?></h3>
	<?php if (!empty($project['OrderLine'])):?>
		<table class="table table-striped">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Project Id'); ?></th>
				<th><?php echo __('Title'); ?></th>
				<th><?php echo __('Order Status Id'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th><?php echo __('Commnet Modified'); ?></th>
				<th><?php echo __('Deadline'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($project['OrderLine'] as $orderLine): ?>
			<tr>
				<td><?php echo $orderLine['id'];?></td>
				<td><?php echo $orderLine['project_id'];?></td>
				<td><?php echo $orderLine['title'];?></td>
				<td><?php echo $orderLine['order_status_id'];?></td>
				<td><?php echo $orderLine['created'];?></td>
				<td><?php echo $orderLine['modified'];?></td>
				<td><?php echo $orderLine['commnet_modified'];?></td>
				<td><?php echo $orderLine['deadline'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'order_lines', 'action' => 'view', $orderLine['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'order_lines', 'action' => 'edit', $orderLine['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'order_lines', 'action' => 'delete', $orderLine['id']), null, __('Are you sure you want to delete # %s?', $orderLine['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
</div>
