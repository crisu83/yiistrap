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
        if (isset(self::$coreTypes[$this->type]))
		{
			return $this->renderCore();
		}
		else
		{
			return $this->renderWidget();
		}
    }

	protected function renderCore()
	{
		// Remove the "active" prefix.
		$method = substr(self::$coreTypes[$this->type], 6) . 'ControlGroup';
		if(strpos($method,'List')!==false)
		{
			return $this->getParent()->getActiveFormWidget()->$method($this->getParent()->getModel(), $this->name, $this->items, $this->attributes);
		}
		else
		{
			return $this->getParent()->getActiveFormWidget()->$method($this->getParent()->getModel(), $this->name, $this->attributes);
		}
	}

	/**
	 * Renders a form control that is implemented via a widget.
	 */
	protected function renderWidget()
	{
		$input = parent::renderInput();
		return TbHtml::activeControlGroup(null, $this->getParent()->getModel(), $this->name, array('input' => $input));
	}
}