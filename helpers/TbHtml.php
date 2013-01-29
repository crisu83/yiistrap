<?php
/**
 * Bootstrap HTML helper.
 */
class TbHtml extends CHtml
{

	// Button types
	const BUTTON_LINK = 'link';
	const BUTTON_BUTTON = 'button';
	const BUTTON_SUBMIT = 'submit';
	const BUTTON_SUBMITLINK = 'submitLink';
	const BUTTON_RESET = 'reset';
	const BUTTON_AJAXLINK = 'ajaxLink';
	const BUTTON_AJAXBUTTON = 'ajaxButton';
	const BUTTON_AJAXSUBMIT = 'ajaxSubmit';
	const BUTTON_INPUTBUTTON = 'inputButton';
	const BUTTON_INPUTSUBMIT = 'inputSubmit';

	// Bootstrap styles
	const STYLE_PRIMARY = 'primary';
	const STYLE_INFO = 'info';
	const STYLE_SUCCESS = 'success';
	const STYLE_WARNING = 'warning';
	const STYLE_ERROR = 'error';
	const STYLE_DANGER = 'danger';
	const STYLE_IMPORTANT = 'important';
	const STYLE_INVERSE = 'inverse';
	const STYLE_LINK = 'link';

	// Bootstrap sizes
	const SIZE_MINI = 'mini';
	const SIZE_SMALL = 'small';
	const SIZE_LARGE = 'large';

	// Valid button styles
	static $buttonStyles = array(
		self::STYLE_PRIMARY,
		self::STYLE_INFO,
		self::STYLE_SUCCESS,
		self::STYLE_WARNING,
		self::STYLE_DANGER,
		self::STYLE_INVERSE,
		self::STYLE_LINK,
	);

	// Valid button sizes
	static $buttonSizes = array(
		self::SIZE_LARGE,
		self::SIZE_SMALL,
		self::SIZE_MINI,
	);

	// Valid label and badge styles
	static $labelBadgeStyles = array(
		self::STYLE_SUCCESS,
		self::STYLE_WARNING,
		self::STYLE_IMPORTANT,
		self::STYLE_INFO,
		self::STYLE_INVERSE,
	);

	/**
	 * @param $label
	 * @param array $htmlOptions
	 * @return string
	 */
	public static function button($label = 'button', $htmlOptions = array())
	{
		$classes = array('btn');

		// Button styles
		if (isset($htmlOptions['style']))
		{
			if (in_array($htmlOptions['style'], self::$buttonStyles))
				$classes[] = 'btn-' . $htmlOptions['style'];
			unset($htmlOptions['style']);
		}

		// Button sizes
		if (isset($htmlOptions['size']))
		{
			if (in_array($htmlOptions['size'], self::$buttonSizes))
				$classes[] = 'btn-' . $htmlOptions['size'];
			unset($htmlOptions['size']);
		}

		// Block level buttons
		if (isset($htmlOptions['block']) && $htmlOptions['block'] === true)
		{
			$classes[] = 'btn-block';
			unset($htmlOptions['block']);
		}

		// Disabled state
		if (isset($htmlOptions['disabled']) && $htmlOptions['disabled'] === true)
		{
			$classes[] = 'disabled';
			unset($htmlOptions['disabled']);
		}

		// Icons
		if (isset($htmlOptions['icon']))
		{
			$icon = $htmlOptions['icon'];
			unset($htmlOptions['icon']);
			if (strpos($icon, 'icon') === false)
				$icon = 'icon-' . implode(' icon-', explode(' ', $icon));
			$label = '<i class="' . $icon . '"></i>' . $label;
		}

		return self::tag('button', self::addClassNames($classes, $htmlOptions), $label);
	}

	/**
	 * @param $label
	 * @param $items
	 * @param array $htmlOptions
	 * @return string
	 */
	public static function buttonDropdown($label, $items, $htmlOptions = array())
	{
		// todo: implement
	}

	/**
	 * @param $label
	 * @param array $htmlOptions
	 * @return string
	 */
	public static function labelSpan($label, $htmlOptions = array())
	{
		return self::labelBadgeSpan('label', $label, $htmlOptions);
	}

	/**
	 * @param $label
	 * @param array $htmlOptions
	 * @return string
	 */
	public static function badgeSpan($label, $htmlOptions = array())
	{
		return self::labelBadgeSpan('badge', $label, $htmlOptions);
	}

	/**
	 * @param $type
	 * @param $label
	 * @param array $htmlOptions
	 * @return string
	 */
	public static function labelBadgeSpan($type, $label, $htmlOptions = array())
	{
		$classes = array($type);

		// Label styles
		if (isset($htmlOptions['style']))
		{
			if (in_array($htmlOptions['style'], self::$labelBadgeStyles))
				$classes[] = $type . '-' . $htmlOptions['style'];
			unset($htmlOptions['style']);
		}

		return self::tag('span', self::addClassNames($classes, $htmlOptions), $label);
	}

	/**
	 * @param $type
	 * @param string $content
	 * @param int $percent
	 * @param bool $striped
	 * @param bool $animated
	 * @param array $htmlOptions
	 * @see http://twitter.github.com/bootstrap/components.html#progress
	 */
	public static function progressBar($type, $content = '', $percent = 0, $striped = false, $animated = false, $htmlOptions = array())
	{
		// valid types
		// todo: Think about $validTypes scope
		$validTypes = array(self::STYLE_INFO, self::STYLE_SUCCESS, self::STYLE_WARNING, self::STYLE_DANGER);

		$classes = array('progress');
		if (in_array($type, $validTypes))
			$classes[] = 'progress-' . $type;
		if ($striped)
			$classes[] = 'progress-striped';
		if ($animated)
			$classes[] = 'active';
		if ($percent < 0)
			$percent = 0;
		else if ($percent > 100)
			$percent = 100;

		ob_start();
		echo parent::openTag('div', self::addClassNames($classes, $htmlOptions));
		echo '<div class="bar" style="width:' . $percent . '%;">' . $content . '</div>';
		echo parent::closeTag('div');
		return ob_get_clean();
	}

	/**
	 * @param string $type the type of alert
	 * @param string $message the message to display  within the alert box
	 * @param string $closeText the text that will act as the closing button
	 * @param bool $block for longer messages, increase the padding on the top and bottom of the alert wrapper
	 * @param bool $fade the effect to show/hide the alert box. To hide remove the class *in*, to show just add it again.
	 * @param array $htmlOptions
	 * @see http://twitter.github.com/bootstrap/components.html#alerts
	 */
	public static function alert($type, $message, $closeText = "&times", $block = true, $fade = true, $htmlOptions = array())
	{
		// valid Types
		// todo: Think about its scope
		$validTypes = array(self::STYLE_SUCCESS, self::STYLE_INFO, self::STYLE_WARNING, self::STYLE_ERROR, self::STYLE_DANGER);

		// add default classes
		// todo: should we allow the user whether to make it visible or not on display?
		$classes = array('alert in');
		if (in_array($type, $validTypes))
			$classes[] = 'alert-' . $type;
		// block
		if ($block)
			$classes[] = 'alert-block';
		// fade
		if ($fade)
			$classes[] = 'fade';

		ob_start();
		echo parent::openTag('div', self::addClassNames($classes, $htmlOptions));
		echo !empty($closeText) ? self::link($closeText, '#', array('class' => 'close', 'data-dismiss' => 'alert')) : '';
		echo $message;
		echo parent::closeTag('div');
		return ob_get_clean();

	}

	/**
	 * Generates an image tag with rounded corners.
	 * @param string $src the image URL
	 * @param string $alt the alternative text display
	 * @param array $htmlOptions additional HTML attributes (see {@link tag}).
	 * @return string the generated image tag
	 * @see http://twitter.github.com/bootstrap/base-css.html#images
	 */
	public static function imageRounded($src, $alt = '', $htmlOptions = array())
	{
		return parent::image($src, $alt, self::addClassNames('img-rounded', $htmlOptions));
	}

	/**
	 * Generates an image tag with circle.
	 * ***Important*** `.img-rounded` and `.img-circle` do not work in IE7-8 due to lack of border-radius support.
	 * @param string $src the image URL
	 * @param string $alt the alternative text display
	 * @param array $htmlOptions additional HTML attributes (see {@link tag}).
	 * @return string the generated image tag
	 * @see http://twitter.github.com/bootstrap/base-css.html#images
	 */
	public static function imageCircle($src, $alt = '', $htmlOptions = array())
	{
		return parent::image($src, $alt, self::addClassNames('img-circle', $htmlOptions));
	}

	/**
	 * Generates an image tag within polaroid frame.
	 * @param string $src the image URL
	 * @param string $alt the alternative text display
	 * @param array $htmlOptions additional HTML attributes (see {@link tag}).
	 * @return string the generated image tag
	 * @see http://twitter.github.com/bootstrap/base-css.html#images
	 */
	public static function imagePolaroid($src, $alt = '', $htmlOptions = array())
	{
		return parent::image($src, $alt, self::addClassNames('img-polaroid', $htmlOptions));
	}

	/**
	 * Generates an icon glyph.
	 * @param $icon the glyph class
	 * @param string $tag
	 * @return string
	 * @see TbIcon
	 * @see http://twitter.github.com/bootstrap/base-css.html#icons
	 */
	public static function iconGlyph($icon, $tag = 'i')
	{
		return parent::tag($tag, array('class' => $icon));
	}

	/**
	 * Generates a text field input.
	 * @param string $name the input name
	 * @param string $value the input value
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link getAddOnClasses} {@link getAppend} {@link getPrepend} {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated input field
	 * @see clientChange
	 * @see inputField
	 */
	public static function textField($name, $value = '', $htmlOptions = array())
	{
		parent::clientChange('change', $htmlOptions);
		$addOnClasses = self::getAddOnClasses($htmlOptions);

		ob_start();
		if (!empty($addOnClasses))
			echo '<div class="' . $addOnClasses . '">';

		echo  self::getPrepend($htmlOptions);
		echo  self::inputField('text', $name, $value, self::cleanUpOptions($htmlOptions, array('append', 'prepend')));
		echo  self::getAppend($htmlOptions);

		if (!empty($addOnClasses))
			echo '</div>';
		return ob_get_clean();
	}

	/**
	 * Generates a check box.
	 * @param string $name the input name
	 * @param boolean $checked whether the check box is checked
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * Since version 1.1.2, a special option named 'uncheckValue' is available that can be used to specify
	 * the value returned when the checkbox is not checked. When set, a hidden field is rendered so that
	 * when the checkbox is not checked, we can still obtain the posted uncheck value.
	 * If 'uncheckValue' is not set or set to NULL, the hidden field will not be rendered.
	 * @return string the generated check box
	 * @see clientChange
	 * @see inputField
	 */
	public static function checkBox($name, $checked = false, $htmlOptions = array())
	{
		$label = self::getArrayValue('label', $htmlOptions);
		$checkBox = parent::checkBox($name, $checked, self::cleanUpOptions($htmlOptions, array('label')));

		if ($label)
		{
			ob_start();
			echo '<label class="checkbox">';
			echo $checkBox;
			echo $label;
			echo '</label>';
			return ob_get_clean();
		}

		return $checkBox;
	}

	/**
	 * Generates a radio button.
	 * @param string $name the input name
	 * @param boolean $checked whether the radio button is checked
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} {@link getArrayValue} and {@link tag} for more details.)
	 * Since version 1.1.2, a special option named 'uncheckValue' is available that can be used to specify
	 * the value returned when the radio button is not checked. When set, a hidden field is rendered so that
	 * when the radio button is not checked, we can still obtain the posted uncheck value.
	 * If 'uncheckValue' is not set or set to NULL, the hidden field will not be rendered.
	 * @return string the generated radio button
	 * @see clientChange
	 * @see inputField
	 */
	public static function radioButton($name,$checked=false,$htmlOptions=array())
	{
		$label = self::getArrayValue('label', $htmlOptions);
		$radioButton = parent::radioButton($name, $checked, self::cleanUpOptions($htmlOptions, array('label')));

		if ($label)
		{
			ob_start();
			echo '<label class="radio">';
			echo $radioButton;
			echo $label;
			echo '</label>';
			return ob_get_clean();
		}

		return $radioButton;
	}

	/**
	 * Returns the add-on classes if any from `$htmlOptions`.
	 * @param array $htmlOptions the HTML tag options
	 * @return array|string the resulting classes
	 */
	public static function getAddOnClasses($htmlOptions)
	{
		$classes = array();
		if (self::getArrayValue('append', $htmlOptions))
		{
			$classes[] = 'input-append';
		}
		if (self::getArrayValue('prepend', $htmlOptions))
		{
			$classes[] = 'input-prepend';
		}
		return !empty($classes) ? implode(' ', $classes) : $classes;
	}

	/**
	 * Extracts append add-on from `$htmlOptions` if any.
	 * @param array $htmlOptions
	 */
	public static function getAppend($htmlOptions)
	{
		return self::getAddOn('append', $htmlOptions);
	}

	/**
	 * Extracts prepend add-on from `$htmlOptions` if any.
	 * @param array $htmlOptions
	 */
	public static function getPrepend($htmlOptions)
	{
		return self::getAddOn('prepend', $htmlOptions);
	}

	/**
	 * Extracs append add-ons from `$htmlOptions` if any.
	 * @param array $htmlOptions
	 */
	public static function getAddOn($type, $htmlOptions)
	{
		$addOn = '';
		if (self::getArrayValue($type, $htmlOptions))
		{
			$addOn = strpos($htmlOptions[$type], self::BUTTON_BUTTON) ?
				$htmlOptions[$type]
				:
				CHtml::tag('span', array('class' => 'add-on'), $htmlOptions[$type]);
		}
		return $addOn;
	}

	/**
	 * Appends new class names to the named index "class" at the `$htmlOptions` parameter.
	 * @param mixed $className the class(es) to append to `$htmlOptions`
	 * @param array $htmlOptions the HTML tag attributes to modify
	 * @return mixed
	 */
	public static function addClassNames($className, $htmlOptions)
	{
		if (is_array($className))
			$className = implode(' ', $className);
		if (isset($htmlOptions['class']))
			$htmlOptions['class'] .= ' ' . $className;
		else
			$htmlOptions['class'] = $className;

		return $htmlOptions;
	}

	/**
	 * Cleans up `$htmlOptions` from unwanted settings.
	 * @param array $htmlOptions the options to clean
	 * @param array $keysToRemove the keys to remove from the options
	 * @return array
	 */
	protected static function cleanUpOptions($htmlOptions, $keysToRemove)
	{
		return array_diff_key($htmlOptions, array_flip($keysToRemove));
	}

	/**
	 * Checks for the existence of a key and returns its value or null otherwise. Done, in order to avoid code
	 * redundancy.
	 *
	 * @param string $key
	 * @param array $htmlOptions
	 * @return mixed
	 */
	protected static function getArrayValue($key, $htmlOptions)
	{
		return (is_array($htmlOptions) && isset($htmlOptions[$key]) && !empty($htmlOptions[$key])) ? $htmlOptions[$key] : null;
	}
}