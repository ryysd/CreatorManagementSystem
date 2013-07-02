<div class="row-fluid">
	<div class="span9">
		<h2><?php echo h($user['User']['username']); ?></h2>
		<dl>
			<dt><?php echo __('名前'); ?></dt>
			<dd>
				<?php echo h($user['User']['username']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Email'); ?></dt>
			<dd>
				<?php echo h($user['User']['email']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('グループ'); ?></dt>
			<dd>
				<?php echo h($user['UserGroup']['name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('作成日'); ?></dt>
			<dd>
				<?php echo h($user['User']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('更新日'); ?></dt>
			<dd>
				<?php echo h($user['User']['modified']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
<?php if (isIllustratorUser($authUser) || isAdminUser($authUser)): ?>
			<li><?php echo $this->Html->link(__('ユーザー情報の変更'), array('action' => 'edit', $user['User']['id'])); ?> </li>
<?php endif; ?>
<?php if (isAdminUser($authUser)): ?>
			<li><?php echo $this->Form->postLink(__('ユーザーの削除'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
<?php endif; ?>
		</ul>
		</div>
	</div>
</div>

