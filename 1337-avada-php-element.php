<?php
/*
Plugin Name: 1337 Avada PHP Element
Description: Avada Fusion Builder element that allows the user to add and execute PHP code.
Version: 1.0
Author: Randal Burger
Author URI: https://shipwr3ck.com
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if (!defined('ABSPATH')) {
    exit;
}

// Load the element only if Fusion Builder exists
function register_avada_php_element() {
    if (function_exists('fusion_builder_map')) {
        fusion_builder_map(
            array(
                'name' => esc_attr__('PHP Code Block', 'avada-php-element'),
                'shortcode' => 'php_code_block',
                'icon' => 'fusiona-code',
                'description' => esc_attr__('Allows adding custom PHP code to pages (only for admins)', 'avada-php-element'),
                'params' => array(
                    array(
                        'type' => 'textarea',
                        'heading' => esc_attr__('PHP Code', 'avada-php-element'),
                        'param_name' => 'php_code',
                        'value' => '',
                        'description' => esc_attr__('Enter your PHP code here. Only administrators can add and execute PHP code.', 'avada-php-element'),
                    ),
                    array(
                        'type' => 'radio_button_set',
                        'heading' => esc_attr__('Execute PHP?', 'avada-php-element'),
                        'param_name' => 'execute_php',
                        'value' => array(
                            'yes' => esc_attr__('Yes', 'avada-php-element'),
                            'no' => esc_attr__('No', 'avada-php-element'),
                        ),
                        'default' => 'no',
                        'description' => esc_attr__('Select whether to execute the PHP code or just display it.', 'avada-php-element'),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_attr__('Custom CSS Class', 'avada-php-element'),
                        'param_name' => 'custom_class',
                        'value' => '',
                        'description' => esc_attr__('Add a custom CSS class for styling.', 'avada-php-element'),
                    ),
                )
            )
        );
    }
}
add_action('fusion_builder_before_init', 'register_avada_php_element');

// Shortcode for executing or displaying the PHP code
function php_code_block_shortcode($atts) {
    // Extract shortcode parameters
    $args = shortcode_atts(
        array(
            'php_code' => '',
            'execute_php' => 'no',
            'custom_class' => ''
        ),
        $atts
    );

    // Restrict PHP execution to administrators only
    if (!current_user_can('administrator')) {
        return esc_html__('You do not have permission to execute PHP code.', 'avada-php-element');
    }

    // Sanitize and display the PHP code as plain text if execution is disabled
    if ($args['execute_php'] === 'no') {
        return '<pre class="' . esc_attr($args['custom_class']) . '">' . esc_html($args['php_code']) . '</pre>';
    }

    // Try executing the PHP code and catching errors
    ob_start();
    try {
        eval($args['php_code']); // Execute the PHP code
    } catch (Throwable $e) {
        return '<div class="php-code-error">' . esc_html__('Error executing PHP code: ', 'avada-php-element') . $e->getMessage() . '</div>';
    }
    return '<div class="' . esc_attr($args['custom_class']) . '">' . ob_get_clean() . '</div>';
}
add_shortcode('php_code_block', 'php_code_block_shortcode');
