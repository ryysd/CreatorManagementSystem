<div class="row-fluid">
	<div class="span9">
          <table class="table table-striped table-hover">
		<h2><?php  echo h($project['Project']['title']);?></h2>
                        <tr>
                          <th>状態</th>
                          <th>締め切り</th>
                        </tr>
			<td>
				<?php echo h($project['ProjectStatus']['name']); ?>
				&nbsp;
			</td>
			<td>
				<?php echo h(datetimeToString($project['Project']['deadline'])); ?>
				&nbsp;
			</td>
          </table>
<?php if(isset($project['Project']['remark'])): ?>
                        <dt>備考</dt>
			<dd>
				<?php echo h($project['Project']['remark']); ?>
				&nbsp;
			</dd>
<?php endif; ?>
	</div>
<?php if(isAdminUser($authUser)): ?>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('プロジェクトの編集'), array('action' => 'edit', $project['Project']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('プロジェクトの削除'), array('action' => 'delete', $project['Project']['id']), null, __('Are you sure you want to delete # %s?', $project['Project']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('新規イラストの発注'), array('controller' => 'order_lines', 'action' => 'add', $project['Project']['id'])); ?> </li>
		</ul>
		</div>
	</div>
<?php endif; ?>
</div>
<hr>
<div class="row-fluid">
	<div class="span9">
		<h3><?php echo '発注イラスト一覧'; ?></h3>
	<?php if (!empty($project['OrderLine'])):?>
		<table class="table table-striped table-hover">
			<tr>
				<th><?php echo __('タイトル'); ?></th>
				<th><?php echo __('状態'); ?></th>
				<th><?php echo __('締め切り'); ?></th>
<?php if(isAdminUser($authUser)): ?>
				<th class="actions"><?php echo __('操作');?></th>
<?php endif; ?>
			</tr>
		<?php foreach ($project['OrderLine'] as $orderLine): ?>
			<tr>
				<td class="actions">
					<?php echo $this->Html->link($orderLine['title'], array('controller' => 'order_lines', 'action' => 'view', $orderLine['id'])); ?>
	                        <?php 
                                    $class = "label label-info";
                                    if ( $orderLine['order_status_id'] == ORDERLINE_STATUS_MASTER ) $class = "label label-success";
                                    else if ( $orderLine['order_status_id'] == ORDERLINE_STATUS_NOTACCEPTED ) $class = "label";
                                ?>
				<td><div class="<?php echo $class ?>"><?php echo $orderStatuses[$orderLine['order_status_id']];?></div></td>
				<td><div class="<?php echo getDeadlineLabelClass($orderLine['deadline']); ?>"><?php echo datetimeToString($orderLine['deadline']);?></div></td>
<?php if(isAdminUser($authUser)): ?>
				<td class="actions">
					<?php echo $this->Html->link(__('編集'), array('controller' => 'order_lines', 'action' => 'edit', $orderLine['id'])); ?>
					<?php echo $this->Form->postLink(__('削除'), array('controller' => 'order_lines', 'action' => 'delete', $orderLine['id'], $project['Project']['id']), null, __('Are you sure you want to delete # %s?', $orderLine['id'])); ?>
				</td>
<?php endif; ?>
			</tr>
		<?php endforeach; ?>
		</table>
        <?php else: ?>
        <?php echo '発注イラストがありません。' ?>
	<?php endif; ?>

	</div>
</div>
