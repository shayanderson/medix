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
 * Asset Group class
 *
 * @author Shay Anderson 01.14
 */
abstract class Group extends \Medix\Asset
{
	/**
	 * Asset objects
	 *
	 * @var array (\Medix\Asset)
	 */
	private $__assets = [];

	/**
	 * Init asset objects
	 *
	 * @param \Medix\Asset $asset
	 * @param mixed $_ (optional asset objects)
	 */
	public function __construct(\Medix\Asset $asset, $_ = null)
	{
		foreach(func_get_args() as $asset)
		{
			if($asset instanceof \Medix\Asset)
			{
				$this->__assets[] = $asset;
			}
		}
	}

	/**
	 * Asset value getter
	 *
	 * @return string
	 */
	public function get()
	{
		$out = '';

		foreach($this->__assets as $asset) /* @var $asset \Medix\Asset */
		{
			$out .= $asset->get();
		}

		return $out;
	}

	/**
	 * Asset original value getter
	 *
	 * @return string
	 */
	public function getSource()
	{
		$out = '';

		foreach($this->__assets as $asset) /* @var $asset \Medix\Asset */
		{
			$out .= $asset->getSource();
		}

		return $out;
	}
}