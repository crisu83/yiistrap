<?php
/**
 * TbWidget class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.behaviors
 */

Yii::import('bootstrap.helpers.TbHtml');
Yii::import('bootstrap.components.TbApi');

/**
 * Bootstrap widget behavior.
 * @property $owner CWidget
 */
class TbWidget extends CBehavior
{
    private $_api;

    /**
     * Copies the id to the widget HTML attributes or vise versa.
     */
    public function copyId()
    {
        if (!isset($this->owner->htmlOptions['id'])) {
            $this->owner->htmlOptions['id'] = $this->owner->id;
        } else {
            $this->owner->id = $this->owner->htmlOptions['id'];
        }
    }

    /**
     * Registers the given plugin with the API.
     * @param string $name the plugin name.
     * @param string $selector the CSS selector.
     * @param array $options the JavaScript options for the plugin.
     * @param int $position the position of the JavaScript code.
     * @return boolean whether the plugin was registered.
     */
    public function registerPlugin($name, $selector, $options = array(), $position = CClientScript::POS_END)
    {
        if (($api = $this->getApi()) !== null) {
            $api->registerPlugin($name, $selector, $options, $position);
            return true;
        }
        return false;
    }

    /**
     * Registers plugin events with the API.
     * @param string $selector the CSS selector.
     * @param string[] $events  the JavaScript event configuration (name=>handler).
     * @param int $position the position of the JavaScript code.
     * @return boolean whether the events were registered.
     */
    public function registerEvents($selector, $events, $position = CClientScript::POS_END)
    {
        if (($api = $this->getApi()) !== null) {
            $api->registerEvents($selector, $events, $position);
            return true;
        }
        return false;
    }

    /**
     * Returns the API instance.
     * @return TbApi the api.
     */
    private function getApi()
    {
        if (isset($this->_api)) {
            return $this->_api;
        } else {
            return $this->_api = Yii::app()->getComponent('bootstrap');
        }
    }
}