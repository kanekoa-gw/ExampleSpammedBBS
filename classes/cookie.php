<?php namespace Example;

class Cookie
{
    // @COOKIE first visit time stamp
    const FIRST_VISIT_TIMESTAMP_COOKIE_NAME = 'cookiename';
    const FIRST_VISIT_TIMESTAMP_COOKIE_EXPIRATION = 70000000;
    const TIMESTAMP_ENCODE_SALT = 'saltsalt';
    const FIRST_VISIT_FILTER_TIME = 14400;

    public static function set_first_visit_timestamp_if_needed()
    {
        $first_visit_timestamp = $_COOKIE[self::FIRST_VISIT_TIMESTAMP_COOKIE_NAME];
        if (empty($first_visit_timestamp)) {
            $first_visit_timestamp = encode(current_timestamp(), self::TIMESTAMP_ENCODE_SALT);
            setcookie(
                self::FIRST_VISIT_TIMESTAMP_COOKIE_NAME,
                $first_visit_timestamp,
                self::FIRST_VISIT_TIMESTAMP_COOKIE_EXPIRATION
            );
        }
    }

    public static function is_past_enabled_time()
    {
        $encoded_timestamp = $_COOKIE[self::FIRST_VISIT_TIMESTAMP_COOKIE_NAME];
        $diff = diff_from_now(decode($encoded_timestamp, self::TIMESTAMP_ENCODE_SALT));
        $is_exist_timestamp = !empty($encoded_timestamp);
        if (!$is_exist_timestamp || $diff < self::FIRST_VISIT_FILTER_TIME) {
            return false;
            } else {
            return true;
        }
    }

    public static function hour_for_filter()
    {
        return self::FIRST_VISIT_FILTER_TIME / 60 / 60;
    }

    public static function get_remaining_time()
    {
        $encoded_timestamp = (self::FIRST_VISIT_TIMESTAMP_COOKIE_NAME);
        $diff = diff_from_now(decode($encoded_timestamp, self::TIMESTAMP_ENCODE_SALT));
        $is_exist_timestamp = !empty($encoded_timestamp);
        return $is_exist_timestamp ? floor((self::FIRST_VISIT_FILTER_TIME - $diff) / 60) : self::FIRST_VISIT_FILTER_TIME / 60;
    }
}