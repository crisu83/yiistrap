<?php
/**
 * SeoRecordBehavior class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

class SeoRecordBehavior extends CActiveRecordBehavior
{
	/**
	 * @property string the route used for SEO.
	 */
	public $route;
	/**
	 * @property array GET parameters used for SEO.
	 */
	public $params = array();

	/**
	 * Returns the URL for this model.
	 * @param array $params additional GET parameters (name=>value)
	 * @return string the URL
	 */
	public function getUrl($params=array())
	{
		return Yii::app()->createUrl($this->route, CMap::mergeArray($params, $this->params));
	}

	/**
	 * Returns the absolute URL for this model.
	 * @param array $params additional GET parameters (name=>value)
	 * @return string the URL
	 */
	public function getAbsoluteUrl($params=array())
	{
		return Yii::app()->createAbsoluteUrl($this->route, CMap::mergeArray($params, $this->params));
	}
}
