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
    private $_assetsUrl;
    private $_clientScript;

    /**
     * Copies the id to the widget HTML attributes or vise versa.
     * @return string the id.
     */
    public function copyId()
    {
        if (!isset($this->owner->htmlOptions['id'])) {
            $this->owner->htmlOptions['id'] = $this->owner->id;
        } else {
            $this->owner->id = $this->owner->htmlOptions['id'];
        }
        return $this->owner->id;
    }

    /**
     * Publishes the extension assets.
     * @param string $path assets path.
     * @param boolean $forceCopy whether we should copy the asset file or directory even if it is already
     * published before.
     * @return string the url.
     */
    public function publishAssets($path, $forceCopy = false)
    {
        if (!Yii::app()->hasComponent('assetManager')) {
            throw new CException('Failed to locate the asset manager component.');
        }
        /* @var CAssetManager $assetManager */
        $assetManager = Yii::app()->getComponent('assetManager');
        $assetsUrl = $assetManager->publish($path, false, -1, $forceCopy);
        return $this->_assetsUrl = $assetsUrl;
    }

    /**
     * Registers a CSS file.
     * @param string $url URL of the CSS file.
     * @param string $media media that the CSS file should be applied to.
     */
    public function registerCssFile($url, $media = '')
    {
        if (isset($this->_assetsUrl)) {
            $url = $this->_assetsUrl . '/' . ltrim($url, '/');
        }
        $this->getClientScript()->registerCssFile($url, $media);
    }

    /**
     * Registers a JavaScript file.
     * @param string $url URL of the javascript file.
     * @param integer $position the position of the JavaScript code.
     */
    public function registerScriptFile($url, $position = null)
    {
        if (isset($this->_assetsUrl)) {
            $url = $this->_assetsUrl . '/' . ltrim($url, '/');
        }
        $this->getClientScript()->registerScriptFile($url, $position);
    }

    /**
     * Returns the name of the correct script file to use.
     * @param string $filename the base file name.
     * @param boolean $minified whether to include the minified version (defaults to false).
     * @return string the full filename.
     */
    public function resolveScriptVersion($filename, $minified = false)
    {
        list($name, $extension) = str_split($filename, strrpos($filename, '.') + 1);
        return !$minified ? $name . $extension : $name . 'min.' . $extension;
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
     * @param string[] $events the JavaScript event configuration (name=>handler).
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
    protected function getApi()
    {
        if (isset($this->_api)) {
            return $this->_api;
        } else {
            return $this->_api = Yii::app()->getComponent('bootstrap');
        }
    }

    /**
     * Returns the client script component.
     * @return CClientScript the component.
     */
    protected function getClientScript()
    {
        if (isset($this->_clientScript)) {
            return $this->_clientScript;
        } else {
            if (!Yii::app()->hasComponent('clientScript')) {
                return false;
            }
            return $this->_clientScript = Yii::app()->getComponent('clientScript');
        }
    }
}