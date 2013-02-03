<?php
/**
 * TbActiveForm class file.
 * @author Antonio Ramirez <ramirez.cobos@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

class TbActiveForm extends CActiveForm
{
	public $type;

	public $helpType;

	public $errorMessageCssClass = TbHtml::STYLE_ERROR;

	public function init()
	{
		if(!in_array($this->type, array(TbHtml::FORM_TYPE_HORIZONTAL, TbHtml::FORM_TYPE_INLINE, TbHtml::FORM_TYPE_VERTICAL)))
			$this->type = TbHtml::FORM_TYPE_VERTICAL;

		$this->htmlOptions = TbHtml::addClassName('form-' . $this->type, $this->htmlOptions);

		if (null === $this->helpType)
			$this->helpType = $this->type == TbHtml::FORM_TYPE_HORIZONTAL
				? TbHtml::HELP_TYPE_INLINE
				: TbHtml::HELP_TYPE_BLOCK;

		parent::init();
	}

	/**
	 * Runs the widget.
	 * This registers the necessary javascript code and renders the form close tag.
	 */
	public function run()
	{
		/* todo: override this parent's method in order to register our own js */
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
	public function urlField($model,$attribute,$htmlOptions=array())
	{
		return $this->wrapControl(TbHtml::activeUrlField($model,$attribute,$htmlOptions));
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
	public function emailField($model,$attribute,$htmlOptions=array())
	{
		return $this->wrapControl(TbHtml::activeEmailField($model,$attribute,$htmlOptions));
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
	public function numberField($model,$attribute,$htmlOptions=array())
	{
		return $this->wrapControl(TbHtml::activeNumberField($model,$attribute,$htmlOptions));
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
	public function rangeField($model,$attribute,$htmlOptions=array())
	{
		return $this->wrapControl(TbHtml::activeRangeField($model,$attribute,$htmlOptions));
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
	public function dateField($model,$attribute,$htmlOptions=array())
	{
		return $this->wrapControl(TbHtml::activeDateField($model,$attribute,$htmlOptions));
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
	public function textField($model,$attribute,$htmlOptions=array())
	{
		return $this->wrapControl(TbHtml::activeTextField($model,$attribute,$htmlOptions));
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
	public function passwordField($model,$attribute,$htmlOptions=array())
	{
		return $this->wrapControl(TbHtml::activePasswordField($model,$attribute,$htmlOptions));
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
	public function textArea($model,$attribute,$htmlOptions=array())
	{
		return $this->wrapControl(TbHtml::activeTextArea($model,$attribute,$htmlOptions));
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
	public function fileField($model,$attribute,$htmlOptions=array())
	{
		return $this->wrapControl(TbHtml::activeFileField($model,$attribute,$htmlOptions));
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
	public function radioButton($model,$attribute,$htmlOptions=array())
	{
		return $this->wrapControl(TbHtml::activeRadioButton($model,$attribute,$htmlOptions));
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
		if($this->type == TbHtml::FORM_TYPE_HORIZONTAL)
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
		if($this->type == TbHtml::FORM_TYPE_HORIZONTAL)
			$htmlOptions = TbHtml::addClassName('control-label', $htmlOptions);
		return parent::labelEx($model, $attribute, $htmlOptions);
	}

	/**
	 * Makes sure whether the form control requires wrapping (normally set by the type of form)
	 * @param $control
	 * @return string
	 */
	protected function wrapControl($control)
	{
		if ($this->type == TbHtml::FORM_TYPE_HORIZONTAL)
		{
			ob_start();
			echo '<div class="controls">';
			echo $control;
			echo '</div>';
			$control = ob_get_clean();
		}
		return $control;
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

		$id = TbHtml::activeId($model, $attribute);
		$inputID = TbHtml::getOption('inputID', $htmlOptions, $id);
		unset($htmlOptions['inputID']);

		if (!isset($htmlOptions['id']))
			$htmlOptions['id'] = $inputID . '_em_';

		$option = array(
			'id' => $id,
			'inputID' => $inputID,
			'errorID' => $htmlOptions['id'],
			'model' => get_class($model),
			'name' => TbHtml::resolveName($model, $attribute),
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
			$html = TbHtml::tag('span', $htmlOptions, '');
		}

		$this->attributes[$inputID] = $option;

		return $html;
	}
}