<?php get_header(); ?>

<script type="text/javascript">
    jQuery(document).ready(function($){
        $(".makeitso").wrapInner("<table cellspacing='30'><tr>");
        $(".makeitso .post").wrap("<td></td>");
        $("body").mousewheel(function(event, delta) {
            this.scrollLeft -= (delta * 50);
            event.preventDefault();
        });
    });
</script>

<div class="isportfolio">

<!--BEGIN: Content-->
<div id="content" class="makeitso" role="main">

	<?php if (have_posts()) : ?>

		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	
		<?php while (have_posts()) : the_post(); ?>

		<!--BEGIN: Archive-->
		<article <?php post_class('post') ?> id="post-<?php the_ID(); ?>">
		
			<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail('portfolio-feat'); ?><?php the_title(); ?></a></h2>

			
		</article>
		<!--END: Archive-->
				
		<?php endwhile; ?>

		<!--BEGIN: Page Nav-->
		<?php if ( $wp_query->max_num_pages > 1 ) : // if there's more than one page turn on pagination ?>
	        <nav id="page-nav">
	        	<h1 class="hide">Page Navigation</h1>
		        <ul class="clear-fix">
			        <li class="prev-link"><?php next_posts_link('Next Page') ?></li>
			        <li class="next-link"><?php previous_posts_link('Previous Page') ?></li>
		        </ul>
	        </nav>
		<?php endif; ?>
		<!--END: Page Nav-->
		
		<?php else : ?>

			<h2>No posts were found :(</h2>
			
	<?php endif; //END: The Loop ?>

</div>
<!--END: Content-->
</div>
<?php get_footer(); ?>