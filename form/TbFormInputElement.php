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
     * Renders everything for this input.
     * @return string the complete rendering result for this input, including label, input field, hint, and error.
     */
    public function render()
    {
        /** @var TbForm $parent */
        $parent = $this->getParent();
        /** @var TbActiveForm $form */
        $form = $parent->getActiveFormWidget();
        return $form->createControlGroup($this->type, $parent->getModel(), $this->name, $this->attributes, $this->items);
    }
}