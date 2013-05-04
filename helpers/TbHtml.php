<?php
/**
 * TbHtml class file.
 * @author Antonio Ramirez <ramirez.cobos@gmail.com>
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.helpers
 */

/**
 * Bootstrap HTML helper.
 */
class TbHtml extends CHtml // required in order to access protected methods
{
    // Element styles.
    const STYLE_DEFAULT = '';
    const STYLE_PRIMARY = 'primary';
    const STYLE_INFO = 'info';
    const STYLE_SUCCESS = 'success';
    const STYLE_WARNING = 'warning';
    const STYLE_ERROR = 'error';
    const STYLE_DANGER = 'danger';
    const STYLE_IMPORTANT = 'important';
    const STYLE_INVERSE = 'inverse';
    const STYLE_LINK = 'link';

    // Element sizes.
    const SIZE_MINI = 'mini';
    const SIZE_SMALL = 'small';
    const SIZE_DEFAULT = '';
    const SIZE_MEDIUM = 'medium';
    const SIZE_LARGE = 'large';
    const SIZE_XLARGE = 'xlarge';
    const SIZE_XXLARGE = 'xxlarge';

    // Menu types.
    const NAV_TABS = 'tabs';
    const NAV_PILLS = 'pills';
    const NAV_LIST = 'list';

    // Navbar positions.
    const NAVBAR_TOP = 'top';
    const NAVBAR_BOTTOM = 'bottom';

    // Floats.
    const PULL_LEFT = 'left';
    const PULL_RIGHT = 'right';

    // Text alignments.
    const ALIGN_LEFT = 'left';
    const ALIGN_CENTER = 'center';
    const ALIGN_RIGHT = 'right';

    // Image types.
    const IMAGE_ROUNDED = 'rounded';
    const IMAGE_CIRCLE = 'circle';
    const IMAGE_POLAROID = 'polaroid';

    // Progress bar types.
    const PROGRESS_LEFT = 'left';
    const PROGRESS_CENTER = 'centered';
    const PROGRESS_RIGHT = 'right';
    const PROGRESS_STRIPED = 'striped';
    const PROGRESS_ACTIVE = 'active';

    // Tooltip placements.
    const TOOLTIP_TOP = 'top';
    const TOOLTIP_BOTTOM = 'bottom';
    const TOOLTIP_LEFT = 'left';
    const TOOLTIP_RIGHT = 'right';

    // Tab placements.
    const TABS_ABOVE = '';
    const TABS_BELOW = 'below';
    const TABS_LEFT = 'left';
    const TABS_RIGHT = 'right';

    // Tooltip triggers.
    const TRIGGER_CLICK = 'click';
    const TRIGGER_HOVER = 'hover';
    const TRIGGER_FOCUS = 'focus';
    const TRIGGER_MANUAL = 'manual';

    // Addon types.
    const ADDON_PREPEND = 'prepend';
    const ADDON_APPEND = 'append';

    // Help types.
    const HELP_INLINE = 'inline';
    const HELP_BLOCK = 'block';

    // Form layouts.
    const FORM_VERTICAL = 'vertical';
    const FORM_HORIZONTAL = 'horizontal';
    const FORM_INLINE = 'inline';
    const FORM_SEARCH = 'search';

    // Input types.
    const INPUT_URL = 'urlField';
    const INPUT_EMAIL = 'emailField';
    const INPUT_NUMBER = 'numberField';
    const INPUT_RANGE = 'rangeField';
    const INPUT_DATE = 'dateField';
    const INPUT_TEXT = 'textField';
    const INPUT_PASSWORD = 'passwordField';
    const INPUT_TEXTAREA = 'textArea';
    const INPUT_FILE = 'fileField';
    const INPUT_RADIOBUTTON = 'radioButton';
    const INPUT_CHECKBOX = 'checkBox';
    const INPUT_DROPDOWN = 'dropDownList';
    const INPUT_LISTBOX = 'listBox';
    const INPUT_CHECKBOXLIST = 'inlineCheckBoxList';
    const INPUT_RADIOBUTTONLIST = 'inlineRadioButtonList';
    const INPUT_UNEDITABLE = 'uneditableField';
    const INPUT_SEARCH = 'searchQuery';

    // grid types.
    const GRID_STRIPED = 'striped';
    const GRID_BORDERED = 'bordered';
    const GRID_CONDENSED = 'condensed';
    const GRID_HOVER = 'hover';

    // Icon types.
    const ICON_GLASS = 'icon-glass';
    const ICON_MUSIC = 'icon-music';
    const ICON_SEARCH = 'icon-search';
    const ICON_ENVELOPE = 'icon-envelope';
    const ICON_HEART = 'icon-heart';
    const ICON_STAR = 'icon-star';
    const ICON_STAR_EMPTY = 'icon-star-empty';
    const ICON_USER = 'icon-user';
    const ICON_FILM = 'icon-film';
    const ICON_TH_LARGE = 'icon-th-large';
    const ICON_TH = 'icon-th';
    const ICON_TH_LIST = 'icon-th-list';
    const ICON_OK = 'icon-ok';
    const ICON_REMOVE = 'icon-remove';
    const ICON_ZOOM_IN = 'icon-zoom-in';
    const ICON_ZOOM_OUT = 'icon-zoom-out';
    const ICON_OFF = 'icon-off';
    const ICON_SIGNAL =  'icon-signal';
    const ICON_COG = 'icon-cog';
    const ICON_TRASH = 'icon-trash';
    const ICON_HOME = 'icon-home';
    const ICON_FILE = 'icon-file';
    const ICON_TIME = 'icon-time';
    const ICON_ROAD = 'icon-road';
    const ICON_DOWNLOAD_ALT = 'icon-download-alt';
    const ICON_DOWNLOAD = 'icon-download';
    const ICON_UPLOAD = 'icon-upload';
    const ICON_INBOX = 'icon-inbox';
    const ICON_PLAY_CIRCLE = 'icon-play-circle';
    const ICON_REPEAT = 'icon-repeat';
    const ICON_REFRESH = 'icon-refresh';
    const ICON_LIST_ALT = 'icon-list-alt';
    const ICON_LOCK = 'icon-lock';
    const ICON_FLAG = 'icon-flag';
    const ICON_HEADPHONES = 'icon-headphones';
    const ICON_VOLUME_OFF = 'icon-volume-off';
    const ICON_VOLUME_DOWN = 'icon-volume-down';
    const ICON_VOLUME_UP = 'icon-volume-up';
    const ICON_QRCODE = 'icon-qrcode';
    const ICON_BARCODE = 'icon-barcode';
    const ICON_TAG = 'icon-tag';
    const ICON_TAGS = 'icon-tags';
    const ICON_BOOK = 'icon-book';
    const ICON_BOOKMARK = 'icon-bookmark';
    const ICON_PRINT = 'icon-print';
    const ICON_CAMERA = 'icon-camera';
    const ICON_FONT = 'icon-font';
    const ICON_BOLD = 'icon-bold';
    const ICON_ITALIC = 'icon-italic';
    const ICON_TEXT_HEIGHT = 'icon-text-height';
    const ICON_TEXT_WIDTH = 'icon-text-width';
    const ICON_ALIGN_LEFT = 'icon-align-left';
    const ICON_ALIGN_CENTER = 'icon-align-center';
    const ICON_ALIGN_RIGHT = 'icon-align-right';
    const ICON_ALIGN_JUSTIFY = 'icon-align-justify';
    const ICON_LIST = 'icon-list';
    const ICON_INDENT_LEFT = 'icon-indent-left';
    const ICON_INDENT_RIGHT = 'icon-indent-right';
    const ICON_FACETIME_VIDEO = 'icon-facetime-video';
    const ICON_PICTURE = 'icon-picture';
    const ICON_PENCIL = 'icon-pencil';
    const ICON_MAP_MARKER = 'icon-map-marker';
    const ICON_ADJUST = 'icon-adjust';
    const ICON_TINT = 'icon-tint';
    const ICON_EDIT = 'icon-edit';
    const ICON_SHARE = 'icon-share';
    const ICON_CHECK = 'icon-check';
    const ICON_MOVE = 'icon-move';
    const ICON_STEP_BACKWARD = 'icon-step-backward';
    const ICON_FAST_BACKWARD = 'icon-fast-backward';
    const ICON_BACKWARD = 'icon-backward';
    const ICON_PLAY = 'icon-play';
    const ICON_PAUSE = 'icon-pause';
    const ICON_STOP = 'icon-pause';
    const ICON_FORWARD = 'icon-forward';
    const ICON_FAST_FORWARD = 'icon-fast-forward';
    const ICON_STEP_FORWARD = 'icon-step-forward';
    const ICON_EJECT = 'icon-eject';
    const ICON_CHEVRON_LEFT = 'icon-chevron-left';
    const ICON_CHEVRON_RIGHT = 'icon-chevron-right';
    const ICON_PLUS_SIGN = 'icon-plus-sign';
    const ICON_MINUS_SIGN = 'icon-minus-sign';
    const ICON_REMOVE_SIGN = 'icon-remove-sign';
    const ICON_OK_SIGN = 'icon-ok-sign';
    const ICON_QUESTION_SIGN = 'icon-question-sign';
    const ICON_INFO_SIGN = 'icon-info-sign';
    const ICON_SCREENSHOT = 'icon-screenshot';
    const ICON_REMOVE_CIRCLE = 'icon-remove-circle';
    const ICON_OK_CIRCLE = 'icon-ok-circle';
    const ICON_BAN_CIRCLE = 'icon-ban-circle';
    const ICON_ARROW_LEFT = 'icon-arrow-left';
    const ICON_ARROW_RIGHT = 'icon-arrow-right';
    const ICON_ARROW_UP = 'icon-arrow-up';
    const ICON_ARROW_DOWN = 'icon-arrow-down';
    const ICON_SHARE_ALT = 'icon-share-alt';
    const ICON_RESIZE_FULL = 'icon-resize-full';
    const ICON_RESIZE_SMALL = 'icon-resize-small';
    const ICON_PLUS = 'icon-plus';
    const ICON_MINUS = 'icon-minus';
    const ICON_ASTERISK = 'icon-asterisk';
    const ICON_EXCLAMATION_SIGN = 'icon-exclamation-sign';
    const ICON_GIFT = 'icon-gift';
    const ICON_LEAF = 'icon-leaf';
    const ICON_FIRE = 'icon-fire';
    const ICON_EYE_OPEN = 'icon-eye-open';
    const ICON_EYE_CLOSE = 'icon-eye-close';
    const ICON_WARNING_SIGN = 'icon-warning-sign';
    const ICON_PLANE = 'icon-plane';
    const ICON_CALENDAR = 'icon-calendar';
    const ICON_RANDOM =  'icon-random';
    const ICON_COMMENT = 'icon-comment';
    const ICON_MAGNET = 'icon-magnet';
    const ICON_CHEVRON_UP = 'icon-chevron-up';
    const ICON_CHEVRON_DOWN = 'icon-chevron-down';
    const ICON_RETWEET = 'icon-retweet';
    const ICON_SHOPPING_CART = 'icon-shopping-cart';
    const ICON_FOLDER_CLOSE = 'icon-folder-close';
    const ICON_FOLDER_OPEN = 'icon-folder-open';
    const ICON_RESIZE_VERTICAL = 'icon-resize-vertical';
    const ICON_RESIZE_HORIZONTAL = 'icon-resize-horizontal';
    const ICON_HDD = 'icon-hdd';
    const ICON_BULLHORN = 'icon-bullhorn';
    const ICON_BELL = 'icon-bell';
    const ICON_CERTFICATE = 'icon-certificate';
    const ICON_THUMBS_UP = 'icon-thumbs-up';
    const ICON_THUMBS_DOWN = 'icon-thumbs-down';
    const ICON_HAND_RIGHT = 'icon-hand-right';
    const ICON_HAND_LEFT = 'icon-hand-left';
    const ICON_HAND_UP = 'icon-hand-up';
    const ICON_HAND_DOWN = 'icon-hand-down';
    const ICON_CIRCLE_ARROW_RIGHT = 'icon-circle-arrow-right';
    const ICON_CIRCLE_ARROW_LEFT = 'icon-circle-arrow-left';
    const ICON_CIRCLE_ARROW_UP   = 'icon-circle-arrow-up';
    const ICON_CIRCLE_ARROW_DOWN = 'icon-circle-arrow-down';
    const ICON_GLOBE = 'icon-globe';
    const ICON_WRENCH = 'icon-wrench';
    const ICON_TASKS = 'icon-tasks';
    const ICON_FILTER = 'icon-filter';
    const ICON_BRIEFCASE = 'icon-briefcase';
    const ICON_FULLSCREEN = 'icon-fullscreen';

    // Default close text.
    const CLOSE_TEXT = '&times;';

    // Scope constants.
    static $formLayouts = array(self::FORM_VERTICAL, self::FORM_HORIZONTAL, self::FORM_INLINE, self::FORM_SEARCH);
    static $inputStates = array(self::STYLE_WARNING, self::STYLE_ERROR, self::STYLE_INFO, self::STYLE_SUCCESS);
    static $inputs = array(self::INPUT_CHECKBOX, self::INPUT_CHECKBOXLIST, self::INPUT_DATE,
        self::INPUT_DROPDOWN, self::INPUT_EMAIL, self::INPUT_FILE, self::INPUT_LISTBOX,
        self::INPUT_NUMBER, self::INPUT_PASSWORD, self::INPUT_RADIOBUTTON, self::INPUT_RANGE,
        self::INPUT_TEXT, self::INPUT_TEXTAREA, self::INPUT_URL, self::INPUT_RADIOBUTTONLIST,
        self::INPUT_UNEDITABLE, self::INPUT_SEARCH);
    static $labelInputs = array(self::INPUT_CHECKBOX, self::INPUT_RADIOBUTTON);
    static $dataInputs = array(self::INPUT_CHECKBOXLIST, self::INPUT_DROPDOWN, self::INPUT_LISTBOX,
        self::INPUT_RADIOBUTTONLIST); // Which one requires data
    static $inputSizes = array(self::SIZE_MINI, self::SIZE_SMALL, self::SIZE_MEDIUM, self::SIZE_LARGE, self::SIZE_XLARGE, self::SIZE_XXLARGE);
    static $helpTypes = array(self::HELP_INLINE, self::HELP_BLOCK);
    static $elementSizes = array(self::SIZE_MINI, self::SIZE_SMALL, self::SIZE_LARGE);
    static $pulls = array(self::PULL_LEFT, self::PULL_RIGHT);
    static $textStyles = array(self::STYLE_ERROR, self::STYLE_INFO, self::STYLE_SUCCESS, self::STYLE_WARNING);
    static $textAlignments = array(self::ALIGN_LEFT, self::ALIGN_CENTER, self::ALIGN_RIGHT);
    static $imageTypes = array(self::IMAGE_ROUNDED, self::IMAGE_CIRCLE, self::IMAGE_POLAROID);
    static $buttonStyles = array(self::STYLE_PRIMARY, self::STYLE_INFO, self::STYLE_SUCCESS, self::STYLE_WARNING,
        self::STYLE_DANGER, self::STYLE_INVERSE, self::STYLE_LINK);
    static $navTypes = array(self::NAV_TABS, self::NAV_PILLS, self::NAV_LIST);
    static $tabPlacements = array(self::TABS_ABOVE, self::TABS_BELOW, self::TABS_LEFT, self::TABS_RIGHT);
    static $navbarStyles = array(self::STYLE_INVERSE);
    static $navbarPositions = array(self::NAVBAR_TOP, self::NAVBAR_BOTTOM);
    static $labelBadgeStyles = array(self::STYLE_SUCCESS, self::STYLE_WARNING, self::STYLE_IMPORTANT, self::STYLE_INFO, self::STYLE_INVERSE);
    static $alertStyles = array(self::STYLE_SUCCESS, self::STYLE_INFO, self::STYLE_WARNING, self::STYLE_ERROR);
    static $progressStyles = array(self::STYLE_INFO, self::STYLE_SUCCESS, self::STYLE_WARNING, self::STYLE_DANGER);
    static $progressAlignments = array(self::PROGRESS_LEFT, self::PROGRESS_CENTER, self::PROGRESS_RIGHT);
    static $tooltipPlacements = array(self::TOOLTIP_TOP, self::TOOLTIP_BOTTOM, self::TOOLTIP_LEFT, self::TOOLTIP_RIGHT);
    static $triggers = array(self::TRIGGER_CLICK, self::TRIGGER_HOVER, self::TRIGGER_FOCUS, self::TRIGGER_MANUAL);
    static $addOnTypes = array(self::ADDON_PREPEND, self::ADDON_APPEND);
    static $grids = array(self::GRID_BORDERED, self::GRID_CONDENSED, self::GRID_HOVER, self::GRID_STRIPED);

    static $errorMessageCss = 'error';

    private static $_counter = 0;

    //
    // BASE CSS
    // --------------------------------------------------

    // Typography
    // http://twitter.github.com/bootstrap/base-css.html#typography
    // --------------------------------------------------

    /**
     * Generates a paragraph that stands out.
     * @param string $text the lead text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated paragraph.
     */
    public static function lead($text, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('lead', $htmlOptions);
        return self::tag('p', $htmlOptions, $text);
    }

    /**
     * Generates small text.
     * @param string $text the text to style.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text.
     */
    public static function small($text, $htmlOptions = array())
    {
        return self::tag('small', $htmlOptions, $text);
    }

    /**
     * Generates bold text.
     * @param string $text the text to style.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text.
     */
    public static function b($text, $htmlOptions = array())
    {
        return self::tag('strong', $htmlOptions, $text);
    }

    /**
     * Generates italic text.
     * @param string $text the text to style.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text.
     */
    public static function i($text, $htmlOptions = array())
    {
        return self::tag('em', $htmlOptions, $text);
    }

    /**
     * Generates an emphasized text.
     * @param string $style the text style.
     * @param string $text the text to emphasize.
     * @param array $htmlOptions additional HTML attributes.
     * @param string $tag the HTML tag.
     * @return string the generated text.
     */
    public static function em($style, $text, $htmlOptions = array(), $tag = 'p')
    {
        if ($style && in_array($style, self::$textStyles))
            $htmlOptions = self::addClassName('text-' . $style, $htmlOptions);
        return self::tag($tag, $htmlOptions, $text);
    }

    /**
     * Generates a muted text block.
     * @param string $text the text.
     * @param array $htmlOptions additional HTML attributes.
     * @param string $tag the HTML tag.
     * @return string the generated text block.
     */
    public static function muted($text, $htmlOptions = array(), $tag = 'p')
    {
        if (self::popOption('muted', $htmlOptions, false))
            $htmlOptions = self::addClassName('muted', $htmlOptions);
        return self::tag($tag, $htmlOptions, $text);
    }

    /**
     * Generates a muted span.
     * @param string $text the text.
     * @param array $htmlOptions additional HTML attributes.
     * @param string $tag the HTML tag.
     * @return string the generated span.
     */
    public static function mutedSpan($text, $htmlOptions = array())
    {
        return self::muted($text, $htmlOptions, 'span');
    }

    /**
     * Generates an abbreviation with a help text.
     * @param string $text the abbreviation.
     * @param string $word the word the abbreviation is for.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated abbreviation.
     */
    public static function abbr($text, $word, $htmlOptions = array())
    {
        if (self::popOption('small', $htmlOptions, false))
            $htmlOptions = self::addClassName('initialism', $htmlOptions);
        $htmlOptions['title'] = $word;
        return self::tag('abbr', $htmlOptions, $text);
    }

    /**
     * Generates a small abbreviation with a help text.
     * @param string $text the abbreviation.
     * @param string $word the word the abbreviation is for.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated abbreviation.
     */
    public static function smallAbbr($text, $word, $htmlOptions = array())
    {
        $htmlOptions['small'] = true;
        return self::abbr($text, $word, $htmlOptions);
    }

    /**
     * Generates an address block.
     * @param string $quote the address text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated block.
     */
    public static function address($text, $htmlOptions = array())
    {
        return self::tag('address', $htmlOptions, $text);
    }

    /**
     * Generates a quote.
     * @param string $text the quoted text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated quote.
     */
    public static function quote($text, $htmlOptions = array())
    {
        $paragraphOptions = self::popOption('paragraphOptions', $htmlOptions, array());
        $source = self::popOption('source', $htmlOptions);
        $sourceOptions = self::popOption('sourceOptions', $htmlOptions, array());
        $cite = self::popOption('cite', $htmlOptions);
        $citeOptions = self::popOption('citeOptions', $htmlOptions, array());
        $cite = isset($cite) ? self::tag('cite', $citeOptions, $cite) : '';
        $source = isset($source) ? self::tag('small', $sourceOptions, $source . ' ' . $cite) : '';
        $text = self::tag('p', $paragraphOptions, $text) . $source;
        return self::tag('blockquote', $htmlOptions, $text);
    }

    /**
     * Generates a help text.
     * @param string $text the help text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text.
     */
    public static function help($text, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('help-inline', $htmlOptions);
        return self::tag('p', $htmlOptions, $text);
    }

    /**
     * Generates a help block.
     * @param string $text the help text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated block.
     */
    public static function helpBlock($text, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('help-block', $htmlOptions);
        return self::tag('p', $htmlOptions, $text);
    }

    // Code
    // http://twitter.github.com/bootstrap/base-css.html#code
    // --------------------------------------------------

    /**
     * Generates inline code.
     * @param string $code the code.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated code.
     */
    public static function code($code, $htmlOptions = array())
    {
        return self::tag('code', $htmlOptions, $code);
    }

    /**
     * Generates a code block.
     * @param string $code the code.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated block.
     */
    public static function codeBlock($code, $htmlOptions = array())
    {
        return self::tag('pre', $htmlOptions, $code);
    }

    /**
     * Generates an HTML element.
     * @param string $tag the tag name.
     * @param array $htmlOptions the element attributes.
     * @param mixed $content the content to be enclosed between open and close element tags.
     * @param boolean $closeTag whether to generate the close tag.
     * @return string the generated HTML element tag.
     */
    public static function tag($tag, $htmlOptions = array(), $content = false, $closeTag = true)
    {
        self::addSpanClass($htmlOptions);
        $align = self::popOption('align', $htmlOptions);
        if (isset($align) && in_array($align, self::$textAlignments))
            $htmlOptions = self::addClassName('text-' . $align, $htmlOptions);
        $pull = self::popOption('pull', $htmlOptions);
        if (isset($pull) && in_array($pull, self::$pulls))
            $htmlOptions = self::addClassName('pull-' . $pull, $htmlOptions);
        return CHtml::tag($tag, $htmlOptions, $content, $closeTag);
    }

    /**
     * Generates an open HTML element.
     * @param string $tag the tag name.
     * @param array $htmlOptions the element attributes.
     * @return string the generated HTML element tag.
     */
    public static function openTag($tag, $htmlOptions = array())
    {
        return self::tag($tag, $htmlOptions);
    }

    // Tables
    // http://twitter.github.com/bootstrap/base-css.html#forms
    // --------------------------------------------------

    // todo: create table methods here.

    // Forms
    // http://twitter.github.com/bootstrap/base-css.html#tables
    // --------------------------------------------------

    /**
     * Generates a form tag.
     * @param string $layout the form layout.
     * @param string $action the form action URL.
     * @param string $method form method (e.g. post, get).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated tag.
     */
    public static function formTb($layout = self::FORM_VERTICAL, $action = '', $method = 'post', $htmlOptions = array())
    {
        return self::beginFormTb($layout, $action, $method, $htmlOptions);
    }

    /**
     * Generates an open form tag.
     * @param string $layout the form layout.
     * @param string $action the form action URL.
     * @param string $method form method (e.g. post, get).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated tag.
     */
    public static function beginFormTb($layout = self::FORM_VERTICAL, $action = '', $method = 'post', $htmlOptions = array())
    {
        if (in_array($layout, self::$formLayouts))
            $htmlOptions = self::addClassName('form-' . $layout, $htmlOptions);
        return CHtml::beginForm($action, $method, $htmlOptions);
    }

    /**
     * Generates a form row.
     * @param string $type the input type.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @param array $data data for multiple select inputs.
     * @return string the generated row.
     */
    public static function row($type, $name, $value, $htmlOptions = array(), $data = array())
    {
        $wrap = self::popOption('wrap', $htmlOptions, false);
        $label = self::popOption('label', $htmlOptions, false);
        $state = self::popOption('state', $htmlOptions);
        $groupOptions = self::popOption('groupOptions', $htmlOptions, array());
        $labelOptions = self::popOption('labelOptions', $htmlOptions, array());
        $controlOptions = self::popOption('controlOptions', $htmlOptions, array());

        if (in_array($type, self::$labelInputs))
        {
            $htmlOptions['label'] = $label;
            $htmlOptions['labelOptions'] = $labelOptions;
            $label = false;
        }

        $input = self::createInput($type, $name, $value, $htmlOptions, $data);

        if ($wrap)
        {
            $groupOptions = self::addClassName('control-group', $groupOptions);
            if (isset($state) && in_array($state, self::$inputStates))
                $groupOptions = self::addClassName($state, $groupOptions);
            $labelOptions = self::addClassName('control-label', $labelOptions);
            ob_start();
            echo self::openTag('div', $groupOptions);
            if ($label !== false)
                echo self::label($label, $name, $labelOptions);
            echo self::formControls($input, $controlOptions);
            echo '</div>';
            return ob_get_clean();
        }
        else
        {
            ob_start();
            if ($label !== false)
                echo self::label($label, $name, $labelOptions);
            echo $input;
            return ob_get_clean();
        }
    }

    /**
     * Generates a wrapped form row.
     * @param string $type the input type.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @param array $data data for multiple select inputs.
     * @return string the generated row.
     */
    public static function wrappedRow($type, $name, $value, $htmlOptions = array(), $data = array())
    {
        $htmlOptions['wrap'] = true;
        return self::row($type, $name, $value, $htmlOptions, $data);
    }

    /**
     * Generates form controls.
     * @param mixed $controls the controls.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated controls.
     */
    public static function formControls($controls, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('controls', $htmlOptions);
        if (isset($htmlOptions['row']) && $htmlOptions['row'] === true)
            $htmlOptions = self::addClassName('controls-row', $htmlOptions);
        $before = self::popOption('before', $htmlOptions, '');
        $after = self::popOption('after', $htmlOptions, '');
        if (is_array($controls))
            $controls = implode(' ', $controls);
        ob_start();
        echo self::openTag('div', $htmlOptions);
        echo $before . $controls . $after;
        echo '</div>';
        return ob_get_clean();
    }

    /**
     * Generates form controls row.
     * @param mixed $controls the controls.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated controls.
     */
    public static function formControlsRow($controls, $htmlOptions = array())
    {
        $htmlOptions['row'] = true;
        return self::formControls($controls, $htmlOptions);
    }

    /**
     * Generates form actions.
     * @param mixed $actions the actions.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated actions.
     */
    public static function formActions($actions, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('form-actions', $htmlOptions);
        if (is_array($actions))
            $actions = implode(' ', $actions);
        ob_start();
        echo self::openTag('div', $htmlOptions);
        echo $actions;
        echo '</div>';
        return ob_get_clean();
    }

    /**
     * Generates an uneditable input.
     * @param string $value the value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input.
     */
    public static function uneditableField($value = '', $htmlOptions = array())
    {
        $size = self::popOption('size', $htmlOptions);
        if (!self::addSpanClass($htmlOptions))
        {
            if (isset($size) && in_array($size, self::$inputSizes))
                $htmlOptions = self::addClassName('input-' . $size, $htmlOptions);
            else if (isset($htmlOptions['block']))
                $htmlOptions = self::addClassName('input-block-level', $htmlOptions);
        }
        $htmlOptions = self::addClassName('uneditable-input', $htmlOptions);
        return self::tag('span', $htmlOptions, $value);
    }

    /**
     * Generates a search query input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input.
     */
    public static function searchQuery($name, $value = '', $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('search-query', $htmlOptions);
        return self::textField($name, $value, $htmlOptions);
    }

    /**
     * Generates a text field input.
     * @param string $name the input name
     * @param string $value the input value
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::inputField
     */
    public static function textField($name, $value = '', $htmlOptions = array())
    {
        return self::inputField('text', $name, $value, $htmlOptions);
    }

    /**
     * Generates a password field input.
     * @param string $name the input name
     * @param string $value the input value
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::inputField
     */
    public static function passwordField($name, $value = '', $htmlOptions = array())
    {
        CHtml::clientChange('change', $htmlOptions);
        return self::inputField('password', $name, $value, $htmlOptions);
    }

    /**
     * Generates an url field input.
     * @param string $name the input name
     * @param string $value the input value
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::inputField
     */
    public static function urlField($name, $value = '', $htmlOptions = array())
    {
        return self::inputField('url', $name, $value, $htmlOptions);
    }

    /**
     * Generates an email field input.
     * @param string $name the input name
     * @param string $value the input value
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::inputField
     */
    public static function emailField($name, $value = '', $htmlOptions = array())
    {
        return self::inputField('email', $name, $value, $htmlOptions);
    }

    /**
     * Generates a number field input.
     * @param string $name the input name
     * @param string $value the input value
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::inputField
     */
    public static function numberField($name, $value = '', $htmlOptions = array())
    {
        return self::inputField('number', $name, $value, $htmlOptions);
    }

    /**
     * Generates a range field input.
     * @param string $name the input name
     * @param string $value the input value
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::inputField
     */
    public static function rangeField($name, $value = '', $htmlOptions = array())
    {
        return self::inputField('range', $name, $value, $htmlOptions);
    }

    /**
     * Generates a date field input.
     * @param string $name the input name
     * @param string $value the input value
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::inputField
     */
    public static function dateField($name, $value = '', $htmlOptions = array())
    {
        return self::inputField('date', $name, $value, $htmlOptions);
    }

    /**
     * Generates a radio button.
     * @param string $name the input name.
     * @param boolean $checked whether the radio button is checked.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated radio button.
     * @see TbHtml::inputField
     */
    public static function radioButton($name, $checked = false, $htmlOptions = array())
    {
        $label = self::popOption('label', $htmlOptions, false);
        $labelOptions = self::popOption('labelOptions', $htmlOptions, array());
        $radioButton = CHtml::radioButton($name, $checked, $htmlOptions);
        if ($label !== false)
        {
            $labelOptions = self::addClassName('radio', $labelOptions);
            ob_start();
            echo self::tag('label', $labelOptions, $radioButton . $label);
            return ob_get_clean();
        }
        else
            return $radioButton;
    }

    /**
     * Generates a check box.
     * @param string $name the input name.
     * @param boolean $checked whether the check box is checked.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated check box.
     * @see TbHtml::inputField
     */
    public static function checkBox($name, $checked = false, $htmlOptions = array())
    {
        $label = self::popOption('label', $htmlOptions, false);
        $labelOptions = self::popOption('labelOptions', $htmlOptions, array());
        $checkBox = CHtml::checkBox($name, $checked, $htmlOptions);
        if ($label !== false)
        {
            $labelOptions = self::addClassName('checkbox', $labelOptions);
            ob_start();
            echo self::tag('label', $labelOptions, $checkBox . $label);
            return ob_get_clean();
        }
        else
            return $checkBox;
    }

    /**
     * Generates a drop down list.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @return string the generated drop down list.
     */
    public static function dropDownList($name, $select, $data, $htmlOptions = array())
    {
        $htmlOptions = self::normalizeInputOptions($htmlOptions);
        return CHtml::dropDownList($name, $select, $data, $htmlOptions);
    }

    /**
     * Generates a check box list.
     * @param string $name name of the check box list.
     * @param mixed $select selection of the check boxes.
     * @param array $data $data value-label pairs used to generate the check box list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function checkBoxList($name, $select, $data, $htmlOptions = array())
    {
        $inline = self::popOption('inline', $htmlOptions, false);

        $separator = self::popOption('separator', $htmlOptions, ' ');
        $container = self::popOption('container', $htmlOptions);
        $containerOptions = self::popOption('containerOptions', $htmlOptions, array());

        if (substr($name, -2) !== '[]')
            $name .= '[]';
        $checkAllLabel = self::popOption('checkAll', $htmlOptions);
        $checkAllLast = self::popOption('checkAllLast', $htmlOptions);

        $labelOptions = self::popOption('labelOptions', $htmlOptions, array());
        $labelOptions = self::addClassName('checkbox', $labelOptions);
        if ($inline)
            $labelOptions = self::addClassName('inline', $labelOptions);

        $items  = array();
        $baseID = $containerOptions['id'] = self::popOption('baseID', $htmlOptions, CHtml::getIdByName($name));
        $id = 0;
        $checkAll = true;

        foreach ($data as $value => $label)
        {
            $checked = !is_array($select) && !strcmp($value, $select) || is_array($select) && in_array($value, $select);
            $checkAll = $checkAll && $checked;
            $htmlOptions['value'] = $value;
            $htmlOptions['id'] = $baseID . '_' . $id++;
            if ($inline)
            {
                $htmlOptions['label'] = $label;
                $htmlOptions['labelOptions'] = $labelOptions;
                $items[] = self::checkBox($name, $checked, $htmlOptions);
            }
            else
            {
                $option = self::checkBox($name, $checked, $htmlOptions);
                $items[] = self::label($option . ' ' . $label, '', $labelOptions);
            }
        }

        if (isset($checkAllLabel))
        {
            $htmlOptions['value'] = 1;
            $htmlOptions['id'] = $id = $baseID . '_all';
            $option = self::checkBox($id, $checkAll, $htmlOptions);
            $label = self::label($checkAllLabel, '', $labelOptions);
            $item = self::label($option . ' ' . $label, '', $labelOptions);
            if ($checkAllLast)
                $items[] = $item;
            else
                array_unshift($items, $item);
            $name = strtr($name, array('[' => '\\[', ']' => '\\]'));
            $js = <<<EOD
jQuery('#$id').click(function() {
	jQuery("input[name='$name']").prop('checked', this.checked);
});
jQuery("input[name='$name']").click(function() {
	jQuery('#$id').prop('checked', !jQuery("input[name='$name']:not(:checked)").length);
});
jQuery('#$id').prop('checked', !jQuery("input[name='$name']:not(:checked)").length);
EOD;
            $cs = Yii::app()->getClientScript();
            $cs->registerCoreScript('jquery');
            $cs->registerScript($id, $js);
        }

        $inputs = implode($separator, $items);
        return !empty($container) ? self::tag($container, $containerOptions, $inputs) : $inputs;
    }

    /**
     * Generates an inline check box list.
     * @param string $name name of the check box list.
     * @param mixed $select selection of the check boxes.
     * @param array $data $data value-label pairs used to generate the check box list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function inlineCheckBoxList($name, $select, $data, $htmlOptions = array())
    {
        $htmlOptions['inline'] = true;
        return self::checkBoxList($name, $select, $data, $htmlOptions);
    }

    /**
     * Generates a radio button list.
     * @param string $name name of the radio button list.
     * @param mixed $select selection of the radio buttons.
     * @param array $data $data value-label pairs used to generate the radio button list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function radioButtonList($name, $select, $data, $htmlOptions = array())
    {
        $inline = self::popOption('inline', $htmlOptions, false);

        $separator = self::popOption('separator', $htmlOptions, ' ');
        $container = self::popOption('container', $htmlOptions);
        $containerOptions = self::popOption('containerOptions', $htmlOptions, array());

        $labelOptions = self::popOption('labelOptions', $htmlOptions, array());
        $labelOptions = self::addClassName('radio', $labelOptions);
        if ($inline)
            $labelOptions = self::addClassName('inline', $labelOptions);

        $items  = array();
        $baseID = $containerOptions['id'] = self::popOption('baseID', $htmlOptions, CHtml::getIdByName($name));

        $id = 0;
        foreach ($data as $value => $label)
        {
            $checked  = !strcmp($value, $select);
            $htmlOptions['value'] = $value;
            $htmlOptions['id'] = $baseID . '_' . $id++;
            if ($inline)
            {
                $htmlOptions['label'] = $label;
                $htmlOptions['labelOptions'] = $labelOptions;
                $items[] = self::radioButton($name, $checked, $htmlOptions);
            }
            else
            {
                $option = self::radioButton($name, $checked, $htmlOptions);
                $items[] = self::label($option . ' ' . $label, '', $labelOptions);
            }
        }

        $inputs = implode($separator, $items);
        return !empty($container) ? self::tag($container, $containerOptions, $inputs) : $inputs;
    }

    /**
     * Generates an inline radio button list.
     * @param string $name name of the radio button list.
     * @param mixed $select selection of the radio buttons.
     * @param array $data $data value-label pairs used to generate the radio button list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function inlineRadioButtonList($name, $select, $data, $htmlOptions = array())
    {
        $htmlOptions['inline'] = true;
        return self::radioButtonList($name, $select, $data, $htmlOptions);
    }

    /**
     * Generates a text field input row.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::row
     */
    public static function textFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_TEXT, $name, $value, $htmlOptions);
    }

    /**
     * Generates a password field input row.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::inputField
     */
    public static function passwordFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_PASSWORD, $name, $value, $htmlOptions);
    }

    /**
     * Generates an url field input row.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::row
     */
    public static function urlFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_URL, $name, $value, $htmlOptions);
    }

    /**
     * Generates an email field input row.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::row
     */
    public static function emailFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_EMAIL, $name, $value, $htmlOptions);
    }

    /**
     * Generates a number field input row.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::inputField
     */
    public static function numberFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_NUMBER, $name, $value, $htmlOptions);
    }

    /**
     * Generates a range field input row.
     * @param string $name the input name
     * @param string $value the input value
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::row
     */
    public static function rangeFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_RANGE, $name, $value, $htmlOptions);
    }

    /**
     * Generates a date field input row.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::row
     */
    public static function dateFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_DATE, $name, $value, $htmlOptions);
    }

    /**
     * Generates a text area input row.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text area.
     * @see TbHtml::row
     */
    public static function textAreaRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_TEXTAREA, $name, $value, $htmlOptions);
    }

    /**
     * Generates a file input row.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see TbHtml::row
     */
    public static function fileFieldRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_FILE, $name, $value, $htmlOptions);
    }

    // todo: docblock
    public static function radioButtonRow($name, $checked = false, $htmlOptions = array())
    {
        return self::row(self::INPUT_RADIOBUTTON, $name, $checked, $htmlOptions);
    }

    // todo: docblock
    public static function checkBoxRow($name, $checked = false, $htmlOptions = array())
    {
        return self::row(self::INPUT_CHECKBOX, $name, $checked, $htmlOptions);
    }

    // todo: docblock
    public static function dropDownListRow($name, $select = '', $data = array(), $htmlOptions = array())
    {
        return self::row(self::INPUT_DROPDOWN, $name, $select, $htmlOptions, $data);
    }

    // todo: docblock
    public static function listBoxRow($name, $select = '', $data = array(), $htmlOptions = array())
    {
        return self::row(self::INPUT_LISTBOX, $name, $select, $htmlOptions, $data);
    }

    // todo: docblock
    public static function radioButtonListRow($name, $select = '', $data = array(), $htmlOptions = array())
    {
        return self::row(self::INPUT_RADIOBUTTONLIST, $name, $select, $htmlOptions, $data);
    }

    // todo: docblock
    public static function checkBoxListRow($name, $select = '', $data = array(), $htmlOptions = array())
    {
        return self::row(self::INPUT_CHECKBOXLIST, $name, $select, $htmlOptions, $data);
    }

    // todo: docblock
    public static function unediableFieldRow($value = '', $htmlOptions = array())
    {
        return ''; // todo: implement
    }

    // todo: docblock
    public static function searchQueryRow($name, $value = '', $htmlOptions = array())
    {
        return self::row(self::INPUT_SEARCH, $name, $value, $htmlOptions);
    }

    /**
     * Generates an input HTML tag.
     * This method generates an input HTML tag based on the given input name and value.
     * @param string $type the input type.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input tag.
     */
    protected static function inputField($type, $name, $value, $htmlOptions)
    {
        CHtml::clientChange('change', $htmlOptions);

        $htmlOptions = self::normalizeInputOptions($htmlOptions);

        $addOnClasses = self::getAddOnClasses($htmlOptions);
        $addOnOptions = self::popOption('addOnOptions', $htmlOptions, array());
        $addOnOptions = self::addClassName($addOnClasses, $addOnOptions);

        $prepend = self::popOption('prepend', $htmlOptions, '');
        $prependOptions = self::popOption('prependOptions', $htmlOptions, array());
        if (!empty($prepend))
            $prepend = self::inputPrepend($prepend, $prependOptions);

        $append = self::popOption('append', $htmlOptions, '');
        $appendOptions = self::popOption('appendOptions', $htmlOptions, array());
        if (!empty($append))
            $append = self::inputAppend($append, $appendOptions);

        $help = self::popOption('help', $htmlOptions, '');
        $helpOptions = self::popOption('helpOptions', $htmlOptions, array());
        if (!empty($help))
            $help = self::inputHelp($help, $helpOptions);

        ob_start();
        if (!empty($addOnClasses))
            echo self::openTag('div', $addOnOptions);
        echo $prepend . CHtml::inputField($type, $name, $value, $htmlOptions) . $append;
        if (!empty($addOnClasses))
            echo '</div>';
        echo $help;
        return ob_get_clean();
    }

    /**
     * Returns the add-on classes based on the given options.
     * @param array $htmlOptions the options.
     * @return string the classes.
     */
    protected static function getAddOnClasses($htmlOptions)
    {
        $classes = array();
        if (self::getOption('append', $htmlOptions))
            $classes[] = 'input-append';
        if (self::getOption('prepend', $htmlOptions))
            $classes[] = 'input-prepend';
        return !empty($classes) ? implode(' ', $classes) : $classes;
    }

    /**
     * Generates an add-on for an input field.
     * @param string $type the add-on type.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated add-on.
     */
    protected static function inputAddOn($type, $addOn, $htmlOptions)
    {
        $addOnOptions = self::popOption('addOnOptions', $htmlOptions, array());
        $addOnOptions = self::addClassName('add-on', $addOnOptions);
        return strpos($addOn, 'btn') === false // buttons should not be wrapped in a span
            ? self::tag('span', $addOnOptions, $addOn)
            : $addOn;
    }

    /**
     * Generates an prepended add-on for an input field.
     * @param string $addOn the add-on.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated add-on.
     */
    public static function inputPrepend($addOn, $htmlOptions)
    {
        return self::inputAddOn(self::ADDON_PREPEND, $addOn, $htmlOptions);
    }

    /**
     * Generates an appended add-on for an input field.
     * @param string $addOn the add-on.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated add-on.
     */
    public static function inputAppend($addOn, $htmlOptions)
    {
        return self::inputAddOn(self::ADDON_APPEND, $addOn, $htmlOptions);
    }

    /**
     * Generates a help text for an input field.
     * @param string $help the help text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated help text.
     */
    public static function inputHelp($help, $htmlOptions)
    {
        $type = self::popOption('type', $htmlOptions, self::HELP_INLINE);
        if (in_array($type, self::$helpTypes))
            $htmlOptions = self::addClassName('help-' . $type, $htmlOptions);
        return self::tag('span', $htmlOptions, $help);
    }

    /**
     * Normalizes input options.
     * @param array $options the options.
     * @return array the normalized options.
     */
    protected function normalizeInputOptions($options)
    {
        $size = self::popOption('size', $options);
        if (!self::addSpanClass($options))
        {
            if (isset($size) && in_array($size, self::$inputSizes))
                $options = self::addClassName('input-' . $size, $options);
            else if (isset($options['block']))
                $options = self::addClassName('input-block-level', $options);
        }
        return $options;
    }

    // todo: rewrite the active methods

    /*
    public static function activeLabel($model, $attribute, $htmlOptions = array())
    {
        $name = CHtml::resolveName($model, $attribute);
        $id = CHtml::getIdByName($name);
        $for = self::popOption('for', $htmlOptions, $id);
        $label = self::popOption('label', $htmlOptions, $model->getAttributeLabel($attribute));

        if ($model->hasErrors($attribute))
            CHtml::addErrorCss($htmlOptions);

        return self::label($label, $for, $htmlOptions);
    }

    public static function activeLabelEx($model, $attribute, $htmlOptions = array())
    {
        $realAttribute = $attribute;
        CHtml::resolveName($model, $attribute); // strip off square brackets if any
        $htmlOptions['required'] = $model->isAttributeRequired($attribute);
        return self::activeLabel($model, $realAttribute, $htmlOptions);
    }

    public static function activeTextField($model, $attribute, $htmlOptions = array())
    {
        CHtml::resolveNameID($model, $attribute, $htmlOptions);
        CHtml::clientChange('change', $htmlOptions);
        return self::activeInputField('text', $model, $attribute, $htmlOptions);
    }

    public static function activeUrlField($model, $attribute, $htmlOptions = array())
    {
        CHtml::resolveNameID($model, $attribute, $htmlOptions);
        CHtml::clientChange('change', $htmlOptions);
        return self::activeInputField('url', $model, $attribute, $htmlOptions);
    }

    public static function activeEmailField($model, $attribute, $htmlOptions = array())
    {
        CHtml::resolveNameID($model, $attribute, $htmlOptions);
        CHtml::clientChange('change', $htmlOptions);
        return self::activeInputField('email', $model, $attribute, $htmlOptions);
    }

    public static function activeNumberField($model, $attribute, $htmlOptions = array())
    {
        CHtml::resolveNameID($model, $attribute, $htmlOptions);
        CHtml::clientChange('change', $htmlOptions);
        return self::activeInputField('number', $model, $attribute, $htmlOptions);
    }

    public static function activeRangeField($model, $attribute, $htmlOptions = array())
    {
        CHtml::resolveNameID($model, $attribute, $htmlOptions);
        CHtml::clientChange('change', $htmlOptions);
        return self::activeInputField('range', $model, $attribute, $htmlOptions);
    }

    public static function activeDateField($model, $attribute, $htmlOptions = array())
    {
        CHtml::resolveNameID($model, $attribute, $htmlOptions);
        CHtml::clientChange('change', $htmlOptions);
        return self::activeInputField('date', $model, $attribute, $htmlOptions);
    }

    public static function activePasswordField($model, $attribute, $htmlOptions = array())
    {
        CHtml::resolveNameID($model, $attribute, $htmlOptions);
        CHtml::clientChange('change', $htmlOptions);
        return self::activeInputField('password', $model, $attribute, $htmlOptions);
    }

    public static function activeTextArea($model, $attribute, $htmlOptions = array())
    {
        CHtml::resolveNameID($model, $attribute, $htmlOptions);
        CHtml::clientChange('change', $htmlOptions);
        if ($model->hasErrors($attribute))
            CHtml::addErrorCss($htmlOptions);

        $text = self::popOption('value', $htmlOptions, CHtml::resolveValue($model, $attribute));

        ob_start();
        echo self::tag('textarea', $htmlOptions, isset($htmlOptions['encode']) && !$htmlOptions['encode'] ? $text : CHtml::encode($text));
        return ob_get_clean();
    }

    public static function activeCheckBox($model, $attribute, $htmlOptions = array())
    {
        // todo: is there another way to extract parents hidden input?
        CHtml::resolveNameID($model, $attribute, $htmlOptions);

        $htmlOptions = self::defaultOption('value', 1, $htmlOptions);

        if (!isset($htmlOptions['checked']) && CHtml::resolveValue($model, $attribute) == $htmlOptions['value'])
            $htmlOptions['checked'] = 'checked';
        CHtml::clientChange('click', $htmlOptions);

        $unCheck = self::popOption('unCheckValue', $htmlOptions, '0');

        $hiddenOptions = isset($htmlOptions['id']) ? array('id' => CHtml::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
        $hidden = $unCheck !== null ? CHtml::hiddenField($htmlOptions['name'], $unCheck, $hiddenOptions) : '';

        $name = CHtml::resolveName($model, $attribute);
        $htmlOptions = self::defaultOption('label', $model->getAttributeLabel($attribute), $htmlOptions);

        // todo: checkbox and radio have different label layout. Test whether this solution works
        return $hidden . self::checkBox($name, $unCheck, $htmlOptions);
    }

    public static function activeRadioButton($model, $attribute, $htmlOptions = array())
    {
        CHtml::resolveNameID($model, $attribute, $htmlOptions);

        $htmlOptions = self::defaultOption('value', 1, $htmlOptions);

        if (!isset($htmlOptions['checked']) && CHtml::resolveValue($model, $attribute) == $htmlOptions['value'])
            $htmlOptions['checked'] = 'checked';

        CHtml::clientChange('click', $htmlOptions);

        $unCheck = self::popOption('uncheckValue', $htmlOptions, '0');

        $hiddenOptions = isset($htmlOptions['id']) ? array('id' => CHtml::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
        $hidden = $unCheck !== null ? CHtml::hiddenField($htmlOptions['name'], $unCheck, $hiddenOptions) : '';

        $name = CHtml::resolveName($model, $attribute);
        $htmlOptions = self::defaultOption('label', $model->getAttributeLabel($attribute), $htmlOptions);

        // todo: checkbox and radio have different label layout. Test whether this solution works
        // add a hidden field so that if the radio button is not selected, it still submits a value
        return $hidden . self::radioButton($name, $unCheck, $htmlOptions);
    }

    public static function activeDropDownList($model, $attribute, $data, $htmlOptions = array())
    {
        CHtml::resolveNameID($model, $attribute, $htmlOptions);
        $selection = CHtml::resolveValue($model, $attribute);
        $options = "\n" . CHtml::listOptions($selection, $data, $htmlOptions);
        CHtml::clientChange('change', $htmlOptions);
        if ($model->hasErrors($attribute))
            CHtml::addErrorCss($htmlOptions);
        if (isset($htmlOptions['multiple']))
        {
            if (substr($htmlOptions['name'], -2) !== '[]')
                $htmlOptions['name'] .= '[]';
        }
        //$help = self::inputHelp($htmlOptions);
        ob_start();
        echo self::tag('select', $htmlOptions, $options);
        echo $help;
        return ob_get_clean();
    }

    public static function activeListBox($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions = self::defaultOption('size', 4, $htmlOptions);
        return self::activeDropDownList($model, $attribute, $data, $htmlOptions);
    }

    public static function activeFileField($model, $attribute, $htmlOptions = array())
    {
        CHtml::resolveNameID($model, $attribute, $htmlOptions);
        // add a hidden field so that if a model only has a file field, we can
        // still use isset($_POST[$modelClass]) to detect if the input is submitted
        $hiddenOptions = isset($htmlOptions['id']) ? array('id' => CHtml::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
        return CHtml::hiddenField($htmlOptions['name'], '', $hiddenOptions)
            . self::activeInputField('file', $model, $attribute, $htmlOptions);
    }

    public static function activeInlineCheckBoxList($model, $attribute, $data, $htmlOptions = array())
    {
        CHtml::resolveNameID($model, $attribute, $htmlOptions);
        $selection = CHtml::resolveValue($model, $attribute);
        if ($model->hasErrors($attribute))
            CHtml::addErrorCss($htmlOptions);
        $name = self::popOption('name', $htmlOptions);

        $unCheck = self::popOption('uncheckValue', $htmlOptions, '');

        $hiddenOptions = isset($htmlOptions['id']) ? array('id' => CHtml::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
        $hidden = $unCheck !== null ? CHtml::hiddenField($name, $unCheck, $hiddenOptions) : '';

        return $hidden . self::inlineCheckBoxList($name, $selection, $data, $htmlOptions);
    }

    public static function activeInlineRadioButtonList($model, $attribute, $data, $htmlOptions = array())
    {
        CHtml::resolveNameID($model, $attribute, $htmlOptions);
        $selection = CHtml::resolveValue($model, $attribute);
        if ($model->hasErrors($attribute))
            CHtml::addErrorCss($htmlOptions);
        $name = self::popOption('name', $htmlOptions);
        $unCheck = self::popOption('uncheckValue', $htmlOptions, '');

        $hiddenOptions = isset($htmlOptions['id']) ? array('id' => CHtml::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
        $hidden = $unCheck !== null ? CHtml::hiddenField($name, $unCheck, $hiddenOptions) : '';

        return $hidden . self::inlineRadioButtonList($name, $selection, $data, $htmlOptions);
    }

    protected static function activeInputField($type, $model, $attribute, $htmlOptions)
    {
        $inputOptions = self::removeOptions($htmlOptions, array('append', 'prepend'));
        $addOnClasses = self::getAddOnClasses($htmlOptions);

        // todo: implement
        $prepend = '';
        $append = '';
        $help = '';

        ob_start();
        if (!empty($addOnClasses))
            echo '<div class="' . $addOnClasses . '">';
        echo $prepend . CHtml::activeInputField($type, $model, $attribute, $inputOptions) . $append;
        if (!empty($addOnClasses))
            echo '</div>';
        echo $help;
        return ob_get_clean();
    }

    public static function error($model, $attribute, $htmlOptions = array())
    {
        CHtml::resolveName($model, $attribute); // turn [a][b]attr into attr
        $error = $model->getError($attribute);
        return $error != ''
            ? self::tag('span', self::defaultOption('class', self::$errorMessageCss, $htmlOptions), $error)
            : '';
    }

    public static function errorSummary($model, $header = null, $footer = null, $htmlOptions = array())
    {
        $htmlOptions = TbHtml::addClassName('alert alert-block alert-error', $htmlOptions);
        return CHtml::errorSummary($model, $header, $footer, $htmlOptions);
    }
    */

    /**
     * Generates a search form.
     * @param mixed $action the form action URL.
     * @param string $method form method (e.g. post, get).
     * @param array $htmlOptions additional HTML options.
     * @return string the generated form.
     */
    public static function searchForm($action, $method = 'post', $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('form-search', $htmlOptions);
        $inputOptions = self::popOption('inputOptions', $htmlOptions, array());
        $inputOptions = self::mergeOptions(array('type' => 'text', 'placeholder' => 'Search'), $inputOptions);
        $inputOptions = self::addClassName('search-query', $inputOptions);
        $buttonOptions = self::popOption('buttonOptions', $htmlOptions, array());
        $buttonLabel = self::popOption('label', $buttonOptions, self::icon('search'));
        $name = self::popOption('name', $inputOptions, 'search');
        $value = self::popOption('value', $inputOptions, '');
        $addon = self::popOption('addon', $htmlOptions);
        if (isset($addon) && in_array($addon, self::$addOnTypes))
            $inputOptions[$addon] = self::button($buttonLabel, $buttonOptions);
        ob_start();
        echo CHtml::beginForm($action, $method, $htmlOptions);
        echo self::textField($name, $value, $inputOptions);
        echo CHtml::endForm();
        return ob_get_clean();
    }

    /**
     * Generates a navbar form.
     * @param mixed $action the form action URL.
     * @param string $method form method (e.g. post, get).
     * @param array $htmlOptions additional HTML attributes
     * @return string the generated form.
     */
    public static function navbarForm($action, $method = 'post', $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('navbar-form', $htmlOptions);
        return CHtml::form($action, $method, $htmlOptions);
    }

    /**
     * Generates a navbar search form.
     * @param mixed $action the form action URL.
     * @param string $method form method (e.g. post, get).
     * @param array $htmlOptions additional HTML attributes
     * @return string the generated form.
     */
    public static function navbarSearchForm($action, $method = 'post', $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('navbar-search', $htmlOptions);
        return self::searchForm($action, $method, $htmlOptions);
    }

    // Buttons
    // http://twitter.github.com/bootstrap/base-css.html#buttons
    // --------------------------------------------------

    /**
     * Generates a button.
     * @param string $label the button label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function button($label = 'button', $htmlOptions = array())
    {
        if (!isset($htmlOptions['name']))
            $htmlOptions['name'] = CHtml::ID_PREFIX . CHtml::$count++;
        CHtml::clientChange('click', $htmlOptions);
        return self::btn('button', $label, $htmlOptions);
    }

    /**
     * Generates a submit button.
     * @param string $label the button label
     * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
     * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
     * @return string the generated button tag
     * @see clientChange
     */
    public static function submitButton($label = 'submit', $htmlOptions = array())
    {
        $htmlOptions['type'] = 'submit';
        return self::button($label, $htmlOptions);
    }

    /**
     * Generates a reset button.
     * @param string $label the button label
     * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
     * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
     * @return string the generated button tag
     * @see clientChange
     */
    public static function resetButton($label = 'reset', $htmlOptions = array())
    {
        $htmlOptions['type'] = 'reset';
        return self::button($label, $htmlOptions);
    }

    /**
     * Generates an image submit button.
     * @param string $src the image URL
     * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
     * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
     * @return string the generated button tag
     * @see clientChange
     */
    public static function imageButton($src, $htmlOptions = array())
    {
        $htmlOptions['src'] = $src;
        $htmlOptions['type'] = 'image';
        return self::button('submit', $htmlOptions);
    }

    /**
     * Generates a link button.
     * @param string $label the button label text.
     * @param array $htmlOptions the HTML attributes for the button.
     * @return string the generated button.
     */
    public static function linkButton($label = 'submit', $htmlOptions = array())
    {
        $htmlOptions['href'] = self::popOption('url', $htmlOptions, '#');
        $htmlOptions['href'] = CHtml::normalizeUrl($htmlOptions['href']);
        return self::btn('a', $label, $htmlOptions);
    }

    // todo: add support for ajax buttons and links.

    /**
     * Generates a button.
     * @param string $tag the HTML tag.
     * @param string $label the button label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function btn($tag, $label, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('btn', $htmlOptions);
        $style = self::popOption('style', $htmlOptions);
        if (isset($style) && in_array($style, self::$buttonStyles))
            $htmlOptions = self::addClassName('btn-' . $style, $htmlOptions);
        $size = self::popOption('size', $htmlOptions);
        if (isset($size) && in_array($size, self::$elementSizes))
            $htmlOptions = self::addClassName('btn-' . $size, $htmlOptions);
        if (self::popOption('block', $htmlOptions, false))
            $htmlOptions = self::addClassName('btn-block', $htmlOptions);
        if (self::popOption('disabled', $htmlOptions, false))
            $htmlOptions = self::addClassName('disabled', $htmlOptions);
        $icon = self::popOption('icon', $htmlOptions);
        if (isset($icon))
            $label = self::icon($icon) . '&nbsp;' . $label;
        return self::tag($tag, $htmlOptions, $label);
    }

    // Images
    // http://twitter.github.com/bootstrap/base-css.html#images
    // --------------------------------------------------

    /**
     * Generates an image tag with rounded corners.
     * @param string $src the image URL.
     * @param string $alt the alternative text display.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated image tag.
     */
    public static function imageRounded($src, $alt = '', $htmlOptions = array())
    {
        $htmlOptions['type'] = self::IMAGE_ROUNDED;
        return self::image($src, $alt, $htmlOptions);
    }

    /**
     * Generates an image tag with circle.
     * ***Important*** `.img-rounded` and `.img-circle` do not work in IE7-8 due to lack of border-radius support.
     * @param string $src the image URL.
     * @param string $alt the alternative text display.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated image tag.
     */
    public static function imageCircle($src, $alt = '', $htmlOptions = array())
    {
        $htmlOptions['type'] = self::IMAGE_CIRCLE;
        return self::image($src, $alt, $htmlOptions);
    }

    /**
     * Generates an image tag within polaroid frame.
     * @param string $src the image URL.
     * @param string $alt the alternative text display.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated image tag.
     */
    public static function imagePolaroid($src, $alt = '', $htmlOptions = array())
    {
        $htmlOptions['type'] = self::IMAGE_POLAROID;
        return self::image($src, $alt, $htmlOptions);
    }

    /**
     * Generates an image tag.
     * @param string $src the image URL.
     * @param string $alt the alternative text display.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated image tag.
     */
    public static function image($src, $alt = '', $htmlOptions = array())
    {
        $type = self::popOption('type', $htmlOptions);
        if (isset($type) && in_array($type, self::$imageTypes))
            $htmlOptions = self::addClassName('img-' . $type, $htmlOptions);
        return CHtml::image($src, $alt, $htmlOptions);
    }

    // Icons by Glyphicons
    // http://twitter.github.com/bootstrap/base-css.html#icons
    // --------------------------------------------------

    /**
     * Generates an icon.
     * @param string $icon the icon type.
     * @param array $htmlOptions additional HTML attributes.
     * @param string $tagName the icon HTML tag.
     * @return string the generated icon.
     */
    public static function icon($icon, $htmlOptions = array(), $tagName = 'i')
    {
        if (is_string($icon))
        {
            if (strpos($icon, 'icon') === false)
                $icon = 'icon-' . implode(' icon-', explode(' ', $icon));
            $htmlOptions = self::addClassName($icon, $htmlOptions);
            return CHtml::openTag($tagName, $htmlOptions) . CHtml::closeTag($tagName); // tag won't work in this case
        }
        return '';
    }

    //
    // COMPONENTS
    // --------------------------------------------------

    // Dropdowns
    // http://twitter.github.com/bootstrap/components.html#dropdowns
    // --------------------------------------------------

    /**
     * Generates a dropdown menu.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function dropdown($items, $htmlOptions = array())
    {
        // todo: think about how to apply this, now it applies to all depths while it should only apply for the first.
        //$htmlOptions = self::setDefaultValue('role', 'menu', $htmlOptions);
        $htmlOptions = self::addClassName('dropdown-menu', $htmlOptions);
        $align = self::popOption('align', $htmlOptions);
        if (isset($align) && $align === self::ALIGN_RIGHT)
            $htmlOptions = self::addClassName('pull-right', $htmlOptions);
        ob_start();
        echo self::menu($items, $htmlOptions);
        return ob_get_clean();
    }

    /**
     * Generates a dropdown toggle link.
     * @param string $label the link label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function dropdownToggleLink($label, $htmlOptions = array())
    {
        return self::dropdownToggle('a', $label, $htmlOptions);
    }

    /**
     * Generates a dropdown toggle button.
     * @param string $label the button label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function dropdownToggleButton($label = '', $htmlOptions = array())
    {
        return self::dropdownToggle('button', $label, $htmlOptions);
    }

    /**
     * Generates a dropdown toggle element.
     * @param string $tag the HTML tag.
     * @param string $label the element text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated element.
     */
    public static function dropdownToggle($tag, $label, $htmlOptions)
    {
        $htmlOptions = self::addClassName('dropdown-toggle', $htmlOptions);
        $htmlOptions = self::defaultOption('data-toggle', 'dropdown', $htmlOptions);
        $label .= ' <b class="caret"></b>';
        return self::btn($tag, $label, $htmlOptions);
    }

    /**
     * Generates a dropdown toggle menu item.
     * @param string $label the menu item text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu item.
     */
    public static function dropdownToggleMenuLink($label, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('dropdown-toggle', $htmlOptions);
        $htmlOptions = self::defaultOption('data-toggle', 'dropdown', $htmlOptions);
        $label .= ' <b class="caret"></b>';
        return CHtml::link($label, '#', $htmlOptions);
    }

    // Button groups
    // http://twitter.github.com/bootstrap/components.html#buttonGroups
    // --------------------------------------------------

    /**
     * Generates a button group. Example:
     *
     * <pre>
     *     echo TbHtml::buttonGroup(array(
     *         array('label'=>'testA'),
     *         array('label'=>'testB')
     * ));
     * </pre>
     *
     * @param array $buttons the button configurations.
     * @param array $htmlOptions additional HTML options. The following special options are recognized:
     * <ul>
     * <li>
     *         items: array, the list of buttons to be inserted into the group (see {@link button} function to see available
     *      config options for buttons.
     * </li>
     * <li>
     *         vertical: string, whether to render the group vertically instead of horizontally.
     * </li>
     * </ul>
     *
     * @return string the generated button group.
     */
    public static function buttonGroup($buttons, $htmlOptions = array())
    {
        if (is_array($buttons) && !empty($buttons))
        {
            $htmlOptions = self::addClassName('btn-group', $htmlOptions);
            if (self::popOption('vertical', $htmlOptions, false))
                $htmlOptions = self::addClassName('btn-group-vertical', $htmlOptions);
            $parentOptions = array(
                'style' => self::popOption('style', $htmlOptions),
                'size' => self::popOption('size', $htmlOptions),
                'disabled' => self::popOption('disabled', $htmlOptions)
            );
            ob_start();
            echo CHtml::openTag('div', $htmlOptions);
            foreach ($buttons as $buttonOptions)
            {
                $options = self::popOption('htmlOptions', $buttonOptions, array());
                if (!empty($options))
                    $buttonOptions = self::mergeOptions($options, $buttonOptions);
                $buttonLabel = self::popOption('label', $buttonOptions, '');
                $buttonOptions = self::copyOptions(array('style', 'size', 'disabled'), $parentOptions, $buttonOptions);
                if (isset($buttonOptions['items']))
                {
                    $items = self::popOption('items', $buttonOptions);
                    echo self::buttonDropdown($buttonLabel, $items, $buttonOptions);
                }
                else
                    echo self::linkButton($buttonLabel, $buttonOptions);
            }
            echo '</div>';
            return ob_get_clean();
        }
        return '';
    }

    /**
     * Generates a button toolbar. Example:
     *
     * echo TbHtml::buttonToolbar(array(
     *     array(
     *         'items' => array(
     *             array('label'=>'testA'),
     *             array('label'=>'testB')
     *         )
     *     ),
     *     array(
     *         'items' => array(
     *             array('label'=>'testC')
     *         )
     * )));
     *
     * @param array $groups the button group configurations.
     * @param array $htmlOptions additional HTML options.
     * @return string the generated button toolbar.
     */
    public static function buttonToolbar($groups, $htmlOptions = array())
    {
        if (is_array($groups) && !empty($groups))
        {
            $htmlOptions = self::addClassName('btn-toolbar', $htmlOptions);
            $parentOptions = array(
                'style' => self::popOption('style', $htmlOptions),
                'size' => self::popOption('size', $htmlOptions),
                'disabled' => self::popOption('disabled', $htmlOptions)
            );
            ob_start();
            echo CHtml::openTag('div', $htmlOptions);
            foreach ($groups as $groupOptions)
            {
                $items = self::popOption('items', $groupOptions, array());
                if (empty($items))
                    continue;
                $options = self::popOption('htmlOptions', $groupOptions, array());
                if (!empty($options))
                    $groupOptions = self::mergeOptions($options, $groupOptions);
                $groupOptions = self::copyOptions(array('style', 'size', 'disabled'), $parentOptions, $groupOptions);
                echo self::buttonGroup($items, $groupOptions);
            }
            echo '</div>';
            return ob_get_clean();
        }
        return '';
    }

    // Button dropdowns
    // http://twitter.github.com/bootstrap/components.html#buttonDropdowns
    // --------------------------------------------------

    /**
     * Generates a button with a dropdown menu.
     * @param string $label the button label text.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function buttonDropdown($label, $items, $htmlOptions = array())
    {
        $menuOptions = self::popOption('menuOptions', $htmlOptions, array());
        $groupOptions = self::popOption('groupOptions', $htmlOptions, array());
        $groupOptions = self::addClassName('btn-group', $groupOptions);
        if (self::popOption('dropup', $htmlOptions, false))
            $groupOptions = self::addClassName('dropup', $groupOptions);
        ob_start();
        echo CHtml::openTag('div', $groupOptions);
        if (self::popOption('split', $htmlOptions, false))
        {
            echo self::linkButton($label, $htmlOptions);
            echo self::dropdownToggleButton('', $htmlOptions);
        } else
            echo self::dropdownToggleLink($label, $htmlOptions);
        echo self::dropdown($items, $menuOptions);
        echo '</div>';
        return ob_get_clean();
    }

    /**
     * Generates a button with a split dropdown menu.
     * @param string $label the button label text.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function splitButtonDropdown($label, $items, $htmlOptions = array())
    {
        $htmlOptions['split'] = true;
        return self::buttonDropdown($label, $items, $htmlOptions);
    }

    // Navs
    // http://twitter.github.com/bootstrap/components.html#navs
    // --------------------------------------------------

    /**
     * Generates a tab navigation.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function tabs($items, $htmlOptions = array())
    {
        return self::nav(self::NAV_TABS, $items, $htmlOptions);
    }

    /**
     * Generates a stacked tab navigation.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function stackedTabs($items, $htmlOptions = array())
    {
        $htmlOptions['stacked'] = true;
        return self::tabs($items, $htmlOptions);
    }

    /**
     * Generates a pills navigation.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function pills($items, $htmlOptions = array())
    {
        return self::nav(self::NAV_PILLS, $items, $htmlOptions);
    }

    /**
     * Generates a stacked pills navigation.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function stackedPills($items, $htmlOptions = array())
    {
        $htmlOptions['stacked'] = true;
        return self::tabs($items, $htmlOptions);
    }

    /**
     * Generates a list navigation.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function navList($items, $htmlOptions = array())
    {
        return self::nav(self::NAV_LIST, $items, $htmlOptions);
    }

    /**
     * Generates a navigation menu.
     * @param string $style the menu style.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function nav($style, $items, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('nav', $htmlOptions);
        if (in_array($style, self::$navTypes))
            $htmlOptions = self::addClassName('nav-' . $style, $htmlOptions);
        if ($style !== self::NAV_LIST && self::popOption('stacked', $htmlOptions, false))
            $htmlOptions = self::addClassName('nav-stacked', $htmlOptions);
        ob_start();
        echo self::menu($items, $htmlOptions);
        return ob_get_clean();
    }

    /**
     * Generates a menu.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function menu($items, $htmlOptions = array())
    {
        ob_start();
        echo CHtml::openTag('ul', $htmlOptions);
        foreach ($items as $itemOptions)
        {
            if (is_string($itemOptions))
                echo $itemOptions;
            else
            {
                $options = self::popOption('itemOptions', $itemOptions, array());
                if (!empty($options))
                    $itemOptions = self::mergeOptions($options, $itemOptions);
                // todo: I'm not quite happy with the logic below but it will have to do for now.
                $label = self::popOption('label', $itemOptions, '');
                if (self::popOption('active', $itemOptions, false))
                    $itemOptions = self::addClassName('active', $itemOptions);
                if (self::popOption('disabled', $itemOptions, false))
                    $itemOptions = self::addClassName('disabled', $itemOptions);
                if (self::popOption('header', $itemOptions, false))
                    echo self::menuHeader($label, $itemOptions);
                else
                {
                    $itemOptions['linkOptions'] = self::getOption('linkOptions', $itemOptions, array());
                    $icon = self::popOption('icon', $itemOptions);
                    if (isset($icon))
                        $label = self::icon($icon) . ' ' . $label;
                    $items = self::popOption('items', $itemOptions, array());
                    if (empty($items))
                    {
                        $url = self::popOption('url', $itemOptions, false);
                        echo self::menuLink($label, $url, $itemOptions);
                    } else
                        echo self::menuDropdown($label, $items, $itemOptions);
                }
            }
        }
        echo '</ul>';
        return ob_get_clean();
    }

    /**
     * Generates a menu link.
     * @param string $label the link label.
     * @param array $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu item.
     */
    public static function menuLink($label, $url, $htmlOptions = array())
    {
        $linkOptions = self::popOption('linkOptions', $htmlOptions, array());
        ob_start();
        echo CHtml::openTag('li', $htmlOptions);
        echo CHtml::link($label, $url, $linkOptions);
        echo '</li>';
        return ob_get_clean();
    }

    /**
     * Generates a menu dropdown.
     * @param string $label the link label.
     * @param array $items the menu configuration.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated dropdown.
     */
    public static function menuDropdown($label, $items, $htmlOptions)
    {
        $htmlOptions = self::addClassName('dropdown', $htmlOptions);
        $linkOptions = self::popOption('linkOptions', $htmlOptions, array());
        $menuOptions = self::popOption('menuOptions', $htmlOptions, array());
        $menuOptions = self::addClassName('dropdown-menu', $menuOptions);
        if (self::popOption('active', $htmlOptions, false))
            $htmlOptions = self::addClassName('active', $htmlOptions);
        ob_start();
        echo CHtml::openTag('li', $htmlOptions);
        echo self::dropdownToggleMenuLink($label, $linkOptions);
        echo self::menu($items, $menuOptions);
        echo '</li>';
        return ob_get_clean();
    }

    /**
     * Generates a menu header.
     * @param string $label the header text.
     * @param array $htmlOptions additional HTML options.
     * @return string the generated header.
     */
    public static function menuHeader($label, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('nav-header', $htmlOptions);
        return self::tag('li', $htmlOptions, $label);
    }

    /**
     * Generates a menu divider.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu item.
     */
    public static function menuDivider($htmlOptions = array())
    {
        $htmlOptions = self::addClassName('divider', $htmlOptions);
        return self::tag('li', $htmlOptions);
    }

    // Navbar
    // http://twitter.github.com/bootstrap/components.html#navbar
    // --------------------------------------------------

    /**
     * Generates a navbar.
     * @param string $content the navbar content.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated navbar.
     */
    public static function navbar($content, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('navbar', $htmlOptions);
        $position = self::popOption('position', $htmlOptions);
        $static = self::popOption('static', $htmlOptions, false);
        // todo: fix navbar static positioning.
        if (isset($position) && in_array($position, self::$navbarPositions))
            $htmlOptions = self::addClassName('navbar-fixed-' . $position, $htmlOptions);
        else if ($static) // navbar cannot be both fixed and static
            $htmlOptions = self::addClassName('navbar-static-top', $htmlOptions);
        $style = self::popOption('style', $htmlOptions);
        if (isset($style) && in_array($style, self::$navbarStyles))
            $htmlOptions = self::addClassName('navbar-' . $style, $htmlOptions);
        $innerOptions = self::popOption('innerOptions', $htmlOptions, array());
        $innerOptions = self::addClassName('navbar-inner', $innerOptions);
        ob_start();
        echo CHtml::openTag('div', $htmlOptions);
        echo self::tag('div', $innerOptions, $content);
        echo '</div>';
        return ob_get_clean();
    }

    /**
     * Generates a brand link for the navbar.
     * @param string $label the link label text.
     * @param string $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function navbarBrandLink($label, $url, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('brand', $htmlOptions);
        return CHtml::link($label, $url, $htmlOptions);
    }

    /**
     * Generates a text for the navbar.
     * @param string $text the text.
     * @param array $htmlOptions additional HTML attributes.
     * @param string $tag the HTML tag.
     * @return string the generated text block.
     */
    public static function navbarText($text, $htmlOptions = array(), $tag = 'p')
    {
        $htmlOptions = self::addClassName('navbar-text', $htmlOptions);
        return self::tag($tag, $htmlOptions, $text);
    }

    /**
     * Generates a menu divider for the navbar.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated divider.
     */
    public static function navbarMenuDivider($htmlOptions = array())
    {
        $htmlOptions = self::addClassName('divider-vertical', $htmlOptions);
        return self::tag('li', $htmlOptions);
    }

    // Breadcrumbs
    // http://twitter.github.com/bootstrap/components.html#breadcrumbs
    // --------------------------------------------------

    /**
     * Generates a breadcrumb menu.
     * @param array $links the breadcrumb links.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated breadcrumb.
     */
    public static function breadcrumbs($links, $htmlOptions = array())
    {
        $divider = self::popOption('divider', $htmlOptions, '/');
        $htmlOptions = self::addClassName('breadcrumb', $htmlOptions);
        ob_start();
        echo CHtml::openTag('ul', $htmlOptions);
        foreach ($links as $label => $url)
        {
            if (is_string($label))
            {
                echo CHtml::openTag('li');
                echo CHtml::link($label, CHtml::normalizeUrl($url));
                echo self::tag('span', array('class' => 'divider'), $divider);
                echo '</li>';
            }
            else
                echo self::tag('li', array('class' => 'active'), $url);
        }
        echo '</ul>';
        return ob_get_clean();
    }

    // Pagination
    // http://twitter.github.com/bootstrap/components.html#pagination
    // --------------------------------------------------

    /**
     * Generates a pagination.
     * @param array $links the pagination buttons.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated pagination.
     */
    public static function pagination($links, $htmlOptions = array())
    {
        if (is_array($links) && !empty($links))
        {
            $htmlOptions = self::addClassName('pagination', $htmlOptions);
            $size = self::popOption('size', $htmlOptions);
            if (isset($size) && in_array($size, self::$elementSizes))
                $htmlOptions = self::addClassName('pagination-' . $size, $htmlOptions);
            $align = self::popOption('align', $htmlOptions);
            if (isset($align) && in_array($align, self::$progressAlignments))
                $htmlOptions = self::addClassName('pagination-' . $align, $htmlOptions);
            $listOptions = self::popOption('listOptions', $htmlOptions, array());
            ob_start();
            echo CHtml::openTag('div', $htmlOptions);
            echo CHtml::openTag('ul', $listOptions);
            foreach ($links as $itemOptions)
            {
                $options = self::popOption('htmlOptions', $itemOptions, array());
                if (!empty($options))
                    $itemOptions = self::mergeOptions($options, $itemOptions);
                $label = self::popOption('label', $itemOptions, '');
                $url = self::popOption('url', $itemOptions, false);
                echo self::paginationLink($label, $url, $itemOptions);
            }
            echo '</ul>' . '</div>';
            return ob_get_clean();
        }
        return '';
    }

    /**
     * Generates a pagination link.
     * @param string $label the link label text.
     * @param mixed $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function paginationLink($label, $url, $htmlOptions = array())
    {
        $active = self::popOption('active', $htmlOptions);
        $disabled = self::popOption('disabled', $htmlOptions);
        if ($active)
            $htmlOptions = self::addClassName('active', $htmlOptions);
        else if ($disabled)
            $htmlOptions = self::addClassName('disabled', $htmlOptions);
        $linkOptions = self::popOption('linkOptions', $itemOptions, array());
        ob_start();
        echo CHtml::openTag('li', $htmlOptions);
        echo CHtml::link($label, $url, $linkOptions);
        echo '</li>';
        return ob_get_clean();
    }

    /**
     * Generates a pager.
     * @param array $links the pager buttons.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated pager.
     */
    public static function pager($links, $htmlOptions = array())
    {
        if (is_array($links) && !empty($links))
        {
            $htmlOptions = self::addClassName('pager', $htmlOptions);
            ob_start();
            echo CHtml::openTag('ul', $htmlOptions);
            foreach ($links as $itemOptions)
            {
                $options = self::popOption('htmlOptions', $itemOptions, array());
                if (!empty($options))
                    $itemOptions = self::mergeOptions($options, $itemOptions);
                $label = self::popOption('label', $itemOptions, '');
                $url = self::popOption('url', $itemOptions, false);
                echo self::pagerLink($label, $url, $itemOptions);
            }
            echo '</ul>';
            return ob_get_clean();
        }
        return '';
    }

    /**
     * Generates a pager link.
     * @param string $label the link label text.
     * @param mixed $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function pagerLink($label, $url, $htmlOptions = array())
    {
        $previous = self::popOption('previous', $htmlOptions);
        $next = self::popOption('next', $htmlOptions);
        if ($previous)
            $htmlOptions = self::addClassName('previous', $htmlOptions);
        else if ($next)
            $htmlOptions = self::addClassName('next', $htmlOptions);
        if (self::popOption('disabled', $htmlOptions, false))
            $htmlOptions = self::addClassName('disabled', $htmlOptions);
        $linkOptions = self::popOption('linkOptions', $itemOptions, array());
        ob_start();
        echo CHtml::openTag('li', $htmlOptions);
        echo CHtml::link($label, $url, $linkOptions);
        echo '</li>';
        return ob_get_clean();
    }

    // Labels and badges
    // http://twitter.github.com/bootstrap/components.html#labels-badges
    // --------------------------------------------------

    /**
     * Generates a label span.
     * @param string $label the label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated span.
     */
    public static function labelTb($label, $htmlOptions = array())
    {
        return self::labelBadge('label', $label, $htmlOptions);
    }

    /**
     * Generates a badge span.
     * @param string $label the badge text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated span.
     *
     */
    public static function badge($label, $htmlOptions = array())
    {
        return self::labelBadge('badge', $label, $htmlOptions);
    }

    /**
     * Generates a label or badge span.
     * @param string $type the span type.
     * @param string $label the label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated span.
     */
    public static function labelBadge($type, $label, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName($type, $htmlOptions);
        $style = self::popOption('style', $htmlOptions);
        if (isset($style) && in_array($style, self::$labelBadgeStyles))
            $htmlOptions = self::addClassName($type . '-' . $style, $htmlOptions);
        return self::tag('span', $htmlOptions, $label);
    }

    // Typography
    // http://twitter.github.com/bootstrap/components.html#typography
    // --------------------------------------------------

    /**
     * Generates a hero unit.
     * @param string $heading the heading text.
     * @param string $content the content text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated hero unit.
     */
    public static function heroUnit($heading, $content, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('hero-unit', $htmlOptions);
        $headingOptions = self::popOption('headingOptions', $htmlOptions, array());
        ob_start();
        echo self::tag('div', $htmlOptions);
        echo self::tag('h1', $headingOptions, $heading);
        echo $content;
        echo '</div>';
        return ob_get_clean();
    }

    /**
     * Generates a pager header.
     * @param string $heading the heading text.
     * @param string $subtext the subtext.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated pager header.
     */
    public static function pageHeader($heading, $subtext, $htmlOptions = array())
    {
        // todo: we may have to set an empty array() as default value
        $htmlOptions = self::addClassName('page-header', $htmlOptions);
        $headerOptions = self::popOption('headerOptions', $htmlOptions, array());
        $subtextOptions = self::popOption('subtextOptions', $htmlOptions, array());
        ob_start();
        echo CHtml::openTag('div', $htmlOptions);
        echo CHtml::openTag('h1', $headerOptions);
        echo CHtml::encode($heading) . ' ' . self::tag('small', $subtextOptions, $subtext);
        echo '</h1>';
        echo '</div>';
        return ob_get_clean();
    }

    // Thumbnails
    // http://twitter.github.com/bootstrap/components.html#thumbnails
    // --------------------------------------------------

    /**
     * Generates a list of thumbnails.
     * @param array $thumbnails the list configuration.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated thumbnails.
     */
    public static function thumbnails($thumbnails, $htmlOptions = array())
    {
        if (is_array($thumbnails) && !empty($thumbnails))
        {
            /* todo: we may have to set an empty array() as default value */
            $htmlOptions = self::addClassName('thumbnails', $htmlOptions);
            $defaultSpan = self::popOption('span', $htmlOptions, 3);
            ob_start();
            echo CHtml::openTag('ul', $htmlOptions);
            foreach ($thumbnails as $thumbnailOptions)
            {
                $options = self::popOption('htmlOptions', $thumbnailOptions, array());
                if (!empty($options))
                    $thumbnailOptions = self::mergeOptions($options, $thumbnailOptions);
                $span = self::popOption('span', $thumbnailOptions, $defaultSpan);
                $caption = self::popOption('caption', $thumbnailOptions, '');
                $captionOptions = self::popOption('captionOptions', $thumbnailOptions, array());
                $captionOptions = self::addClassName('caption', $captionOptions);
                if (isset($thumbnailOptions['label']))
                {
                    $label = self::popOption('label', $thumbnailOptions);
                    $labelOptions = self::popOption('labelOptions', $thumbnailOptions, array());
                    $caption = self::tag('h3', $labelOptions, $label) . $caption;
                }
                $content = !empty($caption) ? self::tag('div', $captionOptions, $caption) : '';
                if (isset($thumbnailOptions['image']))
                {
                    $image = self::popOption('image', $thumbnailOptions);
                    $imageOptions = self::popOption('imageOptions', $thumbnailOptions, array());
                    $alt = self::popOption('alt', $imageOptions, '');
                    $content = CHtml::image($image, $alt, $imageOptions) . $content;
                }
                $url = self::popOption('url', $thumbnailOptions, false);
                echo $url !== false
                    ? self::thumbnailLink($span, $content, $url, $thumbnailOptions)
                    : self::thumbnail($span, $content, $thumbnailOptions);
            }
            echo '</ul>';
            return ob_get_clean();
        }
        return '';
    }

    /**
     * Generates a thumbnail.
     * @param integer $span the number of grid columns that the thumbnail spans over.
     * @param string $content the thumbnail content.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated thumbnail.
     */
    public static function thumbnail($span, $content, $htmlOptions = array())
    {
        $itemOptions = self::popOption('itemOptions', $htmlOptions, array());
        $itemOptions = self::addClassName('span' . $span, $itemOptions);
        $htmlOptions = self::addClassName('thumbnail', $htmlOptions);
        ob_start();
        echo CHtml::openTag('li', $itemOptions);
        echo CHtml::openTag('div', $htmlOptions);
        echo $content;
        echo '</div>';
        echo '</li>';
        return ob_get_clean();
    }

    /**
     * Generates a link thumbnail.
     * @param integer $span the number of grid columns that the thumbnail spans over.
     * @param string $content the thumbnail content.
     * @param mixed $url the url that the thumbnail links to.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated thumbnail.
     */
    public static function thumbnailLink($span, $content, $url, $htmlOptions = array())
    {
        $itemOptions = self::popOption('itemOptions', $htmlOptions, array());
        $itemOptions = self::addClassName('span' . $span, $itemOptions);
        $htmlOptions = self::addClassName('thumbnail', $htmlOptions);
        ob_start();
        echo CHtml::openTag('li', $itemOptions);
        echo CHtml::link($content, $url, $htmlOptions);
        echo '</li>';
        return ob_get_clean();
    }

    // Alerts
    // http://twitter.github.com/bootstrap/components.html#alerts
    // --------------------------------------------------

    /**
     * @param string $style the style of the alert.
     * @param string $message the message to display  within the alert box
     * @param array $htmlOptions additional HTML options. The following special options are recognized:
     * <ul>
     * <li>block: boolean, specifies whether to increase the padding on top and bottom of the alert wrapper.</li>
     * <li>fade: boolean, specifies whether to have fade in/out effect when showing/hiding the alert.
     * Defaults to `true`.</li>
     * <li>closeText: string, the text to use as closing button. If none specified, no close button will be shown.</li>
     * </ul>
     */
    public static function alert($style, $message, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('alert', $htmlOptions);
        if (isset($style) && in_array($style, self::$alertStyles))
            $htmlOptions = self::addClassName('alert-' . $style, $htmlOptions);
        if (self::popOption('in', $htmlOptions, true))
            $htmlOptions = self::addClassName('in', $htmlOptions);
        if (self::popOption('block', $htmlOptions, false))
            $htmlOptions = self::addClassName('alert-block', $htmlOptions);
        if (self::popOption('fade', $htmlOptions, true))
            $htmlOptions = self::addClassName('fade', $htmlOptions);
        $closeText = self::popOption('closeText', $htmlOptions, self::CLOSE_TEXT);
        $closeOptions = self::popOption('closeOptions', $htmlOptions, array());
        ob_start();
        echo CHtml::openTag('div', $htmlOptions);
        echo $closeText !== false ? self::closeLink($closeText, $closeOptions) : '';
        echo $message;
        echo '</div>';
        return ob_get_clean();
    }

    /**
     * Generates an alert block.
     * @param string $style the style of the alert.
     * @param string $message the message to display.
     * @param array $htmlOptions additional HTML options.
     * @return string the generated alert.
     */
    public static function blockAlert($style, $message, $htmlOptions = array())
    {
        $htmlOptions['block'] = true;
        return self::alert($style, $message, $htmlOptions);
    }

    // Progress bars
    // http://twitter.github.com/bootstrap/components.html#progress
    // --------------------------------------------------

    /**
     * Generates a progress bar.
     * @param integer $width the progress in percent.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated progress bar.
     */
    public static function progressBar($width = 0, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('progress', $htmlOptions);
        $style = self::popOption('style', $htmlOptions);
        if (isset($style) && in_array($style, self::$progressStyles))
            $htmlOptions = self::addClassName('progress-' . $style, $htmlOptions);
        if (self::popOption('striped', $htmlOptions, false))
        {
            $htmlOptions = self::addClassName('progress-striped', $htmlOptions);
            if (self::popOption('animated', $htmlOptions, false))
                $htmlOptions = self::addClassName('active', $htmlOptions);
        }
        $barOptions = self::popOption('barOptions', $htmlOptions, array());
        $content = self::popOption('content', $htmlOptions, '');
        $barOptions = self::defaultOption('content', $content, $barOptions);
        ob_start();
        echo CHtml::openTag('div', $htmlOptions);
        echo self::bar($width, $barOptions);
        echo '</div>';
        return ob_get_clean();
    }

    /**
     * Generates a striped progress bar.
     * @param integer $width the progress in percent.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated progress bar.
     */
    public static function stripedProgressBar($width = 0, $htmlOptions = array())
    {
        $htmlOptions['striped'] = true;
        return self::progressBar($width, $htmlOptions);
    }

    /**
     * Generates an animated progress bar.
     * @param integer $width the progress in percent.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated progress bar.
     */
    public static function animatedProgressBar($width = 0, $htmlOptions = array())
    {
        $htmlOptions['animated'] = true;
        return self::stripedProgressBar($width, $htmlOptions);
    }

    /**
     * Generates a stacked progress bar.
     * @param array $bars the bar configurations.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated progress bar.
     */
    public static function stackedProgressBar($bars, $htmlOptions = array())
    {
        if (is_array($bars) && !empty($bars))
        {
            $htmlOptions = self::addClassName('progress', $htmlOptions);
            ob_start();
            echo CHtml::openTag('div', $htmlOptions);
            foreach ($bars as $barOptions)
            {
                $options = self::popOption('htmlOptions', $barOptions, array());
                if (!empty($options))
                    $barOptions = self::mergeOptions($options, $barOptions);
                $width = self::popOption('width', $barOptions, 0);
                echo self::bar($width, $barOptions);
            }
            echo '</div>';
            return ob_get_clean();
        }
        return '';
    }

    /**
     * Generates a progress bar.
     * @param integer $width the progress in percent.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated bar.
     */
    public static function bar($width = 0, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('bar', $htmlOptions);
        $style = self::popOption('style', $htmlOptions);
        if (isset($style) && in_array($style, self::$progressStyles))
            $htmlOptions = self::addClassName('bar-' . $style, $htmlOptions);
        if ($width < 0)
            $width = 0;
        if ($width > 100)
            $width = 100;
        $htmlOptions = self::addStyles("width: {$width}%;", $htmlOptions);
        $content = self::popOption('content', $htmlOptions, '');
        return self::tag('div', $htmlOptions, $content);
    }

    // Media objects
    // http://twitter.github.com/bootstrap/components.html#media
    // --------------------------------------------------

    /**
     * Generates a list of media objects.
     * @param array $mediaObjects, media objects with the following configuration options:
     * <ul>
     *  <li> image: string, url of the image. </li>
     *  <li> heading: string, the heading of the content. </li>
     *  <li> content: string, content of the image. </li>
     *  <li> htmlOptions: array, additional HTML attributes. Factorial attributes see {@link mediaObject}.
     * </ul>
     * @return string generated list.
     */
    public static function mediaObjects($mediaObjects)
    {
        if ($mediaObjects !== null && is_array($mediaObjects))
        {
            ob_start();
            foreach ($mediaObjects as $mediaObjectOptions)
            {
                $image = self::getOption('image', $mediaObjectOptions, '#');
                $heading = self::getOption('heading', $mediaObjectOptions, '');
                $content = self::getOption('content', $mediaObjectOptions, '');
                $itemOptions = self::getOption('htmlOptions', $mediaObjectOptions, array());
                $itemOptions['items'] = self::popOption('items', $mediaObjectOptions, array());
                echo self::mediaObject($image, $heading, $content, $itemOptions);
            }
            return ob_get_clean();
        }
        return '';
    }

    /**
     * Generates a single media object. Factorial.
     * @param $image string the header of the media object
     * @param $title
     * @param $content
     * @param array $htmlOptions additional HTML attributes. The following special attributes are supported:
     * <ul>
     * 	<li> urlOptions: array(), additional HTML attributes for the url of the media-object header image. The following
     *       special attributes are supported:
     *      <ul>
     * 			<li> href: the url of the link </li>
     * 		</ul>
     *  </li>
     *  <li> imageOptions: array(), additional HTML attributes for the image of the media-object header. The following
     *  	 special attributes are supported:
     *       <ul>
     * 			<li> alt: the alt of the image </li>
     * 		 </ul>
     *  </li>
     *  <li> contentOptions: array(), additional HTML attributes for the media-body content. </li>
     *  <li> headingOptions: array(), additional HTML attributes for the heading content. </li>
     *  <li> items: array(), nested media object (childrens) with the following configuration options:
     *       <ul>
     *         <li> image: string, url of the image. </li>
     *         <li> heading: string, the heading of the content. </li>
     *         <li> content: string, content of the image. </li>
     *         <li> htmlOptions: array, additional HTML attributes. Factorial attributes see above.
     *      </ul>
     * </li>
     * </ul>
     * @return string
     */
    public static function mediaObject($imageUrl, $heading, $content, $htmlOptions = array())
    {
        // extract supported options - brainstorm for better approach --
        $urlOptions = self::popOption('urlOptions', $htmlOptions, array());
        $imageOptions = self::popOption('imageOptions', $htmlOptions, array());
        $contentOptions = self::popOption('contentOptions', $htmlOptions, array());
        $headingOptions = self::popOption('headingOptions', $htmlOptions, array());

        // add required classes
        $urlOptions = self::defaultOption('class', 'pull-left', $urlOptions);
        $imageOptions = self::addClassName('media-object', $imageOptions);
        $contentOptions = self::addClassName('media-body', $contentOptions);
        $headingOptions = self::addClassName('media-heading', $headingOptions);

        // do we have any children?
        $children= self::popOption('items', $htmlOptions);

        ob_start();

        echo CHtml::openTag('div', self::addClassName('media', $htmlOptions)); // media

        echo CHtml::link(
            CHtml::image($imageUrl, self::popOption('alt', $imageOptions, ''), $imageOptions),
            self::popOption('href', $urlOptions, '#'),
            $urlOptions);

        echo CHtml::openTag('div', $contentOptions); // media-body

        // render heading
        echo self::tag('h4', $headingOptions, $heading);

        // render content
        echo $content;

        // render children
        echo self::mediaObjects($children);

        echo '</div>'; // media-body
        echo '</div>'; // media

        return ob_get_clean();
    }

    // Misc
    // http://twitter.github.com/bootstrap/components.html#misc
    // --------------------------------------------------

    /**
     * Generates a well element.
     * @param string $content the well content.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated well.
     */
    public static function well($content, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('well', $htmlOptions);
        $size = self::popOption('size', $htmlOptions);
        if (isset($size) && in_array($size, self::$elementSizes))
            $htmlOptions = self::addClassName('well-' . $size, $htmlOptions);
        ob_start();
        echo self::tag('div', $htmlOptions, $content);
        return ob_get_clean();
    }

    /**
     * Generates a close link.
     * @param string $label the link label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function closeLink($label = self::CLOSE_TEXT, $htmlOptions = array())
    {
        $htmlOptions = self::defaultOption('href', '#', $htmlOptions);
        return self::closeIcon('a', $label, $htmlOptions);
    }

    /**
     * Generates a close button.
     * @param string $label the button label text.
     * @param array $htmlOptions the HTML options for the button.
     * @return string the generated button.
     */
    public static function closeButton($label = self::CLOSE_TEXT, $htmlOptions = array())
    {
        return self::closeIcon('button', $label, $htmlOptions);
    }

    /**
     * Generates a close element.
     * @param string $label the element label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated element.
     */
    public static function closeIcon($tag, $label, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('close', $htmlOptions);
        $htmlOptions = self::defaultOption('data-dismiss', 'alert', $htmlOptions);
        return self::tag($tag, $htmlOptions, $label);
    }

    /**
     * Generates a collapse link.
     * @param string $label the link label.
     * @param string $target the CSS selector.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function collapseLink($label, $target, $htmlOptions = array())
    {
        $htmlOptions['data-toggle'] = 'collapse';
        return CHtml::link($label, $target, $htmlOptions);
    }

    /**
     * Generates a collapse icon.
     * @param string $target the CSS selector for the target element.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated icon.
     */
    public static function collapseIcon($target, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('btn btn-navbar', $htmlOptions);
        $htmlOptions = self::defaultOptions($htmlOptions, array(
                'data-toggle' => 'collapse',
                'data-target' => $target,
            ));
        ob_start();
        echo CHtml::openTag('a', $htmlOptions);
        echo '<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>';
        echo '</a>';
        return ob_get_clean();
    }

    //
    // JAVASCRIPT
    // --------------------------------------------------

    // Tooltips and Popovers
    // http://twitter.github.com/bootstrap/javascript.html#tooltips
    // http://twitter.github.com/bootstrap/javascript.html#popovers
    // --------------------------------------------------

    /**
     * Generates a tooltip.
     * @param string $label the tooltip link label text.
     * @param mixed $url the link url.
     * @param string $content the tooltip content text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated tooltip.
     */
    public static function tooltip($label, $url, $content, $htmlOptions = array())
    {
        $htmlOptions['rel'] = 'tooltip';
        return self::tooltipPopover($label, $url, $content, $htmlOptions);
    }

    /**
     * Generates a popover.
     * @param string $label the popover link label text.
     * @param string $title the popover title text.
     * @param string $content the popover content text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated popover.
     */
    public static function popover($label, $title, $content, $htmlOptions = array())
    {
        $htmlOptions['rel'] = 'popover';
        $htmlOptions['data-content'] = $content;
        $htmlOptions['data-toggle'] = 'popover';
        return self::tooltipPopover($label, '#', $title, $htmlOptions);
    }

    /**
     * Generates a base tooltip.
     * @param string $label the tooltip link label text.
     * @param mixed $url the link url.
     * @param string $title the tooltip title text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated tooltip.
     */
    protected static function tooltipPopover($label, $url, $title, $htmlOptions)
    {
        $htmlOptions = self::defaultOption('title', $title, $htmlOptions);
        if (self::popOption('animation', $htmlOptions))
            $htmlOptions = self::defaultOption('data-animation', true, $htmlOptions);
        if (self::popOption('html', $htmlOptions))
            $htmlOptions = self::defaultOption('data-html', true, $htmlOptions);
        $placement = self::popOption('placement', $htmlOptions);
        if (isset($placement) && in_array($placement, self::$tooltipPlacements))
            $htmlOptions = self::defaultOption('data-placement', $placement, $htmlOptions);
        if (self::popOption('selector', $htmlOptions))
            $htmlOptions = self::defaultOption('data-selector', true, $htmlOptions);
        $trigger = self::popOption('trigger', $htmlOptions);
        if (isset($trigger) && in_array($trigger, self::$triggers))
            $htmlOptions = self::defaultOption('data-trigger', $trigger, $htmlOptions);
        if (($delay = self::popOption('delay', $htmlOptions)) !== null)
            $htmlOptions = self::defaultOption('data-delay', $delay, $htmlOptions);
        return CHtml::link($label, $url, $htmlOptions);
    }

    // Carousel
    // http://twitter.github.com/bootstrap/javascript.html#carousel
    // --------------------------------------------------

    /**
     * Generates an image carousel.
     * @param array $items the item configurations.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated carousel.
     */
    public static function carousel($items, $htmlOptions = array())
    {
        if (is_array($items) && !empty($items))
        {
            $id = self::getOption('id', $htmlOptions, self::getNextId());
            $htmlOptions = self::defaultOption('id', $id, $htmlOptions);
            $selector = '#' . $id;
            $htmlOptions = self::addClassName('carousel', $htmlOptions);
            if (self::popOption('slide', $htmlOptions, true))
                $htmlOptions = self::addClassName('slide', $htmlOptions);
            $interval = self::popOption('data-interval', $htmlOptions);
            if ($interval)
                $htmlOptions = self::defaultOption('data-interval', $interval, $htmlOptions);
            $pause = self::popOption('data-interval', $htmlOptions);
            if ($pause) // todo: add attribute validation if seen necessary.
                $htmlOptions = self::defaultOption('data-pause', $pause, $htmlOptions);
            $indicatorOptions = self::popOption('indicatorOptions', $htmlOptions, array());
            $innerOptions = self::popOption('innerOptions', $htmlOptions, array());
            $innerOptions = self::addClassName('carousel-inner', $innerOptions);
            $prevOptions = self::popOption('prevOptions', $htmlOptions, array());
            $prevLabel = self::popOption('label', $prevOptions, '&lsaquo;');
            $nextOptions = self::popOption('nextOptions', $htmlOptions, array());
            $nextLabel = self::popOption('label', $nextOptions, '&rsaquo;');
            ob_start();
            echo CHtml::openTag('div', $htmlOptions);
            echo self::carouselIndicators($selector, count($items), $indicatorOptions);
            echo CHtml::openTag('div', $innerOptions);
            foreach ($items as $i => $itemOptions)
            {
                $itemOptions = self::addClassName('item', $itemOptions);
                if ($i === 0) // first item should be active
                    $itemOptions = self::addClassName('active', $itemOptions);
                $image = self::popOption('image', $itemOptions, '');
                $label = self::popOption('label', $itemOptions);
                $caption = self::popOption('caption', $itemOptions);
                echo self::carouselItem($image, $label, $caption, $itemOptions);
            }
            echo '</div>';
            echo self::carouselPrevLink($prevLabel, $selector, $prevOptions);
            echo self::carouselNextLink($nextLabel, $selector, $nextOptions);
            echo '</div>';
            return ob_get_clean();
        }
        return '';
    }

    /**
     * Generates a carousel item.
     * @param string $image the image url.
     * @param string $label the item label text.
     * @param string $caption the item caption text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated item.
     */
    public static function carouselItem($image, $label, $caption, $htmlOptions = array())
    {
        $alt = self::popOption('alt', $htmlOptions, '');
        $imageOptions = self::popOption('imageOptions', $htmlOptions, array());
        $overlayOptions = self::popOption('overlayOptions', $htmlOptions, array());
        $overlayOptions = self::addClassName('carousel-caption', $overlayOptions);
        $labelOptions = self::popOption('labelOptions', $htmlOptions, array());
        $captionOptions = self::popOption('captionOptions', $htmlOptions, array());
        ob_start();
        echo CHtml::openTag('div', $htmlOptions);
        echo CHtml::image($image, $alt, $imageOptions);
        if (isset($label) || isset($caption))
        {
            echo CHtml::openTag('div', $overlayOptions);
            if ($label)
                echo self::tag('h4', $labelOptions, $label);
            if ($caption)
                echo self::tag('p', $captionOptions, $caption);
            echo '</div>';
        }
        echo '</div>';
        return ob_get_clean();
    }

    /**
     * Generates a previous link for the carousel.
     * @param string $label the link label text.
     * @param mixed $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function carouselPrevLink($label, $url, $htmlOptions = array())
    {
        $htmlOptions['data-slide'] = 'prev';
        $htmlOptions = self::addClassName('carousel-control left', $htmlOptions);
        return CHtml::link($label, $url, $htmlOptions);
    }

    /**
     * Generates a next link for the carousel.
     * @param string $label the link label text.
     * @param mixed $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function carouselNextLink($label, $url, $htmlOptions = array())
    {
        $htmlOptions['data-slide'] = 'next';
        $htmlOptions = self::addClassName('carousel-control right', $htmlOptions);
        return CHtml::link($label, $url, $htmlOptions);
    }

    /**
     * Generates an indicator for the carousel.
     * @param string $target the CSS selector for the target element.
     * @param integer $numSlides the number of slides.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated indicators.
     */
    public static function carouselIndicators($target, $numSlides, $htmlOptions = array())
    {
        $htmlOptions = self::addClassName('carousel-indicators', $htmlOptions);
        ob_start();
        echo CHtml::openTag('ol', $htmlOptions);
        for ($i = 0; $i < $numSlides; $i++)
        {
            $itemOptions = array('data-target' => $target, 'data-slide-to' => $i);
            if ($i === 0)
                $itemOptions['class'] = 'active';
            echo CHtml::tag('li', $itemOptions);
        }
        echo '</ol>';
        return ob_get_clean();
    }

    // UTILITIES
    // --------------------------------------------------

    /**
     * Appends new class names to the named index "class" at the `$htmlOptions` parameter.
     * @param mixed $className the class(es) to append to `$htmlOptions`
     * @param array $htmlOptions the HTML tag attributes to modify
     * @return array the options.
     */
    public static function addClassName($className, $htmlOptions)
    {
        if (is_array($className))
            $className = implode(' ', $className);
        $htmlOptions['class'] = isset($htmlOptions['class']) ? $htmlOptions['class'] . ' ' . $className : $className;
        return $htmlOptions;
    }

    /**
     * Appends a CSS style string to the given options.
     * @param string $styles the CSS style string.
     * @param array $htmlOptions the options.
     * @return array the options.
     */
    public static function addStyles($styles, $htmlOptions)
    {
        $htmlOptions['style'] = isset($htmlOptions['style']) ? $htmlOptions['style'] . ' ' . $styles : $styles;
        return $htmlOptions;
    }

    /**
     * Copies the option values from one option array to another.
     * @param array $names the option names to copy.
     * @param array $fromOptions the options to copy from.
     * @param array $options the options to copy to.
     * @return array the options.
     */
    public static function copyOptions($names, $fromOptions, $options)
    {
        if (is_array($fromOptions) && is_array($options))
        {
            foreach ($names as $key)
            {
                if (isset($fromOptions[$key]) && !isset($options[$key]))
                    $options[$key] = self::getOption($key, $fromOptions);
            }
        }
        return $options;
    }

    /**
     * Moves the option values from one option array to another.
     * @param array $names the option names to move.
     * @param array $fromOptions the options to move from.
     * @param array $options the options to move to.
     * @return array the options.
     */
    public static function moveOptions($names, $fromOptions, $options)
    {
        if (is_array($fromOptions) && is_array($options))
        {
            foreach ($names as $key)
            {
                if (isset($fromOptions[$key]) && !isset($options[$key]))
                    $options[$key] = self::popOption($key, $fromOptions);
            }
        }
        return $options;
    }

    /**
     * Sets multiple default options for the given options array.
     * @param array $options the options to set defaults for.
     * @param array $defaults the default options.
     * @return array the options with default values.
     */
    public static function defaultOptions($options, $defaults)
    {
        if (is_array($defaults) && is_array($options))
        {
            foreach ($defaults as $name => $value)
                $options = self::defaultOption($name, $value, $options);
        }
        return $options;
    }

    /**
     * Merges two options arrays.
     * @param array $a options to be merged to
     * @param array $b options to be merged from
     * @return array the merged options.
     */
    public static function mergeOptions($a, $b)
    {
        return CMap::mergeArray($a, $b); // yeah I know but we might want to change this to be something else later
    }

    /**
     * Returns an item from the given options or the default value if it's not set.
     * @param string $name the name of the item.
     * @param array $options the options to get from.
     * @param mixed $defaultValue the default value.
     * @return mixed the value.
     */
    public static function getOption($name, $options, $defaultValue = null)
    {
        return (is_array($options) && isset($options[$name])) ? $options[$name] : $defaultValue;
    }

    /**
     * Removes an item from the given options and returns the value.
     * @param string $name the name of the item.
     * @param array $options the options to remove the item from.
     * @param mixed $defaultValue the default value.
     * @return mixed the value.
     */
    public static function popOption($name, &$options, $defaultValue = null)
    {
        if (is_array($options))
        {
            $value = self::getOption($name, $options, $defaultValue);
            unset($options[$name]);
            return $value;
        }
        else
            return $defaultValue;
    }

    /**
     * Sets the default value for an item in the given options.
     * @param string $name the name of the item.
     * @param mixed $value the default value.
     * @param array $options the options.
     * @return mixed
     */
    public static function defaultOption($name, $value, $options)
    {
        if (is_array($options) && !isset($options[$name]))
            $options[$name] = $value;
        return $options;
    }

    /**
     * Removes the option values from the given options.
     * @param array $options the options to remove from.
     * @param array $names names to remove from the options.
     * @return array the options.
     */
    public static function removeOptions($options, $names)
    {
        return array_diff_key($options, array_flip($names));
    }

    /**
     * Returns the next free id.
     * @return string the id string.
     */
    public static function getNextId()
    {
        return 'tb' . self::$_counter++;
    }

    /**
     * Adds the grid span class to the given options is applicable.
     * @param array $htmlOptions the HTML attributes.
     * @return boolean whether the span class was added.
     */
    protected static function addSpanClass(&$htmlOptions)
    {
        $span = self::popOption('span', $htmlOptions);
        if (isset($span))
        {
            $htmlOptions = self::addClassName('span' . $span, $htmlOptions);
            return true;
        }
        else
            return false;
    }

    /**
     * Creates a form input of the given type.
     * @param string $type the input type.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @param array $data data for multiple select inputs.
     * @return string the input.
     * @throws CException if the input type is invalid.
     */
    protected static function createInput($type, $name, $value, $htmlOptions = array(), $data = array())
    {
        switch ($type)
        {
            case self::INPUT_URL: return self::urlField($name, $value, $htmlOptions);
            case self::INPUT_EMAIL: return self::emailField($name, $value, $htmlOptions);
            case self::INPUT_NUMBER: return self::numberField($name, $value, $htmlOptions);
            case self::INPUT_RANGE: return self::rangeField($name, $value, $htmlOptions);
            case self::INPUT_DATE: return self::dateField($name, $value, $htmlOptions);
            case self::INPUT_TEXT: return self::textField($name, $value, $htmlOptions);
            case self::INPUT_PASSWORD: return self::passwordField($name, $value, $htmlOptions);
            case self::INPUT_TEXTAREA: return self::textArea($name, $value, $htmlOptions);
            case self::INPUT_FILE: return self::fileField($name, $value, $htmlOptions);
            case self::INPUT_RADIOBUTTON: return self::radioButton($name, $value, $htmlOptions);
            case self::INPUT_CHECKBOX: return self::checkBox($name, $value, $htmlOptions);
            case self::INPUT_DROPDOWN: return self::dropDownList($name, $value, $htmlOptions, $data);
            case self::INPUT_LISTBOX: return self::listBox($name, $value, $htmlOptions, $data);
            case self::INPUT_CHECKBOXLIST: return self::checkBoxList($name, $value, $htmlOptions, $data);
            case self::INPUT_RADIOBUTTONLIST: return self::radioButtonList($name, $value, $htmlOptions, $data);
            case self::INPUT_UNEDITABLE: return self::uneditableField($value, $htmlOptions);
            case self::INPUT_SEARCH: return self::searchQuery($name, $value, $htmlOptions);
            default: throw new CException('Invalid input type "' . $type . '".');
        }
    }

    /**
     * Creates an active form input of the given type.
     * @param string $type the input type.
     * @param CModel $model the model instance.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @param array $data data for multiple select inputs.
     * @return string the input.
     * @throws CException if the input type is invalid.
     */
    protected static function createActiveInput($type, $model, $attribute, $htmlOptions = array(), $data = array())
    {
        switch ($type)
        {
            case self::INPUT_URL: return self::activeUrlField($model, $attribute, $htmlOptions);
            case self::INPUT_EMAIL: return self::activeEmailField($model, $attribute, $htmlOptions);
            case self::INPUT_NUMBER: return self::activeNumberField($model, $attribute, $htmlOptions);
            case self::INPUT_RANGE: return self::activeRangeField($model, $attribute, $htmlOptions);
            case self::INPUT_DATE: return self::activeDateField($model, $attribute, $htmlOptions);
            case self::INPUT_TEXT: return self::activeTextField($model, $attribute, $htmlOptions);
            case self::INPUT_PASSWORD: return self::activePasswordField($model, $attribute, $htmlOptions);
            case self::INPUT_TEXTAREA: return self::activeTextArea($model, $attribute, $htmlOptions);
            case self::INPUT_FILE: return self::activeFileField($model, $attribute, $htmlOptions);
            case self::INPUT_RADIOBUTTON: return self::activeRadioButton($model, $attribute, $htmlOptions);
            case self::INPUT_CHECKBOX: return self::activeCheckBox($model, $attribute, $htmlOptions);
            case self::INPUT_DROPDOWN: return self::activeDropDownList($model, $attribute, $htmlOptions, $data);
            case self::INPUT_LISTBOX: return self::activeListBox($model, $attribute, $htmlOptions, $data);
            case self::INPUT_CHECKBOXLIST: return self::activeCheckBoxList($model, $attribute, $htmlOptions, $data);
            case self::INPUT_RADIOBUTTONLIST: return self::activeRadioButtonList($model, $attribute, $htmlOptions, $data);
            case self::INPUT_UNEDITABLE: return null; // todo: implement
            case self::INPUT_SEARCH: return null; // todo: implement
            default: throw new CException('Invalid input type "' . $type . '".');
        }
    }
}
