<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('User', array('action' => 'changePassword', 'class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo ('パスワードの編集'); ?></legend>
				<?php
				echo $this->BootstrapForm->input('oldpassword', array(
				        'label' => '古いパスワード',
					'type' => 'password',
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('password', array(
					'label' => '新しいパスワード',
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;',
				    )
				);
				echo $this->BootstrapForm->input('cpassword', array(
					'label' => '新しいパスワード(確認)',
					'type' => 'password',
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;',
				    )
				);
				echo $this->BootstrapForm->hidden('id');
				?>
				<?php echo $this->BootstrapForm->submit(__('変更を適用'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
</div>

