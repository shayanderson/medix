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
namespace Medix\Filter\Minify;

/**
 * Minify CSS class
 *
 * @author Shay Anderson 01.14
 */
class Css extends \Medix\Filter
{
	/**
	 * Apply filter to asset value
	 *
	 * @return void
	 */
	public function apply(&$input)
	{
		$input = preg_replace('/\/\*[^*]*\*+([^\/][^*]*\*+)*\//', '', $input); // comments
		$input = str_replace(["\r\n", "\r", "\t", "\n", '  ', '   ', '    ', '     '], '', $input); // whitespaces
		$input = preg_replace(['(\s+{)','({\s+)'], '{', $input); // whitespaces by '{'
		$input = preg_replace(['(\s+})','(}\s+)','(;\s*})'], '}', $input); // whitespaces by '}'
		$input = preg_replace(['(;\s+)','(\s+;)'], ';', $input); // whitespace by ';'
	}
}