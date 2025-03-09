<?php
/**
 * Plugin Name: Simple Weather Widget
 * Description: Displays the weather report using weatherapi.com for Cambridge city with an option to change the city from the admin panel.
 * Version: 1.1
 * Author: Sandeep Kadam <contact@sandykadam.com>
 * Author URI: https://www.sandykadam.com
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Register settings
function sw_register_settings() {
    add_option('sw_city_name', 'Cambridge');
    register_setting('sw_options_group', 'sw_city_name');
}
add_action('admin_init', 'sw_register_settings');

// Add settings page
function sw_register_options_page() {
    add_options_page('Weather Settings', 'Weather Settings', 'manage_options', 'sw-weather-settings', 'sw_options_page');
}
add_action('admin_menu', 'sw_register_options_page');

// Settings page HTML
function sw_options_page() {
    ?>
    <div class="wrap">
        <h1>Weather Plugin Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('sw_options_group'); ?>
            <label for="sw_city_name">City Name:</label>
            <input type="text" id="sw_city_name" name="sw_city_name" value="<?php echo get_option('sw_city_name'); ?>" />
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Fetch weather data from WeatherAPI.com
function sw_get_weather() {
    $city = get_option('sw_city_name', 'Cambridge');
    $api_key = '9c4dd9d5c7974023b30152503250903';
    $url = "https://api.weatherapi.com/v1/current.json?key=" . $api_key . "&q=" . urlencode($city) . "&aqi=no";

    $response = wp_remote_get($url);
    if (is_wp_error($response)) {
        return 'Unable to fetch weather data.';
    }
    $report = '';
    $data = json_decode(wp_remote_retrieve_body($response), true);
    if (isset($data['current']['temp_c'])) {
        $report = "<b>The current temperature in " . esc_html($city) . " is " . esc_html($data['current']['temp_c']) . "°C.</b>";
    }
    if (isset($data['current']['condition'])) {
        $report .= "<br><i>" . esc_html($data['current']['condition']['text']) . "</i>";
        $report .= "<img src='" . esc_html($data['current']['condition']['icon']) . "'/>";
    }
    if ($report) {
        return $report;
    }
    else {
        return 'Weather data not available.';
    }
}

// Shortcode to display weather
function sw_weather_shortcode() {
    return '<div class="sw-weather">' . sw_get_weather() . '</div>';
}
add_shortcode('weather', 'sw_weather_shortcode');
