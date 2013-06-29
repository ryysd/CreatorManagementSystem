<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('ユーザー一覧');?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table table-striped table-hover">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('name', '名前');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('email', 'Email');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('role_id', '属性');?></th>
<?php if(isAdminUser($authUser)): ?>
				<th class="actions"><?php echo __('操作');?></th>
<?php endif; ?>
			</tr>
		<?php foreach ($users as $user): ?>
			<tr>
				<td>
					<?php echo $this->Html->link($user['User']['name'], array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?>
				</td>
				<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
				<td>
					<?php echo h($user['Role']['name']); ?>
				</td>
<?php if(isAdminUser($authUser)): ?>
				<td class="actions">
					<?php echo $this->Html->link(__('編集'), array('action' => 'edit', $user['User']['id'])); ?>
					<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
				</td>
<?php endif; ?>
			</tr>
		<?php endforeach; ?>
		</table>

		<?php echo $this->BootstrapPaginator->pagination(); ?>
	</div>
<?php if(isAdminUser($authUser)): ?>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('ユーザーの新規作成'), array('action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
<?php endif; ?>
</div>
