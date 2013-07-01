<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('Project', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo ('プロジェクトの編集'); ?></legend>
				<?php
				echo $this->BootstrapForm->input('title', array(
				        'label' => 'プロジェクト名',
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('deadline', array(
				        'label' => '締め切り',
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('remark', array(
				        'label' => '備考',
					'type' => 'textarea'
				));
				echo $this->BootstrapForm->hidden('id');
				?>
				<?php echo $this->BootstrapForm->submit(__('変更を適用'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
</div>

