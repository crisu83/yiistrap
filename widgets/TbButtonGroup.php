<?php
/**
* TbButtonGroup class file.
* @author Sergey Kasatikoff <kasatikoff@gmail.com>
* @copyright Copyright &copy; Sergey Kasatikoff 2014-
* @license http://www.opensource.org/licenses/bsd-license.php New BSD License
* @package bootstrap.widgets
* @since 0.0.01
*/

/**
* Bootstrap button group widget.
* @see http://twitter.github.com/bootstrap/components.html#buttonGroups
*/
class TbButtonGroup extends CWidget
{
	/**
	* @var string the button callback type.
	* @see BootButton::type
	*/
	public $type = TbHtml::BUTTON_TYPE_LINK;
	/**
	* @var string the button type.
	* @see BootButton::type
	*/
	public $color;
	/**
	* @var string the button size.
	* @see BootButton::size
	*/
	public $size;
	/**
	* @var boolean indicates whether to encode the button labels.
	*/
	public $encodeLabel = true;
	/**
	* @var array the HTML attributes for the widget container.
	*/
	public $htmlOptions = array();
	/**
	* @var array the button configuration.
	*/
	public $buttons = array();
	/**
	* @var boolean indicates whether to enable button toggling.
	*/
	public $toggle;
	/**
	* @var boolean indicates whether the button group appears vertically stacked. Defaults to 'false'.
	*/
	public $stacked = false;
	/**
	* @var boolean indicates whether dropdowns should be dropups instead. Defaults to 'false'.
	*/
	public $dropup = false;
	/**
	* @var boolean indicates whether the button is disabled.
	*/
	public $disabled = false;

	/**
	* Initializes the widget.
	*/
	public function init()
	{
		$this->attachBehavior('TbWidget', new TbWidget);

		if (isset($this->type))
			TbArray::defaultValue('type', $this->type, $this->htmlOptions);

		if (isset($this->color))
			TbArray::defaultValue('color', $this->color, $this->htmlOptions);

		if (isset($this->size))
			TbArray::defaultValue('size', $this->size, $this->htmlOptions);

		if (isset($this->icon))
			TbArray::defaultValue('icon', $this->icon, $this->htmlOptions);

		if (isset($this->iconOptions))
			TbArray::defaultValue('iconOptions', $this->iconOptions, $this->htmlOptions);

		if ($this->disabled === true)
			TbArray::defaultValue('disabled', $this->disabled, $this->htmlOptions);

		if ($this->stacked === true)
			TbArray::defaultValue('stacked', $this->stacked, $this->htmlOptions);

		if (isset($this->loading))
			TbArray::defaultValue('loading', $this->loading, $this->htmlOptions);

		if (isset($this->toggle))
			TbArray::defaultValue('toggle', $this->toggle, $this->htmlOptions);

		if (isset($this->items))
			TbArray::defaultValue('items', $this->items, $this->htmlOptions);

		if (isset($this->groupOptions))
			TbArray::defaultValue('groupOptions', $this->groupOptions, $this->htmlOptions);

		if (isset($this->menuOptions))
			TbArray::defaultValue('menuOptions', $this->menuOptions, $this->htmlOptions);

		if ($this->dropup === true)
			TbArray::defaultValue('dropup', true, $this->htmlOptions);

		if (isset($this->ajaxOptions))
			TbArray::defaultValue('ajaxOptions', $this->ajaxOptions, $this->htmlOptions);

		if (isset($this->active))
			TbArray::defaultValue('active', $this->active, $this->htmlOptions);
	}

	/**
	* Runs the widget.
	*/
	public function run()
	{
		echo TbHtml::buttonGroup($this->buttons, $this->htmlOptions);
	}
}
