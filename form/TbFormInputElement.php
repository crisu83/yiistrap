<?php

/**
 * TbFormInputElement class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.form
 */

/**
 * Bootstrap form input element.
 */
class TbFormInputElement extends CFormInputElement
{

    /**
     * @var array Core input types (alias=>TbHtml method name)
     */
    public static $coreTypes = array(
        'text' => TbHtml::INPUT_TYPE_TEXT,
//        'hidden' => TbHtml::INPUT_TYPE_HIDDEN, @todo: requires https://github.com/crisu83/yiistrap/pull/227
        'password' => TbHtml::INPUT_TYPE_PASSWORD,
        'textarea' => TbHtml::INPUT_TYPE_TEXTAREA,
        'file' => TbHtml::INPUT_TYPE_FILE,
        'radio' => TbHtml::INPUT_TYPE_RADIOBUTTONLIST,
        'checkbox' => TbHtml::INPUT_TYPE_CHECKBOX,
        'listbox' => TbHtml::INPUT_TYPE_LISTBOX,
        'dropdownlist' => TbHtml::INPUT_TYPE_DROPDOWNLIST,
        'checkboxlist' => TbHtml::INPUT_TYPE_CHECKBOXLIST,
        'inlinecheckboxlist' => TbHtml::INPUT_TYPE_INLINECHECKBOXLIST,
        'radiolist' => TbHtml::INPUT_TYPE_RADIOBUTTONLIST,
        'inlineradiolist' => TbHtml::INPUT_TYPE_INLINERADIOBUTTONLIST,
        'url' => TbHtml::INPUT_TYPE_URL,
        'email' => TbHtml::INPUT_TYPE_EMAIL,
        'number' => TbHtml::INPUT_TYPE_NUMBER,
        'range' => TbHtml::INPUT_TYPE_RANGE,
        'date' => TbHtml::INPUT_TYPE_DATE,
        'uneditable' => TbHtml::INPUT_TYPE_UNEDITABLE,
        'search' => TbHtml::INPUT_TYPE_SEARCH,
        'widget' => TbHtml::INPUT_TYPE_CUSTOM,
    );

    /**
     * Renders everything for this input.
     * When this->type is not a coreType, render widget of specified type.
     * @return string the complete rendering result for this input, including label, input field, hint, and error.
     */
    public function render()
    {
        /** @var TbForm $parent */
        $parent = $this->getParent();
        /** @var TbActiveForm $form */
        $form = $parent->getActiveFormWidget();

        if (isset(self::$coreTypes[$this->type])) {
            $type = self::$coreTypes[$this->type];
            return $form->createControlGroup($type, $parent->getModel(), $this->name, $this->attributes, $this->items);
        } else {
            $attributes = $this->attributes;
            $attributes['model'] = $parent->getModel();
            $attributes['attribute'] = $this->name;
            ob_start();
            $this->getParent()->getOwner()->widget($this->type, $attributes);
            $this->attributes['input'] = ob_get_clean();

            return $form->createControlGroup(TbHtml::INPUT_TYPE_CUSTOM, $parent->getModel(), $this->name, $this->attributes);
        }
    }

}