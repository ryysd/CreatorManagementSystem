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
<div class="row-fluid">
	<?php echo $this->Session->flash(); ?>
	<div class="span9">
		<?php echo $this->BootstrapForm->create('User', array('action' => 'addUser', 'class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('ユーザーの新規作成'); ?></legend>
				<?php
				echo $this->BootstrapForm->input('username', array(
				        'label' => '名前',
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('email', array(
				        'label' => 'Email',
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('password', array(
				        'label' => 'パスワード',
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('cpassword', array(
				        'label' => 'パスワード(確認)',
					'type' => 'password',
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('user_group_id', array(
				        'label' => 'グループ',
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				?>
				<?php echo $this->BootstrapForm->submit(__('ユーザーの新規作成'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
</div>
