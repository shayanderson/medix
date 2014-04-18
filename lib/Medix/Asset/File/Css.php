<?php
/**
 * Medix - Media Asset Manager for PHP 5.4+
 * 
 * @package Medix
 * @version 1.0 - Apr 18, 2014
 * @copyright 2014 Shay Anderson <http://www.shayanderson.com>
 * @license MIT License <http://www.opensource.org/licenses/mit-license.php>
 * @link <http://www.shayanderson.com/projects/medix.htm>
 */
namespace Medix\Asset\File;

/**
 * CSS File class
 *
 * @author Shay Anderson 01.14
 */
class Css extends \Medix\Asset\File
{
	/**
	 * Init
	 *
	 * @param string $path
	 */
	public function __construct($path)
	{
		parent::__construct($path);
		$this->_type = parent::TYPE_CSS;
	}
}