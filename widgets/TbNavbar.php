<?php
/**
 * TbNavbar class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

/**
 * Bootstrap navbar widget.
 */
class TbNavbar extends CWidget
{
    public $style;
    public $brandLabel;
    public $brandUrl;
    public $brandOptions = array();
    public $fixed = TbHtml::FIXED_TOP;
    public $fluid = false;
    public $collapse = false;
    public $items = array();
    public $htmlOptions = array();

    public function init()
    {
        if ($this->brandLabel !== false)
        {
            if (!isset($this->brandLabel))
                $this->brandLabel = CHtml::encode(Yii::app()->name);

            if (!isset($this->brandUrl))
                $this->brandUrl = Yii::app()->homeUrl;

            if ($this->brandUrl !== false)
                $this->brandOptions['href'] = CHtml::normalizeUrl($this->brandUrl);

            $this->brandOptions = TbHtml::addClassName('brand', $this->brandOptions);
        }

        $this->htmlOptions = TbHtml::addClassName('navbar', $this->htmlOptions);

        if (isset($this->style) && in_array($this->style, TbHtml::$navbarStyles))
            $this->htmlOptions = TbHtml::addClassName('navbar-' . $this->style, $this->htmlOptions);

        if ($this->fixed !== false && in_array($this->fixed, TbHtml::$navbarFixes))
            $this->htmlOptions = TbHtml::addClassName('navbar-fixed-' . $this->fixed, $this->htmlOptions);
    }

    public function run()
    {
        echo CHtml::openTag('div', $this->htmlOptions);
        echo '<div class="navbar-inner">';
        echo CHtml::openTag('div', array('class' => $this->fluid ? 'container-fluid' : 'container'));

        if ($this->brandLabel !== false)
            echo CHtml::tag($this->brandUrl !== false ? 'a' : 'span', $this->brandOptions, $this->brandLabel);

        foreach ($this->items as $item)
        {
            if (is_string($item))
                echo $item;
            else
            {
                $widgetClassName = TbHtml::popOption('class', $item);
                if ($widgetClassName !== null)
                    $this->controller->widget($widgetClassName, $item);
            }
        }

        echo '</div></div></div>';
    }
}