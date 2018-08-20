<?php get_header(); ?>
	<div class="relative">
		<div class="bg-image bg-absolute bg-textura" style="background-image: url(<?php echo THEMEPATH; ?>images/fondos/textura.png);"></div>
		<section id="section-initial">
			<div class="container relative">
				<div class="bg-logo bg-image bg-contain margin-auto" style="background-image: url(<?php echo THEMEPATH; ?>images/identidad/qo-logo.png);"></div>
			</div>
		</section>
		<section id="section-nosotros" class="container text-center padding-top-bottom-50">
			<div class="row relative">
				<div class="bg-image bg-contain bg-puntos margin-auto" style="background-image: url(<?php echo THEMEPATH; ?>images/fondos/puntos.png);"></div>
				<div class="bg-image bg-contain absolute top-15p width-40p padding-bottom-40p" style="background-image: url(<?php echo THEMEPATH; ?>images/fondos/bola-rosa.png);"></div>
				<div class="bg-image bg-contain absolute top--10p right-0 width-30p padding-bottom-30p" style="background-image: url(<?php echo THEMEPATH; ?>images/fondos/bola-azul.png);"></div>
				<?php
			        $args = array(
			            'post_type' 		=> 'nosotros',
			            'posts_per_page' 	=> 3,
			            'orderby' 			=> 'date',
			            'order' 			=> 'ASC'
			            );
			        $loop = new WP_Query( $args );
			        $i = 1;
			        if ( $loop->have_posts() ) {
			            while ( $loop->have_posts() ) : $loop->the_post(); ?>		

							<div class="col s12 m4 padding-left-right-30">
								<div class="bg-image bg-contain bg-icon-nosotros margin-bottom-large" style="background-image: url(<?php the_post_thumbnail_url('medium'); ?>);"></div>
								<h3 class="tile-qo <?php if( $i === 3 ) : ?>title-qo-small<?php endif; ?>"><?php the_title(); ?></h3>
								<div class="relative">
									<?php the_content(); ?>
									<?php if( $i !== 3 ) : ?>
										<div class="bg-image bg-contain bg-line-dotted margin-auto" style="background-image: url(<?php echo THEMEPATH; ?>images/nosotros/line-nosotros1.png);"></div>
									<?php endif; ?>
								</div>
							</div>

			            <?php $i ++;  endwhile;
			        } 
			        wp_reset_postdata();
			    ?>
			</div>
		</section>		
	</div>
	<section id="section-servicios" class="container padding-top-bottom-50 relative">
		<div class="bg-degrade-fondo"></div>
		<h2>Servicios</h2>
		<div id="slider-servicios" class="cycle-slideshow" data-cycle-fx="flipHorz" data-cycle-timeout="12000" data-cycle-slides="> div" data-cycle-next="#next-service" data-cycle-prev="#prev-service" data-cycle-pager=".services-pager">
			<?php
		        $args = array(
		            'post_type' 		=> 'servicios',
		            'posts_per_page' 	=> -1,
		            'orderby' 			=> 'date',
		            'order' 			=> 'ASC'
		            );
		        $loop = new WP_Query( $args );
		        $i = 1;
		        if ( $loop->have_posts() ) {
		            while ( $loop->have_posts() ) : $loop->the_post(); ?>		

						<div>
							<div class="content-card">
								<div class="content-card-image">
									<div class="fondo-bg-image"></div>
									<div class="bg-image" style="background-image: url(<?php the_post_thumbnail_url('medium'); ?>);"></div>									
								</div>
								<div class="content-card-body">
									<h3><?php the_title(); ?></h3>
									<div class="hr bg-gradient-qo"></div>
									<?php the_content(); ?>										
								</div>							
							</div>
						</div>

		            <?php $i ++;  endwhile;
		        } 
		        wp_reset_postdata();
		    ?>
		</div>
		<div class="services-pager"></div>
	    <div id="prev-service" class="bg-image bg-contain bg-arrow" style="background-image: url(<?php echo THEMEPATH; ?>images/servicios/atras.png);"></div>
	    <div id="next-service" class="bg-image bg-contain bg-arrow" style="background-image: url(<?php echo THEMEPATH; ?>images/servicios/delante.png);"></div>
	    <div class="bg-image bg-contain absolute top-10p right-10p width-25p padding-bottom-25p rotate-60" style="background-image: url(<?php echo THEMEPATH; ?>images/fondos/bola-rosa.png);"></div>
	    <div class="bg-image bg-contain absolute top-45p left-0 width-20p padding-bottom-20p rotate-140" style="background-image: url(<?php echo THEMEPATH; ?>images/fondos/bola-rosa.png);"></div>
	    <div class="bg-image bg-contain absolute top-30p right-0 width-45p padding-bottom-45p rotate-120" style="background-image: url(<?php echo THEMEPATH; ?>images/fondos/bola-azul.png);"></div>
	    <div class="bg-image bg-contain absolute bottom-5p left-5p width-30p padding-bottom-30p rotate-270" style="background-image: url(<?php echo THEMEPATH; ?>images/fondos/bola-azul.png);"></div>
	</section>
	<div class="relative">
		<div class="bg-image bg-absolute bg-colores-qo" style="background-image: url(<?php echo THEMEPATH; ?>images/fondos/colores-qo.png);"></div>
		<section id="section-clientes">
			<h2>Clientes</h2>
			<?php
		        $args = array(
		            'post_type' 		=> 'clientes',
		            'posts_per_page' 	=> -1,
		            'orderby' 			=> 'title',
		            'order' 			=> 'ASC'
		            );
		        $loop = new WP_Query( $args );
		        $i = 1;
		        if ( $loop->have_posts() ) {
		            while ( $loop->have_posts() ) : $loop->the_post(); ?>		

						<div class="bg-image bg-contain" style="background-image: url(<?php the_post_thumbnail_url('medium'); ?>);"></div>

		            <?php $i ++;  endwhile;
		        } 
		        wp_reset_postdata();
		    ?>
		</section>
		<section id="section-trabajos">
			<h2>Trabajos</h2>
			<div class="row grid">
			<?php
		        $args = array(
		            'post_type' 		=> 'proyectos',
		            'posts_per_page' 	=> -1,
		            'orderby' 			=> 'title',
		            'order' 			=> 'ASC'
		            );
		        $loop = new WP_Query( $args );
		        $i = 1;
		        if ( $loop->have_posts() ) {
		            while ( $loop->have_posts() ) : $loop->the_post(); ?>		

					<div class="col s12 m6">
						<div class="bg-image bg-contain" style="background-image: url(<?php the_post_thumbnail_url('medium'); ?>);"></div>
					</div>				

		            <?php $i ++;  endwhile;
		        } 
		        wp_reset_postdata();
		    ?>
	   		</div> 
		</section>		
	</div>

<?php get_footer(); ?>