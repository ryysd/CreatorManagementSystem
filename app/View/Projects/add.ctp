<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('Project', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo 'プロジェクトの新規作成'; ?></legend>
				<?php
				echo $this->BootstrapForm->input('title', array(
				        'label' => 'プロジェクト名',
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->hidden('project_status_id', array('value' => '1'));
				echo $this->BootstrapForm->input('deadline', array(
					'label' => '締め切り',
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;',
					'id'=>'datepicker',
					'type'=>'text'
				    )
				);
				echo $this->BootstrapForm->input('remark', array(
				        'label' => '備考',
					'type' => 'textarea'
				));
				?>
				<?php echo $this->BootstrapForm->submit(__('プロジェクトの作成'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
</div>
