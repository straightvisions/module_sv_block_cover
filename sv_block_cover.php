<?php
	namespace sv100;

	class sv_block_cover extends init {
		public function init() {
			$this->set_module_title( __( 'Block: Cover', 'sv100' ) )
				->set_module_desc( __( 'Settings for Gutenberg Block', 'sv100' ) )
				->set_css_cache_active()
				->set_section_title( $this->get_module_title() )
				->set_section_desc( $this->get_module_desc() )
				->set_section_template_path()
				->set_section_order(5000)
				->set_section_icon('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 0h24v24h-24z"/></svg>')
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
			parent::register_scripts();

			// Register Styles
			$this->get_script( 'style_text_shadow' )
				->set_is_gutenberg()
				->set_path( 'lib/css/common/style_text_shadow.css' );

			return $this;
		}
		public function enqueue_scripts(): sv_block_cover {
			if(!$this->has_block_frontend('cover')){
				return $this;
			}

			if(!is_admin()){
				$this->load_settings()->register_scripts();
			}

			foreach($this->get_scripts() as $script){
				$script->set_is_enqueued();
			}

			return $this;
		}
	}