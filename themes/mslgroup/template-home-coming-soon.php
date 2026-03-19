<?php
/**
 * Template Name: Home - Coming Soon
 *
 * @package MSLGroup
 */

get_header();

$instagram_link_text = 'View Instagram';
$instagram_url       = '#';
$instagram_image_url = '';
$instagram_image_alt = 'Instagram preview';

$linkedin_link_text = 'View LinkedIn';
$linkedin_url       = '#';
$linkedin_image_url = '';
$linkedin_image_alt = 'LinkedIn preview';

if ( function_exists( 'get_field' ) ) {
    $instagram_link_text = get_field( 'instagram_link_text', 'option' ) ?: $instagram_link_text;
    $instagram_url       = get_field( 'instagram_url', 'option' ) ?: $instagram_url;
    $instagram_image     = get_field( 'instagram_image', 'option' );

    if ( is_array( $instagram_image ) ) {
        $instagram_image_url = $instagram_image['url'] ?? '';
        $instagram_image_alt = $instagram_image['alt'] ?? $instagram_image_alt;
    }

    $linkedin_link_text = get_field( 'linkedin_link_text', 'option' ) ?: $linkedin_link_text;
    $linkedin_url       = get_field( 'linkedin_url', 'option' ) ?: $linkedin_url;
    $linkedin_image     = get_field( 'linkedin_image', 'option' );

    if ( is_array( $linkedin_image ) ) {
        $linkedin_image_url = $linkedin_image['url'] ?? '';
        $linkedin_image_alt = $linkedin_image['alt'] ?? $linkedin_image_alt;
    }
}
?>

	<main id="primary" class="site-main">
        <section id="banner-video" class="banner-video">
            <!-- video background, header-animation file, runs once on page load -->
            <video class="banner-video__media" autoplay muted playsinline>
                <source src="/wp-content/themes/mslgroup/assets/header-animation-v1.webm" type="video/webm">
                <source src="/wp-content/themes/mslgroup/assets/header-animation-v1.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <a class="banner-video__cta" href="#evolving" data-fade-in-at="5.75" data-fade-duration="0.75">Scroll Down</a>
        </section>
        <script>
        (function() {
            var banner = document.getElementById('banner-video');
            if (!banner) return;

            var video = banner.querySelector('video');
            var cta = banner.querySelector('.banner-video__cta');
            if (!video || !cta) return;

            var fadeInAt = parseFloat(cta.getAttribute('data-fade-in-at'));
            var fadeDuration = parseFloat(cta.getAttribute('data-fade-duration')) || 0.75;
            var useVideoDuration = Number.isNaN(fadeInAt);

            function updateCtaOpacity() {
                var duration = video.duration || 0;
                var startAt = useVideoDuration && duration
                    ? Math.max(duration - fadeDuration, 0)
                    : fadeInAt;

                if (!duration && useVideoDuration) return;

                var t = video.currentTime || 0;
                var progress = fadeDuration > 0
                    ? Math.min(Math.max((t - startAt) / fadeDuration, 0), 1)
                    : t >= startAt ? 1 : 0;

                cta.style.opacity = progress.toFixed(3);
                cta.style.pointerEvents = progress > 0.95 ? 'auto' : 'none';
            }

            video.addEventListener('loadedmetadata', updateCtaOpacity);
            video.addEventListener('timeupdate', updateCtaOpacity);
            video.addEventListener('ended', updateCtaOpacity);
        })();
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

        <section id="evolving" data-nav-theme="light">
            <div class="container">
                <div class="content-wrap">
                    <div class="leadfit">
                        <h2 class="typing-reveal"><span class="color-light">We're Updating Our Website —</span> Because the World of PR is <span class="underline">Evolving</span>.</h2>
                        <h3>MSL is a global public relations and strategic communications agency.</h3>
                    </div>
                </div>
            </div>
        </section>

        <script>
        (function() {
            function initTypingReveal() {
                gsap.registerPlugin(ScrollTrigger);

                const headings = document.querySelectorAll('.typing-reveal');
                if (!headings.length) return;

                // Walk the DOM and wrap each text character in a <span class="char">
                function splitTextNodes(el) {
                    const chars = [];
                    Array.from(el.childNodes).forEach(function(node) {
                        if (node.nodeType === Node.TEXT_NODE) {
                            var text = node.textContent;
                            var frag = document.createDocumentFragment();
                            for (var i = 0; i < text.length; i++) {
                                var span = document.createElement('span');
                                span.className = 'char';
                                span.textContent = text[i];
                                frag.appendChild(span);
                                chars.push(span);
                            }
                            node.parentNode.replaceChild(frag, node);
                        } else if (node.nodeType === Node.ELEMENT_NODE) {
                            chars.push.apply(chars, splitTextNodes(node));
                        }
                    });
                    return chars;
                }

                headings.forEach(function(heading) {
                    var chars = splitTextNodes(heading);

                    // Set initial state: all chars hidden
                    gsap.set(chars, { opacity: 0 });

                    // Animate chars to visible on scroll
                    gsap.to(chars, {
                        opacity: 1,
                        duration: 0.05,
                        stagger: { each: 0.05 },
                        scrollTrigger: {
                            trigger: heading,
                            start: 'top 75%',
                            end: 'center center',
                            scrub: true
                        }
                    });
                });
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initTypingReveal);
            } else {
                initTypingReveal();
            }
        })();
        </script>


        <!-- ===== OFFICES MAP ===== -->
        <section id="offices" data-nav-theme="light">
            <link rel="stylesheet" href="https://unpkg.com/leaflet@2.0.0-alpha.1/dist/leaflet.css" />
            
            <div id="map" style="height: 600px; width: 100%; background-color: #fff;"></div>

            <?php
            $offices_data = [];
            $office_query = new WP_Query([
                'post_type'      => 'office',
                'posts_per_page' => -1,
                'post_status'    => 'publish',
                'orderby'        => 'title',
                'order'          => 'ASC',
            ]);

            if ($office_query->have_posts()) {
                while ($office_query->have_posts()) {
                    $office_query->the_post();

                    $office_title = function_exists('wp_entity_decode')
                        ? wp_entity_decode(get_the_title(), ENT_QUOTES, 'UTF-8')
                        : html_entity_decode(get_the_title(), ENT_QUOTES, 'UTF-8');
                    $office_name = function_exists('get_field') ? get_field('office_name') : '';
                    $latitude = function_exists('get_field') ? get_field('latitude') : '';
                    $longitude = function_exists('get_field') ? get_field('longitude') : '';
                    $street_address = function_exists('get_field') ? get_field('street_address') : '';
                    $city = function_exists('get_field') ? get_field('city') : '';
                    $state = function_exists('get_field') ? get_field('state_province_region') : '';
                    $country = function_exists('get_field') ? get_field('country') : '';
                    $website = function_exists('get_field') ? get_field('website') : '';
                    $collaborators = function_exists('get_field') ? get_field('collaborators') : [];

                    if ($latitude === '' || $longitude === '') {
                        continue;
                    }

                    $collaborators_data = [];
                    if (is_array($collaborators)) {
                        foreach ($collaborators as $collaborator) {
                            $collaborators_data[] = [
                                'name'  => $collaborator['name_of_collaborator'] ?? '',
                                'title' => $collaborator['title_of_collaborator'] ?? '',
                                'email' => $collaborator['email_of_collaborator'] ?? '',
                            ];
                        }
                    }

                    $offices_data[] = [
                        'name'        => $office_title,
                        'officeName'  => $office_name ?: $office_title,
                        'lat'         => (float) $latitude,
                        'lng'         => (float) $longitude,
                        'street'      => $street_address,
                        'city'        => $city,
                        'state'       => $state,
                        'country'     => $country,
                        'website'     => $website,
                        'collaborators' => $collaborators_data,
                    ];
                }
                wp_reset_postdata();
            }
            ?>
            
            <div class="offices-panel">
                <h2><span>Where to Find Us?</span><br><strong>Everywhere.</strong></h2>
                <p>Activate our global network</p>
                <div class="offices-search">
                    <input type="text" id="office-search" placeholder="Search" />
                </div>
                <ul class="offices-list" id="offices-list"></ul>
            </div>
            
            <script type="importmap">
                {
                    "imports": {
                        "leaflet": "https://unpkg.com/leaflet@2.0.0-alpha.1/dist/leaflet.js"
                    }
                }
            </script>
            <script type="module">
                import L, { Map, GeoJSON, CircleMarker } from 'leaflet';

                const map = new Map('map', {
                    zoomControl: false,
                    attributionControl: false,
                    worldCopyJump: true,
                    maxBoundsViscosity: 0,
                    scrollWheelZoom: false,
                    doubleClickZoom: false,
                    touchZoom: false,
                    boxZoom: false,
                    keyboard: false
                }).setView([35, 15], 2.5);

                const offices = <?php echo wp_json_encode($offices_data); ?>;

                const markers = {};
                let activeMarker = null;
                let activeListItem = null;

                // Build the office list
                const officesList = document.getElementById('offices-list');
                offices.forEach((office, index) => {
                    const li = document.createElement('li');
                    li.textContent = office.name;
                    li.dataset.index = index;
                    officesList.appendChild(li);
                });

                // Search filter
                document.getElementById('office-search').addEventListener('input', (e) => {
                    const query = e.target.value.toLowerCase();
                    officesList.querySelectorAll('li').forEach(li => {
                        li.style.display = li.textContent.toLowerCase().includes(query) ? '' : 'none';
                    });
                });

                // Load world countries GeoJSON
                fetch('https://raw.githubusercontent.com/datasets/geo-countries/master/data/countries.geojson')
                    .then(response => response.json())
                    .then(data => {
                        new GeoJSON(data, {
                            style: {
                                fillColor: '#BFBFBF',
                                fillOpacity: 1,
                                color: '#BFBFBF',
                                weight: 1
                            }
                        }).addTo(map);

                        // Add markers
                        offices.forEach((office, index) => {
                            const addressParts = [office.street, office.city, office.state, office.country].filter(Boolean);
                            const streetLine = office.street ? office.street.trim() : '';
                            const locationLine = [office.city, office.state, office.country].filter(Boolean).join(', ');
                            const addressLine = streetLine && locationLine
                                ? `${streetLine}<br>${locationLine}`
                                : addressParts.join(', ');
                            const collaboratorsHtml = (office.collaborators || [])
                                .map(collab => {
                                    const title = collab.title ? `${collab.title}` : '';
                                    const email = collab.email ? ` — <a href="mailto:${collab.email}">Email</a>` : '';
                                    return `<li><strong>${collab.name || 'Collaborator'}</strong>${title}${email}</li>`;
                                })
                                .join('');
                            const ctaHtml = office.website
                                ? `<p><a class="office-cta" href="${office.website}" target="_blank" rel="noopener noreferrer">Visit Website</a></p>`
                                : '<p><a class="office-cta" href="#contact">Contact Us</a></p>';
                            const addressHtml = addressLine ? `<p>${addressLine}</p>` : '';
                            const collaboratorsBlock = collaboratorsHtml ? `<div><ul>${collaboratorsHtml}</ul></div>` : '';

                            const popupContent = `
                                <div class="office-popup">
                                    <strong>${office.officeName || office.name}</strong>
                                    ${addressHtml}
                                    ${ctaHtml}
                                    ${collaboratorsBlock}
                                </div>
                            `;
                            const marker = new CircleMarker([office.lat, office.lng], {
                                radius: 10,
                                fillColor: '#fff',
                                fillOpacity: 1,
                                color: '#191919',
                                weight: 1.5
                            })
                                .addTo(map)
                                .bindPopup(popupContent, { autoPan: false });
                            
                            markers[index] = marker;

                            marker.on('click', () => {
                                highlightOffice(index);
                            });
                        });

                        // List click handler
                        officesList.addEventListener('click', (e) => {
                            if (e.target.tagName === 'LI') {
                                const index = parseInt(e.target.dataset.index);
                                highlightOffice(index);
                            }
                        });
                    });

                function highlightOffice(index) {
                    // Reset previous
                    if (activeMarker !== null) {
                        markers[activeMarker].setStyle({ fillColor: '#fff', color: '#191919' });
                        markers[activeMarker].closePopup();
                    }
                    if (activeListItem) {
                        activeListItem.classList.remove('active');
                    }

                    // Highlight new
                    markers[index].setStyle({ fillColor: '#191919', color: '#191919' });
                    activeMarker = index;

                    const listItem = officesList.querySelector(`li[data-index="${index}"]`);
                    if (listItem) {
                        listItem.classList.add('active');
                        activeListItem = listItem;
                    }

                    // Pan to marker, offset to account for the offices panel
                    const targetPoint = map.latLngToContainerPoint([offices[index].lat, offices[index].lng]);
                    const mapSize = map.getSize();
                    // Shift left by half the panel width (~160px) so marker centers in visible area
                    const offsetX = targetPoint.x - (mapSize.x / 2) + 160;
                    const offsetY = targetPoint.y - (mapSize.y / 2);
                    map.panBy([offsetX, offsetY], { animate: true, duration: 0.5 });

                    // Open popup after pan completes
                    setTimeout(() => { markers[index].openPopup(); }, 550);
                }
            </script>
        </section>


        <!-- ===== SOCIAL ===== -->
        <section class="social" data-nav-theme="dark">
            <div class="checkmark_social checkmark_tr"></div>
            <div class="checkmark_social checkmark_bl"></div>
            <h2 class="typing-reveal">While we fine-tune this space <span class="color-light">Follow us on social</span> to see our influence and impact in real-time.</h2>

            <script>
                gsap.to('.checkmark_tr', {
                    yPercent: -140,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: '.social',
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: true
                    }
                });
                gsap.to('.checkmark_bl', {
                    yPercent: 120,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: '.social',
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: true
                    }
                });
            </script>

            
            <div class="social-embeds">
                <!-- Instagram -->
                <a class="social-embed instagram-feed" id="instagram-feed" href="<?php echo esc_url( $instagram_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $instagram_link_text ); ?>">
                    <div class="social-embed__content">
                        <div class="instagram-feed__link" id="instagram-post"<?php echo $instagram_image_url ? ' style="background-image: url(' . esc_url( $instagram_image_url ) . ');"' : ''; ?> aria-label="<?php echo esc_attr( $instagram_image_alt ); ?>"></div>
                    </div>
                    <div class="embed-overlay">
                        <span class="embed-overlay__text"><?php echo esc_html( $instagram_link_text ); ?></span>
                    </div>
                </a>

       
                <!-- LinkedIn -->
                <a class="social-embed linkedin-embed" href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $linkedin_link_text ); ?>">
                    <div class="social-embed__content">
                        <div class="social-embed__image"<?php echo $linkedin_image_url ? ' style="background-image: url(' . esc_url( $linkedin_image_url ) . ');"' : ''; ?> aria-label="<?php echo esc_attr( $linkedin_image_alt ); ?>"></div>
                    </div>
                    <div class="embed-overlay">
                        <span class="embed-overlay__text"><?php echo esc_html( $linkedin_link_text ); ?></span>
                    </div>
                </a>
            </div>

        </section>

        <!-- ===== CONTACT FORM ===== -->
        <section id="contact" data-nav-theme="light">
            <div class="container">
                <div class="content-wrap">
                    <div class="leadfit">
                        <h2 style="--n: 62"><span class="scroll-reveal"><span class="color-light">Let's Get</span> in Touch</span></h2>
                        <?php echo do_shortcode('[gravityform id="1" title="false" ajax="true"]'); ?>
                    </div>
                </div>
            </div>
        </section>
	</main><!-- #main -->

<?php
get_footer();
