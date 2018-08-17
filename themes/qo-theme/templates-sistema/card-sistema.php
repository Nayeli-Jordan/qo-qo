<div class="col s12 m6 l4 element-item margin-bottom-large <?php echo $estatus . ' ' . $prioridad . ' '; ?>
<?php 
	$terms = get_the_terms($post->ID, 'responsable');
	foreach ( $terms as $term ) {
		echo $term->slug . ' ';
	}
	$terms = get_the_terms($post->ID, 'requerimiento');
	foreach ( $terms as $term ) {
		echo $term->slug . ' ';
	}
?>">
	<div class="shadow relative card-sistema">
		<div class="card-head">
			<div class="status shadow-small bg-<?php echo $estatus; ?>"><span class="icon-lock-open"></span><span class="etiqueta-text"><?php echo $estatus; ?></span></div>
			<h2><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h2>												
		</div>
		<div class="bg-gradient-qo hr hr-3"></div>
		<div class="card-body">			
			<span class="etiqueta-prioridad bg-<?php echo $prioridad; ?> shadow-small"><span class="etiqueta-text"><?php echo $prioridad; ?></span></span>
			<?php
				$terms = get_the_terms($post->ID, 'responsable');
				echo '<p><span class="icon-user icon-size-small"></span>';
				foreach ( $terms as $term ) {
					echo '<span>' . $term->name . ' </span>';
				}
				echo '</p>';
				$terms = get_the_terms($post->ID, 'requerimiento');
				echo '<p class="font-strong"><span class="icon-tag icon-size-small"></span>';
				foreach ( $terms as $term ) {
					echo "<span>" . $term->name . "<span class='etiqueta-requerimiento bg-" . $term->slug . "'></span> </span>";
				}
				echo "</p>";
			?>
			<div class="hr bg-gradient-qo margin-top-xsmall margin-bottom-xsmall"></div>
			<p><span class="uppercase color-purple font-strong">Cliente:</span> <?php echo $cliente; ?></p>
			<p><span class="uppercase color-purple font-strong">Marca:</span> <?php echo $marca ?></p>
			<p><span class="uppercase color-purple font-strong">Proyecto:</span> <?php echo $proyecto; ?></p>
			<p class="margin-top-xsmall"><span class="icon-calendar-inv"></span>Requerida: 
			<?php
				/*if( $req_fecha4_ext  != "" ) : 
					$req_fecha4_ext;
				elseif( $req_fecha3_ext  != "" ) : 
					$req_fecha3_ext;
				elseif( $req_fecha2_ext  != "" ) : 
					$req_fecha2_ext;
				elseif( $req_fecha1_ext  != "" ) : 
					$req_fecha1_ext;
				elseif( $fechaEntrega != "" ) : 
					$fechaRequerida;
				endif;*/
			?></p>
			<p><span class="icon-calendar-inv"></span>Entrega: <?php echo $fechaEntrega; ?></p>

			<?php 
				$todayDate = date('Y-m-d');
				$todayDate=date('Y-m-d', strtotime($todayDate));
				if( $ent_fecha4_ext != "" ) : 
					$limitFechaEntrega = $ent_fecha4_ext;
				elseif( $ent_fecha3_ext != "" ) : 
					$limitFechaEntrega = $ent_fecha3_ext;
				elseif( $ent_fecha2_ext != "" ) : 
					$limitFechaEntrega = $ent_fecha2_ext;
				elseif( $ent_fecha1_ext != "" ) : 
					$limitFechaEntrega = $ent_fecha1_ext;
				elseif( $fechaEntrega != "" ) : 
					$limitFechaEntrega = $fechaEntrega;
				endif;
				echo $limitFechaEntrega;
				$activeAlertDate = date('Y-m-d', strtotime($limitFechaEntrega . ' - 3 days'));
				//echo "Hoy: " . $todayDate. "<br> Fecha Alerta: " . $activeAlertDate;

				if (($todayDate >= $activeAlertDate)){
				    echo "<a href='<?php echo the_permalink(); ?>'><div id='btn-entrega-proxima' class='shadow btn-primary-rounded'><span class='icon-clock'></span><span class='etiqueta-text'>Entrega Cercana</span></div></a>";
				}
			?>		
			<a href="<?php echo the_permalink(); ?>"><div class="shadow btn-primary-rounded"><span class="icon-eye"></span></div></a>
		</div>							
	</div>
</div>	