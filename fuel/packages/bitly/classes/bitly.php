<?php

namespace Bitly;

class Bitly
{
	private static $api_url = 'https://api-ssl.bitly.com/';

	public static function _init()
	{
		\Config::load('bitly', true);
	}

	/**
	 * http://dev.bitly.com/links.html#v3_expand
	 * 
	 * @param array
	 * 
	 * @example
	 * shortUrl => 'http://bit.ly/1RmnUT',
	 * hash     => '1RmnUT',
	 * 
	 * @return array
	 */
	public static function v3_expand($params)
	{
		$method = 'v3/expand?';
		return self::call($method, $params);
	}

	/**
	 * http://dev.bitly.com/links.html#v3_shorten
	 * 
	 * @param array
	 * 
	 * @example
	 * longUrl => 'http://google.com/',
	 * domain  => 'bit.ly',
	 * 
	 * @return array
	 */
	public static function v3_shorten($params)
	{
		$method = 'v3/shorten?';
		return self::call($method, $params);
	}

	/*******************************************************
	 * Private Methods
	 ******************************************************/
	private static function call($method, $params)
	{
		$url = self::$api_url.$method.http_build_query(
			array_merge(\Config::get('bitly'), $params));

		$res = file_get_contents($url);

		return json_decode($res,true);
	}
}

/* end of file bitly.php */
