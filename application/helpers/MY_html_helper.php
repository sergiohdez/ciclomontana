<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('script_tag'))
{
	/**
	 * Generates script to a JS file
	 *
	 * @param	mixed	scripts src or an array
	 * @param	string	type
	 * @param	bool	is the script an external source
	 * @param	bool	defer
	 * @param	string	charset
	 * @param	bool	async (HTML5)
	 * @return	string
	 */
	function script_tag($src = '', $type = 'text/javascript', $external_page = FALSE, $defer = FALSE, $charset = '', $async = FALSE)
	{
		$CI =& get_instance();
		$link = '<script ';

		if (is_array($src))
		{
			foreach ($src as $k => $v)
			{
				if ($k === 'src' && ! preg_match('#^([a-z]+:)?//#i', $v))
				{
					if ($external_page === TRUE)
					{
						$link .= 'src="'.$v.'" ';
					}
					else
					{
						$link .= 'src="'.$CI->config->slash_item('base_url').$v.'" ';
					}
				}
				else
				{
					$link .= $k.'="'.$v.'" ';
				}
			}
		}
		else
		{
			if (preg_match('#^([a-z]+:)?//#i', $src))
			{
				$link .= 'src="'.$src.'" ';
			}
			elseif ($external_page === TRUE)
			{
				$link .= 'src="'.$src.'" ';
			}
			else
			{
				$link .= 'src="'.$CI->config->slash_item('base_url').$src.'" ';
			}

			$link .= 'type="'.$type.'" ';

			if ($defer !== FALSE)
			{
				$link .= 'defer ';
			}

			if ($charset !== '')
			{
				$link .= 'charset="'.$charset.'" ';
			}

			if ($async !== FALSE)
			{
				$link .= 'async ';
			}
		}

		return $link."></script>\n";
	}
}