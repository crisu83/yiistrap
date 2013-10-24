<?php
/**
 * TbForm class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.form
 */

/**
 * Bootstrap form object that contains form input specifications.
 */
class TbForm extends CForm
{
    /**
     * @var string the name of the class for representing a form input element. Defaults to 'CFormInputElement'.
     */
    public $inputElementClass = 'TbFormInputElement';

    /**
     * @var string the name of the class for representing a form button element. Defaults to 'CFormButtonElement'.
     */
    public $buttonElementClass = 'TbButtonElement';

    /**
     * @var array the configuration used to create the active form widget.
     */
    public $activeForm = 'TbActiveForm';

    /**
     * Renders a single element which could be an input element, a sub-form, a string, or a button.
     * @param mixed $element the form element to be rendered.
     * @return string the rendering result
     */
    public function renderElement($element)
    {
        if (is_string($element)) {
            if (($e = $this[$element]) === null && ($e = $this->getButtons()->itemAt($element)) === null) {
                return $element;
            } else {
                $element = $e;
            }
        }
        if ($element->getVisible()) {
            if ($element instanceof CFormInputElement) {
                if ($element->type === 'hidden') {
                    return TbHtml::tag('div', array('class' => 'hidden'), $element->render());
                }
            }
            return $element->render();
        }
        return '';
    }

    /**
     * Renders the buttons in this form.
     * @return string the rendering result.
     */
    public function renderButtons()
    {
        $buttons = array();
        foreach ($this->getButtons() as $button) {
            $buttons[] = $this->rendeRelement($button);
        }
        return !empty($buttons) ? TbHtml::tag('div', array('class' => 'form-actions'), implode("\n", $buttons)) : '';
    }
}