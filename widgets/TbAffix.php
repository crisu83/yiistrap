<?php
/**
 * TbAffix class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
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
	 * @var array the JavaScript options for the plugin.
	 */
	public $options = array();

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		$this->options = TbHtml::defaultOption('data-spy', 'affix', $this->options);
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

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		parent::run();
		$selector = $this->htmlOptions['id'];
		$this->registerPlugin(TbApi::PLUGIN_AFFIX, $selector, $this->options);
	}
}