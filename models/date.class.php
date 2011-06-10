<?php

/*
 * Author: Quan Van Sinh
 * Email : qvsinh@gmail.com
 * Mobile: 0972405165
 */

class dateFormatter {


    function dateFormatter() {
        return $this;
    }

    /**
     * Get the diff between given timestamp and now
     *
     * @param int $timestamp
     * @param array $formats
     * @return string
     */
    function diff($timestamp, $formats = null) {
        if ($formats == null) {
            $formats = array(
                'DAY' => '%s ngày trước',
                'DAY_HOUR' => '%s ngày %s giờ',
                'HOUR' => '%s giờ trước',
                'HOUR_MINUTE' => '%s giờ %s phút trước',
                'MINUTE' => '%s phút trước',
                'MINUTE_SECOND' => '%s phút %s giây trước',
                'SECOND' => '%s giây trước',
            );
        }
        $seconds = time() - $timestamp;
        $minutes = floor($seconds / 60);
        $hours = floor($minutes / 60);
        $days = floor($hours / 24);

        if ($days > 0) {
            $diffFormat = 'DAY';
        } else {
            $diffFormat = ($hours > 0) ? 'HOUR' : 'MINUTE';
            if ($diffFormat == 'HOUR') {
                $diffFormat .= ( $minutes > 0 && ($minutes - $hours * 60) > 0) ? '_MINUTE' : '';
            } else {
                $diffFormat = (($seconds - $minutes * 60) > 0 && $minutes > 0) ? $diffFormat . '_SECOND' : 'SECOND';
            }
        }

        $dateDiff = null;
        switch ($diffFormat) {
            case 'DAY':
                $dateDiff = sprintf($formats[$diffFormat], $days);
                break;
            case 'DAY_HOUR':
                $dateDiff = sprintf($formats[$diffFormat], $days, $hours - $days * 60);
                break;
            case 'HOUR':
                $dateDiff = sprintf($formats[$diffFormat], $hours);
                break;
            case 'HOUR_MINUTE':
                $dateDiff = sprintf($formats[$diffFormat], $hours, $minutes - $hours * 60);
                break;
            case 'MINUTE':
                $dateDiff = sprintf($formats[$diffFormat], $minutes);
                break;
            case 'MINUTE_SECOND':
                $dateDiff = sprintf($formats[$diffFormat], $minutes, $seconds - $minutes * 60);
                break;
            case 'SECOND':
                $dateDiff = sprintf($formats[$diffFormat], $seconds);
                break;
        }
        return $dateDiff;
    }

}

?>
