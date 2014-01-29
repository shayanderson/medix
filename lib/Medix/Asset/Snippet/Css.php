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
namespace Medix\Asset\Snippet;

/**
 * CSS Snippet class
 *
 * @author Shay Anderson 01.14
 */
class Css extends \Medix\Asset\Snippet
{
	/**
	 * Init
	 *
	 * @param string $snippet
	 */
	public function __construct($snippet)
	{
		parent::__construct($snippet);
		$this->_type = parent::TYPE_CSS;
	}
}