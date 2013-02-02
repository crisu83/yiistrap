<?php
/**
 * TbNavbar class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

/**
 * Bootstrap navbar widget.
 * @see http://twitter.github.com/bootstrap/components.html#navbar
 */
class TbNavbar extends CWidget
{
	/**
	 * @var string the navbar style.
	 */
	public $style;
	/**
	 * @var string the brand label text.
	 */
	public $brandLabel;
	/**
	 * @var mixed the brand url.
	 */
	public $brandUrl;
	/**
	 * @var array the HTML attributes for the brand link.
	 */
	public $brandOptions = array();
	/**
	 * @var string fix location of the navbar is applicable.
	 */
	public $fixed = TbHtml::POSITION_TOP;
	/**
	 * @var boolean whether the navbar spans over the whole page.
	 */
	public $fluid = false;
	/**
	 * @var boolean whether to enable collapsing of the navbar on narrow screens.
	 */
	public $collapse = false;
	/**
	 * @var array list of navbar item.
	 */
	public $items = array();
	/**
	 * @var array the HTML attributes for the navbar.
	 */
	public $htmlOptions = array();

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		if ($this->brandLabel !== false)
		{
			if (!isset($this->brandLabel))
				$this->brandLabel = CHtml::encode(Yii::app()->name);

			if (!isset($this->brandUrl))
				$this->brandUrl = Yii::app()->homeUrl;

			if ($this->brandUrl !== false)
				$this->brandOptions['href'] = CHtml::normalizeUrl($this->brandUrl);

			$this->brandOptions = TbHtml::addClassName('brand', $this->brandOptions);
		}

		$this->htmlOptions = TbHtml::addClassName('navbar', $this->htmlOptions);

		if (isset($this->style) && in_array($this->style, TbHtml::$navbarStyles))
			$this->htmlOptions = TbHtml::addClassName('navbar-' . $this->style, $this->htmlOptions);

		if ($this->fixed !== false && in_array($this->fixed, TbHtml::$positions))
			$this->htmlOptions = TbHtml::addClassName('navbar-fixed-' . $this->fixed, $this->htmlOptions);
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		$brand = $this->brandLabel !== false
			? CHtml::tag($this->brandUrl !== false ? 'a' : 'span', $this->brandOptions, $this->brandLabel)
			: '';

		ob_start();
		foreach ($this->items as $item)
		{
			if (is_string($item))
				echo $item;
			else
			{
				$widgetClassName = TbHtml::popOption('class', $item);
				if ($widgetClassName !== null)
					$this->controller->widget($widgetClassName, $item);
			}
		}
		$items = ob_get_clean();

		echo CHtml::openTag('div', $this->htmlOptions);
		echo '<div class="navbar-inner">';
		echo CHtml::openTag('div', array('class' => $this->fluid ? 'container-fluid' : 'container'));

		if ($this->collapse !== false)
		{
			$collapseId = TbHtml::getNextId();
			echo TbHtml::collapseIcon('#' . $collapseId);
			echo $brand;
			$this->controller->beginWidget('bootstrap.widgets.TbCollapse', array(
				'id' => $collapseId,
				'toggle' => false, // navbars are collapsed by default
				'htmlOptions' => array('class' => 'nav-collapse'),
			));
			echo $items;
			$this->controller->endWidget();
		}
		else
			echo $brand . $items;

		echo '</div></div></div>';
	}
}