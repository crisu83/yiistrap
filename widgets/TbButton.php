<?php
/**
 * TbButton class file.
 * @author Sergey Kasatikoff <kasatikoff@gmail.com>
 * @copyright Copyright &copy; Sergey Kasatikoff 2014-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 * @since 0.0.01
 */

/**
 * Bootstrap button widget.
 * @see http://twitter.github.com/bootstrap/base-css.html#buttons
 */
class TbButton extends CWidget
{
    /**
     * @var string the button callback types.
     * Valid values are 'link', 'button', 'submit', 'submitLink', 'reset', 'ajaxLink', 'ajaxButton' and 'ajaxSubmit'.
     */
    public $type = TbHtml::BUTTON_TYPE_LINK;
    /**
     * @var string the button type.
     * Valid values are 'primary', 'info', 'success', 'warning', 'danger' and 'inverse'.
     */
    public $color;
    /**
     * @var string the button size.
     * Valid values are 'large', 'small' and 'mini'.
     */
    public $size;
    /**
     * @var string the button icon, e.g. 'ok' or 'remove white'.
     */
    public $icon;
    /**
     * @var string the button label.
     */
    public $label;
    /**
     * @var string the button URL.
     */
    public $url;
    /**
     * @var boolean indicates whether the button should span the full width of the a parent.
     */
    public $block = false;
    /**
     * @var string the button loading.
     */
    public $loading;
    /**
     * @var boolean indicates whether the button is active.
     */
    public $active = false;
    /**
     * @var boolean indicates whether the button is disabled.
     */
    public $disabled = false;
    /**
     * @var boolean indicates whether to encode the label.
     */
    public $encodeLabel = true;
    /**
     * @var boolean indicates whether to enable toggle.
     */
    public $toggle;
    /**
     * @var string the loading text.
     */
    public $loadingText;
    /**
     * @var string the complete text.
     */
    public $completeText;
    /**
     * @var array the dropdown button items.
     */
    public $items;
    /**
     * @var array the HTML attributes for the widget container.
     */
    public $htmlOptions = array();
    /**
     * @var array the HTML attributes for iconOptions the widget container.
     */
    public $iconOptions = array();
    /**
     * @var array the button ajax options (used by 'ajaxLink' and 'ajaxButton').
     */
    public $ajaxOptions = array();
    /**
     * @var array the HTML attributes for the dropdown menu.
     * @since 0.9.11
     */
    public $dropdownOptions = array();
    public $groupOptions = array();
    public $menuOptions = array();
    public $dropup;

    /**
     * Initializes the widget.
     */
    public function init()
    {
        $this->attachBehavior('TbWidget', new TbWidget);

        if (isset($this->type)) {
            switch ($this->type) {
                case 'html':
                    $this->type = TbHtml::BUTTON_TYPE_HTML;
                    break;
                case 'submit':
                    $this->type = TbHtml::BUTTON_TYPE_SUBMIT;
                    break;
                case 'reset':
                    $this->type = TbHtml::BUTTON_TYPE_RESET;
                    break;
                case 'image':
                    $this->type = TbHtml::BUTTON_TYPE_IMAGE;
                    break;
                case 'ajaxLink':
                    $this->type = TbHtml::BUTTON_TYPE_AJAXLINK;
                    break;
                case 'ajax':
                    $this->type = TbHtml::BUTTON_TYPE_AJAXBUTTON;
                    break;
                case 'input':
                    $this->type = TbHtml::BUTTON_TYPE_INPUTBUTTON;
                    break;
                case 'link':
                    $this->type = TbHtml::BUTTON_TYPE_LINK;
                    break;
                default:
                    $this->type = TbHtml::BUTTON_TYPE_LINK;
            }
            TbArray::defaultValue('type', $this->type, $this->htmlOptions);
        }

        if (isset($this->color))
            TbArray::defaultValue('color', $this->color, $this->htmlOptions);

        if (isset($this->size))
            TbArray::defaultValue('size', $this->size, $this->htmlOptions);

        if (isset($this->icon))
            TbArray::defaultValue('icon', $this->icon, $this->htmlOptions);

        if (isset($this->url))
            TbArray::defaultValue('url', $this->url, $this->htmlOptions);

        if (isset($this->iconOptions))
            TbArray::defaultValue('iconOptions', $this->iconOptions, $this->htmlOptions);

        if ($this->disabled === true)
            TbArray::defaultValue('disabled', $this->disabled, $this->htmlOptions);

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
        echo TbHtml::btn($this->type, $this->label, $this->htmlOptions);
    }
}
