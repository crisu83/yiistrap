<?php
/**
 * TbFormButtonElement class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.form
 */

/**
 * Bootstrap form button element.
 */
class TbFormButtonElement extends CFormButtonElement
{
    /**
     * Returns this button.
     * @return string the rendering result.
     */
    public function render()
    {
        return TbHtml::btn($this->type, $this->label, $this->attributes);
    }
}