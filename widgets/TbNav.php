<?php

class TbNav extends CWidget
{
	public $style = TbHtml::NAV_TABS;
	public $items = array();
	public $itemTemplate;
	public $encodeLabel = true;
	public $activeCssClass = 'active';
	public $activateItems = true;
	public $activateParents = false;
	public $hideEmptyItems = true;
	public $htmlOptions = array();
	public $submenuHtmlOptions = array();
	// todo: consider supporting these.
	//public $linkLabelWrapper;
	//public $linkLabelWrapperHtmlOptions=array();
	public $itemCssClass;

	public function init()
	{
		$this->htmlOptions['id'] = $this->getId();
		$route = $this->controller->getRoute();
		$this->items = $this->normalizeItems($this->items, $route, $hasActiveChild);
	}

	public function run()
	{
		if (count($this->items))
			echo TbHtml::nav($this->style, $this->items, $this->htmlOptions);
	}

	protected function normalizeItems($items, $route, &$active)
	{
		foreach ($items as $i => $item)
		{
			// skip dividers
			if (is_string($item))
				continue;

			if (isset($item['visible']) && !$item['visible'])
			{
				unset($items[$i]);
				continue;
			}

			$item = TbHtml::setDefaultValue('label', '', $item);

			if ($this->encodeLabel)
				$items[$i]['label'] = CHtml::encode($item['label']);

			if (!isset($item['url']) && !isset($item['items']))
				$items[$i]['header'] = true;

			$hasActiveChild = false;

			if (isset($item['items']) && !empty($item['items']))
			{
				$items[$i]['items'] = $this->normalizeItems($item['items'], $route, $hasActiveChild);

				if (empty($items[$i]['items']) && $this->hideEmptyItems)
				{
					unset($items[$i]['items']);
					if (!isset($item['url']))
					{
						unset($items[$i]);
						continue;
					}
				}
			}

			if (!isset($item['active']))
			{
				if ($this->activateParents && $hasActiveChild || $this->activateItems && $this->isItemActive($item, $route))
					$active = $items[$i]['active'] = true;
				else
					$items[$i]['active'] = false;
			}
			else if ($item['active'])
				$active = true;
		}

		return array_values($items);
	}

	protected function isItemActive($item, $route)
	{
		if (isset($item['url']) && is_array($item['url']) && !strcasecmp(trim($item['url'][0], '/'), $route))
		{
			unset($item['url']['#']);
			if (count($item['url']) > 1)
			{
				foreach (array_splice($item['url'], 1) as $name => $value)
				{
					if (!isset($_GET[$name]) || $_GET[$name] != $value)
						return false;
				}
			}
			return true;
		}
		return false;
	}
}