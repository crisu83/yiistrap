<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form TbActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
?>
<div class="site-login">

	<h1><?php echo Yii::app()->name; ?></h1>

	<div class="login-form">

		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id'=>'login-form',
		)); ?>

			<fieldset>
				<?php echo $form->textFieldRow($model,'username',array('class'=>'input-block-level','label'=>false,'placeholder'=>'Username')); ?>
				<?php echo $form->passwordFieldRow($model,'password',array('class'=>'input-block-level','label'=>false,'placeholder'=>'Password')); ?>
			</fieldset>

			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'size'=>'large',
				'block'=>true,
				'label'=>'Login',
			)); ?>

		<?php $this->endWidget(); ?>

	</div>
</div>