<?php

function restrict_rest_api_to_localhost()
{

    $whitelist = ['127.0.0.1', "::1", '170.79.54.73'];

    if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
        die('REST API is disabled for you thanks.');
    }
}

add_action('rest_api_init', 'restrict_rest_api_to_localhost', 0);

function theme_support()
{
    register_nav_menus(array(
        'primary' => __('Header'),
        'secondary' => __('Footer'),
    ));

    add_theme_support('post-thumbnails');

    // Custom logo.
    $logo_width  = 120;
    $logo_height = 90;

    // If the retina setting is active, double the recommended width and height.
    if (get_theme_mod('retina_logo', false)) {
        $logo_width  = floor($logo_width * 2);
        $logo_height = floor($logo_height * 2);
    }

    add_theme_support(
        'custom-logo',
        array(
            'height'      => $logo_height,
            'width'       => $logo_width,
            'flex-height' => true,
            'flex-width'  => true,
        )
    );
}
add_action('init', 'theme_support');

add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init()
{
    // Check function exists.
    if (function_exists('acf_add_options_page')) {

        // Register options page.
        $option_page = acf_add_options_page(array(
            'page_title'    => __('Configurações do Tema'),
            'menu_title'    => __('Configurações do Tema'),
            'menu_slug'     => 'configuracoes-do-tema',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));
    }
}


function my_function_admin_bar()
{
    return false;
}
add_filter('show_admin_bar', 'my_function_admin_bar');



// Desabilita widgets

function remove_widget()
{

    unregister_widget('WP_Widget_Calendar');            // Agenda
    unregister_widget('WP_Widget_Archives');            // Arquivos
    unregister_widget('WP_Widget_Links');               // Links
    unregister_widget('WP_Widget_Media_Audio');         // Audio Player Media Widget
    unregister_widget('WP_Widget_Media_Image');         // Image Media Widget
    unregister_widget('WP_Widget_Media_Video');        // Video Media Widget
    unregister_widget('WP_Widget_Media_Gallery');       // Gallery Media Widget
    unregister_widget('WP_Widget_Meta');                // Meta
    unregister_widget('WP_Widget_Pages');               // Páginas
    unregister_widget('WP_Widget_Search');              // Pesquisar
    unregister_widget('WP_Widget_Text');                // Texto
    unregister_widget('WP_Widget_Categories');          // Categorias
    unregister_widget('WP_Widget_Recent_Posts');        // Tópicos recentes
    unregister_widget('WP_Widget_Recent_Comments');     // Comentários
    unregister_widget('WP_Widget_RSS');                 // RSS
    unregister_widget('WP_Widget_Tag_Cloud');           // Nuvem de tags
    unregister_widget('WP_Nav_Menu_Widget');            // Menu personalizado
    unregister_widget('WP_Widget_Custom_HTML');         // Custom HTML Widget


}

add_action('widgets_init', 'remove_widget');
