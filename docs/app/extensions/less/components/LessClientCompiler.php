<?php
/**
 * LessClientCompiler class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

/**
 * Client-side LESS compiler.
 */
class LessClientCompiler extends LessCompiler
{
	// Compiling environments.
	const ENV_DEVELOPMENT = 'development';
	const ENV_PRODUCTION = 'production';

	// Dump line numbers options.
	const DLN_COMMENTS = 'comments';
	const DLN_MEDIAQUERY = 'mediaQuery';
	const DLN_ALL = 'all';

	/**
	 * @var string compiler environment. Valid values are "development" and "production" (defaults to "production").
	 */
	public $env = self::ENV_PRODUCTION;
	/**
	 * @var boolean whether to load imports asynchronous.
	 */
	public $async = false;
	/**
	 * @var boolean whether to load imports asynchronous when in a page under a file protocol.
	 */
	public $fileAsync = false;
	/**
	 * @var integer when in match mode, time in ms between polls (defaults to 1000).
	 */
	public $poll = 1000;
	/**
	 * @var string whether to dump line numbers. Valid values are "comments", "mediaQuery" and "all".
	 */
	public $dumpLineNumbers;
	/**
	 * @var boolean whether the watch mode should be enabled.
	 */
	public $watch = true;
	/**
	 * @var boolean whether assets should be republished on every request.
	 */
	public $forceCopyAssets = false;

	private $_assetsUrl;

	/**
	 * Initializes the component.
	 * @throws CException if initialization fails.
	 */
	public function init()
	{
		parent::init();

		if (!in_array($this->env, array(self::ENV_DEVELOPMENT, self::ENV_PRODUCTION)))
			throw new CException('Failed to initialize LESS compiler. Property env must be either "development" or "production".');

		if (isset($this->dumpLineNumbers)
				&& !in_array($this->dumpLineNumbers, array(self::DLN_COMMENTS, self::DLN_MEDIAQUERY, self::DLN_ALL)))
			throw new CException('Failed to initialize LESS compiler. Property dumpLineNumber must be "comments", "mediaQuery" or "all".');
	}

	/**
	 * Runs the compiler.
	 * @throws CException if an error occurred.
	 */
	public function run()
	{
		$app = Yii::app();
		foreach ($this->files as $lessFile => $cssFile)
			echo CHtml::linkTag('stylesheet/less', 'text/css', $app->baseUrl . '/' . $lessFile);

		$settings = array(
			'env' => $this->env,
			'async' => $this->async,
			'fileAsync' => $this->fileAsync,
			'poll' => $this->poll,
			'relativeUrls' => $this->relativeUrls,
			'rootpath' => $this->rootPath,
		);

		/* @var $cs CClientScript */
		$cs = $app->getClientScript();
		$cs->registerScript(__CLASS__ . '.settings', 'less = ' . CJSON::encode($settings) . ';', CClientScript::POS_HEAD);
		$cs->registerScriptFile($this->getAssetsUrl().'/less.min.js', CClientScript::POS_END);

		if ($this->watch === true)
			$cs->registerScript(__CLASS__ . '.watch', 'less.watch();', CClientScript::POS_END);
	}

	/**
	 * Returns the URL to the published assets folder.
	 * @return string the URL
	 */
	protected function getAssetsUrl()
	{
		if (isset($this->_assetsUrl))
			return $this->_assetsUrl;
		else
		{
			$path = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'assets';
			$assetsUrl = Yii::app()->assetManager->publish($path, false, -1, $this->forceCopyAssets);
			return $this->_assetsUrl = $assetsUrl;
		}
	}
}
