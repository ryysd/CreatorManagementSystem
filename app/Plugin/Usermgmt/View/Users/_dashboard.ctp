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
	<?php echo $this->element('dashboard'); ?>
	<div class="um_box_up"></div>
	<div class="um_box_mid">
		<div class="um_box_mid_content">
			<div class="um_box_mid_content_top">
				<!--<span class="umstyle1"><?php echo __('Dashboard'); ?></span>-->
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
<!--
				<div class="um_box_mid_content_mid_left">
					<br/><br/>
			<?php   if ($this->UserAuth->getGroupName()=='Admin') { ?>
						<span  class="umstyle6"><?php echo $this->Html->link(__("Add User",true),"/addUser") ?></span><br/><br/>
						<span  class="umstyle6"><?php echo $this->Html->link(__("All Users",true),"/allUsers") ?></span><br/><br/>
						<span  class="umstyle6"><?php echo $this->Html->link(__("Add Group",true),"/addGroup") ?></span><br/><br/>
						<span  class="umstyle6"><?php echo $this->Html->link(__("All Groups",true),"/allGroups") ?></span><br/><br/>
						<span  class="umstyle6"><?php echo $this->Html->link(__("Permissions",true),"/permissions") ?></span><br/><br/>
						<span  class="umstyle6"><?php echo $this->Html->link(__("Profile",true),"/viewUser/".$this->UserAuth->getUserId()) ?></span><br/><br/>
						<span  class="umstyle6"><?php echo $this->Html->link(__("Edit Profile",true),"/editUser/".$this->UserAuth->getUserId()) ?></span><br/><br/>
			<?php   } ?>
						<span  class="umstyle6"><?php echo $this->Html->link(__("Change Password",true),"/changePassword") ?></span><br/><br/>
						<span  class="umstyle6"><?php echo $this->Html->link(__("Profile",true),"/myprofile") ?></span><br/><br/>
				</div>
-->
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
		<table class="table table-striped table-hover">
			<tr>
				<th><?php echo __('タイトル'); ?></th>
				<th><?php echo __('状態'); ?></th>
				<th><?php echo __('締め切り'); ?></th>
<?php if(isAdminUser($authUser)): ?>
				<th class="actions"><?php echo __('操作');?></th>
<?php endif; ?>
			</tr>
		<?php foreach ($user['OrderLine'] as $orderLine): ?>
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
					<?php echo $this->Form->postLink(__('削除'), array('controller' => 'order_lines', 'action' => 'delete', $orderLine['id']), null, __('Are you sure you want to delete # %s?', $orderLine['id'])); ?>
				</td>
<?php endif; ?>
			</tr>
		<?php endforeach; ?>
		</table>
        <?php else: ?>
        <?php echo '担当イラストがありません。' ?>
	<?php endif; ?>

	</div>
</div>
<?php endif; ?>

<?php if(isClientUser($authUser)): ?>
<?php endif; ?>
