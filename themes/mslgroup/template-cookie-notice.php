<?php
/**
 * Template Name: Cookie Notice
 *
 * @package MSLGroup
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">
			<div class="content-wrap">
				<h1 class="entry-title"><?php the_title(); ?></h1>

				<!-- OneTrust Privacy Notice start -->
				<!-- Container in which the Privacy Notice will be rendered -->
				<div class="otnotice" id="otnotice-6a29b28d-b636-418a-8fbc-2293bfeb049e">&nbsp;</div>
				<script src="https://privacyportal-cdn.onetrust.com/privacy-notice-scripts/otnotice-1.0.min.js" type="text/javascript" charset="UTF-8" id="otprivacy-notice-script">
					settings="eyJjYWxsYmFja1VybCI6Imh0dHBzOi8vcHJpdmFjeXBvcnRhbC5vbmV0cnVzdC5jb20vcmVxdWVzdC92MS9wcml2YWN5Tm90aWNlcy9zdGF0cy92aWV3cyIsImNvbnRlbnRBcGlVcmwiOiJodHRwczovL3ByaXZhY3lwb3J0YWwub25ldHJ1c3QuY29tL3JlcXVlc3QvdjEvZW50ZXJwcmlzZXBvbGljeS9kaWdpdGFscG9saWN5L2NvbnRlbnQiLCJtZXRhZGF0YUFwaVVybCI6Imh0dHBzOi8vcHJpdmFjeXBvcnRhbC5vbmV0cnVzdC5jb20vcmVxdWVzdC92MS9lbnRlcnByaXNlcG9saWN5L2RpZ2l0YWxwb2xpY3kvbWV0YS1kYXRhIn0="
				</script>
				<script type="text/javascript" charset="UTF-8">
					// To ensure external settings are loaded, use the Initialized promise:
					OneTrust.NoticeApi.Initialized.then(function() {
						OneTrust.NoticeApi.LoadNotices(["https://privacyportal-cdn.onetrust.com/storage-container/73dca12b-5ba4-4937-9072-b5ffa15d1ba7/privacy-notices/6a29b28d-b636-418a-8fbc-2293bfeb049e/published/privacynotice.json"]);
					});
				</script>
				<!-- OneTrust Privacy Notice end -->

				<style type="text/css">.otnotice-menu { position: absolute; }</style>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();