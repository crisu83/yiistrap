<?php
/**
 * TbActiveForm class file.
 * @author Antonio Ramirez <ramirez.cobos@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

class TbActiveForm extends CActiveForm
{

	const TYPE_INLINE = 'inline';
	const TYPE_HORIZONTAL = 'horizontal';
	const TYPE_VERTICAL = 'vertical';


	public $type = self::TYPE_VERTICAL;

	public $errorMessageCssClass = TbHtml::STYLE_ERROR;

	public function init()
	{
		$this->htmlOptions = TbHtml::addClassName('form-' . $this->type, $this->htmlOptions);
	}

    /**
     * Displays a summary of validation errors for one or several models.
     * This method is very similar to {@link CHtml::errorSummary} except that it also works
     * when AJAX validation is performed.
     * @param mixed $models the models whose input errors are to be displayed. This can be either
     * a single model or an array of models.
     * @param string $header a piece of HTML code that appears in front of the errors
     * @param string $footer a piece of HTML code that appears at the end of the errors
     * @param array $htmlOptions additional HTML attributes to be rendered in the container div tag.
     * @return string the error summary. Empty if no errors are found.
     * @see CHtml::errorSummary
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
}