<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('List %s', __('Comments'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table table-striped table-hover">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('user_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('content');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('modified');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('order_line_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('attachment_id');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($comments as $comment): ?>
			<tr>
				<td><?php echo h($comment['Comment']['id']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($comment['User']['name'], array('controller' => 'users', 'action' => 'view', $comment['User']['id'])); ?>
				</td>
				<td><?php echo h($comment['Comment']['content']); ?>&nbsp;</td>
				<td><?php echo h($comment['Comment']['created']); ?>&nbsp;</td>
				<td><?php echo h($comment['Comment']['modified']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($comment['OrderLine']['title'], array('controller' => 'order_lines', 'action' => 'view', $comment['OrderLine']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($comment['Attachment']['name'], array('controller' => 'attachments', 'action' => 'view', $comment['Attachment']['id'])); ?>
				</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $comment['Comment']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $comment['Comment']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $comment['Comment']['id']), null, __('Are you sure you want to delete # %s?', $comment['Comment']['id'])); ?>
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
			<li><?php echo $this->Html->link(__('New %s', __('Comment')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Order Lines')), array('controller' => 'order_lines', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Order Line')), array('controller' => 'order_lines', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Attachments')), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Attachment')), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>
