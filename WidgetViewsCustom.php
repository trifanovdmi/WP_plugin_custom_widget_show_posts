<?php 

class WidgetViewsCustom extends WP_Widget {

	function __construct() {
		parent::__construct(
			"widget_views_custom",
			"Widget views",
			array("description" => "Custom views show widget.")
		);
		
	}

    function widget( $args, $instance ) {

        $title  = $instance["title"];
	    $header = $instance["header"];
	    $footer = $instance["footer"];

	    $criteria_post = array();

	    if($instance['show_post'] && !empty($instance['show_post'])){
	    	(!empty($instance['post_type'])) ? $criteria_post['post_type'] = $instance['post_type'] : $criteria_post['post_type'] = '';
	    	(!empty($instance['category'])) ? $criteria_post['category'] = $instance['category'] : $criteria_post['category'] = '';
	    	(!empty($instance['numberposts'])) ? $criteria_post['numberposts'] = $instance['numberposts'] : $criteria_post['numberposts'] = '';
	    	(!empty($instance['post_status'])) ? $criteria_post['post_status'] = $instance['post_status'] : $criteria_post['post_status'] = '';
	    }
	 	$posts = get_posts($criteria_post);

        require_once WIDGET_ATTACHMENTS_DIR  . '/templates/item_post.php';
	 	
    }

    function update( $new_instance, $old_instance ) {
        $instance = array();

        $instance['title'] = $new_instance['title'];
        $instance['header'] = $new_instance['header'];
        $instance['footer'] = $new_instance['footer'];

        $instance['show_post'] = $new_instance['show_post'];
        $instance['post_type'] = $new_instance['post-type'];
        $instance['category'] = $new_instance['category'];
        $instance['numberposts'] = $new_instance['numberposts'];
        $instance['post_status'] = $new_instance['post_status'];

        return $instance;
    }

    function form( $instance ) {

        $title = '';
        $header = '';
        $footer = '';
        $post_type = '';
        $category = '';
        $numberposts = '5';
        $post_status = 'none';

        if(empty($title)) $title = $instance['title'];
        if(empty($header)) $header = $instance['header'];
        if(empty($footer)) $footer = $instance['footer'];
        if(empty($post_type)) $post_type = $instance['post_type'];
        if(empty($category)) $category = isset($instance['category']) ? $instance['category'] : '';
        if(empty($numberposts)) $numberposts = $instance['numberposts'];
        if(empty($post_status)) $post_status = isset($instance['post_status']) ? $instance['post_status'] : '';

        $title_id = $this->get_field_id('title');
        $title_name = $this->get_field_name('title');

        print "<div><label for='".$title_id."''>".__('Title', 'widget_views')."</label>";
        print "<input type='text' id='".$title_id."' name='".$title_name."' value='".$title."'></div>";

        $header_id = $this->get_field_id('header');
        $header_name = $this->get_field_name('header');

        print "<div><label for='".$header_id."''>".__('Header widget', 'widget_views')."</label>";
        print "<input type='text' id='".$header_id."' name='".$header_name."' value='".$header."'></div>";

        $show_post_id = $this->get_field_id('show_post');
        $show_post_name = $this->get_field_name('show_post');
        
        ?>
        <div><input type='checkbox' id='<?php print $show_post_id;?>' name='<?php print $show_post_name;?>' <?php checked( $instance[ 'show_post' ], 'on' ); ?> value='on' >
        <?php
        print "<label for='".$show_post_id."''>".__('Show content', 'widget_views')."</label></div>";
        

        $post_type_id = $this->get_field_id('post-type');
        $post_type_name = $this->get_field_name('post-type');

        $types_posts = get_post_types(array('public'=> true), 'names');

        print "<div><label for='".$post_type_id."''>".__('Type of post', 'widget_views')."</label>";
        print "<select id='".$post_type_id."' name='".$post_type_name."'>";

        foreach ($types_posts as $post_type) {

        	print "<option ".selected( $instance['post_type'], $post_type )." value='".$post_type."'>".$post_type."</option>";

        }

        print "</select></div>";

        $category_id = $this->get_field_id('category');
        $category_name = $this->get_field_name('category');

        $category_list = get_categories();

        print "<div><label for='".$category_id."''>".__('Category post', 'widget_views')."</label>";
        print "<select id='".$category_id."' name='".$category_name."'>";

        foreach ($category_list as $category_item) {

        	print "<option ".selected( $instance['category'], $category_item->name )." value='".$category_item->name."'>".$category_item->name."</option>";

        }

        print "</select></div>";

        $numberposts_id = $this->get_field_id('numberposts');
        $numberposts_name = $this->get_field_name('numberposts');

        print "<div><label for='".$numberposts_id."''>".__('Count posts', 'widget_views')."</label>";
        print "<input type='text' id='".$numberposts_id."' name='".$numberposts_name."' value='".$numberposts."'></div>";

        $post_status_id = $this->get_field_id('post_status');
        $post_status_name = $this->get_field_name('post_status');

        print "<div><label for='".$post_status_id."''>".__('Category post', 'widget_views')."</label>";
        print "<select id='".$post_status_id."' name='".$post_status_name."'>";

        print "<option ".selected( $instance['post_status'], 'none' )." value='none'>".__('None', 'widget_views')."</option>";
        print "<option ".selected( $instance['post_status'], 'publish' )." value='publish'>".__('Publish', 'widget_views')."</option>";

        print "</select></div>";

        $footer_id = $this->get_field_id('footer');
        $footer_name = $this->get_field_name('footer');

        print "<div><label for='".$footer_id."''>".__('Footer widget', 'widget_views')."</label>";
        print "<input type='text' id='".$footer_id."' name='".$footer_name."' value='".$footer."'></div>";

    }


}
