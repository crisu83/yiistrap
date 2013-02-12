<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<h1>Yiistrap
    <small>Twitter Bootstrap for Yii</small>
</h1>
<div class="clearfix"></div>
<div class="buttons">
    <h3>Buttons</h3>

    <h5>Button styles</h5>

    <div style="margin-bottom: 20px;">
		<?php echo TbHtml::button('Default'); ?>
		<?php echo TbHtml::button('Primary', array('style' => 'primary')); ?>
		<?php echo TbHtml::button('Danger', array('style' => 'danger')); ?>
		<?php echo TbHtml::button('Warning', array('style' => 'warning')); ?>
		<?php echo TbHtml::button('Success', array('style' => 'success')); ?>
		<?php echo TbHtml::button('Info', array('style' => 'info')); ?>
		<?php echo TbHtml::button('Inverse', array('style' => 'inverse')); ?>
		<?php echo TbHtml::button('Link', array('style' => 'link')); ?>
    </div>

    <h5>Button sizes</h5>

    <div style="margin-bottom: 10px;">
		<?php echo TbHtml::button('Large button', array('style' => 'primary', 'size' => 'large')); ?>
		<?php echo TbHtml::button('Large button', array('size' => 'large')); ?>
    </div>

    <div style="margin-bottom: 10px;">
		<?php echo TbHtml::button('Default button', array('style' => 'primary')); ?>
		<?php echo TbHtml::button('Default button'); ?><br/>
    </div>

    <div style="margin-bottom: 10px;">
		<?php echo TbHtml::button('Small button', array('style' => 'primary', 'size' => 'small')); ?>
		<?php echo TbHtml::button('Small button', array('size' => 'small')); ?><br/>
    </div>

    <div style="margin-bottom: 10px;">
		<?php echo TbHtml::button('Mini button', array('style' => 'primary', 'size' => 'mini')); ?>
		<?php echo TbHtml::button('Mini button', array('size' => 'mini')); ?>
    </div>

    <h5>Block buttons</h5>

    <div class="well" style="margin-bottom: 20px; width: 320px;">
		<?php echo TbHtml::button('Block button', array('block' => true, 'style' => 'primary')); ?>
		<?php echo TbHtml::button('Block button', array('block' => true)); ?>
    </div>

    <h5>Disabled state</h5>

    <div style="margin-bottom: 20px;">
		<?php echo TbHtml::linkButton('Primary link', array('disabled' => true, 'style' => 'primary', 'size' => 'large')); ?>
		<?php echo TbHtml::linkButton('Link', array('disabled' => true, 'size' => 'large')); ?>
    </div>
</div>
<div class="clearfix"></div>
<div class="button-groups">
    <h3>Button groups</h3>

    <h5>Single button group</h5>

    <div style="margin-bottom: 20px;">
		<?php echo TbHtml::buttonGroup(array(
		array('label' => 'Left', 'htmlOptions' => array('style' => '')),
		array('label' => 'Middle'),
		array('label' => 'Right'),
	), array('style' => 'primary')); ?>
    </div>

    <h5>Multiple button groups</h5>

    <div style="margin-bottom: 20px;">
		<?php echo TbHtml::buttonToolbar(array(
		array('items' => array(
			array('label' => '1'),
			array('label' => '2'),
			array('label' => '3'),
			array('label' => '4', 'htmlOptions' => array('style' => 'danger')),
		), 'htmlOptions' => array('style' => 'warning')),
		array('items' => array(
			array('label' => '5'),
			array('label' => '6'),
			array('label' => '7'),
		)),
		array('items' => array(
			array('label' => '8'),
		)),
	), array('style' => 'inverse')); ?>
    </div>

    <h5>Vertical button groups</h5>

    <div style="margin-bottom: 20px;">
		<?php echo TbHtml::buttonGroup(array(
		array('icon' => 'align-left'),
		array('icon' => 'align-center'),
		array('icon' => 'align-right'),
		array('icon' => 'align-justify'),
	), array('vertical' => true)); ?>
    </div>

</div>
<div class="clearfix"></div>
<div class="button-dropdowns">
    <h3>Button dropdowns</h3>

	<?php $dropdownConfig = array(
	array('label' => 'Action', 'url' => '#'),
	array('label' => 'Another action', 'url' => '#'),
	array('label' => 'Something else here', 'url' => '#'),
	TbHtml::menuDivider(),
	array('label' => 'Separate link', 'url' => '#'),
); ?>

    <h5>Default dropdown</h5>

    <div style="margin-bottom: 20px;">
		<?php echo TbHtml::buttonDropdown('Action', $dropdownConfig); ?>
		<?php echo TbHtml::buttonDropdown('Action', $dropdownConfig, array('style' => 'primary')); ?>
		<?php echo TbHtml::buttonDropdown('Action', $dropdownConfig, array('style' => 'danger')); ?>
		<?php echo TbHtml::buttonDropdown('Action', $dropdownConfig, array('style' => 'warning')); ?>
		<?php echo TbHtml::buttonDropdown('Action', $dropdownConfig, array('style' => 'success')); ?>
		<?php echo TbHtml::buttonDropdown('Action', $dropdownConfig, array('style' => 'info')); ?>
		<?php echo TbHtml::buttonDropdown('Action', $dropdownConfig, array('style' => 'inverse')); ?>
    </div>

    <h5>Split dropdown</h5>

    <div style="margin-bottom: 20px;">
		<?php echo TbHtml::buttonDropdown('Action', $dropdownConfig, array('split' => true)); ?>
		<?php echo TbHtml::buttonDropdown('Action', $dropdownConfig, array('style' => 'primary', 'split' => true)); ?>
		<?php echo TbHtml::buttonDropdown('Action', $dropdownConfig, array('style' => 'danger', 'split' => true)); ?>
		<?php echo TbHtml::buttonDropdown('Action', $dropdownConfig, array('style' => 'warning', 'split' => true)); ?>
		<?php echo TbHtml::buttonDropdown('Action', $dropdownConfig, array('style' => 'success', 'split' => true)); ?>
		<?php echo TbHtml::buttonDropdown('Action', $dropdownConfig, array('style' => 'info', 'split' => true)); ?>
		<?php echo TbHtml::buttonDropdown('Action', $dropdownConfig, array('style' => 'inverse', 'split' => true)); ?>
    </div>
</div>
<div class="clearfix"></div>
<div class="images">
    <h3>Images</h3>

    <div class="row-fluid" style="text-align: center; width: 450px;">
        <div class="span4">
			<?php echo TbHtml::imageRounded('http://placehold.it/140x140/eeeeee/aaaaaa/'); ?>
            <h5>Rounded</h5>
        </div>
        <div class="span4">
			<?php echo TbHtml::imageCircle('http://placehold.it/140x140/eeeeee/aaaaaa/'); ?>
            <h5>Circle</h5>
        </div>
        <div class="span4">
			<?php echo TbHtml::imagePolaroid('http://placehold.it/140x140/eeeeee/aaaaaa/'); ?>
            <h5>Polaroid</h5>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="navs">
	<?php $navItems = array(
	array('icon' => 'home', 'url' => array('/site/index')),
	array('label' => 'Profile', 'url' => '#', 'itemOptions' => array('class' => 'foo'), 'linkOptions' => array('class' => 'bar')),
	array('label' => 'Messages', 'url' => '#'),
	array('label' => 'Dropdown', 'items' => array(
		array('label' => 'Header'),
		array('label' => 'Action', 'url' => '#'),
		array('label' => 'Another action', 'url' => '#'),
		array('label' => 'Something else here', 'url' => '#'),
		TbHtml::menuDivider(),
		array('label' => 'Separate link', 'url' => '#'),
	)),
); ?>

    <h3>Navs</h3>

    <h5>Nav tabs</h5>

    <div style="margin-bottom: 20px;">
		<?php $this->widget('bootstrap.widgets.TbNav', array('style' => 'tabs', 'items' => $navItems)); ?>
    </div>

    <div style="margin-bottom: 20px;">
		<?php $this->widget('bootstrap.widgets.TbNav', array('style' => 'tabs', 'stacked' => true, 'items' => $navItems)); ?>
    </div>

    <h5>Nav pills</h5>

    <div style="margin-bottom: 20px;">
		<?php $this->widget('bootstrap.widgets.TbNav', array('style' => 'pills', 'items' => $navItems)); ?>
    </div>

    <div style="margin-bottom: 20px;">
		<?php $this->widget('bootstrap.widgets.TbNav', array('style' => 'pills', 'stacked' => true, 'items' => $navItems)); ?>
    </div>

    <h5>Nav list</h5>

    <div style="margin-bottom: 20px;">
        <div class="well" style="padding: 8px 0;">
			<?php $this->widget('bootstrap.widgets.TbNav', array(
			'style' => 'list',
			'items' => array(
				array('label' => 'List header'),
				array('label' => 'Home', 'url' => '#'),
				array('label' => 'Library', 'url' => '#'),
				array('label' => 'Applications', 'url' => '#'),
			),
		)); ?>
        </div>
    </div>
</div>

<div class="breadcrumbs">
    <h3>Breadcrumb</h3>

	<?php echo TbHtml::breadcrumbs(array('Home')); ?>

	<?php echo TbHtml::breadcrumbs(array(
	TbHtml::icon('home') => array('/site/index'),
	'Library',
)); ?>

	<?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
	'divider' => '&rsaquo;',
	'links' => array(
		'Library' => array('#'),
		'Data',
	),
)); ?>
</div>

<div class="paginations" style="width: 590px;">
    <h3>Pagination</h3>

    <h5>Standard pagination</h5>

	<?php $paginationConfig = array(
	array('label' => 'Prev', 'url' => '#'),
	array('label' => '1', 'url' => '#', 'htmlOptions' => array('class' => 'foo')),
	array('label' => '2', 'url' => '#'),
	array('label' => '3', 'url' => '#'),
	array('label' => '4', 'url' => '#'),
	array('label' => '5', 'url' => '#'),
	array('label' => 'Next', 'url' => '#'),
); ?>

	<?php echo TbHtml::pagination($paginationConfig); ?>

    <h5>Disabled and active states</h5>

	<?php echo TbHtml::pagination(array(
	array('label' => 'Prev', 'url' => '#', 'disabled' => true),
	array('label' => '1', 'url' => '#', 'active' => true),
	array('label' => '2', 'url' => '#'),
	array('label' => '3', 'url' => '#'),
	array('label' => '4', 'url' => '#'),
	array('label' => '5', 'url' => '#'),
	array('label' => 'Next', 'url' => '#'),
)); ?>

    <h5>Sizes</h5>

	<?php echo TbHtml::pagination($paginationConfig, array('size' => 'large')); ?>
	<?php echo TbHtml::pagination($paginationConfig); ?>
	<?php echo TbHtml::pagination($paginationConfig, array('size' => 'small')); ?>
	<?php echo TbHtml::pagination($paginationConfig, array('size' => 'mini')); ?>

    <h5>Alignment</h5>

	<?php echo TbHtml::pagination($paginationConfig); ?>
	<?php echo TbHtml::pagination($paginationConfig, array('align' => 'centered')); ?>
	<?php echo TbHtml::pagination($paginationConfig, array('align' => 'right')); ?>

    <h3>Pager</h3>

    <h5>Default pager</h5>

	<?php echo TbHtml::pager(array(
	array('label' => 'Previous', 'htmlOptions' => array('class' => 'bar')),
	array('label' => 'Next'),
)); ?>

    <h5>Aligned links</h5>

	<?php echo TbHtml::pager(array(
	array('label' => 'Older &larr;', 'previous' => true),
	array('label' => 'Newer &rarr;', 'next' => true),
)); ?>

    <h5>Disabled state</h5>

	<?php echo TbHtml::pager(array(
	array('label' => 'Older &larr;', 'previous' => true, 'disabled' => true),
	array('label' => 'Newer &rarr;', 'next' => true),
)); ?>

</div>
<div class="clearfix"></div>
<div class="labels-badges">
    <h3>Labels and badges</h3>

    <h5>Labels</h5>

    <div style="margin-bottom: 10px;">
		<?php echo TbHtml::labelTb('Default'); ?>
		<?php echo TbHtml::labelTb('Success', array('style' => 'success')); ?>
		<?php echo TbHtml::labelTb('Warning', array('style' => 'warning')); ?>
		<?php echo TbHtml::labelTb('Important', array('style' => 'important')); ?>
		<?php echo TbHtml::labelTb('Info', array('style' => 'info')); ?>
		<?php echo TbHtml::labelTb('Inverse', array('style' => 'inverse')); ?>
    </div>

    <h5>Badges</h5>

    <div style="margin-bottom: 10px;">
		<?php echo TbHtml::badge('1'); ?>
		<?php echo TbHtml::badge('2', array('style' => 'success')); ?>
		<?php echo TbHtml::badge('4', array('style' => 'warning')); ?>
		<?php echo TbHtml::badge('6', array('style' => 'important')); ?>
		<?php echo TbHtml::badge('8', array('style' => 'info')); ?>
		<?php echo TbHtml::badge('10', array('style' => 'inverse')); ?>
    </div>
</div>
<div class="clearfix"></div>
<div class="typography">
    <h3>Typography</h3>

    <h5>Hero unit</h5>

	<?php $this->widget('bootstrap.widgets.TbHeroUnit', array(
	'heading' => 'Hello, world!',
	'content' => '_heroUnit',
	'htmlOptions' => array('style' => 'width: 480px')
)); ?>

    <h5>Page header</h5>

	<?php echo TbHtml::pageHeader('Header text', 'Subtext for header'); ?>
</div>

<div class="thumbs" style="width: 870px;">
    <h3>Thumbnails</h3>

	<?php $thumbnail = array(
	'content' => '<img src="http://placehold.it/260x180" />',
	'url' => '#',
); ?>

    <h5>Default thumbnails</h5>

    <div class="row-fluid">
		<?php echo TbHtml::thumbnails(array($thumbnail, $thumbnail, $thumbnail, $thumbnail)); ?>
    </div>

	<?php $captionThumbnail = array(
	'content' => '<img src="http://placehold.it/300x200" /><div class="caption"><h3>Thumbnail label</h3><p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>' . TbHtml::button('Action', array('style' => 'primary')) . ' ' . TbHtml::button('Action') . '</div>',
	'span' => 3,
); ?>

    <h5>Thumbnails with caption</h5>

	<?php echo TbHtml::thumbnails(array($captionThumbnail, $captionThumbnail, $captionThumbnail)); ?>

    <h5>Different sizes</h5>

	<?php echo TbHtml::thumbnails(array(
	array('content' => '<img src="http://placehold.it/360x270" />', 'url' => '#', 'span' => 4),
	array('content' => '<img src="http://placehold.it/260x120" />', 'url' => '#', 'span' => 3),
	array('content' => '<img src="http://placehold.it/160x120" />', 'url' => '#', 'span' => 2),
	array('content' => '<img src="http://placehold.it/260x120" />', 'url' => '#', 'span' => 3),
	array('content' => '<img src="http://placehold.it/160x120" />', 'url' => '#', 'span' => 2),
)); ?>

    <h3>Media objects</h3>
</div>
<div class="clearfix"></div>
<div class="alerts">
    <h3>Alerts</h3>

    <h5>Default alerts</h5>

	<?php echo TbHtml::alert('warning', '<strong>Warning!</strong> Best check yo self, you\'re not looking too good.'); ?>
	<?php echo TbHtml::alert('error', '<strong>Oh snap!</strong> Change a few things up and try submitting again.'); ?>
	<?php echo TbHtml::alert('success', '<strong>Well done!</strong> You successfully read this important alert message.'); ?>
	<?php echo TbHtml::alert('info', '<strong>Heads up!</strong> This alert needs your attention, but it\'s not super important.'); ?>

    <h5>Block alerts</h5>

	<?php Yii::app()->user->setFlash('warning', '<h4>Warning!</h4>Best check yo self, you\'re not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.'); ?>

	<?php $this->widget('bootstrap.widgets.TbAlert', array(
	'block' => true,
	'events' => array(
		'close' => "function() { console.log('Alert close event fired.'); }",
		'closed' => "function() { console.log('Alert closed event fired.'); }",
	),
)); ?>

</div>
<div class="clearfix"></div>
<div class="progressbars">
    <h3>Progress bars</h3>

    <h5>Basic</h5>

	<?php echo TbHtml::progressBar(60); ?>

    <h5>Striped</h5>

	<?php echo TbHtml::stripedProgressBar(20); ?>

    <h5>Animated</h5>

	<?php echo TbHtml::animatedProgressBar(40); ?>

    <h5>Stacked</h5>

	<?php echo TbHtml::stackedProgressBar(array(
	array('style' => 'success', 'width' => 35, 'htmlOptions' => array('class' => 'foo')),
	array('style' => 'warning', 'width' => 20),
	array('style' => 'danger', 'width' => 10),
)); ?>

    <h5>Additional colors</h5>

	<?php echo TbHtml::progressBar(20); ?>
	<?php echo TbHtml::progressBar(40, array('style' => 'success')); ?>
	<?php echo TbHtml::progressBar(60, array('style' => 'warning')); ?>
	<?php echo TbHtml::progressBar(80, array('style' => 'danger')); ?>

    <h5>Striped bars</h5>

	<?php echo TbHtml::stripedProgressBar(20); ?>
	<?php echo TbHtml::stripedProgressBar(40, array('style' => 'success')); ?>
	<?php echo TbHtml::stripedProgressBar(60, array('style' => 'warning')); ?>
	<?php echo TbHtml::stripedProgressBar(80, array('style' => 'danger')); ?>

</div>
<div class="clearfix"></div>
<div class="tooltips">
    <h3>Tooltips</h3>

    <h5>Tooltip</h5>

    <p class="muted">
        Tight pants next level keffiyeh
		<?php echo TbHtml::tooltip('you probably', '#', 'Default tooltip'); ?> haven't heard of them. Photo booth beard
        raw denim letterpress vegan messenger bag stumptown. Farm-to-table seitan, mcsweeney's fixie sustainable quinoa
        8-bit american apparel
		<?php echo TbHtml::tooltip('have a', '#', 'Another tooltip', array('placement' => 'bottom')); ?> terry
        richardson vinyl chambray. Beard stumptown, cardigans banh mi lomo thundercats. Tofu biodiesel williamsburg
        marfa, four loko mcsweeney's cleanse vegan chambray. A really ironic artisan
		<?php echo TbHtml::tooltip('whatever keytar', '#', 'Another one here too', array('placement' => 'right')); ?>,
        scenester farm-to-table banksy Austin
		<?php echo TbHtml::tooltip('twitter handle', '#', 'The last tip!', array('placement' => 'left'));?> freegan cred
        raw denim single-origin coffee viral.
    </p>

    <h5>Popovers</h5>

	<?php echo TbHtml::popover('Popover on top', 'Popover on top', 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus.', array('class' => 'btn', 'placement' => 'top', 'onclick' => 'return false;')); ?>
	<?php echo TbHtml::popover('Popover on right', 'Popover on right', 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus.', array('class' => 'btn', 'placement' => 'right', 'onclick' => 'return false;')); ?>
	<?php echo TbHtml::popover('Popover on bottom', 'Popover on bottom', 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus.', array('class' => 'btn', 'placement' => 'bottom', 'onclick' => 'return false;')); ?>
	<?php echo TbHtml::popover('Popover on left', 'Popover on left', 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus.', array('class' => 'btn', 'placement' => 'left', 'onclick' => 'return false;')); ?>

</div>
<div class="clearfix"></div>
<div class="carousels">
    <h3>Carousel</h3>

	<?php echo TbHtml::carousel(array(
	array(
		'content' => '<img src="http://placehold.it/660x380&text=Slide1" />',
		'label' => 'First Thumbnail label',
		'caption' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.',
	),
	array(
		'content' => '<img src="http://placehold.it/660x380&text=Slide2" />',
		'label' => 'Second Thumbnail label',
		'caption' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.',
	),
	array(
		'content' => '<img src="http://placehold.it/660x380&text=Slide3" />',
		'label' => 'Third Thumbnail label',
		'caption' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.',
	),
), array('style' => 'width: 660px;')); ?>
</div>
<div class="clearfix"></div>
<div class="search-forms">
    <h3>Forms</h3>

    <h5>Append</h5>
	<?php echo TbHtml::searchForm('', 'post', array(
	'addon' => 'append',
	'inputOptions' => array('name' => 'term', 'class' => 'span3', 'placeholder' => 'Search'),
	'buttonOptions' => array('label' => 'search', 'type' => 'submit')
));?>
    <h5>Prepend and Additional Options</h5>
	<?php echo TbHtml::searchForm('', 'post', array(
	'addon' => 'prepend',
	'inputOptions' => array('name' => 'term', 'class' => 'span3', 'placeholder' => 'Search'),
	'buttonOptions' => array('label' => 'search ' . TbHtml::icon(TbIcon::ICON_SEARCH), 'type' => 'submit')
));?>

    <h5>Button Groups</h5>
	<?php echo TbHtml::buttonGroup(array(
	array('label' => 'testA'),
	array('label' => 'testB')
));
	?>
    <div style="clear:both;height:23px"></div>
    <h5>Button Toolbar</h5>
	<?php
	echo TbHtml::buttonToolbar(array(
		array(
			'items' => array(
				array('label' => 'testA'),
				array('label' => 'testB', 'style' => TbHtml::STYLE_PRIMARY)
			)
		),
		array(
			'items' => array(
				array('label' => 'testC')
			)
		)
	));?>

    <h5>Input types</h5>

    <p><strong>Text Fields</strong></p>
	<?php echo TbHtml::textField('test', '', array('placeholder' => 'Test'));?>

    <p><strong>prepend - append</strong></p>
	<?php
	echo TbHtml::textField('manolo', 'test', array(
		'prepend' => '$',
		'append' => 'USD'
	));

	echo TbHtml::textField('manolo', 'test', array(
		'prepend' => TbHtml::button('Test'),
		'append' => TbHtml::button('Another test')
	));
	?>
    <p><strong>password</strong></p>
	<?php
	echo TbHtml::passwordField('password', '', array('placeholder' => 'password'));
	?>
    <p><strong>inlineRadioButtonList</strong></p>
	<?php
	echo TbHtml::inlineRadioButtonList('testB', 0, array('papa' => 'Superman', '4' => 'test'));
	?>
    <br/>

    <p><strong>inlineCheckBoxList</strong></p>
	<?php
	echo TbHtml::inlineCheckBoxList('testC', 0, array('papa' => 'Superman', '4' => 'test'), array('checkAll' => 'All'));
	?>
    <h5>Active Forms</h5>
	<?php /* @var $form TbActiveForm */ ?>
	<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'type' => TbHtml::FORM_HORIZONTAL
));?>
    <strong>Using regular</strong>

    <div class="control-group">
		<?php echo $form->label($model, 'textField');?>
		<?php echo $form->textField($model, 'textField');?>
		<?php echo $form->error($model, 'textField');?>
    </div>
    <strong>Using Row</strong>
	<?php echo $form->row(TbHtml::INPUT_TEXT, $model, 'textField');?>

	<?php echo $form->row(TbHtml::INPUT_CHECKBOX, $model, 'checkbox');?>

	<?php echo $form->row(TbHtml::INPUT_RADIOBUTTON, $model, 'radioButton');?>

	<?php echo $form->row(TbHtml::INPUT_RADIOBUTTONLIST, $model, 'radioButton', array(), array('papa' => 'Superman', '4' => 'test'));?>

	<?php echo $form->row(TbHtml::INPUT_CHECKBOXLIST, $model, 'radioButton', array('checkAll' => 'All'), array('papa' => 'Superman', '4' => 'test'));?>

	<?php $this->endWidget();?>
</div>
<div class="clearfix"></div>
<div class="media-objects">
    <h5>Media Objects</h5>
	<?php
	// media object arrays should be always extracted from DB
	echo TbHtml::mediaObjects(
		array(
			array(
				'image' => "http://placehold.it/64x64",
				'heading' => "Media heading",
				'content' => "Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus
					odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla.
					Donec lacinia congue felis in faucibus.",
				'htmlOptions' => array(
					'items' => array(
						array(
							'image' => "http://placehold.it/64x64",
							'heading' => "Media heading",
							'content' => "Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus
									odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla.
									Donec lacinia congue felis in faucibus.",
							'htmlOptions' => array(
								'items' => array(
									array(
										'image' => "http://placehold.it/64x64",
										'heading' => "Media heading",
										'content' => "Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus
												odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla.
												Donec lacinia congue felis in faucibus."
									)
								)
							)
						)
					)
				)
			),
			array(
				'image' => "http://placehold.it/64x64",
				'heading' => "Media heading",
				'content' => "Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus
					odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla.
					Donec lacinia congue felis in faucibus."
			)
		)
	);
	?>
</div>
<div class="clearfix"></div>
<div class="modals">
    <h5>Modals</h5>
	<strong>Display with button to load modal automatically</strong>
	<div>
	<?php
		$this->widget('bootstrap.widgets.TbModal', array(
			'id' => 'sample-modal-1',
			'buttonOptions' => array('label'=>'show modal', 'class' => 'btn-primary btn-large'),
			'header' => '<h3>Bootstrap Modal</h3>',
			'content' => '<p>This is the modal content</p>',
			'footer' => TbHtml::button('Close', array('data-dismiss'=>'modal')),
			'onShow' => 'js:function(){console.log("show event!");}',
			'onShown' => 'js:function(){console.log("shown event!");}',
			'onHide' => 'js:function(){console.log("hide event!");}',
			'onHidden' => 'js:function(){console.log("hidden event!");}',
		));
	?>
    </div>
    <strong>Remote Content</strong>
	<p><span class="label label-important">Not working on my computer with <strong>showScriptName=>true</strong></span>,
	please, review the issues with the app structure.</p>
    <div>
		<?php
		$this->widget('bootstrap.widgets.TbModal', array(
			'id' => 'sample-modal-2',
			'remote' => array('/site/testRemote'),
			'buttonOptions' => array('label'=>'show modal with remote content', 'class' => 'btn-primary btn-large'),
			'header' => '<h3>Bootstrap Modal</h3>',
			'footer' => TbHtml::button('Close', array('data-dismiss'=>'modal')),
			'onShow' => 'js:function(){console.log("show event!");}',
			'onShown' => 'js:function(){console.log("shown event!");}',
			'onHide' => 'js:function(){console.log("hide event!");}',
			'onHidden' => 'js:function(){console.log("hidden event!");}',
		));
		?>
    </div>

	<strong>Displaying the markup only (for its use with other plugins)</strong>
	<div>
		<pre>
<?php
ob_start();
$this->widget('bootstrap.widgets.TbModal', array(
	'show' => false,
	'id' => 'sample-modal-3',
	'header' => '<h3>Bootstrap Modal</h3>',
	'content' => '<p>This is the modal content</p>',
	'footer' => TbHtml::button('Close', array('data-dismiss'=>'modal')),
));
			echo CHtml::encode(ob_get_clean());
			?>
		</pre>
	</div>
</div>
<div class="clearfix"></div>
<div id="tabs">
	<h5>Tabs Left <small>Change configuration for testing</small></h5>
	<?php
	$this->widget('bootstrap.widgets.TbTabs', array(
		'type' => TbHtml::NAV_TABS,
		'placement' => TbHtml::TABS_LEFT,
		'tabs'=>array(
			array('label'=>'Home', 'content'=>'Raw denim you probably haven\'t heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.', 'active'=>true),
			array('label'=>'Profile', 'content'=>'Food truck fixie locavore, accusamus mcsweeney\'s marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.'),
			array('label'=>'Dropdown', 'items'=>array(
				array('label'=>'@fat', 'content'=>'Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney\'s organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven\'t heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.'),
				array('label'=>'@mdo', 'content'=>'Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.'),
			)),
		),
		'onShown' => 'js:function(e){console.log(e.target, e.relatedTarget);}'
	));
	?>
</div>
<div class="clearfix"></div>
<div id="typeahead">
	<h5>Typeahead plugin <small>accepts bootstrap options</small></h5>
	<?php
		$this->widget('bootstrap.widgets.TbTypeAhead', array(
			'name' => 'typeahead-test',
			'htmlOptions' => array('prepend'=>TbHtml::icon(TbIcon::ICON_GLOBE), 'placeholder'=>'Write an USA country'),
			'source' => array(
				"Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida",
				"Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine",
				"Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska",
				"Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio",
				"Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas",
				"Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"),

		));
	?>
</div>

<div class="clearfix"></div>
<div id="grid">
    <h5>GridView</h5>
	<?php
	$gridDataProvider = Person::getGridDataProvider();

// $gridColumns
	$gridColumns = array(
		array('name'=>'id', 'header'=>'#', 'htmlOptions'=>array('style'=>'width: 60px')),
		array('name'=>'firstName', 'header'=>'First name'),
		array('name'=>'lastName', 'header'=>'Last name'),
		array('name'=>'language', 'header'=>'Language'),
		array('name'=>'hours', 'header'=>'Hours worked'),
		array(
			'htmlOptions' => array('nowrap'=>'nowrap'),
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'viewButtonUrl'=>null,
			'updateButtonUrl'=>null,
			'deleteButtonUrl'=>null,
		)
	);

	$this->widget('bootstrap.widgets.TbGridView', array(
		'type' => array(TbHtml::GRID_CONDENSED, TbHtml::GRID_STRIPED),
		'dataProvider'=>$gridDataProvider,
		'template'=>"{items}{pager}",
		'columns'=>$gridColumns,
	));
	?>
</div>
<div id="detailView">
    <h5>EditView</h5>
	<?php
	$person = new Person();
	$person->firstName = 'Antonio';
	$person->lastName = 'Ramirez';
	$person->hours = 40;

	$this->widget('bootstrap.widgets.TbDetailView', array(
		'type' => array(TbHtml::GRID_BORDERED, TbHtml::GRID_STRIPED),
		'data'=> $person,
		'attributes'=> array(
			'firstName',
			'lastName',
			'hours'
		)
	));
	?>
</div>