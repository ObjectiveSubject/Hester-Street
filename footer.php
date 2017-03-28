<?php
/**
 * The template for displaying the footer.
 */
?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://github.com/ObjectiveSubject/os-wp-starter', 'os-wp-starter' ) ); ?>">WP Starter Theme</a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'os-wp-starter' ), 'WP Starter', '<a href="http://objectivesubject.com/" rel="designer">Objective Subject</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<span class="media-size"></span>

<?php wp_footer(); ?>

</body>
</html>
