<?php
/*
 * Plugin Name: Custom Settings
	Plugin URL:
	Description: Demo of Plugin setting Option
	Version: 1.0
	Author: osman forhad
	Author URI: https://osmanforhad.net
	License: GPLv2 or later
	Text Domain:settingsoption
	Domain Path: /languages/
 * */

class customOption {

	/*constructor*/
	public function __construct() {

	    //action hook
		add_action( 'plugin_loaded', array( $this, 'settingsoption_load_text_domain' ) );
		add_action( 'admin_menu', array( $this, 'settingsoption_create_settings' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'settingsoption_assets' ) );

		//setting hook
		add_action( 'admin_init', array( $this, 'settingsoption_setup_sections' ) );
		add_action( 'admin_init', array( $this, 'settingsoption_setup_fields' ) );

	}//end constructor

	/*Load text domain*/
	public function settingsoption_load_text_domain() {

		load_plugin_textdomain(
			'settingsoption',
			'false',
			dirname( __FILE__ ) . "/languages"
		);

	}//end load text domain

	/*load assets*/
	public function settingsoption_assets() {

		$page = isset( $_REQUEST['page'] ) ? esc_attr( wp_unslash( $_REQUEST['page'] ) ) : '';

		if ( $page == 'settingsoption' ) {
			wp_register_script(
				'customscript-js',
				plugins_url( '/assets/js/customscript.js',
					__FILE__ ),
				array( 'jquery' ), '1.0', true );

			wp_enqueue_script( 'jquery' );
			wp_enqueue_media();
			wp_enqueue_script( 'customscript-js' );
		}

		//write_log( 'settingsoption_assets' );

	}//end load assets

	/*initial setting*/
	public function settingsoption_create_settings() {

		$page_title = esc_html__( 'Custom Setting', 'settingsoption' );
		$menu_title = esc_html__( 'Custom Setting', 'settingsoption' );
		$capability = 'manage_options';
		$slug       = 'settingsoption';
		$callback   = array( $this, 'settingsoption_settings_content' );

		//add submenu to setting menu
		add_options_page( $page_title, $menu_title, $capability, $slug, $callback );

	}//end settings

	/*Settings content*/
	public function settingsoption_settings_content() {
		?>
        <div class="warp">

            <h1>Custom Settings</h1>

            <form action="options.php" method="post">
				<?php
				settings_fields( 'settingsoption_custom' );
				do_settings_sections( 'settingsoption_custom' );

				submit_button( esc_html__( 'Submit Settings', 'settingsoption' ) );
				?>
            </form>

        </div>

		<?php
	}//end settings content

	/*add setting section*/
	public function settingsoption_setup_sections() {

		add_settings_section(
			'settingsoption_section',
			esc_html__( 'Section title one', 'settingsoption' ),
			array(),
			'settingsoption_custom'
		);

		//write_log('settingsoption_setup_section');

	}//end setting section


	/*setup settings field*/
	public function settingsoption_setup_fields() {

		$fields = array(
			/*text field*/
			array(
				'label'       => esc_html__( 'Text Field', 'settingsoption' ),
				'id'          => 'settingsoption_textfield',
				'type'        => 'text',
				'section'     => 'settingsoption_section',
				'placeholder' => esc_html__( 'Text Field', 'settingsoption' ),
				'option_name' => 'settingsoption_custom'
			),//end text field

          /*email field*/
			array(
				'label'       => esc_html__( 'Email Field', 'settingsoption' ),
				'id'          => 'settingsoption_email',
				'type'        => 'email',
				'section'     => 'settingsoption_section',
				'placeholder' => esc_html__( 'Email Field', 'settingsoption' ),
				'option_name' => 'settingsoption_custom'
			),//end email field

            /*password field*/
			array(
				'label'       => esc_html__( 'Password Field', 'settingsoption' ),
				'id'          => "settingsoption_password",
				'type'        => 'password',
				'section'     => 'settingsoption_section',
				'placeholder' => esc_html__( 'Password Filed', 'settingsoption' ),
				'option_name' => 'settingsoption_custom'
			),//end password field

            /*number field*/
			array(
				'label'       => esc_html__( 'Number Field', 'settingsoption' ),
				'id'          => 'settingsoption_number',
				'type'        => 'number',
				'section'     => 'settingsoption_section',
				'placeholder' => esc_html__( 'Number Field', 'settingsoption' ),
				'min'         => '1',
				'max'         => '5',
				'option_name' => 'settingsoption_custom'
			),//end number field

            /*url field*/
			array(
				'label'       => esc_html__( 'Url Field', 'settingsoption' ),
				'id'          => 'settingsoption_url',
				'type'        => 'url',
				'section'     => 'settingsoption_section',
				'placeholder' => esc_html__( 'Url Field', 'settingsoption' ),
				'option_name' => 'settingsoption_custom'
			),//end url field

            /*textarea field*/
			array(
				'label'       => esc_html__( 'Textarea', 'settingsoption' ),
				'id'          => 'settingsoption_textarea',
				'type'        => 'textarea',
				'section'     => 'settingsoption_section',
				'placeholder' => esc_html__( 'Message', 'settingsoption' ),
				'option_name' => 'settingsoption_custom'
			),//end textarea field

            //multiple checkbox field
			array(
				'label'       => esc_html__( 'Multiple Checkbox', 'settingsoption' ),
				'id'          => 'settingsoption_checkbox',
				'type'        => 'checkbox',
				'section'     => 'settingsoption_section',
				/*check option */
				'countries'   => array(
					esc_html__( 'Bangladesh', 'settingsoption' ),
					esc_html__( 'India', 'settingsoption' ),
					esc_html__( 'Pakistan', 'settingsoption' ),
					esc_html__( 'Nepal', 'settingsoption' ),
					esc_html__( 'Bhutan', 'settingsoption' ),
					esc_html__( 'Srilanka', 'settingsoption' )
				),//end check option
				'option_name' => 'settingsoption_custom'
			),//end multiple check box

            /*radio button*/
			array(
				'label'       => esc_html__( 'Radio', 'settingsoption' ),
				'id'          => 'settingsoption_radio',
				'type'        => 'radio',
				'section'     => 'settingsoption_section',
				/*radio option*/
				'conditions'  => array(
					esc_html__( 'Yes', 'settingsoption' ),
					esc_html__( 'No', 'settingsoption' )
				),//end radio option
				'option_name' => 'settingsoption_custom'
			),//end radio button

            /*select field*/
			array(
				'label'       => esc_html__( 'Select', 'settingsoption' ),
				'id'          => 'settingsoption_select',
				'type'        => 'select',
				'section'     => 'settingsoption_section',
				/*select option*/
				'countries'   => array(
					esc_html__( 'India', 'settingsoption' ),
					esc_html__( 'Usa', 'settingsoption' ),
					esc_html__( 'Uk', 'settingsoption' ),
					esc_html__( 'Canada', 'settingsoption' ),
					esc_html__( 'Brazil', 'settingsoption' )
				),//end select option
				'option_name' => 'settingsoption_custom'
			),//end select field

            /*multiple select field*/
			array(
				'label'       => esc_html__( 'Multi Select', 'settingsoption' ),
				'id'          => 'settingsoption_multi_select',
				'type'        => 'multiple',
				'section'     => 'settingsoption_section',
				/*multiple select option*/
				'countries'   => array(
					esc_html__( 'Japan', 'settingsoption' ),
					esc_html__( 'China', 'settingsoption' ),
					esc_html__( 'Korea', 'settingsoption' ),
					esc_html__( 'France', 'settingsoption' ),
					esc_html__( 'Bangladesh', 'settingsoption' )
				),//end multiple select option
				'option_name' => 'settingsoption_custom'
			),//end multiple select field

            /*image upload field 1*/
			array(
				'label'       => esc_html__( 'File Upload', 'settingsoption' ),
				'id'          => 'settingsoption_image',
				'type'        => 'file',
				'section'     => 'settingsoption_section',
				'option_name' => 'settingsoption_custom'
			),//end image upload 1

			/*image upload 2*/
			array(
				'label'       => esc_html__( 'File Upload2', 'settingsoption' ),
				'id'          => 'settingsoption_image2',
				'type'        => 'file',
				'section'     => 'settingsoption_section',
				'option_name' => 'settingsoption_custom'
			),//end image upload 2

			/*image upload 3*/
			array(
				'label'       => esc_html__( 'File Upload3', 'settingsoption' ),
				'id'          => 'settingsoption_image3',
				'type'        => 'file',
				'section'     => 'settingsoption_section',
				'option_name' => 'settingsoption_custom'
			),//end image upload 3

			/*image upload 4*/
			array(
				'label'       => esc_html__( 'File Upload4', 'settingsoption' ),
				'id'          => 'settingsoption_image4',
				'type'        => 'file',
				'section'     => 'settingsoption_section',
				'option_name' => 'settingsoption_custom'
			),//end image upload 4

			/*image upload 5*/
			array(
				'label'       => esc_html__( 'File Upload5', 'settingsoption' ),
				'id'          => 'settingsoption_image5',
				'type'        => 'file',
				'section'     => 'settingsoption_section',
				'option_name' => 'settingsoption_custom'
			),//end image upload 5

		);

		/*looping for array listed fields*/
		foreach ( $fields as $field ) {
			add_settings_field( $field['id'], $field['label'],
				array( $this, 'settingsoption_field_callback' ),
				'settingsoption_custom',
				$field['section'],
				$field
			);

		}//end loop

        //register setting
		register_setting( 'settingsoption_custom', 'settingsoption_custom' );

	}//end settings field

	/*settings fields callback*/
	public function settingsoption_field_callback( $field ) {

		$option_name = $field['option_name'];
		$option      = get_option( $option_name );
		$value       = isset( $option[ $field['id'] ] ) ? $option[ $field['id'] ] : '';

		/*switching user input field*/
		switch ( $field['type'] ) {

		    /*for image upload*/
			case 'file':
			    echo '<div class="cbx_setting_file_wrap">';
				printf( '<input id="%1$s-%2$s" class="cbx_setting_file_input" type="text" name="%1$s[%2$s]"
                           value="%3$s"/>',
					$option_name,
					$field['id'],
					$value
				);

				echo '<a href="#" class="button button-primary cbx_setting_file_btn">Uplolad</a>';
				echo '</div>';
				break;//end image upload

			 /*Multiple select*/
			case 'multiple':
				$countries = $field['countries'];

				printf( '<select id="%1$s-%2$s" name="%1$s[%2$s][]" multiple="%3$s">',
					$option_name,
					$field['id'],
					$field['type']
				);
				foreach ( $countries as $key => $country ) {
					$selected = '';
					if ( is_array( $value ) && in_array( $key, $value ) ) {
						$selected = 'selected';
					}
					printf( '<option value="%1$s" %2$s >%3$s</option>',
						$key,
						$selected,
						$country
					);
				}
				echo "</select>";
				break;//end multiple select


			 /*Select filed*/
			case 'select':
				$countries = $field['countries'];
				printf( '<select id="%1$s-%2$s" name="%1$s[%2$s]">',
					$option_name,
					$field['id']
				);
				foreach ( $countries as $country ) {
					$selected = '';
					if ( $value == $country ) {
						$selected = 'selected';
					}
					printf( '<option value="%1$s" %2$s >%3$s</option>',
						$country,
						$selected,
						$country
					);
				}
				break;//end select field

			 /*Radio filed*/
			case 'radio':
				$conditions = $field['conditions'];
				foreach ( $conditions as $condition ) {
					$selected = '';
					if ( $value == $condition ) {
						$selected = 'checked';
					}

					printf( '<input id="%1$s-%2$s" name="%1$s[%2$s]" type="%3$s" value="%4$s" %5$s />%6$s<br>',
						$option_name,
						$field['id'],
						$field['type'],
						$condition,
						$selected,
						$condition

					);
				}
				break;//end radio field


            /*check box field*/
			case 'checkbox':
				$countries = $field['countries'];
				foreach ( $countries as $key => $country ) {
					$checked = '';
					if ( is_array( $value ) && in_array( $key, $value ) ) {
						$checked = 'checked';
					}
					printf( '<input id="%1$s-%2$s" name="%1$s[%2$s][%4$s]" type="%3$s" value="%4$s" %5$s />%6$s<br>',
						$option_name,
						$field['id'],
						$field['type'],
						$key,
						$checked,
						$country,
						$value
					);
				}
				break;//end check box

            /*textarea field*/
			case 'textarea':
				printf( '<textarea name="%1$s[%2$s]" id="%1$s-%2$s" placeholder="%3$s" rows="5" cols="50">%4$s</textarea>',
					$option_name,
					$field['id'],
					isset( $field['placeholder'] ) ? $field['placeholder'] : '',
					$value
				);
				break;//end textarea

            /*url field*/
			case 'url':
				printf( '<input name="%1$s[%2$s]" id="%1$s-%2$s" type="%3$s" placeholder="%4$s" value="%5$s"/>',
					$option_name,
					$field['id'],
					$field['type'],
					isset( $field['placeholder'] ) ? $field['placeholder'] : '',
					$value
				);
				break;//end url field

            /*number field*/
			case 'number':
				printf( '<input name="%1$s[%2$s]" id="%1$s-%2$s" type="%3$s" placeholder="%4$s" value="%5$s" min="%6$s" max="%7$s"/>',
					$option_name,
					$field['id'],
					$field['type'],
					isset( $field['placeholder'] ) ? $field['placeholder'] : '',
					$value,
					$field['min'],
					$field['max']
				);
				break;//end number

            /*password field*/
			case 'password':
				printf( '<input name="%1$s[%2$s]" id="%1$s-%2$s" type="%3$s" placeholder="%4$s" value="%5$s"/>',
					$option_name,
					$field['id'],
					$field['type'],
					isset( $field['placeholder'] ) ? $field['placeholder'] : '',
					$value
				);
				break;//end password field

            /*email field*/
			case 'email':
				printf( '<input name="%1$s[%2$s]" id="%1$s-%2$s" type="%3$s" placeholder="%4$s" value="%5$s"/>',
					$option_name,
					$field['id'],
					$field['type'],
					isset( $field['placeholder'] ) ? $field['placeholder'] : '',
					$value
				);
				break;//end email field

			/*default */
            default:
				printf( '<input name="%1$s[%2$s]" id="%1$s-%2$s" type="%3$s" placeholder="%4$s" value="%5$s"/>',
					$option_name,
					$field['id'],
					$field['type'],
					isset( $field['placeholder'] ) ? $field['placeholder'] : '',
					$value
				);//end default

		}//end switching

	}//end settings field

}//end of the class

//initialize the class
new customOption();