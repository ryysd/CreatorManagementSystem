<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Comment');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($comment['Comment']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('User'); ?></dt>
			<dd>
				<?php echo $this->Html->link($comment['User']['name'], array('controller' => 'users', 'action' => 'view', $comment['User']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Content'); ?></dt>
			<dd>
				<?php echo h($comment['Comment']['content']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($comment['Comment']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($comment['Comment']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Order Line'); ?></dt>
			<dd>
				<?php echo $this->Html->link($comment['OrderLine']['title'], array('controller' => 'order_lines', 'action' => 'view', $comment['OrderLine']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Attachment'); ?></dt>
			<dd>
				<?php echo $this->Html->link($comment['Attachment']['name'], array('controller' => 'attachments', 'action' => 'view', $comment['Attachment']['id'])); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Comment')), array('action' => 'edit', $comment['Comment']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Comment')), array('action' => 'delete', $comment['Comment']['id']), null, __('Are you sure you want to delete # %s?', $comment['Comment']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Comments')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Comment')), array('action' => 'add')); ?> </li>
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

