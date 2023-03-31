<form class="pd_search" role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="row g-2">
		<div class="col-12 col-lg-5">
		<?php
			$search_cat = isset( $_GET['cat'] ) ? $_GET['cat'] : '';
			$args = array(
				'show_option_all' => 'All categories',
				'orderby' => 'name',
				'value_field' => 'slug',
				'class' => 'pd_ser form-select',
				'echo' => 1,
				'selected' => $search_cat,
				'hierarchical' => 1,
				'depth' => 1,
				'taxonomy' => 'category'
			);
			$categories = wp_dropdown_categories( $args );
		?>
			<input type="hidden" name="post_type" value="post" />
		</div>
		<div class="col-12 col-lg-5">
			<input class="pd_ser form-control" type="search" placeholder="Search product..." value="<?php echo get_search_query(); ?>" name="s" id="s">	
		</div>
		<div class="col-12 col-lg-2">
			<input type="submit" class="pd_btn" id="searchsubmit" value="Search">	
		</div>
	</div>
</form>