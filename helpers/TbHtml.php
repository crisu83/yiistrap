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

	// Tooltip placements.
	const PLACEMENT_TOP = 'top';
	const PLACEMENT_BOTTOM = 'bottom';
	const PLACEMENT_LEFT = 'left';
	const PLACEMENT_RIGHT = 'right';

	// Tooltip triggers.
	const TRIGGER_CLICK = 'click';
	const TRIGGER_HOVER = 'hover';
	const TRIGGER_FOCUS = 'focus';
	const TRIGGER_MANUAL = 'manual';

	// Addon types.
	const ADDON_PREPEND = 'prepend';
	const ADDON_APPEND = 'append';

	// Default close text.
	const CLOSE_TEXT = '&times;';

	// Help types.
	const HELP_TYPE_INLINE = 'inline';
	const HELP_TYPE_BLOCK = 'block';

	// form types
	const FORM_TYPE_INLINE = 'inline';
	const FORM_TYPE_HORIZONTAL = 'horizontal';
	const FORM_TYPE_VERTICAL = 'vertical';

	// Scope constants.
	static $sizes = array(self::SIZE_LARGE, self::SIZE_SMALL, self::SIZE_MINI);
	static $textStyles = array(self::STYLE_ERROR, self::STYLE_INFO, self::STYLE_SUCCESS, self::STYLE_WARNING);
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
	static $placements = array(self::PLACEMENT_TOP, self::PLACEMENT_BOTTOM, self::PLACEMENT_LEFT, self::PLACEMENT_RIGHT);
	static $triggers = array(self::TRIGGER_CLICK, self::TRIGGER_HOVER, self::TRIGGER_FOCUS, self::TRIGGER_MANUAL);
	static $addons = array(self::ADDON_PREPEND, self::ADDON_APPEND);

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
		return parent::tag('p', $htmlOptions, $text);
	}

	/**
	 * Generates small text.
	 * @param string $text the text to style.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated text.
	 */
	public static function small($text, $htmlOptions = array())
	{
		return parent::tag('small', $htmlOptions, $text);
	}

	/**
	 * Generates bold text.
	 * @param string $text the text to style.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated text.
	 */
	public static function b($text, $htmlOptions = array())
	{
		return parent::tag('strong', $htmlOptions, $text);
	}

	/**
	 * Generates italic text.
	 * @param string $text the text to style.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated text.
	 */
	public static function i($text, $htmlOptions = array())
	{
		return parent::tag('em', $htmlOptions, $text);
	}

	/**
	 * Generates an emphasized text block.
	 * @param string$text the text to emphasize.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated text block.
	 */
	public static function em($text, $htmlOptions = array())
	{
		$style = self::popOption('style', $htmlOptions);
		if (self::popOption('muted', $htmlOptions, false))
			$htmlOptions = self::addClassName('muted', $htmlOptions);
		else if ($style && in_array($style, self::$textStyles))
			$htmlOptions = self::addClassName('text-' . $style, $htmlOptions);
		return parent::tag('p', $htmlOptions, $text);
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
		if (self::popOption('smaller', $htmlOptions, false))
			$htmlOptions = self::addClassName('initialism', $htmlOptions);
		$htmlOptions = self::defaultOption('title', $word, $htmlOptions);
		return parent::tag('abbr', $htmlOptions, $text);
	}

	/**
	 * Generates an address block.
	 * @param string $quote the address text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated block.
	 */
	public static function address($text, $htmlOptions = array())
	{
		return parent::tag('address', $htmlOptions, $text);
	}

	/**
	 * Generates a quote.
	 * @param string $text the quoted text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated quote.
	 */
	public static function quote($text, $htmlOptions = array())
	{
		return parent::tag('blockquote', $htmlOptions, $text);
	}

	// Code
	// http://twitter.github.com/bootstrap/base-css.html#code
	// --------------------------------------------------

	/**
	 * Generates a code snippet.
	 * @param string $code the code.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated snippet.
	 */
	public static function code($code, $htmlOptions = array())
	{
		return parent::tag('code', $htmlOptions, $code);
	}

	/**
	 * Generates a code block.
	 * @param string $code the code.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated block.
	 */
	public static function codeBlock($code, $htmlOptions = array())
	{
		return parent::tag('pre', $htmlOptions, $code);
	}

	// Tables
	// http://twitter.github.com/bootstrap/base-css.html#forms
	// --------------------------------------------------

	// todo: create table methods here.

	// Forms
	// http://twitter.github.com/bootstrap/base-css.html#tables
	// --------------------------------------------------

	// todo: move form methods here.

	// Buttons
	// http://twitter.github.com/bootstrap/base-css.html#buttons
	// --------------------------------------------------

	/**
	 * Generates a button.
	 * @param string $label the button label text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated button.
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
		return parent::image($src, $alt, self::addClassName('img-rounded', $htmlOptions));
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
		return parent::image($src, $alt, self::addClassName('img-circle', $htmlOptions));
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
		return parent::image($src, $alt, self::addClassName('img-polaroid', $htmlOptions));
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
			return parent::openTag($tagName, $htmlOptions) . parent::closeTag($tagName); // tag won't work in this case
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

		if (self::popOption('dropup', $htmlOptions, false))
			$htmlOptions = self::addClassName('dropup', $htmlOptions);

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
		return parent::link($label, '#', $htmlOptions);
	}

	// Button groups
	// http://twitter.github.com/bootstrap/components.html#buttonGroups
	// --------------------------------------------------

	/**
	 * Generates a button group.
	 * @param array $buttons the button configurations.
	 * @param array $htmlOptions additional HTML options. The following special options are recognized:
	 * @todo write the options
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
	 * @todo write the options
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

	// Navs
	// http://twitter.github.com/bootstrap/components.html#navs
	// --------------------------------------------------

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

	// Navbar
	// http://twitter.github.com/bootstrap/components.html#navbar
	// --------------------------------------------------

	// todo: consider moving navbar rendering logic here.

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
		echo parent::openTag('ul', $htmlOptions);
		foreach ($links as $label => $url)
		{
			if (is_string($label))
			{
				echo parent::openTag('li');
				echo parent::link($label, parent::normalizeUrl($url));
				echo parent::tag('span', array('class' => 'divider'), $divider);
				echo '</li>';
			}
			else
				echo parent::tag('li', array('class' => 'active'), $url);
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
			if (isset($size) && in_array($size, self::$sizes))
				$htmlOptions = self::addClassName('pagination-' . $size, $htmlOptions);

			$align = self::popOption('align', $htmlOptions);
			if (isset($align) && in_array($align, self::$alignments))
				$htmlOptions = self::addClassName('pagination-' . $align, $htmlOptions);

			$listOptions = self::popOption('listOptions', $htmlOptions, array());

			ob_start();
			echo parent::openTag('div', $htmlOptions) . PHP_EOL;
			echo parent::openTag('ul', $listOptions) . PHP_EOL;
			foreach ($links as $itemOptions)
			{
				$options = self::popOption('htmlOptions', $itemOptions, array());
				if (!empty($options))
					$itemOptions = self::mergeOptions($options, $itemOptions);
				$label = self::popOption('label', $itemOptions, '');
				$url = self::popOption('url', $itemOptions, false);
				echo self::paginationLink($label, $url, $itemOptions) . PHP_EOL;
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
		echo parent::openTag('li', $htmlOptions) . PHP_EOL;
		echo parent::link($label, $url, $linkOptions) . PHP_EOL;
		echo '</li>' . PHP_EOL;
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
			echo parent::openTag('ul', $htmlOptions) . PHP_EOL;
			foreach ($links as $itemOptions)
			{
				$options = self::popOption('htmlOptions', $itemOptions, array());
				if (!empty($options))
					$itemOptions = self::mergeOptions($options, $itemOptions);
				$label = self::popOption('label', $itemOptions, '');
				$url = self::popOption('url', $itemOptions, false);
				echo self::pagerLink($label, $url, $itemOptions) . PHP_EOL;
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
		echo parent::openTag('li', $htmlOptions) . PHP_EOL;
		echo parent::link($label, $url, $linkOptions) . PHP_EOL;
		echo '</li>' . PHP_EOL;
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
	public static function labelSpan($label, $htmlOptions = array())
	{
		return self::labelBadgeSpan('label', $label, $htmlOptions);
	}

	/**
	 * Generates a badge span.
	 * @param string $label the badge text.
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated span.
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
	 */
	public static function labelBadgeSpan($type, $label, $htmlOptions = array())
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

	// Thumbnails
	// http://twitter.github.com/bootstrap/components.html#thumbnails
	// --------------------------------------------------

	// todo: move thumbnail methods here.

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
		echo parent::openTag('div', $htmlOptions);
		echo $closeText !== false ? self::closeLink($closeText, $closeOptions) : '';
		echo $message;
		echo '</div>';
		return ob_get_clean();
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

	// Media objects
	// http://twitter.github.com/bootstrap/components.html#media
	// --------------------------------------------------

	// todo: create media object methods here.

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
		$htmlOptions = self::defaultOption('data-content', $content, $htmlOptions);
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
		if (isset($placement) && in_array($placement, self::$placements))
			$htmlOptions = self::defaultOption('data-placement', $placement, $htmlOptions);
		if (self::popOption('selector', $htmlOptions))
			$htmlOptions = self::defaultOption('data-selector', true, $htmlOptions);
		$trigger = self::popOption('trigger', $htmlOptions);
		if (isset($trigger) && in_array($trigger, self::$triggers))
			$htmlOptions = self::defaultOption('data-trigger', $trigger, $htmlOptions);
		$delay = self::popOption('delay', $htmlOptions);
		if ($delay)
			$htmlOptions = self::defaultOption('data-delay', $delay, $htmlOptions);
		return parent::link($label, $url, $htmlOptions);
	}

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
	 * Extracts the help section of htmlOptions if any. The help option is setup as:
	 * <code>
	 *      // ...
	 * 		'help'=>array('text'=>'This is help text','type'=>'inline')
	 * 		// ...
	 * </code>
	 * @param $htmlOptions
	 * @return mixed|string
	 */
	public static function getHelp(&$htmlOptions)
	{
		$help = self::popOption('help', $htmlOptions);
		if(null !== $help && is_array($help))
		{
			$text = self::popOption('text', $help, 'help');
			$type = self::popOption('type', $help,  self::HELP_TYPE_BLOCK);
			$help = self::tag('span', array('class'=>'help-'.$type, $text));
		}
		return $help;
	}

	//
	// Forms
	// --------------------------------------------------

	/**
	 * Generates a label tag.
	 * @param string $label label text. Note, you should HTML-encode the text if needed.
	 * @param string $for the ID of the HTML element that this label is associated with.
	 * If this is false, the 'for' attribute for the label tag will not be rendered.
	 * @param array $htmlOptions additional HTML attributes.
	 * The following HTML option is recognized:
	 * <ul>
	 * <li>required: if this is set and is true, the label will be styled
	 * with CSS class 'required' (customizable with CHtml::$requiredCss),
	 * and be decorated with {@link CHtml::beforeRequiredLabel} and
	 * {@link CHtml::afterRequiredLabel}.</li>
	 * </ul>
	 * @return string the generated label tag
	 */
	public static function label($label,$for,$htmlOptions=array())
	{
		$formType = self::popOption('formType',$htmlOptions);
		if($formType == TbHtml::FORM_TYPE_HORIZONTAL)
			$htmlOptions = self::addClassName('control-label', $htmlOptions);

		return self::tag('label',$htmlOptions,$label);
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
		return self::inputField('text', $name, $value, $htmlOptions);
	}

	/**
	 * Generates a password field input.
	 * @param string $name the input name
	 * @param string $value the input value
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated input field
	 * @see clientChange
	 * @see inputField
	 */
	public static function passwordField($name,$value='',$htmlOptions=array())
	{
		parent::clientChange('change',$htmlOptions);
		return self::inputField('password',$name,$value,$htmlOptions);
	}

	/**
	 * Generates a text area input.
	 * @param string $name the input name
	 * @param string $value the input value
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated text area
	 * @see clientChange
	 * @see inputField
	 */
	public static function textArea($name,$value='',$htmlOptions=array())
	{
		$help = self::getHelp($htmlOptions);

		ob_start();
		echo parent::textArea($name, $value, $htmlOptions);
		echo $help;
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
		$label = self::popOption('label', $htmlOptions, '');
		$labelOptions = sel::popOption('labelOption', $htmlOptions, array());
		$checkBox = parent::checkBox($name, $checked, $htmlOptions);

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
	 * Generates a drop down list.
	 * @param string $name the input name
	 * @param string $select the selected value
	 * @param array $data data for generating the list options (value=>display).
	 * You may use {@link listData} to generate this data.
	 * Please refer to {@link listOptions} on how this data is used to generate the list options.
	 * Note, the values and labels will be automatically HTML-encoded by this method.
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are recognized. See {@link clientChange} and {@link tag} for more details.
	 * In addition, the following options are also supported specifically for dropdown list:
	 * <ul>
	 * <li>encode: boolean, specifies whether to encode the values. Defaults to true.</li>
	 * <li>prompt: string, specifies the prompt text shown as the first list option. Its value is empty. Note, the prompt text will NOT be HTML-encoded.</li>
	 * <li>empty: string, specifies the text corresponding to empty selection. Its value is empty.
	 * The 'empty' option can also be an array of value-label pairs.
	 * Each pair will be used to render a list option at the beginning. Note, the text label will NOT be HTML-encoded.</li>
	 * <li>options: array, specifies additional attributes for each OPTION tag.
	 *     The array keys must be the option values, and the array values are the extra
	 *     OPTION tag attributes in the name-value pairs. For example,
	 * <pre>
	 *     array(
	 *         'value1'=>array('disabled'=>true, 'label'=>'value 1'),
	 *         'value2'=>array('label'=>'value 2'),
	 *     );
	 * </pre>
	 * </li>
	 * </ul>
	 * @return string the generated drop down list
	 * @see clientChange
	 * @see inputField
	 * @see listData
	 */
	public static function dropDownList($name,$select,$data,$htmlOptions=array())
	{
		$help = self::getHelp($htmlOptions);
		ob_start();
		echo parent::dropDownList($name, $select, $data, $htmlOptions);
		echo $help;
		return ob_get_clean();
	}

	/**
	 * Generates a list box.
	 * @param string $name the input name
	 * @param mixed $select the selected value(s). This can be either a string for single selection or an array for multiple selections.
	 * @param array $data data for generating the list options (value=>display)
	 * You may use {@link listData} to generate this data.
	 * Please refer to {@link listOptions} on how this data is used to generate the list options.
	 * Note, the values and labels will be automatically HTML-encoded by this method.
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized. See {@link clientChange} and {@link tag} for more details.
	 * In addition, the following options are also supported specifically for list box:
	 * <ul>
	 * <li>encode: boolean, specifies whether to encode the values. Defaults to true.</li>
	 * <li>prompt: string, specifies the prompt text shown as the first list option. Its value is empty. Note, the prompt text will NOT be HTML-encoded.</li>
	 * <li>empty: string, specifies the text corresponding to empty selection. Its value is empty.
	 * The 'empty' option can also be an array of value-label pairs.
	 * Each pair will be used to render a list option at the beginning. Note, the text label will NOT be HTML-encoded.</li>
	 * <li>options: array, specifies additional attributes for each OPTION tag.
	 *     The array keys must be the option values, and the array values are the extra
	 *     OPTION tag attributes in the name-value pairs. For example,
	 * <pre>
	 *     array(
	 *         'value1'=>array('disabled'=>true, 'label'=>'value 1'),
	 *         'value2'=>array('label'=>'value 2'),
	 *     );
	 * </pre>
	 * </li>
	 * </ul>
	 * @return string the generated list box
	 * @see clientChange
	 * @see inputField
	 * @see listData
	 */
	public static function listBox($name,$select,$data,$htmlOptions=array())
	{
		$help = self::getHelp($htmlOptions);
		ob_start();
		echo parent::listBox($name, $select, $data, $htmlOptions);
		echo $help;
		return ob_get_clean();
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
		$container = self::popOption('container', $htmlOptions);

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
		$container = self::popOption('container', $htmlOptions);

		if (substr($name, -2) !== '[]')
			$name .= '[]';

		$checkAllLabel = self::popOption('checkAll', $htmlOptions);
		$checkAllLast = self::popOption('checkAllLast', $htmlOptions);

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
	 * Generates an input HTML tag.
	 * This method generates an input HTML tag based on the given input name and value.
	 * @param string $type the input type (e.g. 'text', 'radio')
	 * @param string $name the input name
	 * @param string $value the input value
	 * @param array $htmlOptions additional HTML attributes for the HTML tag (see {@link tag}). The following special
	 * attributes are supported:
	 * <ul>
	 *	<li>append: string, append addon to the input types: text, password, date</li>
	 *	<li>prepend: string, prepend addon to the input types: text, password, date</li>
	 *	<li>help: array, see {@link getHelp}
	 * </ul>
	 * @return string the generated input tag
	 */
	protected static function inputField($type, $name, $value, $htmlOptions)
	{
		$inputOptions = self::removeOptions($htmlOptions, array('append', 'prepend'));
		$addOnClasses = self::getAddOnClasses($htmlOptions);
		$help = self::getHelp($htmlOptions);

		ob_start();
		if (!empty($addOnClasses))
			echo '<div class="' . $addOnClasses . '">';

		echo self::getPrepend($htmlOptions);
		echo parent::inputField($type, $name, $value, $inputOptions);
		echo self::getAppend($htmlOptions);

		if (!empty($addOnClasses))
			echo '</div>';

		echo $help;

		return ob_get_clean();
	}

	// Active Fields

	/**
	 * Generates a check box for a model attribute.
	 * The attribute is assumed to take either true or false value.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * A special option named 'uncheckValue' is available that can be used to specify
	 * the value returned when the checkbox is not checked. By default, this value is '0'.
	 * Internally, a hidden field is rendered so that when the checkbox is not checked,
	 * we can still obtain the posted uncheck value.
	 * If 'uncheckValue' is set as NULL, the hidden field will not be rendered.
	 * @return string the generated check box
	 * @see clientChange
	 * @see activeInputField
	 */
	public static function activeCheckBox($model, $attribute, $htmlOptions = array())
	{
		/* todo: is there another way to extract parents hidden input? */
		self::resolveNameID($model, $attribute, $htmlOptions);

		$htmlOptions = self::defaultOption('value', 1, $htmlOptions);

		if (!isset($htmlOptions['checked']) && self::resolveValue($model, $attribute) == $htmlOptions['value'])
			$htmlOptions['checked'] = 'checked';
		self::clientChange('click', $htmlOptions);

		if (array_key_exists('uncheckValue', $htmlOptions))
		{
			$unCheck = $htmlOptions['uncheckValue'];
			unset($htmlOptions['uncheckValue']);
		} else
			$unCheck = '0';

		$hiddenOptions = isset($htmlOptions['id']) ? array('id' => self::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
		$hidden = $unCheck !== null ? self::hiddenField($htmlOptions['name'], $unCheck, $hiddenOptions) : '';

		$name = parent::resolveName($model, $attribute);

		/* todo: checkbox and radio have different label layout. Test whether this solution works */
		return $hidden . self::checkBox($name, $unCheck, $htmlOptions);
	}

	/**
	 * Generates a radio button for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * A special option named 'uncheckValue' is available that can be used to specify
	 * the value returned when the radio button is not checked. By default, this value is '0'.
	 * Internally, a hidden field is rendered so that when the radio button is not checked,
	 * we can still obtain the posted uncheck value.
	 * If 'uncheckValue' is set as NULL, the hidden field will not be rendered.
	 * @return string the generated radio button
	 * @see clientChange
	 * @see activeInputField
	 */
	public static function activeRadioButton($model, $attribute, $htmlOptions = array())
	{
		self::resolveNameID($model, $attribute, $htmlOptions);

		$htmlOptions = self::defaultOption('value', 1, $htmlOptions);

		if (!isset($htmlOptions['checked']) && self::resolveValue($model, $attribute) == $htmlOptions['value'])
			$htmlOptions['checked'] = 'checked';

		self::clientChange('click', $htmlOptions);

		if (array_key_exists('uncheckValue', $htmlOptions))
		{
			$unCheck = $htmlOptions['uncheckValue'];
			unset($htmlOptions['uncheckValue']);
		} else
			$unCheck = '0';

		$hiddenOptions = isset($htmlOptions['id']) ? array('id' => self::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
		$hidden = $unCheck !== null ? self::hiddenField($htmlOptions['name'], $unCheck, $hiddenOptions) : '';

		$name = parent::resolveName($model, $attribute);

		/* todo: checkbox and radio have different label layout. Test whether this solution works */
		// add a hidden field so that if the radio button is not selected, it still submits a value
		return $hidden . self::radioButton($name, $unCheck, $htmlOptions);
	}

	/**
	 * Generates a url field input for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated input field
	 * @see clientChange
	 * @see activeInputField
	 * @since 1.1.11
	 */
	public static function activeUrlField($model,$attribute,$htmlOptions=array())
	{
		parent::resolveNameID($model,$attribute,$htmlOptions);
		parent::clientChange('change',$htmlOptions);
		return self::activeInputField('url',$model,$attribute,$htmlOptions);
	}

	/**
	 * Generates an email field input for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated input field
	 * @see clientChange
	 * @see activeInputField
	 * @since 1.1.11
	 */
	public static function activeEmailField($model,$attribute,$htmlOptions=array())
	{
		parent::resolveNameID($model,$attribute,$htmlOptions);
		parent::clientChange('change',$htmlOptions);
		return self::activeInputField('email',$model,$attribute,$htmlOptions);
	}

	/**
	 * Generates a number field input for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated input field
	 * @see clientChange
	 * @see activeInputField
	 * @since 1.1.11
	 */
	public static function activeNumberField($model,$attribute,$htmlOptions=array())
	{
		parent::resolveNameID($model,$attribute,$htmlOptions);
		parent::clientChange('change',$htmlOptions);
		return self::activeInputField('number',$model,$attribute,$htmlOptions);
	}

	/**
	 * Generates a range field input for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated input field
	 * @see clientChange
	 * @see activeInputField
	 * @since 1.1.11
	 */
	public static function activeRangeField($model,$attribute,$htmlOptions=array())
	{
		parent::resolveNameID($model,$attribute,$htmlOptions);
		parent::clientChange('change',$htmlOptions);
		return self::activeInputField('range',$model,$attribute,$htmlOptions);
	}

	/**
	 * Generates a date field input for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated input field
	 * @see clientChange
	 * @see activeInputField
	 * @since 1.1.11
	 */
	public static function activeDateField($model,$attribute,$htmlOptions=array())
	{
		parent::resolveNameID($model,$attribute,$htmlOptions);
		parent::clientChange('change',$htmlOptions);
		return self::activeInputField('date',$model,$attribute,$htmlOptions);
	}

	/**
	 * Generates a password field input for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated input field
	 * @see clientChange
	 * @see activeInputField
	 */
	public static function activePasswordField($model,$attribute,$htmlOptions=array())
	{
		parent::resolveNameID($model,$attribute,$htmlOptions);
		parent::clientChange('change',$htmlOptions);
		return self::activeInputField('password',$model,$attribute,$htmlOptions);
	}

	/**
	 * Generates a file input for a model attribute.
	 * Note, you have to set the enclosing form's 'enctype' attribute to be 'multipart/form-data'.
	 * After the form is submitted, the uploaded file information can be obtained via $_FILES (see
	 * PHP documentation).
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes (see {@link tag}).
	 * @return string the generated input field
	 * @see activeInputField
	 */
	public static function activeFileField($model,$attribute,$htmlOptions=array())
	{
		self::resolveNameID($model,$attribute,$htmlOptions);
		// add a hidden field so that if a model only has a file field, we can
		// still use isset($_POST[$modelClass]) to detect if the input is submitted
		$hiddenOptions=isset($htmlOptions['id']) ? array('id'=>self::ID_PREFIX.$htmlOptions['id']) : array('id'=>false);
		return self::hiddenField($htmlOptions['name'],'',$hiddenOptions)
			. self::activeInputField('file',$model,$attribute,$htmlOptions);
	}

	/**
	 * Generates a text field input for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated input field
	 * @see clientChange
	 * @see activeInputField
	 */
	public static function activeTextField($model,$attribute,$htmlOptions=array())
	{
		parent::resolveNameID($model,$attribute,$htmlOptions);
		parent::clientChange('change',$htmlOptions);
		return self::activeInputField('text',$model,$attribute,$htmlOptions);
	}

	/**
	 * Generates a text area input for a model attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated text area
	 * @see clientChange
	 */
	public static function activeTextArea($model,$attribute,$htmlOptions=array())
	{
		parent::resolveNameID($model,$attribute,$htmlOptions);
		parent::clientChange('change',$htmlOptions);
		if($model->hasErrors($attribute))
			self::addErrorCss($htmlOptions);

		$text = self::popOption('value', $htmlOptions, self::resolveValue($model, $attribute));
		$help = self::getHelp($htmlOptions);

		ob_start();
		self::tag('textarea',$htmlOptions, isset($htmlOptions['encode']) && !$htmlOptions['encode'] ? $text : self::encode($text));
		echo $help;
		return ob_get_clean();
	}

	/**
	 * Generates an input HTML tag for a model attribute.
	 * This method generates an input HTML tag based on the given data model and attribute.
	 * If the attribute has input error, the input field's CSS class will
	 * be appended with {@link errorCss}.
	 * This enables highlighting the incorrect input.
	 * @param string $type the input type (e.g. 'text', 'radio')
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes for the HTML tag
	 * @return string the generated input tag
	 */
	protected static function activeInputField($type, $model, $attribute, $htmlOptions)
	{
		$inputOptions = self::removeOptions($htmlOptions, array('append', 'prepend'));
		$addOnClasses = self::getAddOnClasses($htmlOptions);
		$help = self::getHelp($htmlOptions);

		ob_start();
		if (!empty($addOnClasses))
			echo '<div class="' . $addOnClasses . '">';

		echo self::getPrepend($htmlOptions);
		echo parent::activeInputField($type, $model, $attribute, $inputOptions);
		echo self::getAppend($htmlOptions);

		if (!empty($addOnClasses))
			echo '</div>';

		echo $help;

		return ob_get_clean();
	}

}