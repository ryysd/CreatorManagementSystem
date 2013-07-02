<?php
/*
	This file is part of UserMgmt.

	Author: Chetan Varshney (http://ektasoftwares.com)

	UserMgmt is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	UserMgmt is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<div class="umtop">
	<?php echo $this->Session->flash(); ?>
	<div class="um_box_up"></div>
	<div class="um_box_mid">
		<div class="um_box_mid_content">
			<div class="um_box_mid_content_top">
				<div style="clear:both"></div>
			</div>
			<div class="umhr"></div>
			<div class="um_box_mid_content_mid">
                            <div class="hero-unit">
                              <h1>Illust Version Management System</h1>
                              <p>Hello, <?php echo h($user['User']['username']); ?>!</p>
                              <p>
                                <a class="btn btn-primary btn-large">
                                  Learn more
                                </a>
                              </p>
                            </div>
				<div class="um_box_mid_content_mid_right" align="right"></div>
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
	<div class="um_box_down"></div>
</div>

<?php if(isIllustratorUser($authUser)): ?>
<div class="row-fluid">
	<div class="span9">
		<h3><?php echo '担当イラスト一覧'; ?></h3>
	<?php if (!empty($user['OrderLine'])):?>
		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table table-striped table-hover">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort(('Project.title'), __('プロジェクト')); ?></th>
				<th><?php echo $this->BootstrapPaginator->sort(('title'), __('タイトル')); ?></th>
				<th><?php echo $this->BootstrapPaginator->sort(('order_status_id'), __('状態')); ?></th>
				<th><?php echo $this->BootstrapPaginator->sort(('deadline'), __('締め切り')); ?></th>
<?php if(isAdminUser($authUser)): ?>
				<th class="actions"><?php echo __('操作');?></th>
<?php endif; ?>
			</tr>
		<?php foreach ($orderLines as $_orderLine): ?>
<?php $orderLine = $_orderLine['OrderLine'] ?>
			<tr>
				<td> <?php echo h($projectNames[$orderLine['project_id']]); ?> </td>
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
					<?php echo $this->Form->postLink(__('削除'), array('controller' => 'order_lines', 'action' => 'delete', $orderLine['id']), null, __('Are you sure you want to delete # %s?', $orderLine['id'])); ?>
				</td>
<?php endif; ?>
			</tr>
		<?php endforeach; ?>
		</table>
		<?php echo $this->BootstrapPaginator->pagination(); ?>
        <?php else: ?>
        <?php echo '担当イラストがありません。' ?>
	<?php endif; ?>

	</div>
</div>
<?php endif; ?>

<?php if(isClientUser($authUser)): ?>
<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('担当プロジェクト一覧');?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table table-striped table-hover">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('title', 'プロジェクト名');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('project_status_id', '状態');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('deadline', '締め切り');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('remark', '備考');?></th>
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
			</tr>
		<?php endforeach; ?>
		</table>

		<?php echo $this->BootstrapPaginator->pagination(); ?>
	</div>
</div>
<?php endif; ?>
