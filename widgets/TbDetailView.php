<?php
/**
 * TbDetailView class file.
 * @author Antonio Ramirez <ramirez.cobos@gmail.com>
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

Yii::import('bootstrap.helpers.TbHtml');
Yii::import('zii.widgets.CDetailView');

class TbDetailView extends CDetailView
{

	/**
	 * @var string|array the table type.
	 * Valid values are TbHtml::GRID_STRIPED, TbHtml::GRID_BORDERED and/or TbHtml::GRID_CONDENSED.
	 */
	public $type = array(TbHtml::GRID_STRIPED, TbHtml::GRID_CONDENSED);

	/**
	 * @var string the URL of the CSS file used by this detail view.
	 * Defaults to false, meaning that no CSS will be included.
	 */
	public $cssFile = false;

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();

		$classes = array('table');

		if (isset($this->type) && !empty($this->type))
		{
			if (is_string($this->type))
				$this->type = explode(' ', $this->type);

			$validTypes = array(TbHtml::GRID_BORDERED, TbHtml::GRID_CONDENSED, TbHtml::GRID_STRIPED);
			foreach ($this->type as $type)
			{
				if (in_array($type, $validTypes))
					$classes[] = 'table-' . $type;
			}
		}

		$this->htmlOptions = TbHtml::addClassName(implode(' ', $classes), $this->htmlOptions);
	}
}
