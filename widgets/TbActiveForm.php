<?php
/**
 * TbActiveForm class file.
 * @author Antonio Ramirez <ramirez.cobos@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

Yii::import('bootstrap.helpers.TbHtml');
Yii::import('bootstrap.behaviors.TbWidget');

/**
 * Bootstrap active form widget.
 */
class TbActiveForm extends CActiveForm
{
    /**
     * @var string the form layout.
     */
    public $layout;
    /**
     * @var string the help type. Valid values are TbHtml::HELP_INLINE and TbHtml::HELP_BLOCK.
     */
    public $helpType = TbHtml::HELP_TYPE_BLOCK;
    /**
     * @var string the CSS class name for error messages.
     */
    public $errorMessageCssClass = 'error';
    /**
     * @var string the CSS class name for success messages.
     */
    public $successMessageCssClass = 'success';

    /**
     * @var boolean whether to hide inline errors. Defaults to false.
     */
    public $hideInlineErrors = false;

    /**
     * Initializes the widget.
     */
    public function init()
    {
        $this->attachBehavior('TbWidget', new TbWidget);
        $this->copyId();
        if ($this->stateful) {
            echo TbHtml::statefulFormTb($this->layout, $this->action, $this->method, $this->htmlOptions);
        } else {
            echo TbHtml::beginFormTb($this->layout, $this->action, $this->method, $this->htmlOptions);
        }
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
    public function error(
        $model,
        $attribute,
        $htmlOptions = array(),
        $enableAjaxValidation = true,
        $enableClientValidation = true
    ) {
        if (!$this->enableAjaxValidation) {
            $enableAjaxValidation = false;
        }
        if (!$this->enableClientValidation) {
            $enableClientValidation = false;
        }
        if (!$enableAjaxValidation && !$enableClientValidation) {
            return TbHtml::error($model, $attribute, $htmlOptions);
        }
        $id = CHtml::activeId($model, $attribute);
        $inputID = TbArray::getValue('inputID', $htmlOptions, $id);
        unset($htmlOptions['inputID']);
        TbArray::defaultValue('id', $inputID . '_em_', $htmlOptions);
        $option = array(
            'id' => $id,
            'inputID' => $inputID,
            'errorID' => $htmlOptions['id'],
            'model' => get_class($model),
            'name' => $attribute,
            'enableAjaxValidation' => $enableAjaxValidation,
            'inputContainer' => 'div.control-group', // Bootstrap requires this
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
        foreach ($optionNames as $name) {
            if (isset($htmlOptions[$name])) {
                $option[$name] = TbArray::popValue($name, $htmlOptions);
            }
        }
        if ($model instanceof CActiveRecord && !$model->isNewRecord) {
            $option['status'] = 1;
        }
        if ($enableClientValidation) {
            $validators = TbArray::getValue('clientValidation', $htmlOptions, array());
            $attributeName = $attribute;
            if (($pos = strrpos($attribute, ']')) !== false && $pos !== strlen($attribute) - 1) // e.g. [a]name
            {
                $attributeName = substr($attribute, $pos + 1);
            }
            foreach ($model->getValidators($attributeName) as $validator) {
                if ($validator->enableClientValidation) {
                    if (($js = $validator->clientValidateAttribute($model, $attributeName)) != '') {
                        $validators[] = $js;
                    }
                }
            }
            if ($validators !== array()) {
                $option['clientValidation'] = "js:function(value, messages, attribute) {\n" . implode(
                        "\n",
                        $validators
                    ) . "\n}";
            }
        }
        $html = TbHtml::error($model, $attribute, $htmlOptions);
        if ($html === '') {
            $htmlOptions['type'] = $this->helpType;
            TbHtml::addCssStyle('display:none', $htmlOptions);
            $html = TbHtml::help('', $htmlOptions);
        }
        $this->attributes[$inputID] = $option;
        return $html;
    }

    /**
     * Displays a summary of validation errors for one or several models.
     * @param mixed $models the models whose input errors are to be displayed.
     * @param string $header a piece of HTML code that appears in front of the errors
     * @param string $footer a piece of HTML code that appears at the end of the errors
     * @param array $htmlOptions additional HTML attributes to be rendered in the container div tag.
     * @return string the error summary. Empty if no errors are found.
     */
    public function errorSummary($models, $header = null, $footer = null, $htmlOptions = array())
    {
        if (!$this->enableAjaxValidation && !$this->enableClientValidation) {
            return TbHtml::errorSummary($models, $header, $footer, $htmlOptions);
        }
        TbArray::defaultValue('id', $this->id . '_es_', $htmlOptions);
        $html = TbHtml::errorSummary($models, $header, $footer, $htmlOptions);
        if ($html === '') {
            if ($header === null) {
                $header = '<p>' . Yii::t('yii', 'Please fix the following input errors:') . '</p>';
            }
            TbHtml::addCssClass(TbHtml::$errorSummaryCss, $htmlOptions);
            TbHtml::addCssStyle('display:none', $htmlOptions);
            $html = CHtml::tag('div', $htmlOptions, $header . '<ul><li>dummy</li></ul>' . $footer);
        }
        $this->summaryID = $htmlOptions['id'];
        return $html;
    }

    /**
     * Renders a text field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::activeTextField
     */
    public function textField($model, $attribute, $htmlOptions = array())
    {
        return TbHtml::activeTextField($model, $attribute, $htmlOptions);
    }

    /**
     * Renders a password field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::activePasswordField
     */
    public function passwordField($model, $attribute, $htmlOptions = array())
    {
        return TbHtml::activePasswordField($model, $attribute, $htmlOptions);
    }

    /**
     * Renders a url field for a model attribute.
     * @param CModel $model the data model
     * @param string $attribute the attribute
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field
     * @see TbHtml::activeUrlField
     */
    public function urlField($model, $attribute, $htmlOptions = array())
    {
        return TbHtml::activeUrlField($model, $attribute, $htmlOptions);
    }

    /**
     * Renders an email field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::activeEmailField
     */
    public function emailField($model, $attribute, $htmlOptions = array())
    {
        return TbHtml::activeEmailField($model, $attribute, $htmlOptions);
    }

    /**
     * Renders a number field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::activeNumberField
     */
    public function numberField($model, $attribute, $htmlOptions = array())
    {
        return TbHtml::activeNumberField($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a range field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::activeRangeField
     */
    public function rangeField($model, $attribute, $htmlOptions = array())
    {
        return TbHtml::activeRangeField($model, $attribute, $htmlOptions);
    }

    /**
     * Renders a date field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     */
    public function dateField($model, $attribute, $htmlOptions = array())
    {
        return TbHtml::activeDateField($model, $attribute, $htmlOptions);
    }

    /**
     * Renders a text area for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text area.
     * @see TbHtml::activeTextArea
     */
    public function textArea($model, $attribute, $htmlOptions = array())
    {
        return TbHtml::activeTextArea($model, $attribute, $htmlOptions);
    }

    /**
     * Renders a file field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes
     * @return string the generated input field.
     * @see TbHtml::activeFileField
     */
    public function fileField($model, $attribute, $htmlOptions = array())
    {
        return TbHtml::activeFileField($model, $attribute, $htmlOptions);
    }

    /**
     * Renders a radio button for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated radio button.
     * @see TbHtml::activeRadioButton
     */
    public function radioButton($model, $attribute, $htmlOptions = array())
    {
        return TbHtml::activeRadioButton($model, $attribute, $htmlOptions);
    }

    /**
     * Renders a checkbox for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated check box.
     * @see TbHtml::activeCheckBox
     */
    public function checkBox($model, $attribute, $htmlOptions = array())
    {
        return TbHtml::activeCheckBox($model, $attribute, $htmlOptions);
    }

    /**
     * Renders a dropdown list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated drop down list.
     * @see TbHtml::activeDropDownList
     */
    public function dropDownList($model, $attribute, $data, $htmlOptions = array())
    {
        return TbHtml::activeDropDownList($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Renders a list box for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list box.
     * @see TbHtml::activeListBox
     */
    public function listBox($model, $attribute, $data, $htmlOptions = array())
    {
        return TbHtml::activeListBox($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Renders a radio button list for a model attribute
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data data for generating the list options (value=>display)
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated radio button list.
     * @see TbHtml::activeRadioButtonList
     */
    public function radioButtonList($model, $attribute, $data, $htmlOptions = array())
    {
        return TbHtml::activeRadioButtonList($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Renders an inline radio button list for a model attribute
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data data for generating the list options (value=>display)
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated radio button list.
     * @see TbHtml::activeInlineRadioButtonList
     */
    public function inlineRadioButtonList($model, $attribute, $data, $htmlOptions = array())
    {
        return TbHtml::activeInlineRadioButtonList($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Renders a checkbox list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data data for generating the list options (value=>display)
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated checkbox list.
     * @see TbHtml::activeCheckBoxList
     */
    public function checkBoxList($model, $attribute, $data, $htmlOptions = array())
    {
        return TbHtml::activeCheckBoxList($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Renders an inline checkbox list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data data for generating the list options (value=>display)
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated checkbox list.
     * @see TbHtml::activeInlineCheckBoxList
     */
    public function inlineCheckBoxList($model, $attribute, $data, $htmlOptions = array())
    {
        return TbHtml::activeInlineCheckBoxList($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Renders an uneditable field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated field.
     * @see TbHtml::activeUneditableField
     */
    public function uneditableField($model, $attribute, $htmlOptions = array())
    {
        return TbHtml::activeUneditableField($model, $attribute, $htmlOptions);
    }

    /**
     * Renders a search query field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input.
     * @see TbHtml::activeSearchField
     */
    public function searchQuery($model, $attribute, $htmlOptions = array())
    {
        return TbHtml::activeSearchQueryField($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a text field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeTextFieldControlGroup
     */
    public function textFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeTextFieldControlGroup($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a password field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activePasswordFieldControlGroup
     */
    public function passwordFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activePasswordFieldControlGroup($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with an url field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeUrlFieldControlGroup
     */
    public function urlFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeUrlFieldControlGroup($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with an email field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeEmailFieldControlGroup
     */
    public function emailFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeEmailFieldControlGroup($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a number field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeNumberFieldControlGroup
     */
    public function numberFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeNumberFieldControlGroup($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a range field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeRangeFieldControlGroup
     */
    public function rangeFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeRangeFieldControlGroup($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a date field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeDateFieldControlGroup
     */
    public function dateFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeDateFieldControlGroup($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a text area for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeTextAreaControlGroup
     */
    public function textAreaControlGroup($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeTextAreaControlGroup($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a check box for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeCheckBoxControlGroup
     */
    public function checkBoxControlGroup($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeCheckBoxControlGroup($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a radio button for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeRadioButtonControlGroup
     */
    public function radioButtonControlGroup($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeRadioButtonControlGroup($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a drop down list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeDropDownListControlGroup
     */
    public function dropDownListControlGroup($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeDropDownListControlGroup($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates a control group with a list box for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeListBoxControlGroup
     */
    public function listBoxControlGroup($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeListBoxControlGroup($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates a control group with a file field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeFileFieldControlGroup
     */
    public function fileFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeFileFieldControlGroup($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a radio button list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeRadioButtonListControlGroup
     */
    public function radioButtonListControlGroup($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeRadioButtonListControlGroup($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates a control group with an inline radio button list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeInlineCheckBoxListControlGroup
     */
    public function inlineRadioButtonListControlGroup($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeInlineRadioButtonListControlGroup($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates a control group with a check box list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeCheckBoxListControlGroup
     */
    public function checkBoxListControlGroup($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeCheckBoxListControlGroup($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates a control group with an inline check box list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeInlineCheckBoxListControlGroup
     */
    public function inlineCheckBoxListControlGroup($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeInlineCheckBoxListControlGroup($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates a control group with an uneditable field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeUneditableFieldControlGroup
     */
    public function uneditableFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeUneditableFieldControlGroup($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a search field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeSearchFieldControlGroup
     */
    public function searchQueryControlGroup($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeSearchQueryControlGroup($model, $attribute, $htmlOptions);
    }

    /**
     * Processes the options for a input row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions the options.
     * @return array the processed options.
     */
    protected function processRowOptions($model, $attribute, $options)
    {
        $errorOptions = TbArray::popValue('errorOptions', $options, array());
        $errorOptions['type'] = $this->helpType;
        $error = $this->error($model, $attribute, $errorOptions);
        // kind of a hack for ajax forms but this works for now.
        if (!empty($error) && strpos($error, 'display:none') === false) {
            $options['color'] = TbHtml::INPUT_COLOR_ERROR;
        }
        if (!$this->hideInlineErrors) {
            $options['error'] = $error;
        }
        $helpOptions = TbArray::popValue('helpOptions', $options, array());
        $helpOptions['type'] = $this->helpType;
        $options['helpOptions'] = $helpOptions;
        return $options;
    }
}
