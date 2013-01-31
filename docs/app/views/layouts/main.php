<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <?php Yii::app()->bootstrap->register(); ?>

	<?php Yii::app()->less->register(); ?>
</head>

<body>
	<?php /*$this->widget('bootstrap.widgets.TbNavbar',array(
		'collapse'=>true,
		'items'=>array(
			array(
				'class'=>'bootstrap.widgets.TbMenu',
				'items'=>array(
					array('label'=>'Home', 'url'=>array('/site/index')),
					array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
					array('label'=>'Contact', 'url'=>array('/site/contact')),
					array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
				),
			),
		),
	));*/ ?>

	<div class="container" id="page">

		<?php /*if(isset($this->breadcrumbs)):?>
			<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?><!-- breadcrumbs -->
		<?php endif;*/ ?>

		<?php echo $content; ?>

		<hr />

		<div id="footer" style="padding: 20px 0;">
			<div class="row">
				<div class="span6">
					&copy; Yiistrap <?php echo date('Y'); ?><br/>
				</div>
				<div class="span6" style="text-align: right;">
					<?php echo Yii::powered(); ?>
				</div>
			</div>
		</div>

	</div>
</body>
</html>
