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
	const STYLE_PRIMARY			= 'primary';
	const STYLE_INFO			= 'info';
	const STYLE_SUCCESS			= 'success';
	const STYLE_WARNING			= 'warning';
	const STYLE_ERROR			= 'error';
	const STYLE_DANGER			= 'danger';
	const STYLE_IMPORTANT		= 'important';
	const STYLE_INVERSE			= 'inverse';
	const STYLE_LINK			= 'link';
  
	// Element sizes.  
	const SIZE_MINI				= 'mini';
	const SIZE_SMALL			= 'small';
	const SIZE_LARGE			= 'large';
  
	// Navigation menu types.  
	const NAV_TABS				= 'tabs';
	const NAV_PILLS				= 'pills';
	const NAV_LIST				= 'list';
  
	// Fixed types.  
	const FIXED_TOP				= 'top';
	const FIXED_BOTTOM			= 'bottom';
  
	// Addon types.  
	const ADDON_PREPEND			= 'prepend';
	const ADDON_APPEND			= 'append';
  
	const PROGRESS_STRIPED		= 'striped';
	const PROGRESS_ACTIVE		= 'active';
  
	// Default close text.  
	const CLOSE_TEXT			= '&times;';
  
	// Scope constants.  
	static $buttonStyles		= array(
									self::STYLE_PRIMARY, self::STYLE_INFO, self::STYLE_SUCCESS, self::STYLE_WARNING,
									self::STYLE_DANGER, self::STYLE_INVERSE, self::STYLE_LINK,
								);
	static $buttonSizes			= array(self::SIZE_LARGE, self::SIZE_SMALL, self::SIZE_MINI);
	static $labelBadgeStyles	= array(self::STYLE_SUCCESS, self::STYLE_WARNING, self::STYLE_IMPORTANT,
									self::STYLE_INFO, self::STYLE_INVERSE,
								);
	static $alertStyles			= array(self::STYLE_SUCCESS, self::STYLE_INFO, self::STYLE_WARNING, self::STYLE_ERROR);
	static $navbarStyles		= array(self::STYLE_INVERSE);
	static $navbarFixes			= array(self::FIXED_TOP, self::FIXED_BOTTOM);
	static $progressStyles		= array(self::STYLE_INFO, self::STYLE_SUCCESS, self::STYLE_WARNING, self::STYLE_DANGER);
	static $inputAddons			= array(self::ADDON_PREPEND, self::ADDON_APPEND);
	static $navStyles			= array(self::NAV_TABS, self::NAV_PILLS, self::NAV_LIST);
	static $wellSizes			= array(self::SIZE_LARGE, self::SIZE_SMALL, self::SIZE_MINI);

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

		if (isset($htmlOptions['style']) && in_array($htmlOptions['style'], self::$buttonStyles))
			$htmlOptions = self::addClassName('btn-' . self::popOption('style', $htmlOptions), $htmlOptions);

		if (isset($htmlOptions['size']) && in_array($htmlOptions['size'], self::$buttonSizes))
			$htmlOptions = self::addClassName('btn-' . self::popOption('size', $htmlOptions), $htmlOptions);

		if (self::popOption('block', $htmlOptions, false))
			$htmlOptions = self::addClassName('btn-block', $htmlOptions);

		if (self::popOption('disabled', $htmlOptions, false))
			$htmlOptions = self::addClassName('disabled', $htmlOptions);

		if (isset($htmlOptions['icon']))
			$label = self::icon(self::popOption('icon', $htmlOptions)) . $label;

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
            foreach ($buttons as $button)
            {
                $button = self::copyOptions(array('style', 'size', 'disabled'), $parentOptions, $button);
                $buttonLabel = self::popOption('label', $button, '');
                $buttonOptions = self::popOption('htmlOptions', $button, array());
                $buttonOptions = self::moveOptions(array('icon', 'style', 'size', 'disabled'), $button, $buttonOptions);
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
        if(is_array($groups) && !empty($groups))
        {
            $htmlOptions = self::addClassName('btn-toolbar', $htmlOptions);

            $parentOptions = array(
                'style' => self::popOption('style', $htmlOptions),
                'size' => self::popOption('size', $htmlOptions),
                'disabled' => self::popOption('disabled', $htmlOptions)
            );

            ob_start();
            echo parent::openTag('div', $htmlOptions);
            foreach ($groups as $group)
            {
                $items = self::getOption('items', $group, array());
                if (empty($items))
                    continue;

                $group = self::copyOptions(array('style', 'size', 'disabled'), $parentOptions, $group);
                $groupOptions = self::getOption('htmlOptions', $group, array());
                $groupOptions = self::moveOptions(array('style', 'size', 'disabled'), $group, $groupOptions);
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
		}
		else
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
        foreach ($items as $menuItem)
        {
            if (is_string($menuItem))
                echo self::menuDivider();
            else
            {
                // todo: I'm not quite happy with the logic below but it will have to do for now.
                $label = self::getOption('label', $menuItem, '');
                $itemOptions = self::getOption('itemOptions', $menuItem, array());

                if (self::getOption('active', $menuItem, false))
                    $itemOptions = self::addClassName('active', $itemOptions);

                if (self::getOption('header', $menuItem, false))
                    echo self::menuHeader($label, $itemOptions);
                else
                {
                    $itemOptions['linkOptions'] = self::getOption('linkOptions', $menuItem, array());

                    if (isset($menuItem['icon']))
                        $label = self::icon(self::popOption('icon', $menuItem)) . ' ' . $label;

                    $items = self::getOption('items', $menuItem, array());
                    if (empty($items))
                    {
                        $url = self::getOption('url', false, $menuItem);
                        echo self::menuLink($label, $url, $itemOptions);
                    }
                    else
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
        echo self::dropdownToggleMenuItem($label, $linkOptions);
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
    public static function dropdownToggleMenuItem($label, $htmlOptions = array())
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
			}
			else
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

        $striped = self::popOption('striped', $htmlOptions, false);
        if ($striped)
        {
            $htmlOptions = self::addClassName('progress-striped', $htmlOptions);
            $animated = self::popOption('animated', $htmlOptions, false);
            if ($animated)
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
            foreach ($bars as $bar)
            {
                $width = self::popOption('width', $bar, 0);
                $barOptions = self::popOption('htmlOptions', $bar, array());
                $barOptions = self::defaultOption('style', self::popOption('style', $bar), $barOptions);
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
        if (isset($size) && in_array($size, self::$wellSizes))
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
        if (strpos($icon, 'icon') === false)
            $icon = 'icon-' . implode(' icon-', explode(' ', $icon));
        $htmlOptions = self::addClassName($icon, $htmlOptions);
        return parent::openTag($tag, $htmlOptions) . parent::closeTag($tag); // tag won't work in this case
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
		$inputOptions = self::mergeOptions(array('type'=>'text', 'placeholder'=>'Search'), $inputOptions);
		$inputOptions = self::addClassName('search-query', $inputOptions);

		$buttonOptions = self::popOption('buttonOptions', $htmlOptions, array());
		$buttonLabel = self::popOption('label', $buttonOptions, self::icon('search'));

		ob_start();
		echo self::beginForm($action, $method, $htmlOptions);

		$addon = self::popOption('addon', $htmlOptions);
		if(isset($addon) && in_array($addon, self::$inputAddons))
			$inputOptions[$addon] = self::button($buttonLabel, $buttonOptions);

		echo self::textField(
			self::popOption('name', $inputOptions,'search'),
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
		$addOnClasses = self::getAddOnClasses($htmlOptions);

		ob_start();
		if (!empty($addOnClasses))
			echo '<div class="' . $addOnClasses . '">';

		echo self::getPrepend($htmlOptions);
		echo self::inputField('text', $name, $value, self::removeOptions($htmlOptions, array('append', 'prepend')));
		echo self::getAppend($htmlOptions);

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

		// todo: $labelOptions is not actually used at all?
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

		// todo: refactor to declarative approach.
		if (isset($checkAllLabel))
		{
			$htmlOptions['label'] = $checkAllLabel;
			$htmlOptions['labelOptions'] = array('class' => 'inline');
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

    public static function defaultOptions($options, $defaults)
    {
        if (is_array($defaults) && is_array($options))
        {
            foreach ($defaults as $name => $value)
            {
                if (!isset($options[$name]))
                    $options[$name] = $defaults[$name];
            }
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
	 * Displays the first validation error for a model attribute.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute name
	 * @param array $htmlOptions additional HTML attributes to be rendered in the container tag.
	 * @return string the error display. Empty if no errors are found.
	 * @see CModel::getErrors
	 * @see errorMessageCss
	 * @see $errorContainerTag
     * @todo move this method up to the form section.
	 */
	public static function error($model, $attribute, $htmlOptions = array())
	{
		self::resolveName($model, $attribute); // turn [a][b]attr into attr
		$error = $model->getError($attribute);
        // todo: logic below needs to cleaned up, nested ternary operations are messy.
		return $error != ''
			? self::tag('span', (!isset($htmlOptions['class'])
				? self::addClassName(self::$errorMessageCss, $htmlOptions)
				: $htmlOptions), $error)
			: '';
	}
}