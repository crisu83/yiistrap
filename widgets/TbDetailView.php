<?php

/**
 * TbDetailView class file.
 * @author Sam Stenvall <sam@supportersplace.com>
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Sam Stenvall 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */
Yii::import('zii.widgets.CDetailView');

/**
 * Bootstrap Zii detail widget.
 */
class TbDetailView extends CDetailView
{

    /**
     * @var string|array the detail view style.
     * Valid values are TbHtml::DETAIL_STRIPED, TbHtml::DETAIL_BORDERED, 
     * TbHtml::DETAIL_CONDENSED and/or TbHtml::DETAIL_HOVER.
     */
    public $type = array(TbHtml::DETAIL_TYPE_STRIPED, TbHtml::DETAIL_TYPE_CONDENSED);

    /**
     * Initializes the widget.
     */
    public function init()
    {
        // Don't let Yii include its default stylesheet
        if ($this->cssFile === null)
            $this->cssFile = false;

        parent::init();

        if (is_string($this->type))
            $types = explode(' ', $this->type);
        else
            $types = $this->type;

        $validTypes = array(
            TbHtml::DETAIL_TYPE_BORDERED,
            TbHtml::DETAIL_TYPE_CONDENSED,
            TbHtml::DETAIL_TYPE_HOVER,
            TbHtml::DETAIL_TYPE_STRIPED,
        );

        // Set class names
        foreach ($types as $type)
            if (in_array($type, $validTypes))
                $this->htmlOptions = TbHtml::addClassName('table-'.$type, $this->htmlOptions);

        $this->htmlOptions = TbHtml::addClassName('table', $this->htmlOptions);
    }

}
