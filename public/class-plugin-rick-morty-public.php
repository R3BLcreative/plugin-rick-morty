<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://r3blcreative.com
 * @since      1.0.0
 *
 * @package    Plugin_Rick_Morty
 * @subpackage Plugin_Rick_Morty/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Plugin_Rick_Morty
 * @subpackage Plugin_Rick_Morty/public
 * @author     James Cook - R3BL Creative <jcook@r3blcreative.com>
 */
class Plugin_Rick_Morty_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Rick_Morty_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Rick_Morty_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		// wp_register_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/plugin-rick-morty-public.css', array(), filemtime(plugin_dir_path(__FILE__) . 'css/plugin-rick-morty-public.css'), 'all');

		wp_register_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/plugin-rick-morty-public.css', array(), filemtime(plugin_dir_path(__FILE__) . 'css/plugin-rick-morty-public.css'), 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Rick_Morty_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Rick_Morty_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/plugin-rick-morty-public.js', array(), filemtime(plugin_dir_path(__FILE__) . 'js/plugin-rick-morty-public.js'), false);

		wp_register_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/plugin-rick-morty-public.js', array(), filemtime(plugin_dir_path(__FILE__) . 'js/plugin-rick-morty-public.js'), false);
	}

	/**
	 * Register the Shortcodes for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function register_shortcodes() {
		add_shortcode('rick-n-morty', [$this, 'sc_rick_morty_list']);
	}

	/**
	 * Adds custom pagination query vars to WP Query.
	 *
	 * @since    1.0.0
	 */
	public function add_query_vars($qvars) {
		$qvars[] = 'rm_pg';
		return $qvars;
	}

	/**
	 * Register the Shortcodes for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function sc_rick_morty_list($atts, $content = null) {
		global $post;

		wp_enqueue_style('plugin-rick-morty');

		// extract(shortcode_atts([
		// 	'character'	=> 'default'
		// ], $atts));

		$response = $this->rick_morty_api();
		if (is_object($response)) {
			$characters = $response->data->characters->results;
			$pages = $response->data->characters->info->pages;
			$page = get_query_var('rm_pg', '1');
		} else {
			$error = $response;
		}

		ob_start();
		include(plugin_dir_path(__FILE__) . 'partials/list.php');
		return ob_get_clean();
	}

	/**
	 * Make the API call.
	 *
	 * @since    1.0.0
	 */
	private function rick_morty_api() {
		$ep = 'https://rickandmortyapi.com/graphql';
		$page = get_query_var('rm_pg', '1');

		$query = '
		query {
			characters(page: ' . $page . ', filter: {status: "dead"}) {
				info {
					pages
				},
				results {
					image,
					name,
					status,
					created
				}
			}
		}
		';

		$data = ['query' => $query];
		$data = http_build_query($data);
		$options = [
			'http' => [
				'method' => 'POST',
				'content' => $data,
			]
		];

		$context = stream_context_create($options);
		$result = @file_get_contents($ep, false, $context);

		$error = ($result === false) ? 'There was an error with the API call' : false;

		return ($error) ? $error : json_decode($result);
	}
}
