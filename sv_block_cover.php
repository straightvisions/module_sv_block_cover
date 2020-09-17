<?php
	namespace sv100;

	/**
	 * @version         4.001
	 * @author			straightvisions GmbH
	 * @package			sv100
	 * @copyright		2019 straightvisions GmbH
	 * @link			https://straightvisions.com
	 * @since			1.000
	 * @license			See license.txt or https://straightvisions.com
	 */

	class sv_block_cover extends init {
		public function init() {
			$this->set_module_title( __( 'Block: Cover', 'sv100' ) )
				->set_module_desc( __( 'Settings for Gutenberg Block', 'sv100' ) )
				->set_section_title( $this->get_module_title() )
				->set_section_desc( $this->get_module_desc() )
				->set_section_type( 'settings' )
				->set_section_template_path( $this->get_path( 'lib/backend/tpl/settings.php' ) )
				->set_section_order(130)
				->get_root()
				->add_section( $this );
		}

		protected function load_settings(): sv_block_cover {
			$this->get_setting( 'margin' )
				->set_title( __( 'Margin', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'margin' );

			$this->get_setting( 'padding' )
				->set_title( __( 'Padding', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'margin' );

			$this->get_setting( 'border' )
				->set_title( __( 'Border', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'border' );

			return $this;
		}

		protected function register_scripts(): sv_block_cover {
			// Register Styles
			$this->get_script( 'common' )
				->set_is_gutenberg()
				->set_path( 'lib/frontend/css/common.css' );

			$this->get_script( 'config' )
				->set_path( 'lib/frontend/css/config.php' )
				->set_is_gutenberg()
				->set_inline( true );

			return $this;
		}
		public function enqueue_scripts(): sv_block_cover {
			if(!$this->has_block_frontend('cover')){
				return $this;
			}

			if(!is_admin()){
				$this->load_settings()->register_scripts();
			}

			$this->get_script( 'common' )->set_is_enqueued();
			$this->get_script( 'config' )->set_is_enqueued();

			return $this;
		}
	}