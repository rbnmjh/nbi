<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'login-form',
	'enableClientValidation' => true,
	'clientOptions' => array(
		'validateOnSubmit' => true,
		'class' => 'form',
	),
		));
?>
<div class="form-row">
	<div class="form-item">
		<?php echo $form->textField($model, 'username', array('class' => 'login-username required', 'placeholder' => 'Email')); ?>
		<?php echo $form->error($model, 'username'); ?>
	</div>
</div>
<div class="form-row">
	<div class="form-item">
		<?php echo $form->passwordField($model, 'password', array('class' => 'login-username required', 'placeholder' => 'Password')); ?>
		<?php echo $form->error($model, 'password'); ?>
	</div>
</div>
<div id="login-remember" class="form-row">
	<ul class="form-list inline">
		<li>
			<?php echo $form->checkBox($model, 'rememberMe'); ?>
			<?php echo $form->label($model, 'Remember me'); ?>
		</li>
	</ul>
</div>
<div class="form-row">
	<?php echo CHtml::submitButton('Login', array('class' => 'btn btn-success login-button', 'style' => 'width:100%')); ?>
</div>
<?php $this->endWidget(); ?>



