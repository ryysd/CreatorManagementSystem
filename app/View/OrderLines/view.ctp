<div class="row-fluid">
	<div class="span9">
		<h2><?php echo h($orderLine['OrderLine']['title']); ?></h2>
		<dl>
			<dt><?php echo __('Project'); ?></dt>
			<dd>
				<?php echo $this->Html->link($orderLine['Project']['title'], array('controller' => 'projects', 'action' => 'view', $orderLine['Project']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Order Status'); ?></dt>
			<dd>
				<?php echo $this->Html->link($orderLine['OrderStatus']['name'], array('controller' => 'order_statuses', 'action' => 'view', $orderLine['OrderStatus']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Deadline'); ?></dt>
			<dd>
				<?php echo h($orderLine['OrderLine']['deadline']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
</div>

<div class="row-fluid">
<div class="tabbable">
 <ul class="nav nav-tabs">
  <li class="active"><a href="#home" data-toggle="tab">Main</a></li>
<?php
$photo_num = count($orderLine['Attachment']);
for ($i = 0; $i < $photo_num; $i++) { echo <<< _EOT_
	<li><a href="#tab$i" data-toggle="tab">Sub-$i</a></li>
_EOT_;
}
?>
 </ul>
 <div id="photo-tab-content" class="tab-content">
  <div class="tab-pane active" id="home">
  </div>
<?php
for ($i = 0; $i < $photo_num; $i++) { 
    $dir = $this->webroot.APP_DIR."/".WEBROOT_DIR."/files/attachment/photo/".$orderLine['Attachment'][$i]['dir'];
    $org_image = $dir."/".$orderLine['Attachment'][$i]['photo'];
    $thumb_image = $dir."/thumb560_".$orderLine['Attachment'][$i]['photo'];
    echo <<< _EOT_
	<div class="tab-pane" id="tab$i">
	<p>tab$i</p>
	<ul class="thumbnails">
	<li class="span6">
	<a href="$org_image" class="thumbnail">
	<img data-src="holder.js/560x420" src="$org_image" alt="">
	</a>
	</li>
_EOT_;
    echo "<li class =\"span4\">";
    echo $this->BootstrapForm->create('OrderLine', array('controller' => 'OrderLine', 'action' => 'update_status'."/".$orderLine['OrderLine']['id'], 'class' => 'form-horizontal'));
    echo "<fieldset>";
    echo "<table class=\"table table-striped\">";
    echo "<td>";
    echo $this->BootstrapForm->input('order_status_id', array(
	'options' => $orderStatuses)
    );
    //echo $this->BootstrapForm->submit(__('Submit'));
    echo "</td>";
    echo "<td>";
    echo "<div align=\"center\">";
    echo "<button type=\"submit\" class=\"btn\">Update</button>";
    echo "</div>";
    echo "</td>";
    echo "</table>";
    echo "</fieldset>";
    echo $this->BootstrapForm->end();
    echo "</li>";
    echo "</div>";
}
?>
</ul>

 </div>
</div>
<?php
echo "<table class=\"table table-striped\">";
echo "<td>";
echo $this->BootstrapForm->create('OrderLine', array('controller' => 'OrderLine','action' => 'upload'."/".$orderLine['OrderLine']['id'], 'type' => 'file', ));
echo $this->BootstrapForm->input('Attachment.0.photo', array('type' => 'file'));
echo $this->BootstrapForm->hidden('Attachment.0.model', array('value'=>'OrderLine'));
echo "<div>";
echo "<button type=\"submit\" class=\"btn\">Update</button>";
echo "</div>";
echo "</td>";
echo "</table>";
?>
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
				<th><?php echo __('Name'); ?></th>
				<th><?php echo __('Email'); ?></th>
				<th><?php echo __('Password'); ?></th>
				<th><?php echo __('Authority Id'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($orderLine['User'] as $user): ?>
			<tr>
				<td><?php echo $user['id'];?></td>
				<td><?php echo $user['name'];?></td>
				<td><?php echo $user['email'];?></td>
				<td><?php echo $user['password'];?></td>
				<td><?php echo $user['authority_id'];?></td>
				<td><?php echo $user['created'];?></td>
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
