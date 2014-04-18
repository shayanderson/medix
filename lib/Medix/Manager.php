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
namespace Medix;

/**
 * Manager class
 *
 * @author Shay Anderson 01.14
 */
class Manager
{
	/**
	 * Assets
	 *
	 * @var array (\Medix\Asset)
	 */
	private static $__assets = [];

	/**
	 * Asset getter
	 *
	 * @param string $tag
	 * @return \Medix\Asset
	 */
	private static function &__getAsset($tag)
	{
		if(self::__isAsset($tag))
		{
			return self::$__assets[$tag];
		}
	}

	/**
	 * Asset exists flag getter
	 *
	 * @param string $tag
	 * @return boolean
	 * @throws \OutOfBoundsException
	 */
	private static function __isAsset($tag)
	{
		if(!self::__isTag($tag))
		{
			throw new \OutOfBoundsException('Asset with tag "' . $tag . '" does not exist');
		}

		return true;
	}

	/**
	 * Tag exists flag getter
	 *
	 * @param string $tag
	 * @return boolean
	 */
	private static function __isTag($tag)
	{
		return isset(self::$__assets[$tag]);
	}

	/**
	 * Register asset object with tag
	 *
	 * @param string $tag
	 * @param \Medix\Asset $asset
	 * @throws \Exception
	 */
	public static function asset($tag, \Medix\Asset &$asset)
	{
		$tag = trim($tag);

		if(self::__isTag($tag)) // enforce unique tag
		{
			throw new \Exception('Tag "' . $tag . '" already exists for asset');
		}

		$asset->setId(md5($tag)); // init cache ID

		self::$__assets[$tag] = &$asset;
	}

	/**
	 * Delete global caches
	 *
	 * @return int (number of caches deleted)
	 */
	public static function cacheFlush()
	{
		$i = 0;

		$cache = self::globalCache(null, null);

		$caches = glob($cache['path'] . '*');

		foreach($caches as $c)
		{
			if(is_file($c))
			{
				$i += @unlink($c) ? 1 : 0;
			}
		}

		return $i;
	}

	/**
	 * Asset value getter
	 *
	 * @param string $tag
	 * @return string
	 */
	public static function get($tag)
	{
		return self::__getAsset($tag)->get();
	}

	/**
	 * Asset objects getter
	 *
	 * @return array
	 */
	public static function getAssets()
	{
		return self::$__assets;
	}

	/**
	 * Asset original value getter
	 *
	 * @param string $tag
	 * @return string
	 */
	public static function getSource($tag)
	{
		return self::__getAsset($tag)->getSource();
	}

	/**
	 * Global cache settings getter/setter
	 *
	 * @staticvar array $cache
	 * @param string $cache_path (ex: './skin/medix')
	 * @param string $cache_base_url (ex: 'skin/medix')
	 * @param type $cache_expire_seconds (set expire = 0 for forced caching)
	 * @return array|null (array on getter, null on setter)
	 * @throws \Exception
	 */
	public static function globalCache($cache_path, $cache_base_url, $cache_expire_seconds = 60,
		$use_browser_cache_control = false)
	{
		static $cache = [
			'path' => null,
			'url' => null,
			'expire' => null,
			'browser' => false
		];

		if($cache_path === null && $cache_base_url === null) // getter
		{
			if(empty($cache['path']) || empty($cache['url']))
			{
				throw new \Exception('Empty global cache path and/or URL values');
			}

			return $cache;
		}

		// setter
		$cache['path'] = rtrim($cache_path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
		$cache['url'] = rtrim($cache_base_url, '/') . '/';
		$cache['expire'] = (int)$cache_expire_seconds;
		$cache['browser'] = $use_browser_cache_control;
	}

	/**
	 * Global minify flag getter/setter
	 *
	 * @staticvar boolean $is_auto_minify
	 * @param boolean $auto_minify
	 * @return boolean|null (boolean on getter, null on setter)
	 */
	public static function globalMinify($auto_minify = true)
	{
		static $is_auto_minify = true;

		if($auto_minify === null) // getter
		{
			return $is_auto_minify;
		}

		$is_auto_minify = $auto_minify; // setter
	}

	/**
	 * Asset HTML tag getter
	 *
	 * @param string $tag
	 * @return string
	 */
	public static function import($tag)
	{
		return self::__getAsset($tag)->getHtml();
	}
}