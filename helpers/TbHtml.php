<?php
/**
 * Bootstrap HTML helper.
 */
class TbHtml extends CHtml {
	// Yii button types
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

	// Bootstrap types
	const STYLE_PRIMARY = 'primary';
	const STYLE_INFO = 'info';
	const STYLE_SUCCESS = 'success';
	const STYLE_WARNING  = 'warning';
	const STYLE_ERROR = 'error';
	const STYLE_DANGER = 'danger';
	const STYLE_IMPORTANT  = 'important';
	const STYLE_INVERSE = 'inverse';
	const STYLE_LINK = 'link';

	// Bootstrap sizes
	const SIZE_MINI = 'mini';
	const SIZE_SMALL = 'small';
	const SIZE_LARGE = 'large';

	public static function button($label, $htmlOptions = array()) {
		$classes = array('btn');

		// Button styles
		if (isset($htmlOptions['style'])) {
			$buttonStyles = array(self::STYLE_PRIMARY, self::STYLE_INFO, self::STYLE_SUCCESS, self::STYLE_WARNING,
					self::STYLE_DANGER, self::STYLE_INVERSE, self::STYLE_LINK);
			if (in_array($htmlOptions['style'], $buttonStyles))
				$classes[] = 'btn-' . $htmlOptions['style'];
			unset($htmlOptions['style']);
		}

		// Button sizes
		if (isset($htmlOptions['size'])) {
			$buttonSizes = array(self::SIZE_LARGE, self::SIZE_SMALL, self::SIZE_MINI);
			if (in_array($htmlOptions['size'], $buttonSizes))
				$classes[] = 'btn-' . $htmlOptions['size'];
			unset($htmlOptions['size']);
		}

		// Block level buttons
		if (isset($htmlOptions['block']) && $htmlOptions['block'] === true) {
			$classes[] = 'btn-block';
			unset($htmlOptions['block']);
		}

		// Disabled state
		if (isset($htmlOptions['disabled']) && $htmlOptions['disabled'] === true) {
			$classes[] = 'disabled';
			unset($htmlOptions['disabled']);
		}

		// Icons
		if (isset($htmlOptions['icon'])) {
			$icon = $htmlOptions['icon'];
			unset($htmlOptions['icon']);
			if (strpos($icon, 'icon') === false)
				$icon = 'icon-' . implode(' icon-', explode(' ', $icon));
			$label = '<i class="' . $icon . '"></i>' . $label;
		}

		$classes = implode(' ', $classes);
		$htmlOptions['class'] = isset($htmlOptions['class']) ? $htmlOptions['class'] . ' ' . $classes : $classes;

		return self::tag('button', $htmlOptions, $label);
	}

	public static function buttonDropdown($label, $items, $htmlOptions = array()) {
		// todo: implement
	}

	public static function labelSpan($label, $htmlOptions = array()) {
		$classes = array('label');

		// Label styles
		if (isset($htmlOptions['style'])) {
			$labelTypes = array(self::STYLE_SUCCESS, self::STYLE_WARNING, self::STYLE_IMPORTANT, self::STYLE_INFO, self::STYLE_INVERSE);
			if (in_array($htmlOptions['style'], $labelTypes))
				$classes[] = 'label-' . $htmlOptions['style'];
			unset($htmlOptions['style']);
		}

		$classes = implode(' ', $classes);
		$htmlOptions['class'] = isset($htmlOptions['class']) ? $htmlOptions['class'] . ' ' . $classes : $classes;
		
		return self::tag('span', $htmlOptions, $label);
	}
}