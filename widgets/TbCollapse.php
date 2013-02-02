<?php
/**
 * TbCollapse class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
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
	 * @var string[] $events the JavaScript event configuration (name=>handler).
	 */
	public $events = array();

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		$this->htmlOptions = TbHtml::addClassName('collapse', $this->htmlOptions);
		$this->htmlOptions['data-toggle'] = 'collapse';
		if (isset($this->parent))
			$this->htmlOptions = TbHtml::defaultOption('data-parent', $this->parent, $this->htmlOptions);
		if (isset($this->toggle) && $this->toggle)
			$this->htmlOptions = TbHtml::addClassName('in', $this->htmlOptions);
		parent::init();
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		parent::run();
		$selector = $this->htmlOptions['id'];
		$this->registerEvents($selector, $this->events);
	}
}