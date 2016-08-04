<?php

/**
 * TbCarousel class file.
 * @author Sam Stenvall <sam@supportersplace.com>
 * @copyright Copyright &copy; Sam Stenvall 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */
Yii::import('bootstrap.behaviors.TbWidget');

/**
 * Bootstrap carousel widget.
 * @see http://twitter.github.com/bootstrap/javascript.html#carousel
 */
class TbCarousel extends CWidget
{

    /**
     * @var array the carousel items
     */
    public $items = array();

    /**
     * @var array the carousel events
     */
    public $events = array();

    /**
     * @var array HTML options for the carousel
     */
    public $htmlOptions = array();

    /**
     * @var array JavaScript options for the carousel
     */
    public $pluginOptions = array(
        'interval'=>5000,
        'pause'=>'hover',
    );

    /**
     * Initializes the widget.
     */
    public function init()
    {
        $this->attachBehavior('TbWidget', new TbWidget);
        $this->copyId();
    }

    /**
     * Runs the widget
     */
    public function run()
    {
        $itemCount = count($this->items);

        // Don't render if there are no items, and hide the previous and next 
        // buttons if there's only one item to display (unless the user has 
        // specified the option explicitly)
        if ($itemCount === 0)
            return;
        elseif ($itemCount === 1)
            $this->htmlOptions = TbHtml::defaultOption('hidePrevAndNext', true, $this->htmlOptions);

        echo TbHtml::carousel($this->items, $this->htmlOptions);
        $selector = '#'.$this->htmlOptions['id'];
        $this->registerEvents($selector, $this->events);
        $this->registerPlugin(TbApi::PLUGIN_CAROUSEL, $selector, $this->pluginOptions);
    }

}