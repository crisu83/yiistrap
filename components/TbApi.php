<?php
/**
 * TbApi class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.components
 * @version 1.2.0
 */

/**
 * Bootstrap API component.
 */
class TbApi extends CApplicationComponent
{
    // Bootstrap plugins
    const PLUGIN_AFFIX = 'affix';
    const PLUGIN_ALERT = 'alert';
    const PLUGIN_BUTTON = 'button';
    const PLUGIN_CAROUSEL = 'carousel';
    const PLUGIN_COLLAPSE = 'collapse';
    const PLUGIN_DROPDOWN = 'dropdown';
    const PLUGIN_MODAL = 'modal';
    const PLUGIN_POPOVER = 'popover';
    const PLUGIN_SCROLLSPY = 'scrollspy';
    const PLUGIN_TAB = 'tab';
    const PLUGIN_TOOLTIP = 'tooltip';
    const PLUGIN_TRANSITION = 'transition';
    const PLUGIN_TYPEAHEAD = 'typeahead';

    /**
     * @var int static counter, used for determining script identifiers
     */
    public static $counter = 0;

    /**
     * @var bool whether we should copy the asset file or directory even if it is already published before.
     */
    public $forceCopyAssets = false;

    /**
     * @var string path to Bootstrap assets.
     */
    public $assetsPath;

    private $_assetsUrl;

    /**
     * Initializes this component.
     */
    public function init()
    {
        parent::init();
        if ($this->assetsPath === null) {
            $this->assetsPath = Yii::getPathOfAlias('vendor.twbs.bootstrap.dist');
        }
        if ($this->assetsPath === null || strlen($this->assetsPath) < 1) {
        	$this->assetsPath = realpath(__DIR__ . '/../assets');
        }
    }

    /**
     * Registers the Bootstrap CSS.
     * @param string $url the URL to the CSS file to register.
     * @param string $media the media type (defaults to 'screen').
     */
    public function registerCoreCss($url = null, $media = 'screen')
    {
        if ($url === null) {
            $fileName = YII_DEBUG ? 'bootstrap.css' : 'bootstrap.min.css';
            $url = $this->getAssetsUrl() . '/css/' . $fileName;
        }
        Yii::app()->getClientScript()->registerCssFile($url, $media);
    }

    /**
     * Registers the Bootstrap theme CSS.
     * @param string $url the URL to the CSS file to register.
     * @param string $media the media type (defaults to 'screen').
     */
    public function registerThemeCss($url = null, $media = 'screen')
    {
        if ($url === null) {
            $fileName = YII_DEBUG ? 'bootstrap-theme.css' : 'bootstrap-theme.min.css';
            $url = $this->getAssetsUrl() . '/css/' . $fileName;
        }
        Yii::app()->getClientScript()->registerCssFile($url, $media);
    }

    /**
     * Registers the Yiistrap CSS.
     * @param string $url the URL to the CSS file to register.
     * @param string $media the media type.
     */
    public function registerYiistrapCss($url = null, $media = '')
    {
    	// Obsolete since this file doesn't exist
        /*if ($url === null) {
            $fileName = YII_DEBUG ? 'yiistrap.css' : 'yiistrap.min.css';
            $url = $this->getAssetsUrl() . '/css/' . $fileName;
        }
        Yii::app()->getClientScript()->registerCssFile($url, $media);*/
    }

    /**
     * Fixes panning and zooming on mobile devices.
     */
    public function fixPanningAndZooming()
    {
        Yii::app()->getClientScript()->registerMetaTag('width=device-width, initial-scale=1.0', 'viewport');
    }

    /**
     * Registers all Bootstrap CSS files.
     */
    public function registerAllCss()
    {
        $this->registerCoreCss();
        $this->registerYiistrapCss();
        $this->fixPanningAndZooming();
    }

    /**
     * Registers jQuery and Bootstrap JavaScript.
     * @param string $url the URL to the JavaScript file to register.
     * @param int $position the position of the JavaScript code.
     */
    public function registerCoreScripts($url = null, $position = CClientScript::POS_END)
    {
        if ($url === null) {
            $fileName = YII_DEBUG ? 'bootstrap.js' : 'bootstrap.min.js';
            $url = $this->getAssetsUrl() . '/js/' . $fileName;
        }
        /** @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile($url, $position);
    }

    /**
     * Registers the Tooltip and Popover plugins.
     */
    public function registerTooltipAndPopover()
    {
        $this->registerPopover();
        $this->registerTooltip();
    }

    /**
     * Registers all Bootstrap JavaScript files.
     */
    public function registerAllScripts()
    {
        $this->registerCoreScripts();
        $this->registerTooltipAndPopover();
    }

    /**
     * Registers all assets.
     */
    public function register()
    {
        $this->registerAllCss();
        $this->registerAllScripts();
    }

    /**
     * Registers the Bootstrap Popover plugin.
     * @param string $selector the CSS selector.
     * @param array $options the JavaScript options for the plugin.
     * @see http://twitter.github.com/bootstrap/javascript.html#popover
     */
    public function registerPopover($selector = 'body', $options = array())
    {
        TbArray::defaultValue('selector', 'a[rel=popover]', $options);
        $this->registerPlugin(self::PLUGIN_POPOVER, $selector, $options);
    }

    /**
     * Registers the Bootstrap Tooltip plugin.
     * @param string $selector the CSS selector.
     * @param array $options the JavaScript options for the plugin.
     * @see http://twitter.github.com/bootstrap/javascript.html#tooltip
     */
    public function registerTooltip($selector = 'body', $options = array())
    {
        TbArray::defaultValue('selector', 'a[rel=tooltip]', $options);
        $this->registerPlugin(self::PLUGIN_TOOLTIP, $selector, $options);
    }

    /**
     * Registers a specific Bootstrap plugin using the given selector and options.
     * @param string $name the plugin name.
     * @param string $selector the CSS selector.
     * @param array $options the JavaScript options for the plugin.
     * @param int $position the position of the JavaScript code.
     */
    public function registerPlugin($name, $selector, $options = array(), $position = CClientScript::POS_END)
    {
        $options = !empty($options) ? CJavaScript::encode($options) : '';
        $script = "jQuery('{$selector}').{$name}({$options});";
        $id = __CLASS__ . '#Plugin' . self::$counter++;
        Yii::app()->clientScript->registerScript($id, $script, $position);
    }

    /**
     * Registers events using the given selector.
     * @param string $selector the CSS selector.
     * @param string[] $events the JavaScript event configuration (name=>handler).
     * @param int $position the position of the JavaScript code.
     */
    public function registerEvents($selector, $events, $position = CClientScript::POS_END)
    {
        if (!empty($events)) {
            $script = '';
            foreach ($events as $name => $handler) {
                if (!$handler instanceof CJavaScriptExpression) {
                    $handler = new CJavaScriptExpression($handler);
                }
                $script .= "jQuery('{$selector}').on('{$name}', {$handler});";
            }
            $id = __CLASS__ . '#Events' . self::$counter++;
            Yii::app()->clientScript->registerScript($id, $script, $position);
        }
    }

    /**
     * Returns the url to the published assets folder.
     * @return string the url.
     */
    protected function getAssetsUrl()
    {
        if (!isset($this->_assetsUrl)) {
            if (($path = Yii::getPathOfAlias($this->assetsPath)) !== false) {
                $this->assetsPath = $path;
            }
            
            $assetsUrl = Yii::app()->assetManager->publish($this->assetsPath, false, -1, $this->forceCopyAssets);
            $this->_assetsUrl = $assetsUrl;
        }
        return $this->_assetsUrl;
    }
}
