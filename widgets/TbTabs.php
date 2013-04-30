<?php
/**
 * TbTabs class file.
 * @author Antonio Ramirez <ramirez.cobos@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

Yii::import('bootstrap.widgets.TbWidget');

/**
 * Class TbTabs
 */
class TbTabs extends TbWidget
{
	/**
	 * @var array Additional data submitted to the views
	 */
	public $viewData;

	/**
	 * @var string the type of tabs to display. Defaults to 'tabs'. Valid values are 'tabs' and 'pills'.
	 * Please not that Javascript pills are not fully supported in Bootstrap yet!
	 * @see TbHtml::$navStyles
	 */
	public $type = TbHtml::NAV_TABS;

	/**
	 * @var string the placement of the tabs.
	 * Valid values are TbHtml::TABS_TOP, TbHtml::TABS_RIGHT, TbHtml::TABS_LEFT, TbHtml::TABS_BELOW.
	 * @see TbHtml::tabPlacements
	 */
	public $placement;

	/**
	 * @var array the tab configuration.
	 */
	public $tabs = array();

	/**
	 * @var string a javascript function that This event fires on tab show, but before the new tab has been shown.
	 * Use `event.target` and `event.relatedTarget` to target the active tab and the previous active tab (if available)
	 * respectively.
	 */
	public $onShow;

	/**
	 * @var string a javascript function that fires on tab show after a tab has been shown. Use `event.target` and
	 * `event.relatedTarget` to target the active tab and the previous active tab (if available) respectively.
	 */
	public $onShown;

	/**
	 * @var array the HTML attributes for the widget container.
	 */
	public $htmlOptions = array();

	/**
	 * @var string[] the Javascript event handlers.
	 */
	protected $events = array();

	/**
	 * @var array the tab menu items.
	 */
	protected $menuItems = array();

	/**
	 * @var array the contents of the tabs.
	 */
	protected $tabsContent = array();

	/**
	 * Widget's initialization method
	 */
	public function init()
	{
		$this->htmlOptions = TbHtml::defaultOption('id', $this->getId(), $this->htmlOptions);

		if(in_array($this->placement, TbHtml::$tabPlacements))
			$this->htmlOptions = TbHtml::addClassName('tabs-'.$this->placement, $this->htmlOptions);

		$this->menuItems = $this->normalizeTabs($this->tabs, $this->tabsContent);

		$this->initEvents();
	}

	/**
	 * Initialize events if any
	 */
	public function initEvents()
	{
		foreach(array('onShow', 'onShown') as $event)
		{
			if($this->$event!==null)
			{
				$modalEvent = strtolower(substr($event, 2));

				if($this->$event instanceof CJavaScriptExpression)
					$this->events[$modalEvent]=$this->$event;
				else
					$this->events[$modalEvent]=new CJavaScriptExpression($this->$event);
			}
		}
	}

	/**
	 * Widget's run method
	 */
	public function run()
	{
		ob_start();
		$this->renderTabsNavigation();
		$navigation = ob_get_clean();

		ob_start();
		$this->renderTabsContent();
		$content = ob_get_clean();

		$this->renderTabs($navigation, $content);

		$this->registerClientScript();
	}

	/**
	 * Renders the
	 * @param string $navigation the menu tabs
	 * @param string $content the tabs contents
	 */
	public function renderTabs($navigation, $content)
	{
		echo CHtml::openTag('div', $this->htmlOptions);
		echo $this->placement === TbHtml::TABS_BELOW
			? $content.$navigation
			: $navigation.$content;
		echo '</div>';
	}

	/**
	 * Renders tab navigation
	 */
	public function renderTabsNavigation()
	{
		$navOptions = TbHtml::popOption('menuOptions', $this->htmlOptions, array());
		echo TbHtml::nav($this->type, $this->menuItems, $navOptions );
	}

	/**
	 * Renders tabs contents
	 */
	public function renderTabsContent()
	{
		$contentOptions = TbHtml::popOption('contentOptions', $this->htmlOptions, array());
		$contentOptions = TbHtml::addClassName('tab-content', $contentOptions);
		echo CHtml::openTag('div', $contentOptions );
		echo implode(' ', $this->tabsContent);
		echo '</div>';
	}

	/**
	 * Normalizes the tab configuration.
	 * @param array $tabs the tab configuration
	 * @param array $panes a reference to the panes array
	 * @param integer $i the current index
	 * @return array the items
	 */
	protected function normalizeTabs($tabs, &$panes, &$i = 0)
	{

		$id = TbHtml::getOption('id', $this->htmlOptions, $this->getId());
		$items = array();

		//Check if has an active item
		$hasActiveItem = false;
		foreach ($tabs as $tab)
		{
			if ($hasActiveItem = TbHtml::getOption('active', $tab, false) === true)
				break;
		}

		foreach ($tabs as $tab)
		{
			$item = $tab;

			if (isset($item['visible']) && $item['visible'] === false)
				continue;

			// if no tab should be active, activate first
			if (!$hasActiveItem && $i == 0)
				$item['active'] = true;

			// set the label to the title if any
			if (isset($item['title']))
				$item['label'] = TbHtml::defaultOption('label', TbHtml::popOption('title', $item), $item);

			$item = TbHtml::defaultOption('itemOptions', array(), $item);

			if (isset($tab['items']))
			{
				$item['linkOptions']['data-toggle'] = 'dropdown';
				$item['items'] = $this->normalizeTabs($item['items'], $panes, $i);
			}
			else
			{
				$item['linkOptions']['data-toggle'] = 'tab';

				$item = TbHtml::defaultOption('id', $id . '_tab_' . ($i + 1), $item);

				$item['url'] = '#' . $item['id'];

				// no content and we have a view?
				if (!isset($item['content']) && isset($item['view']))
				{
					$view = TbHtml::popOption('view', $item, '');

					$data = TbHtml::popOption('data', $item, array());
					if (is_array($this->viewData))
						$data = TbHtml::mergeOptions($this->viewData, $data);

					$process = TbHtml::popOption('processOutput', $item, false);

					$item['content'] = !empty($view)
						? $this->getController()->renderPartial($view, $data, true, $process)
						: '';
				}

				$content = TbHtml::popOption('content', $item, '');
				$paneOptions = TbHtml::popOption('paneOptions', $item, array());
				$paneOptions['id'] = TbHtml::popOption('id', $item);

				$classes = array('tab-pane fade');

				if (isset($item['active']) && $item['active'])
					$classes[] = 'active in';

				$paneOptions = TbHtml::addClassName(implode(' ', $classes), $paneOptions);

				$panes[] = CHtml::tag('div', $paneOptions, $content);

				$i++; // increment the tab-index
			}

			$items[] = $item;
		}

		return $items;
	}

	/**
	 * Registers necessary client scripts.
	 */
	public function registerClientScript()
	{
		$selector = '#' . $this->htmlOptions['id'];
		Yii::app()->clientScript->registerScript(__CLASS__.$selector, "jQuery('{$selector}').tab('show');");
		$this->registerEvents($selector, $this->events);
	}
}