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
	<?php $this->widget('bootstrap.widgets.TbNavbar',array(
        'style'=>'inverse',
		'collapse'=>true,
        'items'=>array(
			array(
				'class'=>'bootstrap.widgets.TbNav',
				'items'=>array(
					array('label'=>'Home','url'=>array('/site/index')),
					array('label'=>'Link','url'=>'#'),
					array('label'=>'Link','url'=>'#'),
				),
			),
		),
	)); ?>

	<div id="page">

        <div class="container">
		    <?php echo $content; ?>
        </div>

		<hr />

		<div id="footer" style="padding-bottom: 20px;">
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
