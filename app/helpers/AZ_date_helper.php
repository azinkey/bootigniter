<?php

/**
 * Bootigniter
 *
 * An Open Source CMS Boilerplate for PHP 5.1.6 or newer
 *
 * @package		Bootigniter
 * @author		AZinkey
 * @copyright   Copyright (c) 2015, AZinkey LLC.
 * @license		http://bootigniter.org/license
 * @link		http://bootigniter.org
 * @Version		Version 1.0
 */
// ------------------------------------------------------------------------

/**
 * Date Helper
 *
 * @package		Helper
 * @subpackage  Date
 * @author		AZinkey
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/**
 * Return very user friendly Date Format
 *
 * @access	public
 * @param	timestamp
 * @param	bool
 * @return	string
 */
if (!function_exists('date_when')) {

    function date_when($timestamp = NULL, $base = NULL) {
        if (strlen($timestamp) < 10)
            return;

        if (empty($base))
            $base = now();

        // Is timestamp in past or future?
        $past = ($base > $timestamp);

        // Create suffix based on past/future
        $suffix = ($past) ? ' ago' : ' from now';

        // Actual time string of timestamp ie 4:54 pm
        $timestr = date('g:i a', $timestamp);

        $diff = abs($timestamp - $base);

        $periods = array('year' => 31536000, 'month' => 2628000, 'day' => 86400, 'hour' => 3600, 'minute' => 60, 'second' => 1);

        // create array holding count of each period

        $out = array();

        foreach ($periods as $period => $seconds) {
            if ($diff > $seconds) {
                $result = floor($diff / $seconds);
                $diff = $diff % $seconds;
                $out[] = array($period, $result);
            }
        }

        // Get largest period, other counts are still in $out for use
        $top = array_shift($out);

        switch ($top[0]) {
            case 'month' :
                $output = $top[1] == 1 ? ( $past ? 'last month' : 'next month' ) : $top[1] . ' months' . $suffix;
                break;
            case 'day' :
                $output = $top[1] == 1 ? ( $past ? 'yesterday' : 'tomorrow' ) . ', ' . $timestr : $top[1] . ' days' . $suffix;
                break;
            case 'hour':
                // Calculate in case, for example if yesterday was only 7 hours ago
                $output = date('j', $base) == date('j', $timestamp) ? 'today, ' . $timestr : (( $past ? 'yesterday' : 'tomorrow' ) . ', ' . $timestr);
                break;
            default :
                $output = $top[1] . ' ' . $top[0] . ( $top[1] > 1 ? 's' : '' ) . $suffix;
                break;
        }


        return ucfirst($output);
    }

}  

/* End of file az_date_helper.php */
/* Location: ./app/helpers/az_date_helper.php */