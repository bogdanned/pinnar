<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="container-fluid">
	<div class="row row-footerfull">
			<?php get_sidebar('footerfull'); ?>
	</div>
</div>


<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_html( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<span>
								<a href="">2017</a>
							</span>
							<span>
								<a href="">Terminos y Condiciones</a>
							</span>
							<span>
								<a href="">Politica de Privacidad</a>
							</span>
							<span>
								<a href="/blog">Blog</a>
							</span>
						</div>
					</div>

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
