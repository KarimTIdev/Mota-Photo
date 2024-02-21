
<?php get_header(); ?>

<?php

// Récupération des champs ACF 
$photo_url = get_field('photo');
$reference = get_field('reference');
$type = get_field('type');
$year = get_field('annee');

// Récupération des taxonomies
$categories = get_the_terms(get_the_ID(), 'categorie');
$formats = get_the_terms(get_the_ID(), 'format');
$categorie_name = $categories[0]->name;

// Récupération des URL des thumbnails et des posts précédents et suivants
$nextPost = get_next_post();
$previousPost = get_previous_post();
$previousThumbnailURL = $previousPost ? get_the_post_thumbnail_url($previousPost->ID, 'thumbnail') : '';
$nextThumbnailURL = $nextPost ? get_the_post_thumbnail_url($nextPost->ID, 'thumbnail') : '';
?>

<section class="cataloguePhotos">
    <div class="galleryPhotos">
        <div class="detailPhoto">

            <div  class="containerPhoto">
                <img src="<?php echo $photo_url; ?>" alt="<?php the_title_attribute(); ?>">
            </div>

            <div class="selecteurK">
                <h2><?php echo get_the_title(); ?></h2>
                <div  class="taxonomies">

                        <p class="uppercase">RÉFÉRENCE : <span id="single-reference"><?php echo strtoupper($reference) ?></span></p>
                        <p class="uppercase">CATÉGORIE : <?php foreach ($categories as $key => $cat) {
                                    $categoryNameSingle = $cat->name;
                                    echo ($categoryNameSingle);
                        }  ?></p>
                        <p class="uppercase">FORMAT : <?php foreach ($formats as $key => $format) {
                                    $formatName = $format->name;
                                    echo ($formatName);
                        } ?></p>
                        <p class="uppercase">TYPE : <?php echo ($type) ?> </p>
                        <p class="uppercase">ANNÉE : <?php echo $year ?> </p>
                </div>
            </div>
        </div>
    </div>

    <div class="contenairContact">
    	<div class="contact_photo">
    		<p class="interesser"> Cette photo vous intéresse ? </p>
    		<button id="boutonContact" class="contact-modale" data-reference="<?php echo $reference; ?>">Contact</button>
		</div>

		<div class="naviguationPhotos">
			<div class="miniPicture" id="miniPicture">
      	  	<!-- Le thumbnail sera ici -->
      		</div>

      		<div class="naviguationArrow">
      	 		<?php if (!empty($previousPost)) : ?>
      	     		<img class="arrow arrow-left" src="<?php echo get_theme_file_uri() . '/assets/images/left.png'; ?>" alt="Photo précédente" data-thumbnail-url="<?php echo $previousThumbnailURL; ?>" data-target-url="<?php echo esc_url(get_permalink($previousPost->ID)); ?>">
      	 		<?php endif; ?>

      	 		<?php if (!empty($nextPost)) : ?>
      	    		<img class="arrow arrow-right" src="<?php echo get_theme_file_uri() . '/assets/images/right.png'; ?>" alt="Photo suivante" data-thumbnail-url="<?php echo $nextThumbnailURL; ?>" data-target-url="<?php echo esc_url(get_permalink($nextPost->ID)); ?>">
      	 		<?php endif; ?>
      		</div>
		</div>
    </div>
</section>

<section>
	<div class="titreVousAimerezAussi">
	    <h3>VOUS AIMEREZ AUSSI</h3>
	</div>

	<div class="PhotoSimilaire">
		<?php
		//  On définit les éléments qui seront récupérés en fonction de leur catégories
		$categories = get_the_terms(get_the_ID(), 'categorie');
			if ($categories && !is_wp_error($categories)) {
				$category_ids = wp_list_pluck($categories, 'term_id');
					$args = array(
						'post_type' => 'photos',
						'posts_per_page' => 2,
						'orderby' => 'rand',
						// On exclu de la suggestion le post actuel
						'post__not_in' => array(get_the_ID()),
						'tax_query' => array(
								array(
									'taxonomy' => 'categorie',
									'field' => 'term_id',
									'terms' => $category_ids,
									),
								),
						);

				$compteur = 0;
				$related_block = new WP_Query($args);
			while ($related_block->have_posts()) {
				$related_block->the_post();
				$photo_url = get_the_post_thumbnail_url(null, "large");
				$reference = get_field('reference');
				$categorie_name = isset($categories[0]) ? $categories[0]->name : '';

			get_template_part('templates_part/photo_block');
			$compteur++;
			}
			if ($compteur ===0) {
				echo "<p class='photoNotFound'> Aucune photo similaire trouvée pour la catégorie '" . $categorie_name . "'</p>"; 
			}
		}
		?>
	</div>
</section>


<?php get_footer(); ?>
