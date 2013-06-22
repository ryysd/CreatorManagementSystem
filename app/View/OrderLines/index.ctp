<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('List %s', __('Order Lines'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table table-striped">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('project_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('title');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('order_status_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('modified');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('commnet_modified');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('deadline');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($orderLines as $orderLine): ?>
			<tr>
				<td><?php echo h($orderLine['OrderLine']['id']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($orderLine['Project']['title'], array('controller' => 'projects', 'action' => 'view', $orderLine['Project']['id'])); ?>
				</td>
				<td><?php echo h($orderLine['OrderLine']['title']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($orderLine['OrderStatus']['name'], array('controller' => 'order_statuses', 'action' => 'view', $orderLine['OrderStatus']['id'])); ?>
				</td>
				<td><?php echo h($orderLine['OrderLine']['created']); ?>&nbsp;</td>
				<td><?php echo h($orderLine['OrderLine']['modified']); ?>&nbsp;</td>
				<td><?php echo h($orderLine['OrderLine']['commnet_modified']); ?>&nbsp;</td>
				<td><?php echo h($orderLine['OrderLine']['deadline']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $orderLine['OrderLine']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $orderLine['OrderLine']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $orderLine['OrderLine']['id']), null, __('Are you sure you want to delete # %s?', $orderLine['OrderLine']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>

		<?php echo $this->BootstrapPaginator->pagination(); ?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Order Line')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Projects')), array('controller' => 'projects', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Project')), array('controller' => 'projects', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Order Statuses')), array('controller' => 'order_statuses', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Order Status')), array('controller' => 'order_statuses', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Comments')), array('controller' => 'comments', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Comment')), array('controller' => 'comments', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>
