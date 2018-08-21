<?php

/**
 * Provide pages for the plugin
 *
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin/includes
 */

class my_uw_stats_admin_pages {

    static private $class = null;

    private $submenus = [
        [
            "parent" => "my_uw_stats",
            "page_title" => "My Upwork Statistics",
            "menu_title" => "Options",
            "slug" => "my_uw_stats_options",
        ]
    ];

    public static function init(){
        if (null===self::$class){
            self::$class = new self;
        }
        return self::$class;
    }

    public function __construct(){
        $this->my_uw_stats_main_page();
        $this->my_uw_stats_sub_page();
    }

    public function my_uw_stats_main_page() {
        add_menu_page(
            'My Upwork Statistics',
            'Upwork Statistics',
            'manage_options',
            'my_uw_stats',
            array('my_uw_stats_admin_display', 'init')
            );

    }

    public function my_uw_stats_sub_page() {
        
        foreach ($this->submenus as $value) {

        add_submenu_page(
            $value["parent"],
            $value["page_title"],
            $value["menu_title"],
            'manage_options',
            $value["slug"],
            array($value["slug"], "init")
        );
        }
    }

}
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
