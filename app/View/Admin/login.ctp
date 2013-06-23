<div class="row-fluid">
<div class="hero-unit">
  <h1>Creator Management System</h1>
  <p>for Freedom Speech</p>
  <p>
    <a class="btn btn-primary btn-large">
      Learn more
    </a>
  </p>
</div>
</div>

<div class="row-fluid">
	<div class="span9">
            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $this->Form->create('User', Array('url' => '/admin/login')); ?>
		<?php echo $this->BootstrapForm->create('User', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Login'); ?></legend>
				<?php
				echo $this->BootstrapForm->input('email', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('password', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				?>
				<?php echo $this->BootstrapForm->submit(__('ログイン'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
</div>

