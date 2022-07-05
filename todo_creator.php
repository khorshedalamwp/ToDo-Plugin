<?php
/**
 * Plugin Name:ToDo Creator
 * Plugin URI: https://pluginbazar.com/plugin/visitors
 * Description: This plugins for count websites visitors.
 * Version: 1.0.0
 * Author: Pluginbazar
 * Text Domain: td_creator
 * Domain Path: /languages/
 * Author URI: https://pluginbazar.com/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

defined( 'ABSPATH' ) || exit;

defined( 'TODO_FILE_DIR' ) || define( 'TODO_FILE_DIR', plugin_dir_path( __FILE__ ) . '/' );
defined( 'TODO_FILE_URL' ) || define( 'TODO_FILE_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );


class ToDo_Main{
    function __construct(){
        require TODO_FILE_DIR . 'include/classes/todo-hooks.php';
        require TODO_FILE_DIR . 'include/functions.php';
        require TODO_FILE_DIR . 'include/classes/metadata.php';
	    add_action( 'wp_enqueue_scripts', array( $this, 'add_frontend_scripts' ) );
    }
	function add_frontend_scripts(){
		wp_enqueue_style( 'todo-creator-front', TODO_FILE_URL . 'assets/front/css/style.css', array(), time() );
		wp_enqueue_script( 'todo-creator-front', TODO_FILE_URL . 'assets/front/js/scripts.js', array( 'jquery' ), time() );
		wp_localize_script('todo-creator-front','todo_creator',array(
			'ajaxURL'             => admin_url( 'admin-ajax.php' ),
		));
	}

}

new ToDo_Main();
