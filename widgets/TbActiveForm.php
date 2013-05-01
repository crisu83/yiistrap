<?php
/**
 * TbActiveForm class file.
 * @author Antonio Ramirez <ramirez.cobos@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

Yii::import('bootstrap.helpers.TbHtml');

/**
 * Class TbActiveForm
 */
class TbActiveForm extends CActiveForm
{
	/**
	 * @var string the form type.
	 * Valid values are TbHtml::FORM_HORIZONTAL, TbHtml::FORM_INLINE and TbHtml::FORM_VERTICAL.
	 */
	public $type;
	/**
	 * @var string the help type. Valid values are TbHtml::HELP_INLINE and TbHtml::HELP_BLOCK.
	 */
	public $helpType;
	/**
	 * @var string the CSS class name for error messages.
	 */
	public $errorMessageCssClass = TbHtml::STYLE_ERROR;

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		if (!in_array($this->type, array(TbHtml::FORM_HORIZONTAL, TbHtml::FORM_INLINE, TbHtml::FORM_VERTICAL)))
			$this->type = TbHtml::FORM_VERTICAL;

		$this->htmlOptions = TbHtml::addClassName('form-' . $this->type, $this->htmlOptions);

		if (null === $this->helpType)
			$this->helpType = $this->type == TbHtml::FORM_HORIZONTAL
				? TbHtml::HELP_INLINE
				: TbHtml::HELP_BLOCK;

		parent::init();
	}

	/**
	 * Runs the widget.
	 * This registers the necessary javascript code and renders the form close tag.
	 */
	public function run()
	{
		/* todo: override this parent's method in order to register our own js */
		parent::run();
	}

	/**
	 * Displays the first validation error for a model attribute.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute name
	 * @param array $htmlOptions additional HTML attributes to be rendered in the container div tag.
	 * @return string the error display. Empty if no errors are found.
	 * @see CModel::getErrors
	 * @see errorMessageCss
	 */
	protected function renderError($model, $attribute, $htmlOptions = array())
	{
		$htmlOptions = TbHtml::defaultOption('formType', $this->type, $htmlOptions);
		return TbHtml::error($model, $attribute, $htmlOptions);
	}

	/**
	 * Displays the first validation error for a model attribute.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute name
	 * @param array $htmlOptions additional HTML attributes to be rendered in the container div tag.
	 * @param boolean $enableAjaxValidation whether to enable AJAX validation for the specified attribute.
	 * @param boolean $enableClientValidation whether to enable client-side validation for the specified attribute.
	 * @return string the validation result (error display or success message).
	 */
	public function error($model, $attribute, $htmlOptions = array(), $enableAjaxValidation = true, $enableClientValidation = true)
	{
		if (!$this->enableAjaxValidation)
			$enableAjaxValidation = false;

		if (!$this->enableClientValidation)
			$enableClientValidation = false;

		if (!isset($htmlOptions['class']))
			$htmlOptions['class'] = $this->errorMessageCssClass;

		if (!$enableAjaxValidation && !$enableClientValidation)
			return $this->renderError($model, $attribute, $htmlOptions);

		$id = CHtml::activeId($model, $attribute);
		$inputID = TbHtml::getOption('inputID', $htmlOptions, $id);
		unset($htmlOptions['inputID']);

		if (!isset($htmlOptions['id']))
			$htmlOptions['id'] = $inputID . '_em_';

		$option = array(
			'id' => $id,
			'inputID' => $inputID,
			'errorID' => $htmlOptions['id'],
			'model' => get_class($model),
			'name' => CHtml::resolveName($model, $attribute),
			'enableAjaxValidation' => $enableAjaxValidation,
			'inputContainer' => 'div.control-group', // Bootstrap requires this ;)
		);

		$optionNames = array(
			'validationDelay',
			'validateOnChange',
			'validateOnType',
			'hideErrorMessage',
			'inputContainer',
			'errorCssClass',
			'successCssClass',
			'validatingCssClass',
			'beforeValidateAttribute',
			'afterValidateAttribute',
		);

		foreach ($optionNames as $name)
		{
			$option[$name] = TbHtml::getOption($name, $htmlOptions);
			unset($htmlOptions[$name]);
		}

		if ($model instanceof CActiveRecord && !$model->isNewRecord)
			$option['status'] = 1;

		if ($enableClientValidation)
		{
			$validators = TbHtml::getOption('clientValidation', $htmlOptions, array());

			$attributeName = $attribute;
			if (($pos = strrpos($attribute, ']')) !== false && $pos !== strlen($attribute) - 1) // e.g. [a]name
				$attributeName = substr($attribute, $pos + 1);

			foreach ($model->getValidators($attributeName) as $validator)
			{
				if ($validator->enableClientValidation)
					if (($js = $validator->clientValidateAttribute($model, $attributeName)) != '')
						$validators[] = $js;
			}

			if ($validators !== array())
				$option['clientValidation'] = "js:function(value, messages, attribute) {\n" . implode("\n", $validators) . "\n}";
		}

		$html = TbHtml::error($model, $attribute, $htmlOptions);

		if ($html === '')
		{
			$htmlOptions = TbHtml::addStyles('display:none', $htmlOptions);
			$html = CHtml::tag('span', $htmlOptions, '');
		}

		$this->attributes[$inputID] = $option;

		return $html;
	}


	/**
	 * Displays a summary of validation errors for one or several models.
	 * This method is very similar to {@link TbHtml::errorSummary} except that it also works
	 * when AJAX validation is performed.
	 * @param mixed $models the models whose input errors are to be displayed. This can be either
	 * a single model or an array of models.
	 * @param string $header a piece of HTML code that appears in front of the errors
	 * @param string $footer a piece of HTML code that appears at the end of the errors
	 * @param array $htmlOptions additional HTML attributes to be rendered in the container div tag.
	 * @return string the error summary. Empty if no errors are found.
	 * @see TbHtml::errorSummary
	 */
	public function errorSummary($models, $header = null, $footer = null, $htmlOptions = array())
	{
		$htmlOptions = TbHtml::addClassName('alert alert-block alert-error', $htmlOptions);

		return parent::errorSummary($models, $header, $footer, $htmlOptions);
	}

	/**
	 * Renders an HTML label for a model attribute.
	 * This method is a wrapper of {@link TbHtml::activeLabel}.
	 * Please check {@link TbHtml::activeLabel} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated label tag
	 */
	public function label($model, $attribute, $htmlOptions = array())
	{
		if ($this->type == TbHtml::FORM_HORIZONTAL)
			$htmlOptions = TbHtml::addClassName('control-label', $htmlOptions);
		return parent::label($model, $attribute, $htmlOptions);
	}

	/**
	 * Renders an HTML label for a model attribute.
	 * This method is a wrapper of {@link TbHtml::activeLabelEx}.
	 * Please check {@link TbHtml::activeLabelEx} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated label tag
	 */
	public function labelEx($model, $attribute, $htmlOptions = array())
	{
		if ($this->type == TbHtml::FORM_HORIZONTAL)
			$htmlOptions = TbHtml::addClassName('control-label', $htmlOptions);
		return parent::labelEx($model, $attribute, $htmlOptions);
	}

	/**
	 * Renders a url field for a model attribute.
	 * This method is a wrapper of {@link TbHtml::activeUrlField}.
	 * Please check {@link TbHtml::activeUrlField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 * @since Yii 1.1.11
	 */
	public function urlField($model, $attribute, $htmlOptions = array())
	{
		return $this->wrapControl(TbHtml::activeUrlField($model, $attribute, $htmlOptions));
	}

	/**
	 * Renders an email field for a model attribute.
	 * This method is a wrapper of {@link TbHtml::activeEmailField}.
	 * Please check {@link TbHtml::activeEmailField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 * @since 1.1.11
	 */
	public function emailField($model, $attribute, $htmlOptions = array())
	{
		return $this->wrapControl(TbHtml::activeEmailField($model, $attribute, $htmlOptions));
	}

	/**
	 * Renders a number field for a model attribute.
	 * This method is a wrapper of {@link TbHtml::activeNumberField}.
	 * Please check {@link TbHtml::activeNumberField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 * @since 1.1.11
	 */
	public function numberField($model, $attribute, $htmlOptions = array())
	{
		return $this->wrapControl(TbHtml::activeNumberField($model, $attribute, $htmlOptions));
	}

	/**
	 * Generates a range field for a model attribute.
	 * This method is a wrapper of {@link TbHtml::activeRangeField}.
	 * Please check {@link TbHtml::activeRangeField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 * @since 1.1.11
	 */
	public function rangeField($model, $attribute, $htmlOptions = array())
	{
		return $this->wrapControl(TbHtml::activeRangeField($model, $attribute, $htmlOptions));
	}

	/**
	 * Renders a date field for a model attribute.
	 * This method is a wrapper of {@link TbHtml::activeDateField}.
	 * Please check {@link TbHtml::activeDateField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 * @since 1.1.11
	 */
	public function dateField($model, $attribute, $htmlOptions = array())
	{
		return $this->wrapControl(TbHtml::activeDateField($model, $attribute, $htmlOptions));
	}

	/**
	 * Renders a text field for a model attribute.
	 * This method is a wrapper of {@link TbHtml::activeTextField}.
	 * Please check {@link TbHtml::activeTextField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 */
	public function textField($model, $attribute, $htmlOptions = array())
	{
		return $this->wrapControl(TbHtml::activeTextField($model, $attribute, $htmlOptions));
	}

	/**
	 * Renders a password field for a model attribute.
	 * This method is a wrapper of {@link TbHtml::activePasswordField}.
	 * Please check {@link TbHtml::activePasswordField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 */
	public function passwordField($model, $attribute, $htmlOptions = array())
	{
		return $this->wrapControl(TbHtml::activePasswordField($model, $attribute, $htmlOptions));
	}

	/**
	 * Renders a text area for a model attribute.
	 * This method is a wrapper of {@link TbHtml::activeTextArea}.
	 * Please check {@link TbHtml::activeTextArea} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated text area
	 */
	public function textArea($model, $attribute, $htmlOptions = array())
	{
		return $this->wrapControl(TbHtml::activeTextArea($model, $attribute, $htmlOptions));
	}

	/**
	 * Renders a file field for a model attribute.
	 * This method is a wrapper of {@link TbHtml::activeFileField}.
	 * Please check {@link TbHtml::activeFileField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes
	 * @return string the generated input field
	 */
	public function fileField($model, $attribute, $htmlOptions = array())
	{
		return $this->wrapControl(TbHtml::activeFileField($model, $attribute, $htmlOptions));
	}

	/**
	 * Renders a radio button for a model attribute.
	 * This method is a wrapper of {@link TbHtml::activeRadioButton}.
	 * Please check {@link TbHtml::activeRadioButton} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated radio button
	 */
	public function radioButton($model, $attribute, $htmlOptions = array())
	{
		return $this->wrapControl(TbHtml::activeRadioButton($model, $attribute, $htmlOptions));
	}

	/**
	 * Renders a checkbox for a model attribute.
	 * This method is a wrapper of {@link TbHtml::activeCheckBox}.
	 * Please check {@link TbHtml::activeCheckBox} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated check box
	 */
	public function checkBox($model, $attribute, $htmlOptions = array())
	{
		return $this->wrapControl(TbHtml::activeCheckBox($model, $attribute, $htmlOptions));
	}

	/**
	 * Renders a dropdown list for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeDropDownList}.
	 * Please check {@link CHtml::activeDropDownList} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $data data for generating the list options (value=>display)
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated drop down list
	 */
	public function dropDownList($model, $attribute, $data, $htmlOptions = array())
	{
		return $this->wrapControl(TbHtml::activeDropDownList($model, $attribute, $data, $htmlOptions));
	}

	/**
	 * Renders a list box for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeListBox}.
	 * Please check {@link CHtml::activeListBox} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $data data for generating the list options (value=>display)
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated list box
	 */
	public function listBox($model, $attribute, $data, $htmlOptions = array())
	{
		return $this->wrapControl(TbHtml::activeListBox($model, $attribute, $data, $htmlOptions));
	}

	/**
	 * Renders and inline checkbox list.
	 * Please check {@link TbHtml::activeInlieCheckBoxList} for detailed information
	 * @param $model
	 * @param $attribute
	 * @param $data
	 * @param array $htmlOptions
	 * @return string
	 */
	public function inlineCheckBoxList($model, $attribute, $data, $htmlOptions = array())
	{
		return $this->wrapControl(TbHtml::activeInlineCheckBoxList($model, $attribute, $data, $htmlOptions));
	}

	/**
	 * Renders an inlineRadioButtonList
	 * Please check {@link TbHtml::activeInlineRadioButtonList} for detailed information
	 * @param $model
	 * @param $attribute
	 * @param $data
	 * @param array $htmlOptions
	 * @return string
	 */
	public function inlineRadioButtonList($model, $attribute, $data, $htmlOptions = array())
	{
		return $this->wrapControl(TbHtml::activeInlineRadioButtonList($model, $attribute, $data, $htmlOptions));
	}

	/**
	 * Generates a text field row.
	 * @param CModel $model the data model.
	 * @param string $attribute the attribute name.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated row.
	 */
	public function textFieldRow($model, $attribute, $htmlOptions = array())
	{
		return $this->row(TbHtml::INPUT_TEXT, $model, $attribute, null/* no data */, $htmlOptions);
	}

	/**
	 * Generates an url field row.
	 * @param CModel $model the data model.
	 * @param string $attribute the attribute name.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated row.
	 */
	public function urlFieldRow($model, $attribute, $htmlOptions = array())
	{
		return $this->row(TbHtml::INPUT_URL, $model, $attribute, null/* no data */, $htmlOptions);
	}

	/**
	 * Generates an email field row.
	 * @param CModel $model the data model.
	 * @param string $attribute the attribute name.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated row.
	 */
	public function emailFieldRow($model, $attribute, $htmlOptions = array())
	{
		return $this->row(TbHtml::INPUT_EMAIL, $model, $attribute, null/* no data */, $htmlOptions);
	}

	/**
	 * Generates a number field row.
	 * @param CModel $model the data model.
	 * @param string $attribute the attribute name.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated row.
	 */
	public function numberFieldRow($model, $attribute, $htmlOptions = array())
	{
		return $this->row(TbHtml::INPUT_NUMBER, $model, $attribute, null/* no data */, $htmlOptions);
	}

	/**
	 * Generates a range field row.
	 * @param CModel $model the data model.
	 * @param string $attribute the attribute name.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated row.
	 */
	public function rangeFieldRow($model, $attribute, $htmlOptions = array())
	{
		return $this->row(TbHtml::INPUT_RANGE, $model, $attribute, null/* no data */, $htmlOptions);
	}

	/**
	 * Generates a date field row.
	 * @param CModel $model the data model.
	 * @param string $attribute the attribute name.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated row.
	 */
	public function dateFieldRow($model, $attribute, $htmlOptions = array())
	{
		return $this->row(TbHtml::INPUT_DATE, $model, $attribute, null/* no data */, $htmlOptions);
	}

	/**
	 * Generates a password field row.
	 * @param CModel $model the data model.
	 * @param string $attribute the attribute name.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated row.
	 */
	public function passwordFieldRow($model, $attribute, $htmlOptions = array())
	{
		return $this->row(TbHtml::INPUT_PASSWORD, $model, $attribute, null/* no data */, $htmlOptions);
	}

	/**
	 * Generates a text area row.
	 * @param CModel $model the data model.
	 * @param string $attribute the attribute name.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated row.
	 */
	public function textAreaRow($model, $attribute, $htmlOptions = array())
	{
		return $this->row(TbHtml::INPUT_TEXTAREA, $model, $attribute, null/* no data */, $htmlOptions);
	}

	/**
	 * Generates a check box row.
	 * @param CModel $model the data model.
	 * @param string $attribute the attribute name.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated row.
	 */
	public function checkBoxRow($model, $attribute, $htmlOptions = array())
	{
		return $this->row(TbHtml::INPUT_CHECKBOX, $model, $attribute, null/* no data */, $htmlOptions);
	}

	/**
	 * Generates a radio button row.
	 * @param CModel $model the data model.
	 * @param string $attribute the attribute name.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated row.
	 */
	public function radioButtonRow($model, $attribute, $htmlOptions = array())
	{
		return $this->row(TbHtml::INPUT_RADIOBUTTON, $model, $attribute, null/* no data */, $htmlOptions);
	}

	/**
	 * Generates a drop down list row.
	 * @param CModel $model the data model.
	 * @param string $attribute the attribute name.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated row.
	 */
	public function dropDownListRow($model, $attribute, $data, $htmlOptions = array())
	{
		return $this->row(TbHtml::INPUT_DROPDOWN, $model, $attribute, $data, $htmlOptions);
	}

	/**
	 * Generates a list box row.
	 * @param CModel $model the data model.
	 * @param string $attribute the attribute name.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated row.
	 */
	public function listBoxRow($model, $attribute, $data, $htmlOptions = array())
	{
		return $this->row(TbHtml::INPUT_LISTBOX, $model, $attribute, $data, $htmlOptions);
	}

	/**
	 * Generates a file field row.
	 * @param CModel $model the data model.
	 * @param string $attribute the attribute name.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated row.
	 */
	public function fileFieldRow($model, $attribute, $htmlOptions = array())
	{
		return $this->row(TbHtml::INPUT_FILE, $model, $attribute, null/* no data */, $htmlOptions);
	}

	/**
	 * Generates a check box list row.
	 * @param CModel $model the data model.
	 * @param string $attribute the attribute name.
	 * @param array $data data for generating the list options (value=>display).
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated row.
	 */
	public function checkBoxListRow($model, $attribute, $data, $htmlOptions = array())
	{
		return $this->row(TbHtml::INPUT_CHECKBOXLIST, $model, $attribute, $data, $htmlOptions);
	}

	/**
	 * Generates a radio button list row.
	 * @param CModel $model the data model.
	 * @param string $attribute the attribute name.
	 * @param array $data data for generating the list options (value=>display).
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated row.
	 */
	public function radioButtonListRow($model, $attribute, $data, $htmlOptions = array())
	{
		return $this->row(TbHtml::INPUT_RADIOBUTTONLIST, $model, $attribute, $data, $htmlOptions);
	}

	/**
	 * Helper method to display different input types for the different complain bootstrap forms wrapped with their
	 * labels, help and error messages. This method is a replacement of the old 'typeRow' methods from Yii-Bootstrap
	 * extension. Example:
	 * <pre>
	 * 	$form->row(TbHtml::INPUT_TEXT, $model, 'attribute', array('style'=>'width:125px'));
	 *	$form->row(TbHtml::INPUT_DROPDOWN, $model, 'attribute', array('a'=>'A','b'=>'B'), array());
	 * </pre>
	 * @param $type
	 * @param $model
	 * @param $attribute
	 * @param $data
	 * @param array $htmlOptions
	 * @return string
	 * @throws CException
	 */
	public function row($type, $model, $attribute, $data = array(), $htmlOptions = array())
	{
		if (!in_array($type, TbHtml::$inputs))
			throw new CException(Yii::t('tb', 'Unrecognized input type'));

		$labelOptions = TbHtml::popOption('labelOptions', $htmlOptions, array());
		$errorOptions = TbHtml::popOption('errorOptions', $htmlOptions, array());
		$containerOptions = TbHtml::popOption('containerOptions', $htmlOptions, array());

		$labelOptions = TbHtml::defaultOption('formType', $this->type, $labelOptions);

		ob_start();

		// make sure it holds the class control-label
		if ($this->type === TbHtml::FORM_HORIZONTAL)
			echo CHtml::openTag('div', TbHtml::addClassName('control-group', $containerOptions));

		// form's inline do not render labels and radio|checkbox input types render label's differently
		if ($this->type !== TbHtml::FORM_INLINE
			&& !preg_match('/radio|checkbox/i',$type)
			&& TbHtml::popOption('label', $htmlOptions, true))
			echo TbHtml::activeLabel($model, $attribute, $labelOptions);
		elseif (preg_match('/radio|checkbox/i', $type))
			$htmlOptions['labelOptions'] = $labelOptions;

		if (TbHtml::popOption('block', $htmlOptions, false))
			$htmlOptions = TbHtml::addClassName('input-block-level', $htmlOptions);

		$params = in_array($type, TbHtml::$dataInputs)
			? array($model, $attribute, $data, $htmlOptions)
			: array($model, $attribute, $htmlOptions);

		$errorSpan = $this->error($model, $attribute, $errorOptions);

		echo $this->wrapControl(call_user_func_array('TbHtml::active' . ucfirst($type), $params), $errorSpan); /* since PHP 5.3 */

		if ($this->type === TbHtml::FORM_VERTICAL && TbHtml::popOption('error', $htmlOptions, true))
			echo $errorSpan;

		if ($this->type == TbHtml::FORM_HORIZONTAL)
			echo '</div>';

		return ob_get_clean();
	}

	/**
	 * Makes sure whether the form control requires wrapping (normally set by the type of form)
	 * @param $control
	 * @param $errorSpan
	 * @return string
	 */
	protected function wrapControl($control, $errorSpan = '')
	{
		if ($this->type == TbHtml::FORM_HORIZONTAL)
		{
			ob_start();
			echo '<div class="controls">';
			echo $control . ' ' . $errorSpan;
			echo '</div>';
			$control = ob_get_clean();
		}
		return $control;
	}
}