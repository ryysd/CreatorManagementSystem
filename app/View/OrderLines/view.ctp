<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Order Line');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($orderLine['OrderLine']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Project'); ?></dt>
			<dd>
				<?php echo $this->Html->link($orderLine['Project']['title'], array('controller' => 'projects', 'action' => 'view', $orderLine['Project']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Title'); ?></dt>
			<dd>
				<?php echo h($orderLine['OrderLine']['title']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('User Id'); ?></dt>
			<dd>
				<?php echo h($orderLine['OrderLine']['user_id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Illust Id'); ?></dt>
			<dd>
				<?php echo h($orderLine['OrderLine']['illust_id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Status'); ?></dt>
			<dd>
				<?php echo h($orderLine['OrderLine']['status']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Comment Id'); ?></dt>
			<dd>
				<?php echo h($orderLine['OrderLine']['comment_id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($orderLine['OrderLine']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($orderLine['OrderLine']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Commnet Modified'); ?></dt>
			<dd>
				<?php echo h($orderLine['OrderLine']['commnet_modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Deadline'); ?></dt>
			<dd>
				<?php echo h($orderLine['OrderLine']['deadline']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Order Line')), array('action' => 'edit', $orderLine['OrderLine']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Order Line')), array('action' => 'delete', $orderLine['OrderLine']['id']), null, __('Are you sure you want to delete # %s?', $orderLine['OrderLine']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Order Lines')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Order Line')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Projects')), array('controller' => 'projects', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Project')), array('controller' => 'projects', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Comments')), array('controller' => 'comments', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Comment')), array('controller' => 'comments', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Illusts')), array('controller' => 'illusts', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Illust')), array('controller' => 'illusts', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Comments')); ?></h3>
	<?php if (!empty($orderLine['Comment'])):?>
		<table class="table table-striped">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Content'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th><?php echo __('Order Line Id'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($orderLine['Comment'] as $comment): ?>
			<tr>
				<td><?php echo $comment['id'];?></td>
				<td><?php echo $comment['user_id'];?></td>
				<td><?php echo $comment['content'];?></td>
				<td><?php echo $comment['created'];?></td>
				<td><?php echo $comment['modified'];?></td>
				<td><?php echo $comment['order_line_id'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'comments', 'action' => 'view', $comment['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'comments', 'action' => 'edit', $comment['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'comments', 'action' => 'delete', $comment['id']), null, __('Are you sure you want to delete # %s?', $comment['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('Comment')), array('controller' => 'comments', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Users')); ?></h3>
	<?php if (!empty($orderLine['User'])):?>
		<table class="table table-striped">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Username'); ?></th>
				<th><?php echo __('Email'); ?></th>
				<th><?php echo __('Password'); ?></th>
				<th><?php echo __('Authority'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Orider Line Id'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($orderLine['User'] as $user): ?>
			<tr>
				<td><?php echo $user['id'];?></td>
				<td><?php echo $user['username'];?></td>
				<td><?php echo $user['email'];?></td>
				<td><?php echo $user['password'];?></td>
				<td><?php echo $user['authority'];?></td>
				<td><?php echo $user['created'];?></td>
				<td><?php echo $user['orider_line_id'];?></td>
				<td><?php echo $user['modified'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Illusts')); ?></h3>
	<?php if (!empty($orderLine['Illust'])):?>
		<table class="table table-striped">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Order Line Id'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($orderLine['Illust'] as $illust): ?>
			<tr>
				<td><?php echo $illust['id'];?></td>
				<td><?php echo $illust['order_line_id'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'illusts', 'action' => 'view', $illust['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'illusts', 'action' => 'edit', $illust['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'illusts', 'action' => 'delete', $illust['id']), null, __('Are you sure you want to delete # %s?', $illust['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('Illust')), array('controller' => 'illusts', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
