<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MSLGroup
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'mslgroup' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="site-branding">
				<svg class="footer-logo-svg" xmlns="http://www.w3.org/2000/svg" aria-labelledby="title" viewBox="0 0 57.081 21.478"><title id="title">MSL</title><path d="m16.249.342-5.4 8.731L5.47.342H0v20.814h5.492V9.679l5.36 8.163 5.379-8.163v11.477h5.492V.342ZM34.09 8.486c-3.087-.89-4.432-1.212-4.432-2.367 0-.8.776-1.42 2.443-1.42a8.15 8.15 0 0 1 4.962 1.837l2.481-4.015A12.7 12.7 0 0 0 31.798.002c-4.773 0-7.8 2.822-7.8 6.629 0 3.693 2.917 5.246 5.7 6.06 2.936.852 4.829 1.117 4.829 2.481 0 .871-.833 1.629-2.443 1.629a10.2 10.2 0 0 1-6.193-2.614l-2.689 4.11a13.25 13.25 0 0 0 8.844 3.182c4.829 0 8.106-2.765 8.106-6.951 0-3.372-3.031-4.792-6.041-5.663ZM47.46 16.345v-16h-5.511v20.814h15.132v-4.81Z"/></svg>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<ul class="site-header-links">
					<li><a href="#offices">Our Locations</a></li>
					<li><a href="#contact">Get in Touch</a></li>
				</ul>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->
	<script>
		(() => {
			const header = document.getElementById('masthead');
			const getSections = () => document.querySelectorAll('section[data-nav-theme]');

			const updateHeaderState = () => {
				const scrolled = window.scrollY > 0;
				document.body.classList.toggle('is-scrolled', scrolled);

				if (scrolled) {
					const headerHeight = header.offsetHeight;
					let theme = 'light';
					getSections().forEach(section => {
						if (section.getBoundingClientRect().top <= headerHeight) {
							theme = section.dataset.navTheme || 'light';
						}
					});
					header.dataset.theme = theme;
				} else {
					delete header.dataset.theme;
				}
			};

			updateHeaderState();
			window.addEventListener('scroll', updateHeaderState, { passive: true });
		})();
	</script>
