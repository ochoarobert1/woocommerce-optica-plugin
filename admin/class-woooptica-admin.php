<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WooOptica
 * @subpackage WooOptica/admin
 * @author     Robert Ochoa <contacto@robertochoaweb.com>
 */
class WooOptica_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $woooptica    The ID of this plugin.
     */
    private $woooptica;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $woooptica       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($woooptica, $version)
    {
        $this->woooptica = $woooptica;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->woooptica, plugin_dir_url(__FILE__) . 'css/woooptica-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script($this->woooptica, plugin_dir_url(__FILE__) . 'js/woooptica-admin.js', array( 'jquery' ), $this->version, false);
    }

    /**
     * Register a custom data tab for Woocommerce
     *
     * @param $product_data_tabs $product_data_tabs [array]
     * @since    1.0.0
     *
     */
    public function custom_product_data_tab_handler($product_data_tabs)
    {
        // Modify product data tabs array
        $product_data_tabs['optica-tab'] = array(
            'label'     => __('Datos de Lentes', 'woo-optica'),
            'target'    => 'custom_optica_product_data',
            'priority'  => 15,
            'class'     => array( 'show_if_simple', 'show_if_variable' ),
        );

        return $product_data_tabs;
    }

    /**
     * Add custom data to tab for Woocommerce
     *
     * @param   null
     * @since   1.0.0
     *
     */
    public function custom_product_data_fields()
    {
        global $post;
        ob_start(); ?>
<div id='custom_optica_product_data' class='panel woocommerce_options_panel'>
    <div class='options_group'>
        <?php

        // Get an array of product attribute taxonomies slugs
        $attributes_tax_slugs = array_keys(wc_get_attribute_taxonomy_labels());

        // Get an array of product attribute taxonomies names (starting with "pa_")
        $attributes_tax_names = array_filter(array_map('wc_attribute_taxonomy_name', $attributes_tax_slugs));

        $data_select = array();
        foreach ($attributes_tax_slugs as $key => $value) {
            $data_select[$attributes_tax_names[$key]] = $value;
        }
        
        woocommerce_wp_text_input(
            array(
              'id' => '_select_attributes',
              'label' => __('Selecciona las características de los lentes a usar', 'woooptica'),
              'options' => $data_select
            )
        ); ?>
        </div>
</div>
<?php
        $content = ob_get_clean();
        echo $content;
    }

    /**
     * Saving custom data to product
     *
     * @param   $post_id [Integer]
     * @since   1.0.0
     *
     */
    public function save_custom_data_fields($post_id)
    {
        // Save Text Field
        $text_field = $_POST['_text_field'];
        if (!empty($text_field)) {
            update_post_meta($post_id, '_text_field', esc_attr($text_field));
        }
    
        // Save Number Field
        $number_field = $_POST['_number_field'];
        if (!empty($number_field)) {
            update_post_meta($post_id, '_number_field', esc_attr($number_field));
        }
        // Save Textarea
        $textarea = $_POST['_textarea'];
        if (!empty($textarea)) {
            update_post_meta($post_id, '_textarea', esc_html($textarea));
        }
    
        // Save Select
        $select = $_POST['_select'];
        if (!empty($select)) {
            update_post_meta($post_id, '_select', esc_attr($select));
        }
    
        // Save Checkbox
        $checkbox = isset($_POST['_checkbox']) ? 'yes' : 'no';
        update_post_meta($post_id, '_checkbox', $checkbox);
    
        // Save Hidden field
        $hidden = $_POST['_hidden_field'];
        if (!empty($hidden)) {
            update_post_meta($post_id, '_hidden_field', esc_attr($hidden));
        }
    }
}
