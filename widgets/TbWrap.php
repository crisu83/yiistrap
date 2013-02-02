<?php
/**
 * TbWrap class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

Yii::import('bootstrap.components.TbApi');
Yii::import('bootstrap.widgets.TbWidget');

/**
 * Bootstrap base widget for wrappers.
 */
abstract class TbWrap extends TbWidget
{
	/**
	 * @var string the HTML tag for the container.
	 */
	public $tagName = 'div';
	/**
	 * @var array the HTML attributes for the container.
	 */
	public $htmlOptions = array();

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		$this->htmlOptions = TbHtml::defaultOption('id', $this->getId(), $this->htmlOptions);
		echo CHtml::openTag($this->tagName, $this->htmlOptions);
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		echo CHtml::closeTag($this->tagName);
	}
}