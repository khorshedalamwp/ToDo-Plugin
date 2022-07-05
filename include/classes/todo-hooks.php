<?php
/**
 * TODO Hooks
 */

defined( 'ABSPATH' ) || exit;

class ToDo_Hooks {
	function __construct() {

		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_custom_taxonomies' ) );
		add_action( 'add_meta_boxes', array( $this, 'todo_register_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_post_metadata' ) );
		add_action( 'admin_menu', array(&$this, 'register_sub_menu') );
	}


	/**
	 * @return void
	 */
	public function register_post_types() {
		register_post_type( 'ToDos',
			array(
				'labels'    => array(
					'name'          => esc_html__( 'ToDos', 'td_creator' ),
					'singular_name' => esc_html__( 'ToDos', 'td_creator' ),
				),
				'menu_icon' => 'dashicons-chart-bar',
				'public'    => true,
				'supports'  => array( 'title', 'thumbnail', 'editor' ),
			) );
	}


	/**
	 * @return void
	 */
	public function register_custom_taxonomies() {
		register_taxonomy( 'todo_category', 'todos', array(
			"hierarchical"   => true,
			"label"          => "todo_category",
			"singular_label" => "todo_category",
			'public'         => true,
		) );
	}



	/**
	 * @param $post_type
	 *
	 * @return void
	 */
	public function todo_register_meta_boxes( $post_type ) {
		add_meta_box( 'meta_id', __( 'ToDo Metadata', 'td_creator' ),
            array( $this, 'todo_custom_meta_field' ),
            $post_type, 'advanced', 'core' );
	}



	/**
	 * @param WP_Post $post
	 *
	 * @return void
	 */
	public function todo_custom_meta_field( WP_Post $post ) {
		$data = get_post_meta( $post->ID, 'todo_id', true );

		?>
        <form action="" method="post">
            <label for="dificulty">Difficulty Level :</label>
            <select name="selected" id="dificulty">
                <option <?php  selected( $data, 'Select Level' ); ?> value="Select Level">Select Level</option>
                <option <?php  selected( $data, 'good' ); ?> value="good">Good</option>
                <option <?php  selected( $data, 'better' ); ?> value="better">Better</option>
                <option <?php  selected( $data, 'best' ); ?> value="best">Best</option>
            </select>
        </form>
      <?php }



	/**
	 * @param $post_id
	 *
	 * @return void
	 */
	public function save_post_metadata( $post_id ) {
		$posted_data = wp_unslash( $_POST['selected'] );
		update_post_meta( $post_id, 'todo_id', $posted_data );
	}



	/**
	 * Register submenu
	 * @return void
	 */
	public function register_sub_menu() {
		add_submenu_page(
			'edit.php?post_type=todos', 'Settings', 'Settings', 'manage_options', 'post-type', array($this, 'submenu_page_callback')
		);
	}


	public function submenu_page_callback(){
        ?>   
		<h2>Settings</h2>
		<?php
    }

}

new ToDo_Hooks();