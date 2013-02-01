<?php
/**
 * TbCollapse class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

Yii::import('bootstrap.components.TbApi');

/**
 * Bootstrap collapse widget.
 * @see http://twitter.github.com/bootstrap/javascript.html#collapse
 */
class TbCollapse extends CWidget
{
	// Collapse widget id prefix.
	const ID_PREFIX = 'tbcollapse';

	/**
	 * @var string the HTML tag for the container.
	 */
	public $tagName = 'div';
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
	 * @var array the HTML attributes for the container.
	 */
	public $htmlOptions = array();

	private static $_containerId = 0;

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		$this->htmlOptions = TbHtml::defaultOption('id', $this->getId(), $this->htmlOptions);
		if (isset($this->parent))
			$this->options = TbHtml::defaultOption('parent', $this->parent, $this->options);
		if (isset($this->toggle))
			$this->options = TbHtml::defaultOption('toggle', $this->toggle, $this->options);

		echo CHtml::openTag($this->tagName, $this->htmlOptions);
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		echo CHtml::closeTag($this->tagName);
		$selector = $this->htmlOptions['id'];
		$this->options = TbHtml::defaultOption('events', $this->events, $this->options);
		Yii::app()->bootstrap->registerPlugin(TbApi::PLUGIN_COLLAPSE, $selector, $this->options);
	}

	/**
	 * Returns the next collapse container ID.
	 * @return string the id.
	 */
	public static function getNextContainerId()
	{
		return self::ID_PREFIX . self::$_containerId++;
	}
}