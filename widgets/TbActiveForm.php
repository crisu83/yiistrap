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
     * @var string the form layout.
     */
    public $layout;
    /**
     * @var boolean whether the inputs should be wrapped as control-groups.
     */
    public $wrapInputs = true;
    /**
     * @var string the help type. Valid values are TbHtml::HELP_INLINE and TbHtml::HELP_BLOCK.
     */
    public $helpType = TbHtml::HELP_TYPE_BLOCK;
    /**
     * @var string the CSS class name for error messages.
     */
    public $errorMessageCssClass = 'error';

    /**
     * Initializes the widget.
     */
    public function init()
    {
        $this->attachBehavior('tbWidget', new TbWidget);
        $this->copyId();
        if ($this->stateful)
            echo TbHtml::statefulFormTb($this->layout, $this->action, $this->method, $this->htmlOptions);
        else
            echo TbHtml::beginFormTb($this->layout, $this->action, $this->method, $this->htmlOptions);
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
        if (!$enableAjaxValidation && !$enableClientValidation)
            return TbHtml::error($model, $attribute, $htmlOptions);
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
     * @param mixed $models the models whose input errors are to be displayed.
     * @param string $header a piece of HTML code that appears in front of the errors
     * @param string $footer a piece of HTML code that appears at the end of the errors
     * @param array $htmlOptions additional HTML attributes to be rendered in the container div tag.
     * @return string the error summary. Empty if no errors are found.
     */
    public function errorSummary($models, $header = null, $footer = null, $htmlOptions = array())
    {
        if (!$this->enableAjaxValidation && !$this->enableClientValidation)
            return TbHtml::errorSummary($models, $header, $footer, $htmlOptions);
        if (!isset($htmlOptions['id']))
            $htmlOptions['id'] = $this->id . '_es_';
        $html = TbHtml::errorSummary($models, $header, $footer, $htmlOptions);
        if ($html === '')
        {
            if ($header === null)
                $header = '<p>' . Yii::t('yii', 'Please fix the following input errors:') . '</p>';
            if (!isset($htmlOptions['class']))
                $htmlOptions['class'] = CHtml::$errorSummaryCss;
            $htmlOptions['style'] = isset($htmlOptions['style'])
                ? rtrim($htmlOptions['style'], ';') . ';display:none'
                : 'display:none';
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
    public function uneditableField($model, $attribute, $data, $htmlOptions = array())
    {
        return TbHtml::activeUneditableField($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Renders a search query field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input.
     * @see TbHtml::activeSearchQuery
     */
    public function searchQuery($model, $attribute, $data, $htmlOptions = array())
    {
        return TbHtml::activeSearchQuery($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates a text field row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeTextFieldRow
     */
    public function textFieldRow($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeTextFieldRow($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a password field row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activePasswordFieldRow
     */
    public function passwordFieldRow($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activePasswordFieldRow($model, $attribute, $htmlOptions);
    }

    /**
     * Generates an url field row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeUrlFieldRow
     */
    public function urlFieldRow($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeUrlFieldRow($model, $attribute, $htmlOptions);
    }

    /**
     * Generates an email field row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeEmailFieldRow
     */
    public function emailFieldRow($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeEmailFieldRow($model, $attribute, null/* no data */, $htmlOptions);
    }

    /**
     * Generates a number field row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeNumberFieldRow
     */
    public function numberFieldRow($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeNumberFieldRow($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a range field row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeRangeFieldRow
     */
    public function rangeFieldRow($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeRangeFieldRow($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a date field row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeDateFieldRow
     */
    public function dateFieldRow($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeDateFieldRow($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a text area row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeTextAreaRow
     */
    public function textAreaRow($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeTextAreaRow($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a check box row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeCheckBoxRow
     */
    public function checkBoxRow($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeCheckBoxRow($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a radio button row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeRadioButtonRow
     */
    public function radioButtonRow($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeRadioButtonRow($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a drop down list row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeDropDownListRow
     */
    public function dropDownListRow($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeDropDownListRow($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates a list box row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeListBoxRow
     */
    public function listBoxRow($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeListBoxRow($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates a file field row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeFileFieldRow
     */
    public function fileFieldRow($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeFileFieldRow($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a radio button list row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeRadioButtonListRow
     */
    public function radioButtonListRow($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeRadioButtonListRow($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates an inline radio button list row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeInlineCheckBoxListRow
     */
    public function inlineRadioButtonListRow($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeInlineRadioButtonListRow($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates a check box list row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeCheckBoxListRow
     */
    public function checkBoxListRow($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeCheckBoxListRow($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates an inline check box list row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeInlineCheckBoxListRow
     */
    public function inlineCheckBoxListRow($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeInlineCheckBoxListRow($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates an uneditable field row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeUnediableFieldRow
     */
    public function uneditableFieldRow($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeUnediableFieldRow($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a search query field row.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see TbHtml::activeSearchQueryRow
     */
    public function searchQueryRow($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return TbHtml::activeSearchQueryRow($model, $attribute, $htmlOptions);
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
        $errorOptions = TbHtml::popOption('errorOptions', $options, array());
        $error = $this->error($model, $attribute, $errorOptions);
        if (!empty($error))
        {
            $options['error'] = $error;
            $options['color'] = TbHtml::COLOR_ERROR;
        }
        $helpOptions = TbHtml::popOption('helpOptions', $options, array());
        $helpOptions['type'] = $this->helpType;
        $options['helpOptions'] = $helpOptions;
        $options['wrap'] = $this->wrapInputs;
        return $options;
    }
}
