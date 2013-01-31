<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Yiistrap</h1>

<?php $this->widget('bootstrap.widgets.TbNav', array(
	'style'=>'tabs',
	'items'=>array(
		array('icon'=>'home','url'=>array('/site/index')),
		array('label'=>'Foo','url'=>'#'),
		array('label'=>'Bar','url'=>'#'),
		array('label'=>'Dropdown','items'=>array(
			array('label'=>'Heading'),
			array('label'=>'Link','url'=>'#'),
			array('label'=>'Link','url'=>'#'),
			'---',
			array('label'=>'Link','url'=>'#'),
		)),
	),
)); ?>

<?php echo TbHtml::buttonDropdown('Action', array(
	array('label'=>'Foo','url'=>'#'),
	array('label'=>'Bar','url'=>'#'),
), array('split'=>true)); ?>