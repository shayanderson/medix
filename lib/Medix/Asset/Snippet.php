<?php
/**
 * Medix - Media Asset Manager for PHP 5.4+
 * 
 * @package Medix
 * @version 1.0.b - Jan 29, 2014
 * @copyright 2014 Shay Anderson <http://www.shayanderson.com>
 * @license MIT License <http://www.opensource.org/licenses/mit-license.php>
 * @link <http://www.shayanderson.com/projects/medix.htm>
 */
namespace Medix\Asset;

/**
 * Abstract Snippet class
 *
 * @author Shay Anderson 01.14
 */
abstract class Snippet extends \Medix\Asset
{
	/**
	 * Snippet
	 *
	 * @var string
	 */
	private $__snippet;

	/**
	 * Init
	 *
	 * @param string $snippet
	 */
	public function __construct($snippet)
	{
		$this->__snippet = $snippet;
	}

	/**
	 * Asset original value getter
	 *
	 * @return string
	 */
	public function getSource()
	{
		return $this->__snippet;
	}
}