<?php
/**
 * TbPager class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

/**
 * Bootstrap pager widget.
 * http://twitter.github.com/bootstrap/components.html#pagination
 */
class TbPager extends CBasePager
{
	public $size;
	/**
	 * @var integer maximum number of page buttons that can be displayed.
	 */
	public $maxButtonCount = 10;
	/**
	 * @var string the text label for the next page button.
	 */
	public $nextPageLabel = '&rsaquo;';
	/**
	 * @var string the text label for the previous page button.
	 */
	public $prevPageLabel = '&lsaquo;';
	/**
	 * @var string the text label for the first page button.
	 */
	public $firstPageLabel = '&larr;';
	/**
	 * @var string the text label for the last page button.
	 */
	public $lastPageLabel = '&rarr;';
	/**
	 * @var array HTML attributes for the pager container tag.
	 */
	public $htmlOptions = array();

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		$this->htmlOptions = TbHtml::defaultOption('id', $this->getId(), $this->htmlOptions);

		if (isset($this->size))
			$this->htmlOptions = TbHtml::defaultOption('size', $this->size, $this->htmlOptions);
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		$buttons = $this->createPageButtons();
		if (!empty($buttons))
			echo TbHtml::pagination($buttons, $this->htmlOptions);
	}

	/**
	 * Creates the page buttons.
	 * @return array a list of page buttons (in HTML code).
	 */
	protected function createPageButtons()
	{
		if (($pageCount = $this->getPageCount()) <= 1)
			return array();

		list($beginPage, $endPage) = $this->getPageRange();

		$currentPage = $this->getCurrentPage(false); // currentPage is calculated in getPageRange()
		$buttons = array();

		// first page
		$buttons[] = $this->createPageButton(
			$this->firstPageLabel,
			0,
			$currentPage <= 0,
			false
		);

		// prev page
		if (($page = $currentPage - 1) < 0)
			$page = 0;

		$buttons[] = $this->createPageButton(
			$this->prevPageLabel,
			$page,
			$currentPage <= 0,
			false
		);

		// internal pages
		for ($i = $beginPage; $i <= $endPage; ++$i)
		{
			$buttons[] = $this->createPageButton(
				$i + 1,
				$i,
				false,
				$i == $currentPage
			);
		}

		// next page
		if (($page = $currentPage + 1) >= $pageCount - 1)
			$page = $pageCount - 1;

		$buttons[] = $this->createPageButton(
			$this->nextPageLabel,
			$page,
			$currentPage >= $pageCount - 1,
			false
		);

		// last page
		$buttons[] = $this->createPageButton(
			$this->lastPageLabel,
			$pageCount - 1,
			$currentPage >= $pageCount - 1,
			false
		);

		return $buttons;
	}

	/**
	 * Creates a page button.
	 * You may override this method to customize the page buttons.
	 * @param string $label the text label for the button
	 * @param integer $page the page number
	 * @param boolean $visible whether this page button is visible
	 * @param boolean $active whether this page button is active
	 * @return string the generated button
	 */
	protected function createPageButton($label, $page, $disabled, $active)
	{
		return array(
			'label' => $label,
			'url' => $this->createPageUrl($page),
			'disabled' => $disabled,
			'active' => $active,
		);
	}

	/**
	 * @return array the begin and end pages that need to be displayed.
	 */
	protected function getPageRange()
	{
		$currentPage = $this->getCurrentPage();
		$pageCount = $this->getPageCount();
		$beginPage = max(0, $currentPage - (int)($this->maxButtonCount / 2));
		if (($endPage = $beginPage + $this->maxButtonCount - 1) >= $pageCount)
		{
			$endPage = $pageCount - 1;
			$beginPage = max(0, $endPage - $this->maxButtonCount + 1);
		}
		return array($beginPage, $endPage);
	}
}
