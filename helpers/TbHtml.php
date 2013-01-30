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
	 * Renders a button group
	 * @param $items
	 * @param array $htmlOptions additional HTML options. The following special options are recognized:
	 *  TODO: write the options
	 * @return string
	 */
	public static function buttonGroup($items, $htmlOptions = array())
	{
		if(is_array($items) && !empty($items))
		{
			$classes = array('btn-group');
			$vertical = self::getArrayValue('vertical', $htmlOptions, false);
			if($vertical)
				$classes[] = 'btn-group-vertical';

			$htmlOptions = self::cleanUpOptions($htmlOptions, array('vertical'));

			ob_start();
			echo parent::openTag('div', self::addClassNames($classes, $htmlOptions));
			foreach($items as $item)
			{
				$buttonLabel = self::getArrayValue('label', $item, 'button');
				$buttonOptions = self::cleanUpOptions($item, array('label'));
				echo self::button($buttonLabel, $buttonOptions);
			}
			echo parent::closeTag('div');
			return ob_get_clean();
		}
		return '';
	}

	/**
	 * @param $groups
	 *  TODO: explain the configuration array
	 * @param array $htmlOptions additional HTML options. The following special options are recognized:
	 *  TODO: write the options
	 * @return string
	 */
	public static function multipleButtonGroup($groups, $htmlOptions = array())
	{
		if(is_array($groups) && !empty($groups))
		{
			ob_start();
			echo parent::openTag('div', self::addClassNames('btn-toolbar', $htmlOptions));
			foreach($groups as $group)
			{
				$groupOptions = self::getArrayValue('options', $group, array());
				$items = self::getArrayValue('items', $group, array());
				if(empty($items))
				{
					continue;
				}
				echo self::buttonGroup($items, $groupOptions);
			}
			echo parent::closeTag('div');
			return ob_get_clean();
		}
		return '';
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
	 * Renders a search form.
	 * @param string $action
	 * @param string $method
	 * @param array $htmlOptions additional HTML options. The following special options are recognized:
	 * <ul>
	 * <li>appendButton: boolean, whether to append or prepend the search button.</li>
	 * <li>inputOptions: array, additional HTML options of the text input field. `type` will always default to `text`.</li>
	 * <li>buttonOptions: array, additional HTML options of the button. It contains special options for the button:
	 *      <ul>
	 *      <li>label: string, the button label</li>
	 *      </ul>
	 * </li>
	 * </ul>
	 * @return string
	 * @see http://twitter.github.com/bootstrap/base-css.html#forms
	 */
	public static function searchForm($action = '', $method = 'post', $htmlOptions = array())
	{
		// Append or prepend button
		$appendButton = self::getArrayValue('appendButton', $htmlOptions, true);
		// Input options
		$inputOptions = self::getArrayValue('inputOptions', $htmlOptions, array());
		// Button options
		$buttonOptions = self::getArrayValue('buttonOptions', $htmlOptions, array());
		// Button label
		$buttonLabel = self::getArrayValue('label', $buttonOptions, 'button');

		// Clean up options
		$htmlOptions = self::cleanUpOptions($htmlOptions, array('appendButton', 'inputOptions', 'buttonOptions'));
		$buttonOptions = self::cleanUpOptions($buttonOptions, array('label'));

		// Render
		ob_start();
		echo self::beginForm($action, $method, self::addClassNames('form-search', $htmlOptions));
		echo self::openTag('div', self::addClassNames(($appendButton ? 'input-append' : 'input-prepend'), $inputOptions));
		if ($appendButton === false)
		{
			echo self::button($buttonLabel, $buttonOptions);
		}
		echo self::tag('input', CMap::mergeArray(self::addClassNames('search-query', $inputOptions), array('type' => 'text')));
		if ($appendButton)
		{
			echo self::button($buttonLabel, $buttonOptions);
		}
		echo self::closeTag('div');
		echo parent::endForm();
		return ob_get_clean();
	}

	/**
	 * @param string $type the type of progress bar
	 * @param array $htmlOptions additional HTML options. The following special options are recognized:
	 * <ul>
	 * <li>content: string, the contents of the progress bar (if any).</li>
	 * <li>percent: integer, the initial percentage of the progress bar. Defaults to `0`.</li>
	 * <li>striped: boolean, set to true to use a gradient to create a striped effect. Not available for IE7-8.</li>
	 * <li>animated: boolean, set to true to animate the stripes. Not available in all versions of IE.</li>
	 * </ul>
	 * @see http://twitter.github.com/bootstrap/components.html#progress
	 */
	public static function progressBar($type, $htmlOptions = array())
	{
		// valid types
		// todo: Think about $validTypes scope
		$validTypes = array(self::STYLE_INFO, self::STYLE_SUCCESS, self::STYLE_WARNING, self::STYLE_DANGER);

		$content = self::getArrayValue('content', $htmlOptions);
		$percent = self::getArrayValue('percent', $htmlOptions, 0);
		$striped = self::getArrayValue('striped', $htmlOptions);
		$animated = self::getArrayValue('animated', $htmlOptions);

		$htmlOptions = self::cleanUpOptions($htmlOptions, array('content', 'percent', 'striped', 'animated'));

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
	 * Displays a stacked progress bar.
	 * @param array $items the bars to display within the progress bar. The following is the configuration of a bar:
	 * <ul>
	 * <li>type: string, the Type of progress bar. Valid types are STYLE_INFO, STYLE_SUCCESS, STYLE_WARNING and STYLE_DANGER.</li>
	 * <li>percent: integer, the initial percentage of the progress bar. Defaults to `0`.</li>
	 * <li>content: string, the contents of the progress bar (if any).</li>
	 * <li>barOptions: array, additional HTML options of the bar.</li>
	 * </ul>
	 * @param array $htmlOptions additional HTML options. The following special options are recognized:
	 * <ul>
	 * <li>striped: boolean, set to true to use a gradient to create a striped effect. Not available for IE7-8.</li>
	 * <li>animated: boolean, set to true to animate the stripes. Not available in all versions of IE.</li>
	 * </ul>
	 * @see http://twitter.github.com/bootstrap/components.html#progress
	 */
	public static function stackedProgressBar($items, $htmlOptions = array())
	{
		if (is_array($items))
		{
			$validTypes = array(self::STYLE_INFO, self::STYLE_SUCCESS, self::STYLE_WARNING, self::STYLE_DANGER);

			$striped = self::getArrayValue('striped', $htmlOptions);
			$animated = self::getArrayValue('animated', $htmlOptions);

			$htmlOptions = self::cleanUpOptions($htmlOptions, array('striped', 'animated'));

			$classes = array('progress');

			if ($striped)
				$classes[] = 'progress-striped';
			if ($animated)
				$classes[] = 'active';

			ob_start();
			echo parent::openTag('div', self::addClassNames($classes, $htmlOptions));

			foreach ($items as $item)
			{
				$classes = array('bar');

				$type = self::getArrayValue('type', $item);
				$percent = self::getArrayValue('percent', $item, 0);
				$content = self::getArrayvalue('content', $item);
				$barOptions = self::getArrayValue('barOptions', @$item['barOptions'], array());

				if (in_array($type, $validTypes))
					$classes[] = 'bar-' . $type;

				if ($percent < 0)
					$percent = 0;
				else if ($percent > 100)
					$percent = 100;

				$barOptions['style'] = 'width:' . $percent . '%;';

				echo parent::tag('div', self::addClassNames($classes, $barOptions), $content);
			}

			echo parent::closeTag('div');
			return ob_get_clean();
		}
		return '';
	}

	/**
	 * @param string $type the type of alert
	 * @param string $message the message to display  within the alert box
	 * @param array $htmlOptions addtional HTML options. The following special options are recognized:
	 * <ul>
	 * <li>block: boolean, specifies whether to increase the padding on top and bottom of the alert wrapper.</li>
	 * <li>fade: boolean, specifies whether to have fade in/out effect when showing/hiding the alert.
	 * Defaults to `true`.</li>
	 * <li>closeText: string, the text to use as closing button. If none specified, no close button will be shown.</li>
	 * </ul>
	 * @see http://twitter.github.com/bootstrap/components.html#alerts
	 */
	public static function alert($type, $message, $htmlOptions = array())
	{
		// valid Types
		// todo: Think about its scope
		$validTypes = array(self::STYLE_SUCCESS, self::STYLE_INFO, self::STYLE_WARNING, self::STYLE_ERROR, self::STYLE_DANGER);

		$closeText = self::getArrayValue('closeText', $htmlOptions);
		$block = self::getArrayValue('block', $htmlOptions);
		$fade = self::getArrayValue('fade', $htmlOptions, true);

		$htmlOptions = self::cleanUpOptions($htmlOptions, array('closeText', 'block', 'fade'));


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
		$labelOptions = isset($htmlOptions['labelOptions']) ? $htmlOptions['labelOptions'] : array();
		$checkBox = parent::checkBox($name, $checked, self::cleanUpOptions($htmlOptions, array('label', 'labelOptions')));

		if ($label)
		{
			$labelOptions = self::addClassNames('checkbox', $labelOptions);

			ob_start();
			echo '<label ' . parent::renderAttributes($labelOptions) . '>';
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
	 * The following special options are recognized:
	 * <ul>
	 * <li>labelOptions: array, specifies the additional HTML attributes to be rendered
	 * for every label tag in the list.</li>
	 * </ul>
	 * @return string the generated radio button
	 * @see clientChange
	 * @see inputField
	 */
	public static function radioButton($name, $checked = false, $htmlOptions = array())
	{
		$label = self::getArrayValue('label', $htmlOptions);
		$labelOptions = isset($htmlOptions['labelOptions']) ? $htmlOptions['labelOptions'] : array();
		$radioButton = parent::radioButton($name, $checked, self::cleanUpOptions($htmlOptions, array('label', 'labelOptions')));

		if ($label)
		{
			$labelOptions = self::addClassNames('radio', $labelOptions);

			ob_start();
			echo '<label ' . parent::renderAttributes($labelOptions) . '>';
			echo $radioButton;
			echo $label;
			echo '</label>';
			return ob_get_clean();
		}

		return $radioButton;
	}

	/**
	 * Generates an inline radio button list.
	 * A radio button list is like a {@link checkBoxList check box list}, except that
	 * it only allows single selection.
	 * @param string $name name of the radio button list. You can use this name to retrieve
	 * the selected value(s) once the form is submitted.
	 * @param string $select selection of the radio buttons.
	 * @param array $data value-label pairs used to generate the radio button list.
	 * Note, the values will be automatically HTML-encoded, while the labels will not.
	 * @param array $htmlOptions addtional HTML options. The options will be applied to
	 * each radio button input. The following special options are recognized:
	 * <ul>
	 * <li>labelOptions: array, specifies the additional HTML attributes to be rendered
	 * for every label tag in the list.</li>
	 * <li>container: string, specifies the radio buttons enclosing tag. Defaults to 'span'.
	 * If the value is an empty string, no enclosing tag will be generated</li>
	 * </ul>
	 * @return string the generated radio button list
	 */
	public static function inlineRadioButtonList($name, $select, $data, $htmlOptions = array())
	{
		$separator = " ";
		$container = isset($htmlOptions['container']) ? $htmlOptions['container'] : null;
		unset($htmlOptions['separator'], $htmlOptions['container']);

		$items = array();
		$baseID = self::getIdByName($name);
		$id = 0;
		foreach ($data as $value => $label)
		{
			$checked = !strcmp($value, $select);
			$htmlOptions['label'] = $label;
			$htmlOptions['labelOptions'] = array('class' => 'inline');
			$htmlOptions['value'] = $value;
			$htmlOptions['id'] = $baseID . '_' . $id++;
			$items[] = self::radioButton($name, $checked, $htmlOptions);
		}

		return empty($container) ?
			implode($separator, $items)
			:
			self::tag($container, array('id' => $baseID), implode($separator, $items));
	}

	/**
	 * Generates a inline check box list.
	 * A check box list allows multiple selection, like {@link listBox}.
	 * As a result, the corresponding POST value is an array.
	 * @param string $name name of the check box list. You can use this name to retrieve
	 * the selected value(s) once the form is submitted.
	 * @param mixed $select selection of the check boxes. This can be either a string
	 * for single selection or an array for multiple selections.
	 * @param array $data value-label pairs used to generate the check box list.
	 * Note, the values will be automatically HTML-encoded, while the labels will not.
	 * @param array $htmlOptions addtional HTML options. The options will be applied to
	 * each checkbox input. The following special options are recognized:
	 * <ul>
	 * <li>checkAll: string, specifies the label for the "check all" checkbox.
	 * If this option is specified, a 'check all' checkbox will be displayed. Clicking on
	 * this checkbox will cause all checkboxes checked or unchecked.</li>
	 * <li>checkAllLast: boolean, specifies whether the 'check all' checkbox should be
	 * displayed at the end of the checkbox list. If this option is not set (default)
	 * or is false, the 'check all' checkbox will be displayed at the beginning of
	 * the checkbox list.</li>
	 * <li>labelOptions: array, specifies the additional HTML attributes to be rendered
	 * for every label tag in the list.</li>
	 * <li>container: string, specifies the checkboxes enclosing tag. Defaults to 'span'.
	 * If the value is an empty string, no enclosing tag will be generated</li>
	 * </ul>
	 * @return string the generated check box list
	 */
	public static function inlineCheckBoxList($name, $select, $data, $htmlOptions = array())
	{
		$separator = " ";
		$container = isset($htmlOptions['container']) ? $htmlOptions['container'] : null;
		unset($htmlOptions['separator'], $htmlOptions['container']);

		if (substr($name, -2) !== '[]')
			$name .= '[]';

		if (isset($htmlOptions['checkAll']))
		{
			$checkAllLabel = $htmlOptions['checkAll'];
			$checkAllLast = isset($htmlOptions['checkAllLast']) && $htmlOptions['checkAllLast'];
		}
		unset($htmlOptions['checkAll'], $htmlOptions['checkAllLast']);

		$labelOptions = isset($htmlOptions['labelOptions']) ? $htmlOptions['labelOptions'] : array();
		unset($htmlOptions['labelOptions']);

		$items = array();
		$baseID = self::getIdByName($name);
		$id = 0;
		$checkAll = true;

		foreach ($data as $value => $label)
		{
			$checked = !is_array($select) && !strcmp($value, $select) || is_array($select) && in_array($value, $select);
			$checkAll = $checkAll && $checked;
			$htmlOptions['label'] = $label;
			$htmlOptions['labelOptions'] = array('class' => 'inline');
			$htmlOptions['value'] = $value;
			$htmlOptions['id'] = $baseID . '_' . $id++;
			$items[] = self::checkBox($name, $checked, $htmlOptions);
		}

		// todo: refactor to declarative approach
		if (isset($checkAllLabel))
		{
			$htmlOptions['label'] = $checkAllLabel;
			$htmlOptions['labelOptions'] = array('class' => 'inline');
			$htmlOptions['value'] = 1;
			$htmlOptions['id'] = $id = $baseID . '_all';
			$option = self::checkBox($id, $checkAll, $htmlOptions);
			$item = $option;
			if ($checkAllLast)
				$items[] = $item;
			else
				array_unshift($items, $item);
			$name = strtr($name, array('[' => '\\[', ']' => '\\]'));
			$js = <<<EOD
$('#$id').click(function() {
	$("input[name='$name']").prop('checked', this.checked);
});
$("input[name='$name']").click(function() {
	$('#$id').prop('checked', !$("input[name='$name']:not(:checked)").length);
});
$('#$id').prop('checked', !$("input[name='$name']:not(:checked)").length);
EOD;
			$cs = Yii::app()->getClientScript();
			$cs->registerCoreScript('jquery');
			$cs->registerScript($id, $js);
		}

		return empty($container) ?
			implode($separator, $items)
			:
			self::tag($container, array('id' => $baseID), implode($separator, $items));

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
	public static function cleanUpOptions($htmlOptions, $keysToRemove)
	{
		return array_diff_key($htmlOptions, array_flip($keysToRemove));
	}

	/**
	 * Checks for the existence of a key and returns its value or null otherwise. Done, in order to avoid code
	 * redundancy.
	 *
	 * @param string $key
	 * @param array $htmlOptions
	 * @param mixed $default value to return in case no value was found
	 * @return mixed
	 */
	public static function getArrayValue($key, $htmlOptions, $default = null)
	{
		return (is_array($htmlOptions) && isset($htmlOptions[$key])) ? $htmlOptions[$key] : $default;
	}
}