<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php Yii::app()->bootstrap->register(); ?>

	<?php /* todo: something is wrong with the extension, is continuously making calls and re-registering files over and over */ ?>
	<?php //Yii::app()->less->register(); ?>
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
					array('label'=>'Dropdown','items'=>array(
						array('label'=>'Heading'),
						array('label'=>'Action','url'=>'#'),
						array('label'=>'Another action','url'=>'#'),
						array('label'=>'Something else here','url'=>'#'),
						TbHtml::menuDivider(),
						array('label'=>'Separate link','url'=>'#'),
					)),
				),
			),
	        TbHtml::navbarSearchForm('#'),
	        array(
		        'class'=>'bootstrap.widgets.TbNav',
		        'htmlOptions'=>array('class'=>'pull-right'),
		        'items'=>array(
			        array('label'=>'Link','url'=>'#'),
			        array('label'=>'Dropdown','items'=>array(
				        array('label'=>'Heading'),
				        array('label'=>'Action','url'=>'#'),
				        array('label'=>'Another action','url'=>'#'),
				        array('label'=>'Something else here','url'=>'#'),
						TbHtml::menuDivider(),
				        array('label'=>'Separate link','url'=>'#'),
			        )),
		        ),
	        ),
		),
	)); ?>

	<div id="page"><div class="container">

	    <?php echo $content; ?>

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

    </div></div>
</body>
</html>
