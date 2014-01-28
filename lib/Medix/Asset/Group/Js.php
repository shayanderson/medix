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
namespace Medix\Asset\Group;

/**
 * JavaScript Group class
 *
 * @author Shay Anderson 01.14
 */
class Js extends \Medix\Asset\Group
{
	/**
	 * Asset HTML tag getter
	 *
	 * @return string
	 */
	public function getHtml()
	{
		$this->_type = parent::TYPE_JS;
		return parent::getHtml();
	}
}