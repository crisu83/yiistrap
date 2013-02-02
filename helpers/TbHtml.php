<?php
/**
 * TbHtml class file.
 * @author Antonio Ramirez <ramirez.cobos@gmail.com>
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

/**
 * Bootstrap HTML helper.
 */
class TbHtml extends CHtml
{
	// Element styles.
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
	const SIZE_LARGE = 'large';

	// Navigation menu types.
	const NAV_TABS = 'tabs';
	const NAV_PILLS = 'pills';
	const NAV_LIST = 'list';

	// Position types.
	const POSITION_TOP = 'top';
	const POSITION_BOTTOM = 'bottom';

	// Alignments.
	const ALIGN_CENTER = 'centered';
	const ALIGN_RIGHT = 'right';

	// Progress bar types.
	const PROGRESS_STRIPED = 'striped';
	const PROGRESS_ACTIVE = 'active';

	// Addon types.
	const ADDON_PREPEND = 'prepend';
	const ADDON_APPEND = 'append';


	// Default close text.
	const CLOSE_TEXT = '&times;';

	// Scope constants.
	static $sizes = array(self::SIZE_LARGE, self::SIZE_SMALL, self::SIZE_MINI);
	static $buttonStyles = array(
		self::STYLE_PRIMARY, self::STYLE_INFO, self::STYLE_SUCCESS, self::STYLE_WARNING,
		self::STYLE_DANGER, self::STYLE_INVERSE, self::STYLE_LINK,
	);
	static $labelBadgeStyles = array(self::STYLE_SUCCESS, self::STYLE_WARNING, self::STYLE_IMPORTANT,
		self::STYLE_INFO, self::STYLE_INVERSE,
	);
	static $navStyles = array(self::NAV_TABS, self::NAV_PILLS, self::NAV_LIST);
	static $navbarStyles = array(self::STYLE_INVERSE);
	static $positions = array(self::POSITION_TOP, self::POSITION_BOTTOM);
	static $alignments = array(self::ALIGN_CENTER, self::ALIGN_RIGHT);
	static $alertStyles = array(self::STYLE_SUCCESS, self::STYLE_INFO, self::STYLE_WARNING, self::STYLE_ERROR);
	static $progressStyles = array(self::STYLE_INFO, self::STYLE_SUCCESS, self::STYLE_WARNING, self::STYLE_DANGER);
	static $addons = array(self::ADDON_PREPEND, self::ADDON_APPEND);

	private static $_counter;

	//
	// Buttons
	// --------------------------------------------------

	/**
	 * Generates a button.
	 * @param string $label the button label text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated button.
	 * @see http://twitter.github.com/bootstrap/base-css.html#buttons
	 */
	public static function button($label, $htmlOptions = array())
	{
		return self::btn('button', $label, $htmlOptions);
	}

	/**
	 * Generates a link button.
	 * @param string $label the button label text.
	 * @param array $htmlOptions the HTML attributes for the button.
	 * @return string the generated button.
	 * @see http://twitter.github.com/bootstrap/base-css.html#buttons
	 */
	public static function linkButton($label, $htmlOptions = array())
	{
		return self::btn('a', $label, $htmlOptions);
	}

	/**
	 * Generates a button.
	 * @param string $tag the HTML tag.
	 * @param string $label the button label text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated button.
	 * @see http://twitter.github.com/bootstrap/base-css.html#buttons
	 */
	public static function btn($tag, $label, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('btn', $htmlOptions);

		$style = self::popOption('style', $htmlOptions);
		if (isset($style) && in_array($style, self::$buttonStyles))
			$htmlOptions = self::addClassName('btn-' . $style, $htmlOptions);

		$size = self::popOption('size', $htmlOptions);
		if (isset($size) && in_array($size, self::$sizes))
			$htmlOptions = self::addClassName('btn-' . $size, $htmlOptions);

		if (self::popOption('block', $htmlOptions, false))
			$htmlOptions = self::addClassName('btn-block', $htmlOptions);

		if (self::popOption('disabled', $htmlOptions, false))
			$htmlOptions = self::addClassName('disabled', $htmlOptions);

		$icon = self::popOption('icon', $htmlOptions);
		if (isset($icon))
			$label = self::icon($icon) . $label;

		return self::tag($tag, $htmlOptions, $label);
	}

	//
	// Images
	// --------------------------------------------------

	/**
	 * Generates an image tag with rounded corners.
	 * @param string $src the image URL.
	 * @param string $alt the alternative text display.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated image tag.
	 * @see http://twitter.github.com/bootstrap/base-css.html#images
	 */
	public static function imageRounded($src, $alt = '', $htmlOptions = array())
	{
		return parent::image($src, $alt, self::addClassName('img-rounded', $htmlOptions));
	}

	/**
	 * Generates an image tag with circle.
	 * ***Important*** `.img-rounded` and `.img-circle` do not work in IE7-8 due to lack of border-radius support.
	 * @param string $src the image URL.
	 * @param string $alt the alternative text display.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated image tag.
	 * @see http://twitter.github.com/bootstrap/base-css.html#images
	 */
	public static function imageCircle($src, $alt = '', $htmlOptions = array())
	{
		return parent::image($src, $alt, self::addClassName('img-circle', $htmlOptions));
	}

	/**
	 * Generates an image tag within polaroid frame.
	 * @param string $src the image URL.
	 * @param string $alt the alternative text display.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated image tag.
	 * @see http://twitter.github.com/bootstrap/base-css.html#images
	 */
	public static function imagePolaroid($src, $alt = '', $htmlOptions = array())
	{
		return parent::image($src, $alt, self::addClassName('img-polaroid', $htmlOptions));
	}

	//
	// Button groups
	// --------------------------------------------------

	/**
	 * Generates a button group.
	 * @param array $buttons the button configurations.
	 * @param array $htmlOptions additional HTML options. The following special options are recognized:
	 * todo: write the options
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
			echo parent::openTag('div', $htmlOptions);
			foreach ($buttons as $buttonOptions)
			{
				$options = self::popOption('htmlOptions', $buttonOptions, array());
				if (!empty($options))
					$buttonOptions = self::mergeOptions($options, $buttonOptions);
				$buttonLabel = self::popOption('label', $buttonOptions, '');
				$buttonOptions = self::copyOptions(array('style', 'size', 'disabled'), $parentOptions, $buttonOptions);
				echo self::button($buttonLabel, $buttonOptions);
			}
			echo '</div>';
			return ob_get_clean();
		}
		return '';
	}

	/**
	 * Generates a button toolbar.
	 * @param array $groups the button group configurations.
	 * @param array $htmlOptions additional HTML options. The following special options are recognized:
	 * todo: write the options
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
			echo parent::openTag('div', $htmlOptions);
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

	//
	// Button dropdowns
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

		ob_start();
		echo parent::openTag('div', $groupOptions);
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

	//
	// Navs
	// --------------------------------------------------

	/**
	 * Generates a menu.
	 * @param array $items the menu items.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated menu.
	 */
	public static function menu($items, $htmlOptions = array())
	{
		ob_start();
		echo parent::openTag('ul', $htmlOptions);
		foreach ($items as $itemOptions)
		{
			if (is_string($itemOptions))
				echo self::menuDivider();
			else
			{
				$options = self::popOption('itemOptions', $itemOptions, array());
				if (!empty($options))
					$itemOptions = self::mergeOptions($options, $itemOptions);

				// todo: I'm not quite happy with the logic below but it will have to do for now.
				$label = self::popOption('label', $itemOptions, '');
				if (self::popOption('active', $itemOptions, false))
					$itemOptions = self::addClassName('active', $itemOptions);
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
		echo parent::openTag('li', $htmlOptions);
		echo parent::link($label, $url, $linkOptions);
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
		echo parent::openTag('li', $htmlOptions);
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
		return parent::tag('li', $htmlOptions, $label);
	}

	/**
	 * Generates a menu divider.
	 * @param string $className the divider CSS class.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated menu item.
	 */
	public static function menuDivider($className = 'divider', $htmlOptions = array())
	{
		$htmlOptions = self::addClassName($className, $htmlOptions);
		return parent::tag('li', $htmlOptions);
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

		if (in_array($style, self::$navStyles))
			$htmlOptions = self::addClassName('nav-' . $style, $htmlOptions);

		if (self::popOption('stacked', $htmlOptions, false))
			$htmlOptions = self::addClassName('nav-stacked', $htmlOptions);

		ob_start();
		echo self::menu($items, $htmlOptions);
		return ob_get_clean();
	}

	//
	// Dropdowns
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
		ob_start();
		echo self::menu($items, $htmlOptions);
		return ob_get_clean();
	}

	/**
	 * Generates a dropdown toggle link.
	 * @param string $label the link label text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated link.
	 * http://twitter.github.com/bootstrap/components.html#buttonDropdowns
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
	 * http://twitter.github.com/bootstrap/components.html#buttonDropdowns
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
	 * http://twitter.github.com/bootstrap/components.html#dropdowns
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
	 * http://twitter.github.com/bootstrap/components.html#dropdowns
	 */
	public static function dropdownToggleMenuLink($label, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('dropdown-toggle', $htmlOptions);
		$htmlOptions = self::defaultOption('data-toggle', 'dropdown', $htmlOptions);
		$label .= ' <b class="caret"></b>';
		return parent::link($label, '#', $htmlOptions);
	}

	//
	// Breadcrumbs
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
		echo parent::openTag('ul', $htmlOptions);
		foreach ($links as $label => $url)
		{
			if (is_string($label))
			{
				echo parent::openTag('li');
				echo parent::link($label, parent::normalizeUrl($url));
				echo parent::tag('span', array('class' => 'divider'), $divider);
				echo '</li>';
			} else
				echo parent::tag('li', array('class' => 'active'), $url);
		}
		echo '</ul>';
		return ob_get_clean();
	}

	//
	// Alerts
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
	 * @see http://twitter.github.com/bootstrap/components.html#alerts
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
		echo parent::openTag('div', $htmlOptions);
		echo $closeText !== false ? self::closeLink($closeText, $closeOptions) : '';
		echo $message;
		echo '</div>';
		return ob_get_clean();
	}

	//
	// Pagination
	// --------------------------------------------------

	/**
	 * Generates a pagination.
	 * @param array $buttons the pagination buttons.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated pagination.
	 * @see http://twitter.github.com/bootstrap/components.html#pagination
	 */
	public static function pagination($buttons, $htmlOptions = array())
	{
		if (is_array($buttons) && !empty($buttons))
		{
			$htmlOptions = self::addClassName('pagination', $htmlOptions);

			$size = self::popOption('size', $htmlOptions);
			if (isset($size) && in_array($size, self::$sizes))
				$htmlOptions = self::addClassName('pagination-' . $size, $htmlOptions);

			$align = self::popOption('align', $htmlOptions);
			if (isset($align) && in_array($align, self::$alignments))
				$htmlOptions = self::addClassName('pagination-' . $align, $htmlOptions);

			$listOptions = self::popOption('listOptions', $htmlOptions, array());

			ob_start();
			echo parent::openTag('div', $htmlOptions) . PHP_EOL;
			echo parent::openTag('ul', $listOptions) . PHP_EOL;
			foreach ($buttons as $itemOptions)
			{
				$options = self::popOption('htmlOptions', $itemOptions, array());
				if (!empty($options))
					$itemOptions = self::mergeOptions($options, $itemOptions);
				$label = self::popOption('label', $itemOptions, '');
				$url = self::popOption('url', $itemOptions, false);
				echo self::paginationButton($label, $url, $itemOptions) . PHP_EOL;
			}
			echo '</ul>' . PHP_EOL . '</div>' . PHP_EOL;
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
	public static function paginationButton($label, $url, $htmlOptions = array())
	{
		$active = self::popOption('active', $htmlOptions);
		$disabled = self::popOption('disabled', $htmlOptions);

		if ($active)
			$htmlOptions = self::addClassName('active', $htmlOptions);
		else if ($disabled)
			$htmlOptions = self::addClassName('disabled', $htmlOptions);

		$linkOptions = self::popOption('linkOptions', $itemOptions, array());

		ob_start();
		echo parent::openTag('li', $htmlOptions) . PHP_EOL;
		echo parent::link($label, $url, $linkOptions) . PHP_EOL;
		echo '</li>' . PHP_EOL;
		return ob_get_clean();
	}

	/**
	 * Generates a pager.
	 * @param array $buttons the pager buttons.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated pager.
	 * @see http://twitter.github.com/bootstrap/components.html#pagination
	 */
	public static function pager($buttons, $htmlOptions = array())
	{
		if (is_array($buttons) && !empty($buttons))
		{
			$htmlOptions = self::addClassName('pager', $htmlOptions);
			ob_start();
			echo parent::openTag('ul', $htmlOptions) . PHP_EOL;
			foreach ($buttons as $itemOptions)
			{
				$options = self::popOption('htmlOptions', $itemOptions, array());
				if (!empty($options))
					$itemOptions = self::mergeOptions($options, $itemOptions);
				$label = self::popOption('label', $itemOptions, '');
				$url = self::popOption('url', $itemOptions, false);
				echo self::pagerButton($label, $url, $itemOptions) . PHP_EOL;
			}
			echo '</ul>' . PHP_EOL;
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
	public static function pagerButton($label, $url, $htmlOptions = array())
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
		echo parent::openTag('li', $htmlOptions) . PHP_EOL;
		echo parent::link($label, $url, $linkOptions) . PHP_EOL;
		echo '</li>' . PHP_EOL;
		return ob_get_clean();
	}

	//
	// Labels and badges
	// --------------------------------------------------

	/**
	 * Generates a label span.
	 * @param string $label the label text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated span.
	 * @see http://twitter.github.com/bootstrap/components.html#labels-badges
	 */
	public static function labelSpan($label, $htmlOptions = array())
	{
		return self::labelBadgeSpan('label', $label, $htmlOptions);
	}

	/**
	 * Generates a badge span.
	 * @param string $label the badge text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated span.
	 * @see http://twitter.github.com/bootstrap/components.html#labels-badges
	 *
	 */
	public static function badgeSpan($label, $htmlOptions = array())
	{
		return self::labelBadgeSpan('badge', $label, $htmlOptions);
	}

	/**
	 * Generates a label or badge span.
	 * @param string $type the span type.
	 * @param string $label the label text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated span.
	 * @see http://twitter.github.com/bootstrap/components.html#labels-badges
	 */
	public static function labelBadgeSpan($type, $label, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName($type, $htmlOptions);
		$style = self::popOption('style', $htmlOptions);
		if (isset($style) && in_array($style, self::$labelBadgeStyles))
			$htmlOptions = self::addClassName($type . '-' . $style, $htmlOptions);
		return self::tag('span', $htmlOptions, $label);
	}

	//
	// Typography
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
		echo parent::tag('div', $htmlOptions);
		echo parent::tag('h1', $headingOptions, $heading);
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
		$htmlOptions = self::addClassName('page-header', $htmlOptions);
		$headerOptions = self::popOption('headerOptions', $htmlOptions, array());
		$subtextOptions = self::popOption('subtextOptions', $htmlOptions, array());
		ob_start();
		echo parent::openTag('div', $htmlOptions);
		echo parent::openTag('h1', $headerOptions);
		echo parent::encode($heading) . ' ' . parent::tag('small', $subtextOptions, $subtext);
		echo '</h1></div>';
		return ob_get_clean();
	}

	//
	// Progress bars
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

		$barOptions = self::getOption('barOptions', $htmlOptions, array());
		$barOptions = self::defaultOption('content', self::getOption('content', $htmlOptions, ''), $barOptions);

		ob_start();
		echo parent::openTag('div', $htmlOptions);
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
		$htmlOptions = self::defaultOption('striped', true, $htmlOptions);
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
		$htmlOptions = self::defaultOption('animated', true, $htmlOptions);
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
			echo parent::openTag('div', $htmlOptions);
			foreach ($bars as $barOptions)
			{
				$options = self::popOption('htmlOptions', $barOptions, array());
				if (!empty($options))
					$barOptions = self::mergeOptions($options, $barOptions);
				$style = self::popOption('style', $barOptions);
				if (isset($style))
					$barOptions = self::defaultOption('style', $style, $barOptions);
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
		return parent::tag('div', $htmlOptions, $content);
	}

	//
	// Misc
	// --------------------------------------------------

	/**
	 * Generates a well element.
	 * @param string $content the well content.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated well.
	 * @see http://twitter.github.com/bootstrap/components.html#misc
	 */
	public static function well($content, $htmlOptions = array())
	{
		$size = self::popOption('size', $htmlOptions);
		if (isset($size) && in_array($size, self::$sizes))
			$htmlOptions = self::addClassName('well-' . $size, $htmlOptions);
		ob_start();
		parent::tag('div', $htmlOptions, $content);
		return ob_get_clean();
	}

	/**
	 * Generates a close link.
	 * @param string $label the link label text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated link.
	 * @see http://twitter.github.com/bootstrap/components.html#misc
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
	 * @see http://twitter.github.com/bootstrap/components.html#misc
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
	 * @see http://twitter.github.com/bootstrap/components.html#misc
	 */
	public static function closeIcon($tag = 'a', $label, $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('close', $htmlOptions);
		$htmlOptions = self::defaultOption('data-dismiss', 'alert', $htmlOptions);
		return parent::tag($tag, $htmlOptions, $label);
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
		echo parent::openTag('a', $htmlOptions);
		echo '<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>';
		echo '</a>';
		return ob_get_clean();
	}

	/**
	 * Generates a Glyph icon.
	 * @param string $icon the icon type.
	 * @param array $htmlOptions additional HTML attributes.
	 * @param string $tag the icon tag.
	 * @return string the generated icon.
	 * @see http://twitter.github.com/bootstrap/base-css.html#icons
	 */
	public static function icon($icon, $htmlOptions = array(), $tag = 'i')
	{
		if (is_string($icon))
		{
			if (strpos($icon, 'icon') === false)
				$icon = 'icon-' . implode(' icon-', explode(' ', $icon));
			$htmlOptions = self::addClassName($icon, $htmlOptions);
			return parent::openTag($tag, $htmlOptions) . parent::closeTag($tag); // tag won't work in this case
		}
		return '';
	}

	//
	// Forms
	// --------------------------------------------------

	// todo: move the form sections up to its right place.

	/**
	 * Generates a search form.
	 * @param mixed $action the form action URL.
	 * @param string $method form method (e.g. post, get).
	 * @param array $htmlOptions additional HTML options. The following special options are recognized:
	 * <ul>
	 * <li>appendButton: boolean, whether to append or prepend the search button.</li>
	 * <li>inputOptions: array, additional HTML options of the text input field. `type` will always default to `text`.</li>
	 * <li>buttonOptions: array, additional HTML options of the button. It contains special options for the button:
	 * <ul>
	 * <li>label: string, the button label</li>
	 * </ul>
	 * </li>
	 * </ul>
	 * @return string the generated form.
	 * @see http://twitter.github.com/bootstrap/base-css.html#forms
	 */
	public static function searchForm($action, $method = 'post', $htmlOptions = array())
	{
		$htmlOptions = self::addClassName('form-search', $htmlOptions);
		$inputOptions = self::popOption('inputOptions', $htmlOptions, array());
		$inputOptions = self::mergeOptions(array('type' => 'text', 'placeholder' => 'Search'), $inputOptions);
		$inputOptions = self::addClassName('search-query', $inputOptions);

		$buttonOptions = self::popOption('buttonOptions', $htmlOptions, array());
		$buttonLabel = self::popOption('label', $buttonOptions, self::icon('search'));

		ob_start();
		echo self::beginForm($action, $method, $htmlOptions);

		$addon = self::popOption('addon', $htmlOptions);
		if (isset($addon) && in_array($addon, self::$addons))
			$inputOptions[$addon] = self::button($buttonLabel, $buttonOptions);

		echo self::textField(
			self::popOption('name', $inputOptions, 'search'),
			self::popOption('value', $inputOptions, ''),
			$inputOptions
		);

		echo parent::endForm();
		return ob_get_clean();
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

		return  self::inputField('text', $name, $value, $htmlOptions);
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
		$label = self::getOption('label', $htmlOptions);
		$labelOptions = isset($htmlOptions['labelOptions']) ? $htmlOptions['labelOptions'] : array();
		$checkBox = parent::checkBox($name, $checked, self::removeOptions($htmlOptions, array('label', 'labelOptions')));

		if ($label)
		{
			$labelOptions = self::addClassName('checkbox', $labelOptions);

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
	 * attributes are also recognized (see {@link clientChange} {@link getOption} and {@link tag} for more details.)
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
		$label = self::getOption('label', $htmlOptions);
		$labelOptions = isset($htmlOptions['labelOptions']) ? $htmlOptions['labelOptions'] : array();
		$radioButton = parent::radioButton($name, $checked, self::removeOptions($htmlOptions, array('label', 'labelOptions')));

		if ($label)
		{
			$labelOptions = self::addClassName('radio', $labelOptions);

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
	 * @param array $htmlOptions additional HTML options. The options will be applied to
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

		return empty($container)
			? implode($separator, $items)
			: self::tag($container, array('id' => $baseID), implode($separator, $items));
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
	 * @param array $htmlOptions additional HTML options. The options will be applied to
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

		$labelOptions = self::popOption('labelOptions', $htmlOptions, array());

		$items = array();
		$baseID = self::getIdByName($name);
		$id = 0;
		$checkAll = true;

		foreach ($data as $value => $label)
		{
			$checked = !is_array($select) && !strcmp($value, $select) || is_array($select) && in_array($value, $select);
			$checkAll = $checkAll && $checked;
			$htmlOptions['label'] = $label;
			$htmlOptions['labelOptions'] = self::addClassName('inline', $labelOptions);
			$htmlOptions['value'] = $value;
			$htmlOptions['id'] = $baseID . '_' . $id++;
			$items[] = self::checkBox($name, $checked, $htmlOptions);
		}

		// todo: refactor to declarative approach.
		if (isset($checkAllLabel))
		{
			$htmlOptions['label'] = $checkAllLabel;
			$htmlOptions['labelOptions'] = self::addClassName('inline', $labelOptions);
			$htmlOptions['value'] = 1;
			$htmlOptions['id'] = $id = $baseID . '_all';
			$option = self::checkBox($id, $checkAll, $htmlOptions);
			$item = $option;
			// todo: $checkAllLast might not be defined here.
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
			/* @var $cs CClientScript */
			$cs = Yii::app()->getClientScript();
			$cs->registerCoreScript('jquery');
			$cs->registerScript($id, $js);
		}

		return empty($container)
			? implode($separator, $items)
			: self::tag($container, array('id' => $baseID), implode($separator, $items));

	}

	/**
	 * Returns the add-on classes if any from `$htmlOptions`.
	 * @param array $htmlOptions the HTML tag options
	 * @return array|string the resulting classes
	 */
	public static function getAddOnClasses($htmlOptions)
	{
		$classes = array();
		if (self::getOption('append', $htmlOptions))
			$classes[] = 'input-append';
		if (self::getOption('prepend', $htmlOptions))
			$classes[] = 'input-prepend';
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
		if (self::getOption($type, $htmlOptions))
		{
			$addOn = strpos($htmlOptions[$type], 'button')
				? $htmlOptions[$type]
				: CHtml::tag('span', array('class' => 'add-on'), $htmlOptions[$type]);
		}
		return $addOn;
	}

	//
	// Utilities
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
		} else
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
	 * Displays the first validation error for a model attribute.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute name
	 * @param array $htmlOptions additional HTML attributes to be rendered in the container tag.
	 * @return string the error display. Empty if no errors are found.
	 * @see CModel::getErrors
	 * @see errorMessageCss
	 * @see $errorContainerTag
	 *
	 */
	public static function error($model, $attribute, $htmlOptions = array())
	{
		self::resolveName($model, $attribute); // turn [a][b]attr into attr
		$error = $model->getError($attribute);
		return $error != ''
			? self::tag('span', self::defaultOption('class', self::$errorMessageCss, $htmlOptions), $error)
			: '';
	}

	/**
	 * Displays a summary of validation errors for one or several models.
	 * @param mixed $model the models whose input errors are to be displayed. This can be either
	 * a single model or an array of models.
	 * @param string $header a piece of HTML code that appears in front of the errors
	 * @param string $footer a piece of HTML code that appears at the end of the errors
	 * @param array $htmlOptions additional HTML attributes to be rendered in the container div tag.
	 * A special option named 'firstError' is recognized, which when set true, will
	 * make the error summary to show only the first error message of each attribute.
	 * If this is not set or is false, all error messages will be displayed.
	 * This option has been available since version 1.1.3.
	 * @return string the error summary. Empty if no errors are found.
	 * @see CModel::getErrors
	 * @see errorSummaryCss
	 */
	public static function errorSummary($model, $header = null, $footer = null, $htmlOptions = array())
	{
		$htmlOptions = TbHtml::addClassName('alert alert-block alert-error', $htmlOptions);

		return parent::errorSummary($model, $header, $footer, $htmlOptions);
	}

	/**
	 * Generates an input HTML tag.
	 * This method generates an input HTML tag based on the given input name and value.
	 * @param string $type the input type (e.g. 'text', 'radio')
	 * @param string $name the input name
	 * @param string $value the input value
	 * @param array $htmlOptions additional HTML attributes for the HTML tag (see {@link tag}). The following special
	 * attributes are supported:
	 * <ul>
	 * 	<li>append: string, append addon to the input types: text, password, date</li>
	 *  <li>prepend: string, prepend addon to the input types: text, password, date</li>
	 * </ul>
	 * @return string the generated input tag
	 */
	protected static function inputField($type, $name, $value, $htmlOptions)
	{
		$inputOptions = self::removeOptions($htmlOptions, array('append', 'prepend'));
		$addOnClasses = self::getAddOnClasses($htmlOptions);

		ob_start();
		if (!empty($addOnClasses))
			echo '<div class="' . $addOnClasses . '">';

		echo self::getPrepend($htmlOptions);
		echo parent::inputField($type, $name, $value, $inputOptions);
		echo self::getAppend($htmlOptions);

		if (!empty($addOnClasses))
			echo '</div>';

		return ob_get_clean();
	}
}