<?php
/**
 * SeoFilter class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

class SeoFilter extends CFilter
{
	/**
	 * Performs the pre-action filtering.
	 * @param CFilterChain $filterChain the filter chain that the filter is on.
	 * @return boolean whether the filtering process should continue and the action
	 * should be executed.
	 */
	protected function preFilter($filterChain)
	{
		$controller = $filterChain->controller;

		if (isset($_GET['id']) && method_exists($controller, 'loadModel'))
		{
			$model = $controller->loadModel($_GET['id']);
			$url = $model->getUrl();

			if (strpos(Yii::app()->request->getRequestUri(), $url) === false)
				$controller->redirect($url, true, 301);
		}

		return parent::preFilter($filterChain);
	}
}
