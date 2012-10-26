<?php

namespace Bitly;

class Bitly
{
	const API_URL = 'https://api-ssl.bitly.com/';
	const STATUS_CODE_OK = '200';

	public static function _init()
	{
		\Config::load('bitly', true);
	}

	/*******************************************************
	 * Utility
	 ******************************************************/
	/**
	 * Expand Short URL.
	 * 
	 * @param string $short_url
	 * 
	 * @return string
	 */
	public static function expand($short_url)
	{
		$ret = static::v3_expand(array('shortUrl' => $short_url));

		if (isset($ret->status_code) && $ret->status_code == static::STATUS_CODE_OK)
		{
			return $ret->data->expand[0]->long_url;
		}

		return false;
	}

	/**
	 * Shorten Long URL.
	 * 
	 * @param string $long_url
	 * 
	 * @return string
	 */
	public static function shorten($long_url)
	{
		$ret = static::v3_shorten(array('longUrl' => $long_url));

		if (isset($ret->status_code) && $ret->status_code == static::STATUS_CODE_OK)
		{
			return $ret->data->url;
		}

		return false;
	}

	/*******************************************************
	 * Version 3 API.
	 ******************************************************/
	/**
	 * Expand
	 * http://dev.bitly.com/links.html#v3_expand
	 * 
	 * @param array $params
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
		return static::api($method, $params);
	}

	/**
	 * Shorten
	 * http://dev.bitly.com/links.html#v3_shorten
	 * 
	 * @param array $params
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
		return static::api($method, $params);
	}

	/*******************************************************
	 * Local
	 ******************************************************/
	/**
	 * Call Bitly API.
	 * 
	 * @param string $method, array $params
	 * 
	 * @return array
	 */
	public static function api($method, $params)
	{
		$url = static::API_URL.$method.http_build_query(
			array_merge(\Config::get('bitly'), $params));

		$res = file_get_contents($url);

		return json_decode($res);
	}
}

/* end of file bitly.php */
