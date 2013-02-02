<?php
/**
 * TbAffix class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

Yii::import('bootstrap.widgets.TbWrap');

/**
 * Bootstrap affix widget.
 * @see http://twitter.github.com/bootstrap/javascript.html#affix
 */
class TbAffix extends TbWrap
{
	/**
	 * @var mixed pixels to offset from screen when calculating position of scroll.
	 */
	public $offset;

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		$this->htmlOptions['data-spy'] = 'affix';
		if (isset($this->offset))
		{
			if (is_string($this->offset))
				$this->offset = array(TbHtml::POSITION_TOP, $this->offset);

			if (is_array($this->offset) && count($this->offset) === 2)
			{
				list($position, $offset) = $this->offset;
				if (in_array($position, TbHtml::$positions))
					$this->options = TbHtml::defaultOption('data-offset-' . $position, $offset, $this->options);
			}
		}
		parent::init();
	}
}