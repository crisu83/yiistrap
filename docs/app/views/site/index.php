<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Yiistrap</h1>

<div class="btn-group">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
        Action
        <span class="caret"></span>
    </a>
    <?php echo TbHtml::dropdown(array(
        array('label'=>'Foo','url'=>'#'),
        array('label'=>'Bar','url'=>'#'),
    )); ?>
</div>