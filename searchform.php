<div class="form_container">
    <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div>
            <label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
            <input type="text"  placeholder="Search" value="<?php echo get_search_query(); ?>" name="s" id="s" />
            <button class="fa fa-search search-submit" id="searchsubmit"><i class="fa fa-search"></i></button> 
        </div>
    </form>
</div>
