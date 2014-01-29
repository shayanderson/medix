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
namespace Medix;

use Medix\Manager;

/**
 * Abstract Asset class
 *
 * @author Shay Anderson 01.14
 */
abstract class Asset
{
	/**
	 * Types
	 */
	const TYPE_CSS = 0;
	const TYPE_JS = 1;

	/**
	 * Asset filters objects
	 *
	 * @var array (\Medix\Filter)
	 */
	private $__filters = [];

	/**
	 * Internal ID (used in cache filename)
	 *
	 * @var string
	 */
	private $__id;

	/**
	 * Asset type
	 *
	 * @var int
	 */
	protected $_type;

	/**
	 * Apply filters to asset value
	 *
	 * @param string $value
	 * @return string
	 */
	final protected function &_applyFilters($value)
	{
		if(count($this->__filters) < 1 && Manager::globalMinify(null)) // auto minify
		{
			switch($this->_type)
			{
				case self::TYPE_CSS:
					$this->filter(new \Medix\Filter\Minify\Css);
					break;

				case self::TYPE_JS:
					$this->filter(new \Medix\Filter\Minify\Js);
					break;
			}
		}

		foreach($this->__filters as $filter) /* @var $filter \Medix\Filter */
		{
			$filter->apply($value);
		}

		return $value;
	}

	/**
	 * Cache asset file
	 *
	 * @param string $file_ext
	 * @return string (URL, ex: '/skin/js/c1d2f3aa83zc46b9d6898c851571b889.js')
	 */
	public function fileCache($file_ext)
	{
		$cache = Manager::globalCache(null, null);

		$file = $cache['path'] . $this->getId() . $file_ext;

		if($cache['expire'] === 0 || @filemtime($file) < (time() - $cache['expire'])) // cache file
		{
			self::fileWrite($file, $this->get());
		}

		return $cache['url'] . $this->getId() . $file_ext
			// browser cache control
			. ( $cache['browser'] ? '?' . substr(md5_file($cache['path'] . $this->getId() . $file_ext), 0, 8) : '' );
	}

	/**
	 * File contents getter
	 *
	 * @param string $path
	 * @return string
	 * @throws \Exception
	 */
	public static function fileRead($path)
	{
		if(!is_readable($path))
		{
			throw new \Exception('File "' . $path . '" does not exist (or is not readable)');
		}

		return file_get_contents($path);
	}

	/**
	 * File contents setter
	 *
	 * @param string $path
	 * @param string $data
	 * @return void
	 * @throws \Exception
	 */
	public static function fileWrite($path, $data)
	{
		if(@file_put_contents($path, $data) === false)
		{
			throw new \Exception('Failed to write file "' . $path . '"');
		}
	}

	/**
	 * Add filter
	 *
	 * @param \Medix\Filter $filter
	 * @return void
	 */
	final public function filter(\Medix\Filter &$filter)
	{
		$this->__filters[] = &$filter;
	}

	/**
	 * Asset value getter
	 *
	 * @return string
	 */
	public function get()
	{
		return $this->_applyFilters($this->getSource());
	}

	/**
	 * Asset HTML tag getter
	 *
	 * @return string
	 */
	public function getHtml()
	{
		switch($this->_type)
		{
			case self::TYPE_CSS:
				return '<link rel="stylesheet" type="text/css" href="' . $this->fileCache('.css') . '">';
				break;

			case self::TYPE_JS:
				return '<script src="' . $this->fileCache('.js') . '"></script>';
				break;
		}
	}

	/**
	 * Asset ID getter
	 *
	 * @return string
	 */
	final public function getId()
	{
		return $this->__id;
	}

	/**
	 * Asset original value getter
	 *
	 * @return string
	 */
	abstract public function getSource();

	/**
	 * Asset ID setter
	 *
	 * @param string $id
	 * @return void
	 */
	public function setId($id)
	{
		if(empty($this->__id)) // init once
		{
			$this->__id = $id;
		}
	}
}