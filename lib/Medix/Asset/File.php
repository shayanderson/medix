<?php
/**
 * Medix - Media Asset Manager for PHP 5.4+
 * 
 * @package Medix
 * @version 1.0.b - Jan 28, 2014
 * @copyright 2014 Shay Anderson <http://www.shayanderson.com>
 * @license MIT License <http://www.opensource.org/licenses/mit-license.php>
 * @link <http://www.shayanderson.com/projects/medix.htm>
 */
namespace Medix\Asset;

/**
 * Abstract File class
 *
 * @author Shay Anderson 01.14
 */
abstract class File extends \Medix\Asset
{
	/**
	 * File path
	 *
	 * @var string
	 */
	private $__path;

	/**
	 * Init
	 *
	 * @param string $path
	 */
	public function __construct($path)
	{
		$this->__path = $path;
	}

	/**
	 * Asset original value getter
	 *
	 * @return string
	 */
	public function getSource()
	{
		return self::fileRead($this->__path);
	}
}