<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin/partials
 */

function my_uw_stats_options_page_html()
{
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?= esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "my_uw_stats_options"
            settings_fields('my_uw_stats_options');
            // output setting sections and their fields
            // (sections are registered for "my_uw_stats", each field is registered to a specific section)
            do_settings_sections('my_uw_stats');
            // output save settings button
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
