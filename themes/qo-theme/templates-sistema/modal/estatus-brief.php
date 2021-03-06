<?php 
	$custom_fields  = get_post_custom();
    $post_id        = get_the_ID();
    $estatus      	= get_post_meta( $post_id, 'sistema_estatus', true ); 

    $responsableName 	= '';
	$terms = get_the_terms($post->ID, 'responsable');
	if ( is_array( $terms ) ) {
		foreach($terms as $term){
			$responsableName .= $term->name . " (" . $term->description . ") ";
		}
	} ?>
<div id="modal-estatus-brief" class="modal">
	<div class="fondo-modal"></div>
	<div class="modal-content">
		<div class="close-modal"><i class="icon-cancel"></i></div>
		<div class="modal-body">
			<div class="fz-medium margin-bottom-xsmall color-purple text-center">Estatus Brief</div>
			<form id="update_brief_estatus" name="update_brief_estatus" action="" method="post" class="validation row"  enctype="multipart/form-data" data-parsley-qo_brief data-parsley-validate="">
		        <label>¿Cuál es el estatus?*</label>
		        <select id="sistema_estatus" name="sistema_estatus" required data-parsley-required-message="El campo es obligatorio.">
		            <option value="Abierto" <?php selected($estatus, 'Abierto'); ?> class="<?php if ($estatus != 'Abierto') { echo 'hide'; } ?>">Abierto</option>
	                <option value="Enterado" <?php selected($estatus, 'Enterado'); ?> class="<?php if ($estatus === 'Trabajando' || $estatus === 'Hecho' || $estatus === 'Cerrado') { echo 'hide'; } ?>">Enterado</option>
	                <option value="Trabajando" <?php selected($estatus, 'Trabajando'); ?> class="<?php if ($estatus === 'Hecho' || $estatus === 'Cerrado') { echo 'hide'; } ?>">Trabajando</option>
	                <option value="Hecho" <?php selected($estatus, 'Hecho'); ?> class="<?php if ($estatus === 'Cerrado') { echo 'hide'; } ?>">Hecho</option>
	                <?php if (current_user_can( 'administrator' )): ?>
		                <option value="Cerrado" <?php selected($estatus, 'Cerrado'); ?> class="">Cerrado</option>
		                <option value="Reabierto" <?php selected($estatus, 'Reabierto'); ?> class="<?php if ($estatus != 'Hecho' && $estatus != 'Cerrado') { echo 'hide'; } ?>">Reabierto</option>
		            <?php endif; ?>
		        </select>
				<input type="submit" id="qo_brief_submit" name="qo_brief_submit" class="width-100p" value="Actualizar"/>
				<input type="hidden" name="edit_estatusBrief" value="post" />
				<?php wp_nonce_field( 'update_brief_estatus' ); ?>
			</form>
			<? if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['edit_estatusBrief'] )) : 
			    $nuevoEstatus 		= $_POST['sistema_estatus'];
			    $permalink 			= get_permalink();
			    $titleBrief			= $post->post_title;

				$post = array(
					'ID'           => $post_id,
				);
				$my_post_id = wp_update_post($post);
				update_post_meta($my_post_id,'sistema_estatus',$nuevoEstatus);

				/* Send email */
				$to 				= "jeaninne@queonda.com.mx";
			    $subject 			= "Estatus Brief Actualizado | QO";

				$message 			= '<html style="font-family: Arial, sans-serif; font-size: 14px;"><body>';
				$message 		   .= '<div style="text-align: center; margin-bottom: 20px;"><a style="color: #000; text-align: center; display: block;" href="' . SITEURL . '"><img style="display: inline-block; margin: auto;" src="https://queonda.com.mx/sites/queonda/wp-content/themes/qo-theme/images/identidad/qo-logo-mail.png"></a></div>'; /* to do cambiar por sitio final */
				$message 		   .= '<h1 style="display: block; margin-bottom: 20px; text-align: center;  font-size: 20px; font-weight: 700; color: #7b2183; text-transform: uppercase;">Estatus Brief QO</h1>';
				$message 			.= '<p>Se ha modificado el estatus de un brief de ' . $estatus . ' a <span style="text-transform: uppercase; font-weight: 600; color: #7b2183;">' . $nuevoEstatus . '</span>.</p>';
				if ($nuevoEstatus === 'Hecho') {
					$message 		.= '<p>Verifica que la tarea esté terminada y actualiza el estatus a "Cerrado".</p>';
				}
				$message 			.= '<p><span style="text-transform: uppercase; font-weight: 600; color: #7b2183;">Brief: </span>' . $titleBrief . '</p>';
				$message 			.= '<p><span style="text-transform: uppercase; font-weight: 600; color: #7b2183;">Responsable: </span>' . $responsableName . '</span></p>';
				$message 			.= '<p><span style="text-transform: uppercase; font-weight: 600; color: #7b2183;">URL: </span>' . $permalink . '</p>';
				$message 			.= '<div style="text-align: center; margin-bottom: 10px; margin-top: 20px;"><p><small>Este email fue enviado desde el sitio de ¿Qué Onda?</small></p></div>';
				$message 	        .= '</body></html>';
				
				/* Evitar enviar mail si se guardo el mismo estatus */
				if ($estatus != $nuevoEstatus && ($nuevoEstatus === 'Enterado' || $nuevoEstatus === 'Hecho')) { 
					wp_mail($to, $subject, $message);
				}
			endif; ?>
		</div>
	</div>
</div>