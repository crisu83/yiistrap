<?php
/**
 * TbNavbar class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

Yii::import('bootstrap.helpers.TbHtml');

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
	public $position;
	/**
	 * @var boolean whether the navbar should be static on the top of the page.
	 */
	public $static = false;
	/**
	 * @var boolean whether the navbar spans over the whole page.
	 */
	public $fluid = false;
	/**
	 * @var boolean whether to enable collapsing of the navbar on narrow screens.
	 */
	public $collapse = false;
	/**
	 * @var array additional HTML attributes for the collapse widget.
	 */
	public $collapseOptions = array();
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
		}
		// todo: somehow the style attribute in htmlOptions is ignored completely, fix.
		if (isset($this->style))
			$this->htmlOptions = TbHtml::defaultOption('style', $this->style, $this->htmlOptions);
		if ($this->position !== false)
			$this->htmlOptions = TbHtml::defaultOption('position', $this->position, $this->htmlOptions);
		if ($this->static)
			$this->htmlOptions = TbHtml::defaultOption('static', $this->static, $this->htmlOptions);
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		$brand = $this->brandLabel !== false
			? TbHtml::navbarBrandLink($this->brandLabel, $this->brandUrl, $this->brandOptions)
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

		ob_start();
		echo CHtml::openTag('div', array('class' => $this->fluid ? 'container-fluid' : 'container'));

		if ($this->collapse !== false)
		{
			$collapseId = TbHtml::getNextId();
			$this->collapseOptions = TbHtml::addClassName('nav-collapse', $this->collapseOptions);
			echo TbHtml::collapseIcon('#' . $collapseId) . PHP_EOL;
			echo $brand . PHP_EOL;
			$this->controller->beginWidget('bootstrap.widgets.TbCollapse', array(
				'id' => $collapseId,
				'toggle' => false, // navbars are collapsed by default
				'htmlOptions' => $this->collapseOptions,
			));
			echo $items;
			$this->controller->endWidget();
		}
		else
		{
			echo $brand . PHP_EOL;
			echo $items . PHP_EOL;
		}

		echo '</div>';
		$content = ob_get_clean();
		echo TbHtml::navbar($content, $this->htmlOptions);
	}
}