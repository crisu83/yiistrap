<?php
/**
 * SeoHead class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

class SeoHead extends CWidget
{
	/**
	 * @property array the configuration for the title. 
	 * Defaults to <code>array('class'=>'ext.seo.widgets.SeoTitle')</code>.
	 * @see enableTitle
	 */
	public $title = array('class'=>'ext.seo.widgets.SeoTitle');
	/**
	 * @property boolean whether to enable the title.
	 */
	public $enableTitle = true;
	/**
	 * @property array the page http-equivs.
	 */
	public $httpEquivs = array();
	/**
	 * @property string the page meta title.
	 */
	public $defaultTitle;
	/**
	 * @property string the page meta description.
	 */
	public $defaultDescription;
	/**
	 * @property string the page meta keywords.
	 */
	public $defaultKeywords;
	/**
	 * @property array the page meta properties.
	 */
	public $defaultProperties = array();

	protected $_title;
	protected $_description;
	protected $_keywords;
	protected $_properties = array();
	protected $_canonical;

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		$behavior = $this->controller->asa('seo');

		if ($behavior !== null && $behavior->metaTitle !== null)
			$this->_title = $behavior->metaTitle;
		else if ($this->defaultDescription !== null)
			$this->_title = $this->defaultTitle;

		if ($behavior !== null && $behavior->metaDescription !== null)
			$this->_description = $behavior->metaDescription;
		else if ($this->defaultDescription !== null)
			$this->_description = $this->defaultDescription;

		if ($behavior !== null && $behavior->metaKeywords !== null)
			$this->_keywords = $behavior->metaKeywords;
		else if ($this->defaultKeywords !== null)
			$this->_keywords = $this->defaultKeywords;

		if ($behavior !== null)
			$this->_properties = CMap::mergeArray($behavior->metaProperties, $this->defaultProperties);
		else
			$this->_properties = $this->defaultProperties;

		if ($behavior !== null && $behavior->canonical !== null)
			$this->_canonical = $behavior->canonical;
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		$this->renderContent();
	}

	/**
	 * Renders the widget content.
	 */
	protected function renderContent()
	{
		$this->renderTitle().PHP_EOL;

		foreach ($this->httpEquivs as $name => $content)
			echo '<meta http-equiv="'.$name.'" content="'.$content.'" />'.PHP_EOL;

		if ($this->_description !== null)
			echo CHtml::metaTag($this->_title, 'title').PHP_EOL;

		if ($this->_description !== null)
			echo CHtml::metaTag($this->_description, 'description').PHP_EOL;

		if ($this->_keywords !== null)
			echo CHtml::metaTag($this->_keywords, 'keywords').PHP_EOL;

		foreach ($this->_properties as $name => $content)
			echo '<meta property="'.$name.'" content="'.$content.'" />'.PHP_EOL; // we can't use Yii's method for this.

		if ($this->_canonical !== null)
			$this->renderCanonical();
	}
	
	/**
	 * Renders the page title.
	 */
	protected function renderTitle()
	{
		if (!$this->enableTitle)
			return;

		$title = array();
		$class = 'ext.seo.widgets.SeoTitle';

		if (is_string($this->title))
			$class = $this->title;
		else if (is_array($this->title))
		{
			$title = $this->title;
			if (isset($title['class']))
			{
				$class = $title['class'];
				unset($title['class']);
			}
		}

		$this->widget($class, $title);
	}

	/**
	 * Renders the canonical link tag.
	 */
	protected function renderCanonical()
	{
		$request = Yii::app()->getRequest();
		$url = $request->getUrl();

		// Make sure that we do not create a recursive canonical redirect.
		if ($this->_canonical !== $url && $this->_canonical !== $request->getHostInfo().$url)
			echo '<link rel="canonical" href="'.$this->_canonical.'" />'.PHP_EOL;
	}
}
