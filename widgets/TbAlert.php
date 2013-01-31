<?php
/**
 * TbAlert class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

/**
 * Bootstrap alert widget.
 */
class TbAlert extends CWidget
{
    /**
     * @var array the alerts configurations (style=>config).
     */
    public $alerts;
    /**
     * @var string|boolean the close link text. If this is set false, no close link will be displayed.
     */
    public $closeText = '&times;';
    /**
     * @var boolean indicates whether the alert should be an alert block. Defaults to 'true'.
     */
    public $block = true;
    /**
     * @var boolean indicates whether alerts should use transitions. Defaults to 'true'.
     */
    public $fade = true;
    /**
     * @var string[] the JavaScript event configuration (name=>handler).
     */
    public $events = array();
    /**
     * @var array the HTML attributes for the alert container.
     */
    public $htmlOptions = array();

    /**
     * Initializes the widget.
     */
    public function init()
    {
        $this->htmlOptions = TbHtml::setDefaultOption('id', $this->getId(), $this->htmlOptions);
        if (is_string($this->alerts))
            $styles = explode(' ', $this->alerts);
        else if (!isset($this->alerts))
            $styles = TbHtml::$alertStyles; // render all styles by default
        if (isset($styles))
        {
            $this->alerts = array();
            foreach ($styles as $style)
                $this->alerts[$style] = array();
        }
    }

    /**
     * Runs the widget.
     */
    public function run()
    {
        /* @var $user CWebUser */
        $user = Yii::app()->getUser();
        echo CHtml::openTag('div', $this->htmlOptions);
        foreach ($this->alerts as $style => $alert)
        {
            if (isset($alert['visible']) && !$alert['visible'])
                continue;

            if ($user->hasFlash($style))
            {
                $htmlOptions = TbHtml::popOption('htmlOptions', $alert, array());
                $htmlOptions = TbHtml::setDefaultOption('closeText', $this->closeText, $htmlOptions);
                $htmlOptions = TbHtml::setDefaultOption('block', $this->block, $htmlOptions);
                $htmlOptions = TbHtml::setDefaultOption('fade', $this->fade, $htmlOptions);
                echo TbHtml::alert($style, $user->getFlash($style), $htmlOptions);
            }
        }
        echo '</div>';
        Yii::app()->bootstrap->registerEvents("#{$this->htmlOptions['id']} > .alert", $this->events);
    }
}