<?php
/**
 * TbButtonColumn class file.
 * @author Antonio Ramirez <ramirez.cobos@gmail.com>
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

Yii::import('bootstrap.helpers.TbHtml');
Yii::import('zii.widgets.grid.CButtonColumn');

/**
 * Bootstrap button column widget.
 */
class TbButtonColumn extends CButtonColumn
{
	/**
	 * @var string the view button icon (defaults to TbHtml::ICON_EYE_OPEN).
	 */
	public $viewButtonIcon = TbHtml::ICON_EYE_OPEN;
	/**
	 * @var string the update button icon (defaults to TbHtml::ICON_PENCIL).
	 */
	public $updateButtonIcon = TbHtml::ICON_PENCIL;
	/**
	 * @var string the delete button icon (defaults to TbHtml::ICON_TRASH).
	 */
	public $deleteButtonIcon = TbHtml::ICON_TRASH;

	/**
	 * Initializes the default buttons (view, update and delete).
	 */
	protected function initDefaultButtons()
	{
		parent::initDefaultButtons();

		if ($this->viewButtonIcon !== false && !isset($this->buttons['view']['icon']))
			$this->buttons['view']['icon'] = $this->viewButtonIcon;
		if ($this->updateButtonIcon !== false && !isset($this->buttons['update']['icon']))
			$this->buttons['update']['icon'] = $this->updateButtonIcon;
		if ($this->deleteButtonIcon !== false && !isset($this->buttons['delete']['icon']))
			$this->buttons['delete']['icon'] = $this->deleteButtonIcon;
	}

	/**
	 * Renders a link button.
	 * @param string $id the ID of the button
	 * @param array $button the button configuration which may contain 'label', 'url', 'imageUrl' and 'options' elements.
	 * @param integer $row the row number (zero-based)
	 * @param mixed $data the data object associated with the row
	 */
	protected function renderButton($id, $button, $row, $data)
	{
		if (isset($button['visible']) && !$this->evaluateExpression($button['visible'], array('row' => $row, 'data' => $data)))
			return;

		$url = TbHtml::popOption('url', $button, '#');
		if(strcmp($url, '#') !== 0)
			$url = $this->evaluateExpression($url, array('data' => $data, 'row' => $row));

		$imageUrl = TbHtml::popOption('imageUrl', $button, false);
		$label = TbHtml::popOption('label', $button, $id);
		$options = TbHtml::popOption('options', $button, array());

		$options = TbHtml::defaultOption('title', $label, $options);
		$options = TbHtml::defaultOption('rel', 'tooltip', $options);

		if ($icon = TbHtml::popOption('icon', $button, false ))
		{
			/* todo: not sure if we require this anymore */
			if (strpos($icon, 'icon') === false)
				$icon = 'icon-' . implode(' icon-', explode(' ', $icon));

			echo CHtml::link('<i class="' . $icon. '"></i>', $url, $options);

		} else if ($imageUrl && is_string($imageUrl))
			echo CHtml::link(CHtml::image($imageUrl, $label), $url, $options);
		else
			echo CHtml::link($label, $url, $options);
	}
}
