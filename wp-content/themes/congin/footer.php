		</div><!-- /.main-content -->
		<?php if (congin_get_elementor_option('footer_hide') !== 'yes') { 
			if ( congin_footer_style() == '1' ) {
				// Basic Footer
				get_template_part( 'templates/footer-widgets');
				get_template_part( 'templates/bottom');
			} else { 
				// Elementor Footer 
				?>
				<footer class="congin-footer footer">
					<div class="congin-container">
		        		<?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display(congin_footer_style(), false); ?>
		        	</div>
		        </footer>
			<?php } 
		} ?>

		<?php get_template_part( 'templates/scroll-top'); ?>
	</div><!-- /#page -->
</div><!-- /#wrapper -->

<?php wp_footer(); ?>

</body>
</html>