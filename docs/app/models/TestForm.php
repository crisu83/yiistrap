<?php
/**
 * TbHtml class file.
 * @author Antonio Ramirez <ramirez.cobos@gmail.com>
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.helpers
 */

/**
 * TestForm Model
 */
class TestForm extends CFormModel
{
	public $textField;
	public $password;
	public $textarea;
	public $dropdown;
	public $multiDropdown;
	public $checkbox;
	public $checkboxes;
	public $inlineCheckboxes;
	public $radioButton;
	public $radioButtons;
	public $inlineRadioButtons;
	public $fileField;
	public $uneditable;
	public $disabled;
	public $prepend;
	public $append;
	public $disabledCheckbox;
	public $captcha;

	public function attributeLabels()
	{
		return array(
			'textField'=>'Text input',
			'dropdown'=>'Select list',
			'multiDropdown'=>'Multiple select',
			'checkbox'=>'Check me out',
			'inlineCheckboxes'=>'Inline checkboxes',
			'radioButtons'=>'Radio buttons',
			'fileField'=>'File input',
			'uneditable'=>'Uneditable input',
			'disabled'=>'Disabled input',
			'prepend'=>'Prepend text',
			'append'=>'Append text',
			'disabledCheckbox'=>'Disabled checkbox',
		);
	}
}
