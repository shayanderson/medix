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
namespace Medix;

/**
 * Abstract Filter class
 *
 * @author Shay Anderson 01.14
 */
abstract class Filter
{
	/**
	 * Apply filter to asset value
	 *
	 * @return void
	 */
	abstract public function apply(&$input);
}