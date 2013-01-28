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
	public static function button($label, $htmlOptions = array())
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
	 */
	public static function progressBar($type, $content = '', $percent = 0, $striped = false, $animated = false, $htmlOptions = array())
	{
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
		echo '</div>';
		return ob_get_clean();
	}

	/**
	 * Helper method to add class names to htmlOptions to avoid code redundancy
	 * @param $className
	 * @param $htmlOptions
	 * @return mixed
	 */
	protected static function addClassNames($className, $htmlOptions)
	{
		if (is_array($className))
			$className = implode(' ', $className);
		if (isset($htmlOptions['class']))
			$htmlOptions['class'] .= ' ' . $className;
		else
			$htmlOptions['class'] = $className;

		return $htmlOptions;
	}

}