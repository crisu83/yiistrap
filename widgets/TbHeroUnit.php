<?php
/**
 * TbHeroUnit class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

Yii::import('bootstrap.helpers.TbHtml');

/**
 * Bootstrap hero unit widget.
 * @see http://twitter.github.com/bootstrap/javascript.html#affix
 */
class TbHeroUnit extends CWidget
{
	/**
	 * @var string the heading text.
	 */
	public $heading;
	/**
	 * @var array the HTML attributes for the heading.
	 */
	public $headingOptions = array();
	/**
	 * @var string the content text or path to a partial view with the content.
	 */
	public $content;
	/**
	 * @var array the HTML attributes for the container tag.
	 */
	public $htmlOptions = array();
	/**
	 * @var array additional data to be passed to the view.
	 */
	public $viewData = array();

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		$controller = $this->getController();
		if (isset($controller) && $controller->getViewFile($this->content) !== false)
			$this->content = $this->controller->renderPartial($this->content, $this->viewData, true);
		$this->htmlOptions['headingOptions'] = $this->headingOptions;
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		echo TbHtml::heroUnit($this->heading, $this->content, $this->htmlOptions);
	}
}
