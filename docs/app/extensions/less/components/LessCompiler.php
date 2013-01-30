<?php
/**
 * LessCompiler class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

/**
 * Base class for LESS compilers.
 */
abstract class LessCompiler extends CComponent
{
	/**
	 * @var array a list of files to compile (lessPath => cssPath).
	 */
	public $files;
	/**
	 * @var string path to add on to the start of every url resource.
	 */
	public $rootPath;
	/**
	 * @var boolean whether to adjust urls to be relative to the entry less file.
	 */
	public $relativeUrls = false;

	/**
	 * Initializes the component.
	 * @throws CException if initialization fails.
	 */
	public function init()
	{
		if (!is_array($this->files))
			throw new CException('Failed to compile LESS. Property files must be an array.');
	}

	/**
	 * Runs the compiler.
	 */
	abstract public function run();
}
