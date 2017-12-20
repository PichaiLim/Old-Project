<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
@include '../config_database.inc.php';
class lnwphp_config
{

    public static $dbname = DATABASE_NAME;
    public static $dbuser = DATABASE_USER;
    public static $dbpass = DATABASE_PASS;
    public static $dbhost = DATABASE_HOST;

    public static $theme = 'bootstrap';
    public static $language = 'th';
    public static $is_rtl = false;

    public static $dbencoding = 'utf8';
    public static $db_time_zone = '';
    public static $mbencoding = 'utf-8';
    public static $dbprefix = '';

    public static $sess_name = 'PHPSESSID';
    public static $sess_expire = 30;
    public static $dynamic_session = false;

    public static $alt_session = false;
    public static $alt_encription_key = 'lnwphpthailand';
    public static $alt_lifetime = 30;
    public static $mc_host = 'localhost';
    public static $mc_port = 11211;

    public static $load_bootstrap = false;
    public static $load_googlemap = true;
    public static $load_jquery = true;
    public static $load_jquery_ui = true;
    public static $load_jcrop = true;
    public static $jquery_no_conflict = false;
    public static $manual_load = false;


    public static $editor_url = 'editors/ckeditor/ckeditor.js';
    public static $editor_init_url = '';
    public static $force_editor = false;
    public static $auto_editor_insertion = true;

    public static $show_primary_ai_field = false;
    public static $show_primary_ai_column = false;
    public static $start_minimized = false;
    public static $remove_confirm = true;
    public static $column_cut = 50;
    public static $limit = 5;
    public static $limit_list = array('20', '50', '100', 'all');
    public static $clickable_list_links = true;
    public static $clickable_filenames = true;
    public static $fixed_action_buttons = true;
    public static $images_in_grid = true;
    public static $images_in_grid_height = 55;
    public static $button_labels = false;
    public static $strip_tags = true;
    public static $safe_output = false;

    public static $print_all_fields = false;

    public static $csv_delimiter = ';';
    public static $csv_enclosure = '"';
    public static $csv_all_fields = true;

    public static $make_checkbox = true;
    public static $lists_null_opt = true;
    public static $enum_as_radio = false;
    public static $set_as_checkboxes = false;
    public static $upload_folder_def = '../image';

    public static $enable_printout = true;
    public static $enable_search = true;
    public static $enable_pagination = true;
    public static $enable_csv_export = true;
    public static $enable_table_title = true;
    public static $enable_numbers = true;
    public static $enable_limitlist = true;
    public static $enable_sorting = true;
    public static $benchmark = false;
    public static $nested_readonly_on_view = true;
    public static $default_tab = false;
    public static $nested_in_tab = true;

    public static $email_from = 'benzbenz900@gmail.com';
    public static $email_from_name = 'lnwPHP lnwphp Data Management System';
    public static $email_enable_html = true;

    public static $use_browser_info = false;

    public static $date_first_day = 1;
    public static $date_format = 'dd.mm.yy';
    public static $time_format = 'HH:mm:ss';
    public static $php_date_format = 'd.m.Y';
    public static $php_time_format = 'H:i:s';

    public static $search_all = true;
    public static $available_date_ranges = array(
        'next_year',
        'next_month',
        'today',
        'this_week_today',
        'this_week_full',
        'last_week',
        'last_2weeks',
        'this_month',
        'last_month',
        'last_3months',
        'last_6months',
        'this_year',
        'last_year');
    public static $search_pattern = array('%','%');
    public static $search_opened = false;

    public static $default_point = '19.17897652955378,100.7735538482666';
    public static $default_text = 'lnwPHP.in.th';
    public static $default_zoom = 15;
    public static $default_width = 500;
    public static $default_height = 300;
    public static $default_coord = true;
    public static $default_search = true;
    public static $default_search_text = 'ค้นหาเลย';

    public static $scripts_url = '';
    public static $urls2abs = true;


    public static $plugins_uri = 'plugins';
    public static $themes_uri = 'themes';
    public static $lang_uri = 'languages';
    public static $ajax_uri = 'lnwphp_ajax.php';

    public static $themes_path = 'themes';
    public static $lang_path = 'languages';

    public static $external_session = false;

    public static $before_construct = false;
    public static $after_render = false;

    public static $demo_mode = false;
    public static $performance_mode = false;
    public static $autoclean_timeout = 3;

    public static $auto_xss_filtering = true;
    public static $xss_disalowed_attibutes = array('on\w*',  'xmlns', 'formaction');
    public static $xss_naughty_html = 'alert|applet|audio|basefont|base|behavior|bgsound|blink|body|embed|expression|form|frameset|frame|head|html|ilayer|iframe|input|isindex|layer|link|meta|object|plaintext|script|textarea|title|video|xml|xss';
    public static $xss_naughty_scripts = 'alert|cmd|passthru|eval|exec|expression|system|fopen|fsockopen|file|file_get_contents|readfile|unlink';
    

}
