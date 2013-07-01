<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('プロジェクト一覧');?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table table-striped table-hover">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('title', 'プロジェクト名');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('project_status_id', '状態');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('deadline', '締め切り');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('remark', '備考');?></th>
<?php if (isAdminUser($authUser)): ?>
				<th class="actions"><?php echo __('操作');?></th>
<?php endif; ?>
			</tr>
		<?php foreach ($projects as $project): ?>
			<tr>
				<td>
					<?php echo $this->Html->link($project['Project']['title'], array('controller' => 'projects', 'action' => 'view', $project['Project']['id'])); ?>
				</td>
				<td>
                                        <?php 
                                          $class = "label";
					  if ( $project['Project']['project_status_id'] == PROJECT_STATUS_COMPLETE ) $class .= " label-success";
					  else if ( $project['Project']['project_status_id'] == PROJECT_STATUS_PROGRESS ) $class .= " label-info";
                                        ?>
					<div class="<?php echo $class ?>"> <?php echo h($project['ProjectStatus']['name']); ?> </div>
				</td>
				<td><div class="<?php echo getDeadlineLabelClass($project['Project']['deadline']) ?>"><?php echo h(datetimeToString($project['Project']['deadline'])); ?>&nbsp;</div></td>
				<td><?php echo h($project['Project']['remark']); ?>&nbsp;</td>
<?php if (isAdminUser($authUser)): ?>
				<td class="actions">
					<?php echo $this->Html->link(__('編集'), array('action' => 'edit', $project['Project']['id'])); ?>
					<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $project['Project']['id']), null, __('Are you sure you want to delete # %s?', $project['Project']['id'])); ?>
				</td>
<?php endif; ?>
			</tr>
		<?php endforeach; ?>
		</table>

		<?php echo $this->BootstrapPaginator->pagination(); ?>
	</div>
<?php if (isAdminUser($authUser)): ?>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link('新規プロジェクト作成', array('action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
<?php endif; ?>
</div>
