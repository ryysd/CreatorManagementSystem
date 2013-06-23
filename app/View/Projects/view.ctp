<div class="row-fluid">
	<div class="span9">
          <table class="table table-striped">
		<h2><?php  echo h($project['Project']['title']);?></h2>
                        <tr>
                          <th>Status</th>
                          <th>deadline</th>
                        </tr>
			<td>
				<?php echo h($project['ProjectStatus']['name']); ?>
				&nbsp;
			</td>
			<td>
				<?php echo h($project['Project']['deadline']); ?>
				&nbsp;
			</td>
          </table>
                        <dt>Remark</dt>
			<dd>
				<?php echo h($project['Project']['remark']); ?>
				&nbsp;
			</dd>
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
<hr>
<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Order Lines')); ?></h3>
	<?php if (!empty($project['OrderLine'])):?>
		<table class="table table-striped">
			<tr>
				<th><?php echo __('Title'); ?></th>
				<th><?php echo __('Status'); ?></th>
				<th><?php echo __('Deadline'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($project['OrderLine'] as $orderLine): ?>
			<tr>
				<td class="actions">
					<?php echo $this->Html->link($orderLine['title'], array('controller' => 'order_lines', 'action' => 'view', $orderLine['id'])); ?>
				<td><?php echo $orderStatuses[$orderLine['order_status_id']];?></td>
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
