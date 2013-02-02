<?php
/**
 * TbCollapse class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

Yii::import('bootstrap.widgets.TbWrap');

/**
 * Bootstrap collapse widget.
 * @see http://twitter.github.com/bootstrap/javascript.html#collapse
 */
class TbCollapse extends TbWrap
{
	/**
	 * @var string the CSS selector for the parent element.
	 */
	public $parent;
	/**
	 * @var boolean whether to be collapsed on invocation.
	 */
	public $toggle;
	/**
	 * @var array the JavaScript options for the plugin.
	 */
	public $options = array();
	/**
	 * @var string[] $events the JavaScript event configuration (name=>handler).
	 */
	public $events = array();

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		if (isset($this->parent))
			$this->options = TbHtml::defaultOption('parent', $this->parent, $this->options);
		if (isset($this->toggle))
			$this->options = TbHtml::defaultOption('toggle', $this->toggle, $this->options);
		parent::init();
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		parent::run();
		$selector = $this->htmlOptions['id'];
		$this->options = TbHtml::defaultOption('events', $this->events, $this->options);
		$this->registerPlugin(TbApi::PLUGIN_COLLAPSE, $selector, $this->options);
	}
}