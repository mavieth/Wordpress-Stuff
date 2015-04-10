<?php
/*
Template Name: Custom Page
*/

get_header(); ?>

<section class="main">
	
	<?php while ( have_posts() ): the_post(); ?>	
		<?php
		$posts = get_posts(array(
		'posts_per_page'    => -1,
		'post_type'         => 'custom_post_type',
		'category'          => 3
		));
		if( $posts ): ?>
			<?php foreach( $posts as $post ): setup_postdata( $post )?>

			<li>
				<?php echo  the_title(); ?>
			</li>
			
			<?php 
			$image = get_field('field_name');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>

				<p class="description-paragraph">
					<?php echo the_field('custom_description')?>
				</p>	
				
				<a href="#0" class="read-more">Read more</a>
			
			<?php $date = DateTime::createFromFormat('Ymd', get_field('custom_date')); ?>
			
			<span class="custom-date">
				<?php echo $date->format('F Y');?>
			</span>
			
			<?php endforeach; ?>
		<?php wp_reset_postdata(); ?>
		<?php endif; ?>
	<?php endwhile; ?>

</section>
<?php get_footer(); ?>        