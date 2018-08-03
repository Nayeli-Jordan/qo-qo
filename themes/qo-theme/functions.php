<?php 

/**
* Define paths to javascript, styles, theme and site.
**/
define( 'JSPATH', get_stylesheet_directory_uri() . '/js/' );
define( 'THEMEPATH', get_stylesheet_directory_uri() . '/' );
define( 'SITEURL', get_site_url() . '/' );


/*------------------------------------*\
	#SNIPPETS
\*------------------------------------*/
require_once( 'inc/post-types.php' );
require_once( 'inc/taxonomies.php' );
require_once( 'inc/pages.php' );


/*------------------------------------*\
	#GENERAL FUNCTIONS
\*------------------------------------*/

/**
* Enqueue frontend scripts and styles
**/
add_action( 'wp_enqueue_scripts', function(){
 
	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.2.1.min.js', array(''), '2.1.1', true );
	// wp_enqueue_script( 'materialize_js', JSPATH.'bin/materialize.min.js', array('jquery'), '1.0', true );
    // wp_enqueue_script( 'imagesloaded_js', JSPATH.'imagesloaded.pkgd.min.js', array(), '', true );
	// wp_enqueue_script( 'masonry_js', JSPATH.'packery.pkgd.min.js', array(), '', true );
	wp_enqueue_script( 'qo_functions', JSPATH.'functions.js', array('materialize_js'), '1.0', true );
 
	wp_localize_script( 'qo_functions', 'siteUrl', SITEURL );
	wp_localize_script( 'qo_functions', 'theme_path', THEMEPATH );
	
	// $is_home = is_front_page() ? "1" : "0";
	// wp_localize_script( 'qo_functions', 'isHome', $is_home );
 
});

/**
* Configuraciones WP
*/

// Agregar css y js al administrador
function load_custom_files_wp_admin() {
        wp_register_style( 'qo_wp_admin_css', THEMEPATH . '/admin/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'qo_wp_admin_css' );

        wp_register_script( 'qo_wp_admin_js', THEMEPATH . 'admin/admin-script.js', false, '1.0.0' );
        wp_enqueue_script( 'qo_wp_admin_js' );       
}
add_action( 'admin_enqueue_scripts', 'load_custom_files_wp_admin' );

//Habilitar thumbnail en post
add_theme_support( 'post-thumbnails' ); 

//Habilitar menú (aparece en personalizar)
add_action('after_setup_theme', 'add_top_menu');
function add_top_menu(){
	register_nav_menu('top_menu',__('Top menu'));
}

//Delimitar número palabras excerpt
/*function custom_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );*/


/**
* Optimización
*/

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );


/**
* SEO y Analitics
**/

//Código Analitics
// function add_google_analytics() {
//     echo '<script src="https://www.google-analytics.com/ga.js" type="text/javascript"></script>';
//     echo '<script type="text/javascript">';
//     echo 'var pageTracker = _gat._getTracker("UA-117075138-1");';
//     echo 'pageTracker._trackPageview();';
//     echo '</script>';
// }
// add_action('wp_footer', 'add_google_analytics');

/* Aplaza el análisis de JavaScript para una carga más rápida */
if(!is_admin()) {
    // Move all JS from header to footer
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
}


/**
* CUSTOM FUNCTIONS
*/

//Sistema
add_action( 'add_meta_boxes', 'sistema_custom_metabox' );

function sistema_custom_metabox(){
	add_meta_box( 'sistema_meta', 'Información BRIEF', 'display_sistema_atributos', 'sistema', 'advanced', 'default');
}

function display_sistema_atributos( $sistema ){
    $cliente            = esc_html( get_post_meta( $sistema->ID, 'sistema_cliente', true ) );    
    $marca            	= esc_html( get_post_meta( $sistema->ID, 'sistema_marca', true ) );    
    $proyecto           = esc_html( get_post_meta( $sistema->ID, 'sistema_proyecto', true ) );    
    $tiempoCotizado    	= esc_html( get_post_meta( $sistema->ID, 'sistema_tiempoCotizado', true ) );   
 
    $fechaRequerida    	= esc_html( get_post_meta( $sistema->ID, 'sistema_fechaRequerida', true ) );   
    $fechaEntrega    	= esc_html( get_post_meta( $sistema->ID, 'sistema_fechaEntrega', true ) );


    $tiempoCreativo_di   	= esc_html( get_post_meta( $sistema->ID, 'sistema_tiempoCreativo_di', true ) );   
    $medioEntrada_di   	= esc_html( get_post_meta( $sistema->ID, 'sistema_medioEntrada_di', true ) );   
    $requerimiento_di 	= esc_html( get_post_meta( $sistema->ID, 'sistema_requerimiento_di', true ) );   
    $noPiezas_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_noPiezas_di', true ) );   
    $descripcion_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_descripcion_di', true ) );   
    $cantidad_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_cantidad_di', true ) );
    $detalles_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_detalles_di', true ) );       
    $product1_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_product1_di', true ) );   
    $peso1_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_peso1_di', true ) );   
    $cantCarga1_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_cantCarga1_di', true ) );   
    $largo1_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_largo1_di', true ) );   
    $ancho1_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_peso1_di', true ) );   
    $alto1_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_alto1_di', true ) );
    $product2_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_product2_di', true ) );   
    $peso2_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_peso2_di', true ) );   
    $cantCarga2_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_cantCarga2_di', true ) );   
    $largo2_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_largo2_di', true ) );   
    $ancho2_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_peso2_di', true ) );   
    $alto2_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_alto2_di', true ) );
    $product3_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_product3_di', true ) );   
    $peso3_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_peso3_di', true ) );   
    $cantCarga3_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_cantCarga3_di', true ) );   
    $largo3_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_largo3_di', true ) );   
    $ancho3_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_peso3_di', true ) );   
    $alto3_di    	= esc_html( get_post_meta( $sistema->ID, 'sistema_alto3_di', true ) );

    $tiempoCreativo_dv   	= esc_html( get_post_meta( $sistema->ID, 'sistema_tiempoCreativo_dv', true ) );   
    $medioEntrada_dv   	= esc_html( get_post_meta( $sistema->ID, 'sistema_medioEntrada_dv', true ) );   
    $requerimiento_dv 	= esc_html( get_post_meta( $sistema->ID, 'sistema_requerimiento_dv', true ) );   
    $noPiezas_dv    	= esc_html( get_post_meta( $sistema->ID, 'sistema_noPiezas_dv', true ) );   
    $descripcion_dv    	= esc_html( get_post_meta( $sistema->ID, 'sistema_descripcion_dv', true ) );   
    $cantidad_dv    	= esc_html( get_post_meta( $sistema->ID, 'sistema_cantidad_dv', true ) );
    $detalles_dv    	= esc_html( get_post_meta( $sistema->ID, 'sistema_detalles_dv', true ) );       
    $material1_dv    	= esc_html( get_post_meta( $sistema->ID, 'sistema_material1_dv', true ) );  
    $largo1_dv    	= esc_html( get_post_meta( $sistema->ID, 'sistema_largo1_dv', true ) );   
    $ancho1_dv    	= esc_html( get_post_meta( $sistema->ID, 'sistema_peso1_dv', true ) );   
    $alto1_dv    	= esc_html( get_post_meta( $sistema->ID, 'sistema_alto1_dv', true ) );
    $material2_dv    	= esc_html( get_post_meta( $sistema->ID, 'sistema_material2_dv', true ) );  
    $largo2_dv    	= esc_html( get_post_meta( $sistema->ID, 'sistema_largo2_dv', true ) );   
    $ancho2_dv    	= esc_html( get_post_meta( $sistema->ID, 'sistema_peso2_dv', true ) );   
    $alto2_dv    	= esc_html( get_post_meta( $sistema->ID, 'sistema_alto2_dv', true ) );
    $material3_dv    	= esc_html( get_post_meta( $sistema->ID, 'sistema_material3_dv', true ) );  
    $largo3_dv    	= esc_html( get_post_meta( $sistema->ID, 'sistema_largo3_dv', true ) );   
    $ancho3_dv    	= esc_html( get_post_meta( $sistema->ID, 'sistema_peso3_dv', true ) );   
    $alto3_dv    	= esc_html( get_post_meta( $sistema->ID, 'sistema_alto3_dv', true ) );

    $tiempoCreativo_mkt   	= esc_html( get_post_meta( $sistema->ID, 'sistema_tiempoCreativo_mkt', true ) );   
    $medioEntrada_mkt   	= esc_html( get_post_meta( $sistema->ID, 'sistema_medioEntrada_mkt', true ) );   
    $requerimiento_mkt 	= esc_html( get_post_meta( $sistema->ID, 'sistema_requerimiento_mkt', true ) );   
    $personasExternas_mkt    	= esc_html( get_post_meta( $sistema->ID, 'sistema_personasExternas_mkt', true ) );
    $caracteristicas_mkt    	= esc_html( get_post_meta( $sistema->ID, 'sistema_caracteristicas_mkt', true ) ); 
    $noPersonas_mkt    	= esc_html( get_post_meta( $sistema->ID, 'sistema_noPersonas_mkt', true ) );
    $detalles_mkt    	= esc_html( get_post_meta( $sistema->ID, 'sistema_detalles_mkt', true ) );

    $tiempoCreativo_stm   	= esc_html( get_post_meta( $sistema->ID, 'sistema_tiempoCreativo_stm', true ) );   
    $medioEntrada_stm   	= esc_html( get_post_meta( $sistema->ID, 'sistema_medioEntrada_stm', true ) );   
    $requerimiento_stm 	= esc_html( get_post_meta( $sistema->ID, 'sistema_requerimiento_stm', true ) );   
    $dominioHospedaje_stm    	= esc_html( get_post_meta( $sistema->ID, 'sistema_dominioHospedaje_stm', true ) );
    $dominio_stm    	= esc_html( get_post_meta( $sistema->ID, 'sistema_dominio_stm', true ) ); 
    $ftp_stm    	= esc_html( get_post_meta( $sistema->ID, 'sistema_ftp_stm', true ) );
    $detalles_stm    	= esc_html( get_post_meta( $sistema->ID, 'sistema_detalles_stm', true ) );

    $tiempoCreativo_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_tiempoCreativo_ext', true ) ); 
    $solicitud1_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_solicitud1_ext', true ) ); 
    $solic_fecha1_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_solic_fecha1_ext', true ) ); 
    $solic_hora1_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_solic_hora1_ext', true ) ); 
    $req_fecha1_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_req_fecha1_ext', true ) ); 
    $req_hora1_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_req_hora1_ext', true ) );
    $ent_fecha1_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_ent_fecha1_ext', true ) ); 
    $ent_hora1_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_ent_hora1_ext', true ) ); 
    $solicitud2_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_solicitud2_ext', true ) ); 
    $solic_fecha2_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_solic_fecha2_ext', true ) ); 
    $solic_hora2_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_solic_hora2_ext', true ) ); 
    $req_fecha2_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_req_fecha2_ext', true ) ); 
    $req_hora2_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_req_hora2_ext', true ) );
    $ent_fecha2_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_ent_fecha2_ext', true ) ); 
    $ent_hora2_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_ent_hora2_ext', true ) ); 
    $solicitud3_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_solicitud3_ext', true ) ); 
    $solic_fecha3_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_solic_fecha3_ext', true ) ); 
    $solic_hora3_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_solic_hora3_ext', true ) ); 
    $req_fecha3_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_req_fecha3_ext', true ) ); 
    $req_hora3_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_req_hora3_ext', true ) );
    $ent_fecha3_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_ent_fecha3_ext', true ) ); 
    $ent_hora3_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_ent_hora3_ext', true ) ); 
    $solicitud4_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_solicitud4_ext', true ) ); 
    $solic_fecha4_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_solic_fecha4_ext', true ) ); 
    $solic_hora4_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_solic_hora4_ext', true ) ); 
    $req_fecha4_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_req_fecha4_ext', true ) ); 
    $req_hora4_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_req_hora4_ext', true ) );
    $ent_fecha4_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_ent_fecha4_ext', true ) ); 
    $ent_hora4_ext   	= esc_html( get_post_meta( $sistema->ID, 'sistema_ent_hora4_ext', true ) ); 
?>

<table class="table-sistema">
	<tr><th colspan="6"><p class="note">*No olvides seleccionar el o los requerimientos necesarios para visualizar correctamente los campos. Aunque los campos estén completos no se visualizarán si no se selecciona (Columna derecha) el requerimiento correspondiente (Área Industrial, Visual, UX/UI, Social Media, etc.)</p></th></tr>
	<tr>
		<th><label>Solicitante</label></th>
		<th><p class="disabled">Columna derecha</p></th>
		<th colspan="2" class="color-light">.</th>
		<th><label>No. de Brief</label></th>
		<th colspan="1"><p class="disabled">Designado</p></th>
	</tr>
	<tr>
		<th><label>Cliente</label></th>
		<th><input type="text" name="sistema_cliente" value="<?php echo $cliente; ?>"></th>
		<th colspan="2" class="color-light">.</th>
		<th><label>Fecha Requerida</label></th>
		<th><input type="date" name="sistema_fechaRequerida" value="<?php echo $fechaRequerida; ?>"></th>
	</tr>
	<tr>
		<th><label>Marca</label></th>
		<th><input type="text" name="sistema_marca" value="<?php echo $marca; ?>"></th>
		<th colspan="2" class="color-light">.</th>
		<th><label>Fecha de Entrega</label></th>
		<th><input type="date" name="sistema_fechaEntrega" value="<?php echo $fechaEntrega; ?>"></th>
	</tr>
	<tr>
		<th><label>Proyecto</label></th>
		<th><input type="text" name="sistema_proyecto" value="<?php echo $proyecto; ?>"></th>
		<th><label class="text-center">Tiempo cotizado</label></th>
		<th colspan="1"></th>
		<th><label>Responsable</label></th>
		<th><p class="disabled">Columna derecha</p></th>
	</tr>
	<tr class="margin-bottom-large">
		<th><label>Requerimiento</label></th>
		<th><p class="disabled">Columna derecha</p></th>
		<th><input type="text" name="sistema_tiempoCotizado" value="<?php echo $tiempoCotizado; ?>"></th>
		<th colspan="1" class="color-light">.</th>
		<th><label>Prioridad</label></th>
		<th><p class="disabled">Columna derecha</p></th>
	</tr>	
</table>
<table class="table-sistema">
	<thead>
		<tr>
			<th colspan="6"><h2>DISEÑO INDUSTRIAL / DATOS Y APOYO</h2></th>			
		</tr>
		<tr>
			<th colspan="2" class="bg-destacade"><label>Tiempo Creativo</label></th>
			<th colspan="4"><input type="text" name="sistema_tiempoCreativo_di" value="<?php echo $tiempoCreativo_di; ?>" placeholder="00:00:00"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th><label>Medio de entrada</label></th>
			<th>
				<select name="sistema_medioEntrada_di">
					<option value="">---</option>
					<option value="CD" <?php selected($medioEntrada_di, 'CD'); ?>>CD</option>
					<option value="Mail" <?php selected($medioEntrada_di, 'Mail'); ?>>Mail</option>
					<option value="Planos" <?php selected($medioEntrada_di, 'Planos'); ?>>Planos</option>
					<option value="USB" <?php selected($medioEntrada_di, 'USB'); ?>>USB</option>
					<option value="Drive" <?php selected($medioEntrada_di, 'Drive'); ?>>Drive</option>
					<option value="Dropbox" <?php selected($medioEntrada_di, 'Dropbox'); ?>>Dropbox</option>
					<option value="WeTransfer" <?php selected($medioEntrada_di, 'WeTransfer'); ?>>WeTransfer</option>
					<option value="Otros" <?php selected($medioEntrada_di, 'Otros'); ?>>Otros (especificar)</option>
				</select>
			</th>
			<th><label>Requerimiento</label></th>
			<th>
				<select name="sistema_requerimiento_di">
					<option value="">---</option>
					<option value="Dummy" <?php selected($requerimiento_di, 'Dummy'); ?>>Dummy</option>
					<option value="Empaque" <?php selected($requerimiento_di, 'Empaque'); ?>>Empaque</option>
					<option value="Planos" <?php selected($requerimiento_di, 'Planos'); ?>>Planos</option>
					<option value="Prototipo" <?php selected($requerimiento_di, 'Prototipo'); ?>>Prototipo</option>
					<option value="Render" <?php selected($requerimiento_di, 'Render'); ?>>Render</option>
					<option value="Suaje" <?php selected($requerimiento_di, 'Suaje'); ?>>Suaje</option>
					<option value="Stand" <?php selected($requerimiento_di, 'Stand'); ?>>Stand</option>
				</select>
			</th>
			<th><label>No. de piezas</label></th>
			<th><input type="text" name="sistema_noPiezas_di" value="<?php echo $noPiezas_di; ?>"></th>
		</tr>
		<tr>
			<th colspan="2"><label>Descripción general del proyecto</label></th>
			<th colspan="2"><input type="text" name="sistema_descripcion_di" value="<?php echo $descripcion_di; ?>"></th>
			<th><label>Cantidad a producir</label></th>
			<th><input type="text" name="sistema_cantidad_di" value="<?php echo $cantidad_di; ?>"></th>
		</tr>
		<tr>
			<th colspan="6"><textarea name="sistema_detalles_di"><?php echo $detalles_di; ?></textarea></th>
		</tr>
		<tr>
			<th colspan="6"><label>Llenar en caso de tener medida de producto o material creativo:</label></th>
		</tr>
		<tr>
			<th><label>Producto 1</label></th>
			<th><input type="text" name="sistema_product1_di" value="<?php echo $product1_di; ?>"></th>
			<th><label>Peso(kg)</label></th>
			<th><input type="text" name="sistema_peso1_di" value="<?php echo $peso1_di; ?>"></th>
			<th><label>Cantidad de Carga</label></th>
			<th><input type="text" name="sistema_cantCarga1_di" value="<?php echo $cantCarga1_di; ?>"></th>
		</tr>
		<tr>
			<th><label>Largo (cm)</label></th>
			<th><input type="text" name="sistema_largo1_di" value="<?php echo $largo1_di; ?>"></th>
			<th><label>Ancho (cm)</label></th>
			<th><input type="text" name="sistema_ancho1_di" value="<?php echo $ancho1_di; ?>"></th>
			<th><label>Alto (cm)</label></th>
			<th><input type="text" name="sistema_alto1_di" value="<?php echo $alto1_di; ?>"></th>
		</tr>
		<tr>
			<th><label>Producto 2</label></th>
			<th><input type="text" name="sistema_product2_di" value="<?php echo $product2_di; ?>"></th>
			<th><label>Peso(kg)</label></th>
			<th><input type="text" name="sistema_peso2_di" value="<?php echo $peso2_di; ?>"></th>
			<th><label>Cantidad de Carga</label></th>
			<th><input type="text" name="sistema_cantCarga2_di" value="<?php echo $cantCarga2_di; ?>"></th>
		</tr>
		<tr>
			<th><label>Largo (cm)</label></th>
			<th><input type="text" name="sistema_largo2_di" value="<?php echo $largo2_di; ?>"></th>
			<th><label>Ancho (cm)</label></th>
			<th><input type="text" name="sistema_ancho2_di" value="<?php echo $ancho2_di; ?>"></th>
			<th><label>Alto (cm)</label></th>
			<th><input type="text" name="sistema_alto2_di" value="<?php echo $alto2_di; ?>"></th>
		</tr>
		<tr>
			<th><label>Producto 3</label></th>
			<th><input type="text" name="sistema_product3_di" value="<?php echo $product3_di; ?>"></th>
			<th><label>Peso(kg)</label></th>
			<th><input type="text" name="sistema_peso3_di" value="<?php echo $peso3_di; ?>"></th>
			<th><label>Cantidad de Carga</label></th>
			<th><input type="text" name="sistema_cantCarga3_di" value="<?php echo $cantCarga3_di; ?>"></th>
		</tr>
		<tr>
			<th><label>Largo (cm)</label></th>
			<th><input type="text" name="sistema_largo3_di" value="<?php echo $largo3_di; ?>"></th>
			<th><label>Ancho (cm)</label></th>
			<th><input type="text" name="sistema_ancho3_di" value="<?php echo $ancho3_di; ?>"></th>
			<th><label>Alto (cm)</label></th>
			<th><input type="text" name="sistema_alto3_di" value="<?php echo $alto3_di; ?>"></th>
		</tr>
	</tbody>
</table>
<table class="table-sistema">
	<thead>
		<tr>
			<th colspan="6"><h2>DISEÑO VISUAL / DATOS Y APOYO</h2></th>			
		</tr>
		<tr>
			<th colspan="2" class="bg-destacade"><label>Tiempo Creativo</label></th>
			<th colspan="4"><input type="text" name="sistema_tiempoCreativo_dv" value="<?php echo $tiempoCreativo_dv; ?>" placeholder="00:00:00"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th><label>Medio de entrada</label></th>
			<th>
				<select name="sistema_medioEntrada_dv">
					<option value="">---</option>
					<option value="CD" <?php selected($medioEntrada_dv, 'CD'); ?>>CD</option>
					<option value="Mail" <?php selected($medioEntrada_dv, 'Mail'); ?>>Mail</option>
					<option value="Planos" <?php selected($medioEntrada_dv, 'Planos'); ?>>Planos</option>
					<option value="USB" <?php selected($medioEntrada_dv, 'USB'); ?>>USB</option>
					<option value="Drive" <?php selected($medioEntrada_dv, 'Drive'); ?>>Drive</option>
					<option value="Dropbox" <?php selected($medioEntrada_dv, 'Dropbox'); ?>>Dropbox</option>
					<option value="WeTransfer" <?php selected($medioEntrada_dv, 'WeTransfer'); ?>>WeTransfer</option>
					<option value="Otros" <?php selected($medioEntrada_dv, 'Otros'); ?>>Otros (especificar)</option>
				</select>
			</th>
			<th><label>Requerimiento</label></th>
			<th>
				<select name="sistema_requerimiento_dv">
					<option value="">---</option>
					<option value="Diseño p/adaptar" <?php selected($requerimiento_dv, 'Diseño p/adaptar'); ?>>Diseño p/adaptar</option>
					<option value="Diseño p/impresión" <?php selected($requerimiento_dv, 'Diseño p/impresión'); ?>>Diseño p/impresión</option>
					<option value="Diseño nuevo" <?php selected($requerimiento_dv, 'Diseño nuevo'); ?>>Diseño nuevo</option>
					<option value="Montaje" <?php selected($requerimiento_dv, 'Montaje'); ?>>Montaje</option>
					<option value="Logo" <?php selected($requerimiento_dv, 'Logo'); ?>>Logo</option>
					<option value="Página Web" <?php selected($requerimiento_dv, 'Página Web'); ?>>Página Web</option>
					<option value="Render" <?php selected($requerimiento_dv, 'Render'); ?>>Render</option>
					<option value="Otros" <?php selected($requerimiento_dv, 'Otros'); ?>>Otros</option>
				</select>
			</th>
			<th><label>No. de piezas</label></th>
			<th><input type="text" name="sistema_noPiezas_dv" value="<?php echo $noPiezas_dv; ?>"></th>
		</tr>
		<tr>
			<th colspan="2"><label>Descripción general del proyecto</label></th>
			<th colspan="2"><input type="text" name="sistema_descripcion_dv" value="<?php echo $descripcion_dv; ?>"></th>
			<th><label>Cantidad a producir</label></th>
			<th><input type="text" name="sistema_cantidad_dv" value="<?php echo $cantidad_dv; ?>"></th>
		</tr>
		<tr>
			<th colspan="6"><textarea name="sistema_detalles_dv"><?php echo $detalles_dv; ?></textarea></th>
		</tr>
		<tr>
			<th colspan="6"><label>Llenar en caso de tener medida del material creativo:</label></th>
		</tr>
		<tr>
			<th><label>Material 1</label></th>
			<th colspan="6"><input type="text" name="sistema_material1_dv" value="<?php echo $material1_dv; ?>"></th>
		</tr>
		<tr>
			<th><label>Largo (cm)</label></th>
			<th><input type="text" name="sistema_largo1_dv" value="<?php echo $largo1_dv; ?>"></th>
			<th><label>Ancho (cm)</label></th>
			<th><input type="text" name="sistema_ancho1_dv" value="<?php echo $ancho1_dv; ?>"></th>
			<th><label>Alto (cm)</label></th>
			<th><input type="text" name="sistema_alto1_dv" value="<?php echo $alto1_dv; ?>"></th>
		</tr>
		<tr>
			<th><label>Material 2</label></th>
			<th colspan="6"><input type="text" name="sistema_material2_dv" value="<?php echo $material2_dv; ?>"></th>
		</tr>
		<tr>
			<th><label>Largo (cm)</label></th>
			<th><input type="text" name="sistema_largo2_dv" value="<?php echo $largo2_dv; ?>"></th>
			<th><label>Ancho (cm)</label></th>
			<th><input type="text" name="sistema_ancho2_dv" value="<?php echo $ancho2_dv; ?>"></th>
			<th><label>Alto (cm)</label></th>
			<th><input type="text" name="sistema_alto2_dv" value="<?php echo $alto2_dv; ?>"></th>
		</tr>
		<tr>
			<th><label>Material 3</label></th>
			<th colspan="6"><input type="text" name="sistema_material3_dv" value="<?php echo $material3_dv; ?>"></th>
		</tr>
		<tr>
			<th><label>Largo (cm)</label></th>
			<th><input type="text" name="sistema_largo3_dv" value="<?php echo $largo3_dv; ?>"></th>
			<th><label>Ancho (cm)</label></th>
			<th><input type="text" name="sistema_ancho3_dv" value="<?php echo $ancho3_dv; ?>"></th>
			<th><label>Alto (cm)</label></th>
			<th><input type="text" name="sistema_alto3_dv" value="<?php echo $alto3_dv; ?>"></th>
		</tr>
	</tbody>
</table>
<table class="table-sistema">
	<thead>
		<tr>
			<th colspan="6"><h2>MARKETING / DATOS Y APOYO</h2></th>			
		</tr>
		<tr>
			<th colspan="2" class="bg-destacade"><label>Tiempo Creativo</label></th>
			<th colspan="4"><input type="text" name="sistema_tiempoCreativo_mkt" value="<?php echo $tiempoCreativo_mkt; ?>" placeholder="00:00:00"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th><label>Medio de entrada</label></th>
			<th>
				<select name="sistema_medioEntrada_mkt">
					<option value="">---</option>
					<option value="CD" <?php selected($medioEntrada_mkt, 'CD'); ?>>CD</option>
					<option value="Mail" <?php selected($medioEntrada_mkt, 'Mail'); ?>>Mail</option>
					<option value="Planos" <?php selected($medioEntrada_mkt, 'Planos'); ?>>Planos</option>
					<option value="USB" <?php selected($medioEntrada_mkt, 'USB'); ?>>USB</option>
					<option value="Drive" <?php selected($medioEntrada_mkt, 'Drive'); ?>>Drive</option>
					<option value="Dropbox" <?php selected($medioEntrada_mkt, 'Dropbox'); ?>>Dropbox</option>
					<option value="WeTransfer" <?php selected($medioEntrada_mkt, 'WeTransfer'); ?>>WeTransfer</option>
					<option value="Otros" <?php selected($medioEntrada_mkt, 'Otros'); ?>>Otros (especificar)</option>
				</select>
			</th>
			<th><label>Requerimiento</label></th>
			<th>
				<select name="sistema_requerimiento_mkt">
					<option value="">---</option>
					<option value="Asesoría Técnica" <?php selected($requerimiento_mkt, 'Asesoría Técnica'); ?>>Asesoría Técnica</option>
					<option value="Activación BTL" <?php selected($requerimiento_mkt, 'Activación BTL'); ?>>Activación BTL</option>
					<option value="Asesoría de mercado" <?php selected($requerimiento_mkt, 'Asesoría de mercado'); ?>>Asesoría de mercado</option>
					<option value="Estudio de mercado" <?php selected($requerimiento_mkt, 'Estudio de mercado'); ?>>Estudio de mercado</option>
					<option value="Medios de comunicación" <?php selected($requerimiento_mkt, 'Medios de comunicación'); ?>>Medios de comunicación</option>
					<option value="Estrategía de comunicación" <?php selected($requerimiento_mkt, 'Estrategía de comunicación'); ?>>Estrategía de comunicación</option>
					<option value="Pauta" <?php selected($requerimiento_mkt, 'Pauta'); ?>>Pauta</option>
					<option value="Estadisticas" <?php selected($requerimiento_mkt, 'Estadisticas'); ?>>Estadisticas</option>
					<option value="Creación de red" <?php selected($requerimiento_mkt, 'Creación de red'); ?>>Creación de red</option>
				</select>
			</th>
			<th><label>Personas externas</label></th>
			<th><input type="text" name="sistema_personasExternas_mkt" value="<?php echo $personasExternas_mkt; ?>"></th>
		</tr>
		<tr>
			<th colspan="2"><label>Descripción general del proyecto</label></th>
			<th><label>Características</label></th>
			<th><input type="text" name="sistema_caracteristicas_mkt" value="<?php echo $caracteristicas_mkt; ?>"></th>
			<th><label>No. de Personas</label></th>
			<th><input type="text" name="sistema_noPersonas_mkt" value="<?php echo $noPersonas_mkt; ?>"></th>
		</tr>
		<tr>
			<th colspan="6"><textarea name="sistema_detalles_mkt"><?php echo $detalles_mkt; ?></textarea></th>
		</tr>
	</tbody>
</table>
<table class="table-sistema">
	<thead>
		<tr>
			<th colspan="6"><h2>SISTEMAS / DATOS Y APOYO</h2></th>			
		</tr>
		<tr>
			<th colspan="2" class="bg-destacade"><label>Tiempo Creativo</label></th>
			<th colspan="4"><input type="text" name="sistema_tiempoCreativo_stm" value="<?php echo $tiempoCreativo_stm; ?>" placeholder="00:00:00"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th><label>Medio de entrada</label></th>
			<th>
				<select name="sistema_medioEntrada_stm">
					<option value="">---</option>
					<option value="CD" <?php selected($medioEntrada_stm, 'CD'); ?>>CD</option>
					<option value="FTP" <?php selected($medioEntrada_stm, 'FTP'); ?>>FTP</option>
					<option value="Mail" <?php selected($medioEntrada_stm, 'Mail'); ?>>Mail</option>
					<option value="Planos" <?php selected($medioEntrada_stm, 'Planos'); ?>>Planos</option>
					<option value="USB" <?php selected($medioEntrada_stm, 'USB'); ?>>USB</option>
					<option value="Drive" <?php selected($medioEntrada_stm, 'Drive'); ?>>Drive</option>
					<option value="Dropbox" <?php selected($medioEntrada_stm, 'Dropbox'); ?>>Dropbox</option>
					<option value="WeTransfer" <?php selected($medioEntrada_stm, 'WeTransfer'); ?>>WeTransfer</option>
					<option value="Otros" <?php selected($medioEntrada_stm, 'Otros'); ?>>Otros (especificar)</option>
				</select>
			</th>
			<th><label>Requerimiento</label></th>
			<th>
				<select name="sistema_requerimiento_stm">
					<option value="">---</option>
					<option value="Asesoría Técnica" <?php selected($requerimiento_stm, 'Asesoría Técnica'); ?>>Asesoría Técnica</option>
					<option value="Desarrollo de sistemas" <?php selected($requerimiento_stm, 'Desarrollo de sistemas'); ?>>Desarrollo de sistemas</option>
					<option value="Programación Web" <?php selected($requerimiento_stm, 'Programación Web'); ?>>Programación Web</option>
					<option value="SSL" <?php selected($requerimiento_stm, 'SSL'); ?>>SSL</option>
					<option value="Posicionamiento" <?php selected($requerimiento_stm, 'Posicionamiento'); ?>>Posicionamiento</option>
					<option value="Mantenimiento Web" <?php selected($requerimiento_stm, 'Mantenimiento Web'); ?>>Mantenimiento Web</option>
				</select>
			</th>
			<th><label>Dominio y Hospedaje</label></th>
			<th>
				<select name="sistema_dominioHospedaje_stm">
					<option value="">---</option>
					<option value="Sí" <?php selected($dominioHospedaje_stm, 'Sí'); ?>>Sí</option>
					<option value="No" <?php selected($dominioHospedaje_stm, 'No'); ?>>No</option>
				</select>
			</th>
		</tr>
		<tr>
			<th colspan="2"><label>Descripción general del proyecto</label></th>
			<th><label>Dominio</label></th>
			<th><input type="text" name="sistema_dominio_stm" value="<?php echo $dominio_stm; ?>"></th>
			<th><label>FTP</label></th>
			<th><input type="text" name="sistema_ftp_stm" value="<?php echo $ftp_stm; ?>"></th>
		</tr>
		<tr>
			<th colspan="6"><textarea name="sistema_detalles_stm"><?php echo $detalles_stm; ?></textarea></th>
		</tr>
	</tbody>
</table>
<table class="table-sistema">
	<thead>
		<tr>
			<th colspan="6"><h2>LLENAR EN CASO QUE EXISTAN CAMBIOS POSTERIORES A LA PRIMERA SOLICITUD</h2></th>
		</tr>
		<tr>
			<th colspan="2" class="bg-destacade"><label>Tiempo Creativo</label></th>
			<th colspan="4"><input type="text" name="sistema_tiempoCreativo_ext" value="<?php echo $tiempoCreativo_ext; ?>" placeholder="00:00:00"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th class="bg-destacade"><label>Actualización #1</label></th>
			<th colspan="2" rowspan="3"><textarea class="textarea_row3" name="sistema_solicitud1_ext"><?php echo $solicitud1_ext; ?></textarea></th>
			<th><label>Fecha y Hora Solicitado</label></th>
			<th><input type="date" name="sistema_solic_fecha1_ext" value="<?php echo $solic_fecha1_ext; ?>"></th>
			<th><input type="text" name="sistema_solic_hora1_ext" value="<?php echo $solic_hora1_ext; ?>" placeholder="00:00"></th>
		</tr>
		<tr>
			<th rowspan="2"><label>Solicitud</label></th>
			<th><label>Fecha Requerida</label></th>
			<th><input type="date" name="sistema_req_fecha1_ext" value="<?php echo $req_fecha1_ext; ?>"></th>
			<th><input type="text" name="sistema_req_hora1_ext" value="<?php echo $req_hora1_ext; ?>" placeholder="00:00">
		</tr>
		<tr>
			<th><label>Fecha de ENTREGA</label></th>
			<th><input type="date" name="sistema_ent_fecha1_ext" value="<?php echo $ent_fecha1_ext; ?>"></th>
			<th><input type="text" name="sistema_ent_hora1_ext" value="<?php echo $ent_hora1_ext; ?>" placeholder="00:00">
		</tr>
		<tr>
			<th class="bg-destacade"><label>Actualización #2</label></th>
			<th colspan="2" rowspan="3"><textarea class="textarea_row3" name="sistema_solicitud2_ext"><?php echo $solicitud2_ext; ?></textarea></th>
			<th><label>Fecha y Hora Solicitado</label></th>
			<th><input type="date" name="sistema_solic_fecha2_ext" value="<?php echo $solic_fecha2_ext; ?>"></th>
			<th><input type="text" name="sistema_solic_hora2_ext" value="<?php echo $solic_hora2_ext; ?>" placeholder="00:00"></th>
		</tr>
		<tr>
			<th rowspan="2"><label>Solicitud</label></th>
			<th><label>Fecha Requerida</label></th>
			<th><input type="date" name="sistema_req_fecha2_ext" value="<?php echo $req_fecha2_ext; ?>"></th>
			<th><input type="text" name="sistema_req_hora2_ext" value="<?php echo $req_hora2_ext; ?>" placeholder="00:00">
		</tr>
		<tr>
			<th><label>Fecha de ENTREGA</label></th>
			<th><input type="date" name="sistema_ent_fecha2_ext" value="<?php echo $ent_fecha2_ext; ?>"></th>
			<th><input type="text" name="sistema_ent_hora2_ext" value="<?php echo $ent_hora2_ext; ?>" placeholder="00:00">
		</tr>
		<tr>
			<th class="bg-destacade"><label>Actualización #3</label></th>
			<th colspan="2" rowspan="3"><textarea class="textarea_row3" name="sistema_solicitud3_ext"><?php echo $solicitud3_ext; ?></textarea></th>
			<th><label>Fecha y Hora Solicitado</label></th>
			<th><input type="date" name="sistema_solic_fecha3_ext" value="<?php echo $solic_fecha3_ext; ?>"></th>
			<th><input type="text" name="sistema_solic_hora3_ext" value="<?php echo $solic_hora3_ext; ?>" placeholder="00:00"></th>
		</tr>
		<tr>
			<th rowspan="2"><label>Solicitud</label></th>
			<th><label>Fecha Requerida</label></th>
			<th><input type="date" name="sistema_req_fecha3_ext" value="<?php echo $req_fecha3_ext; ?>"></th>
			<th><input type="text" name="sistema_req_hora3_ext" value="<?php echo $req_hora3_ext; ?>" placeholder="00:00">
		</tr>
		<tr>
			<th><label>Fecha de ENTREGA</label></th>
			<th><input type="date" name="sistema_ent_fecha3_ext" value="<?php echo $ent_fecha3_ext; ?>"></th>
			<th><input type="text" name="sistema_ent_hora3_ext" value="<?php echo $ent_hora3_ext; ?>" placeholder="00:00">
		</tr>
		<tr>
			<th class="bg-destacade"><label>Actualización #4</label></th>
			<th colspan="2" rowspan="3"><textarea class="textarea_row3" name="sistema_solicitud4_ext"><?php echo $solicitud4_ext; ?></textarea></th>
			<th><label>Fecha y Hora Solicitado</label></th>
			<th><input type="date" name="sistema_solic_fecha4_ext" value="<?php echo $solic_fecha4_ext; ?>"></th>
			<th><input type="text" name="sistema_solic_hora4_ext" value="<?php echo $solic_hora4_ext; ?>" placeholder="00:00"></th>
		</tr>
		<tr>
			<th rowspan="2"><label>Solicitud</label></th>
			<th><label>Fecha Requerida</label></th>
			<th><input type="date" name="sistema_req_fecha4_ext" value="<?php echo $req_fecha4_ext; ?>"></th>
			<th><input type="text" name="sistema_req_hora4_ext" value="<?php echo $req_hora4_ext; ?>" placeholder="00:00">
		</tr>
		<tr>
			<th><label>Fecha de ENTREGA</label></th>
			<th><input type="date" name="sistema_ent_fecha4_ext" value="<?php echo $ent_fecha4_ext; ?>"></th>
			<th><input type="text" name="sistema_ent_hora4_ext" value="<?php echo $ent_hora4_ext; ?>" placeholder="00:00">
		</tr>
	</tbody>
</table>
<?php

}

add_action( 'save_post', 'sistema_save_metas', 10, 2 );
function sistema_save_metas( $idsistema, $sistema ){
	//Comprobamos que es del tipo que nos interesa
	if ( $sistema->post_type == 'sistema' ){
	//Guardamos los datos que vienen en el POST
        if ( isset( $_POST['sistema_cliente'] ) ){
            update_post_meta( $idsistema, 'sistema_cliente', $_POST['sistema_cliente'] );
        }
        if ( isset( $_POST['sistema_marca'] ) ){
            update_post_meta( $idsistema, 'sistema_marca', $_POST['sistema_marca'] );
        }
        if ( isset( $_POST['sistema_proyecto'] ) ){
            update_post_meta( $idsistema, 'sistema_proyecto', $_POST['sistema_proyecto'] );
        } 
        if ( isset( $_POST['tiempoCotizado'] ) ){
            update_post_meta( $idsistema, 'tiempoCotizado', $_POST['tiempoCotizado'] );
        }
        if ( isset( $_POST['sistema_fechaRequerida'] ) ){
            update_post_meta( $idsistema, 'sistema_fechaRequerida', $_POST['sistema_fechaRequerida'] );
        }
        if ( isset( $_POST['sistema_fechaEntrega'] ) ){
            update_post_meta( $idsistema, 'sistema_fechaEntrega', $_POST['sistema_fechaEntrega'] );
        }
        if ( isset( $_POST['sistema_medioEntrada_di'] ) ){
            update_post_meta( $idsistema, 'sistema_medioEntrada_di', $_POST['sistema_medioEntrada_di'] );
        }
		if ( isset( $_POST['sistema_requerimiento_di'] ) ){
            update_post_meta( $idsistema, 'sistema_requerimiento_di', $_POST['sistema_requerimiento_di'] );
        }
		if ( isset( $_POST['sistema_noPiezas_di'] ) ){
            update_post_meta( $idsistema, 'sistema_noPiezas_di', $_POST['sistema_noPiezas_di'] );
        }
		if ( isset( $_POST['sistema_descripcion_di'] ) ){
            update_post_meta( $idsistema, 'sistema_descripcion_di', $_POST['sistema_descripcion_di'] );
        }
		if ( isset( $_POST['sistema_cantidad_di'] ) ){
            update_post_meta( $idsistema, 'sistema_cantidad_di', $_POST['sistema_cantidad_di'] );
        }
        if ( isset( $_POST['sistema_detalles_di'] ) ){
            update_post_meta( $idsistema, 'sistema_detalles_di', $_POST['sistema_detalles_di'] );
        }
        if ( isset( $_POST['sistema_product1_di'] ) ){
            update_post_meta( $idsistema, 'sistema_product1_di', $_POST['sistema_product1_di'] );
        }
        if ( isset( $_POST['sistema_peso1_di'] ) ){
            update_post_meta( $idsistema, 'sistema_peso1_di', $_POST['sistema_peso1_di'] );
        }
        if ( isset( $_POST['sistema_cantCarga1_di'] ) ){
            update_post_meta( $idsistema, 'sistema_cantCarga1_di', $_POST['sistema_cantCarga1_di'] );
        }
        if ( isset( $_POST['sistema_largo1_di'] ) ){
            update_post_meta( $idsistema, 'sistema_largo1_di', $_POST['sistema_largo1_di'] );
        }
        if ( isset( $_POST['sistema_ancho1_di'] ) ){
            update_post_meta( $idsistema, 'sistema_product1_di', $_POST['sistema_product1_di'] );
        }
        if ( isset( $_POST['sistema_alto1_di'] ) ){
            update_post_meta( $idsistema, 'sistema_alto1_di', $_POST['sistema_alto1_di'] );
        }
        if ( isset( $_POST['sistema_product2_di'] ) ){
            update_post_meta( $idsistema, 'sistema_product2_di', $_POST['sistema_product2_di'] );
        }
        if ( isset( $_POST['sistema_peso2_di'] ) ){
            update_post_meta( $idsistema, 'sistema_peso2_di', $_POST['sistema_peso2_di'] );
        }
        if ( isset( $_POST['sistema_cantCarga2_di'] ) ){
            update_post_meta( $idsistema, 'sistema_cantCarga2_di', $_POST['sistema_cantCarga2_di'] );
        }
        if ( isset( $_POST['sistema_largo2_di'] ) ){
            update_post_meta( $idsistema, 'sistema_largo2_di', $_POST['sistema_largo2_di'] );
        }
        if ( isset( $_POST['sistema_ancho2_di'] ) ){
            update_post_meta( $idsistema, 'sistema_product2_di', $_POST['sistema_product2_di'] );
        }
        if ( isset( $_POST['sistema_alto2_di'] ) ){
            update_post_meta( $idsistema, 'sistema_alto2_di', $_POST['sistema_alto2_di'] );
        }
        if ( isset( $_POST['sistema_product3_di'] ) ){
            update_post_meta( $idsistema, 'sistema_product3_di', $_POST['sistema_product3_di'] );
        }
        if ( isset( $_POST['sistema_peso3_di'] ) ){
            update_post_meta( $idsistema, 'sistema_peso3_di', $_POST['sistema_peso3_di'] );
        }
        if ( isset( $_POST['sistema_cantCarga3_di'] ) ){
            update_post_meta( $idsistema, 'sistema_cantCarga3_di', $_POST['sistema_cantCarga3_di'] );
        }
        if ( isset( $_POST['sistema_largo3_di'] ) ){
            update_post_meta( $idsistema, 'sistema_largo3_di', $_POST['sistema_largo3_di'] );
        }
        if ( isset( $_POST['sistema_ancho3_di'] ) ){
            update_post_meta( $idsistema, 'sistema_product3_di', $_POST['sistema_product3_di'] );
        }
        if ( isset( $_POST['sistema_alto3_di'] ) ){
            update_post_meta( $idsistema, 'sistema_alto3_di', $_POST['sistema_alto3_di'] );
        }
        if ( isset( $_POST['sistema_tiempoCreativo_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_tiempoCreativo_dv', $_POST['sistema_tiempoCreativo_dv'] );
        }
        if ( isset( $_POST['sistema_medioEntrada_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_medioEntrada_dv', $_POST['sistema_medioEntrada_dv'] );
        }
        if ( isset( $_POST['sistema_requerimiento_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_requerimiento_dv', $_POST['sistema_requerimiento_dv'] );
        }
        if ( isset( $_POST['sistema_noPiezas_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_noPiezas_dv', $_POST['sistema_noPiezas_dv'] );
        }
        if ( isset( $_POST['sistema_descripcion_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_descripcion_dv', $_POST['sistema_descripcion_dv'] );
        }
        if ( isset( $_POST['sistema_cantidad_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_cantidad_dv', $_POST['sistema_cantidad_dv'] );
        }
        if ( isset( $_POST['sistema_detalles_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_detalles_dv', $_POST['sistema_detalles_dv'] );
        }
        if ( isset( $_POST['sistema_material1_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_material1_dv', $_POST['sistema_material1_dv'] );
        }
        if ( isset( $_POST['sistema_largo1_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_largo1_dv', $_POST['sistema_largo1_dv'] );
        }
        if ( isset( $_POST['sistema_ancho1_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_ancho1_dv', $_POST['sistema_ancho1_dv'] );
        }
        if ( isset( $_POST['sistema_alto1_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_alto1_dv', $_POST['sistema_alto1_dv'] );
        }
        if ( isset( $_POST['sistema_material2_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_material2_dv', $_POST['sistema_material2_dv'] );
        }
        if ( isset( $_POST['sistema_largo2_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_largo2_dv', $_POST['sistema_largo2_dv'] );
        }  
        if ( isset( $_POST['sistema_ancho2_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_ancho2_dv', $_POST['sistema_ancho2_dv'] );
        }  
        if ( isset( $_POST['sistema_alto2_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_alto2_dv', $_POST['sistema_alto2_dv'] );
        }  
        if ( isset( $_POST['sistema_material3_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_material3_dv', $_POST['sistema_material3_dv'] );
        }
        if ( isset( $_POST['sistema_largo3_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_largo3_dv', $_POST['sistema_largo3_dv'] );
        }  
        if ( isset( $_POST['sistema_ancho3_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_ancho3_dv', $_POST['sistema_ancho3_dv'] );
        } 
        if ( isset( $_POST['sistema_alto3_dv'] ) ){
            update_post_meta( $idsistema, 'sistema_alto3_dv', $_POST['sistema_alto3_dv'] );
        } 
        if ( isset( $_POST['sistema_tiempoCreativo_mkt'] ) ){
            update_post_meta( $idsistema, 'sistema_tiempoCreativo_mkt', $_POST['sistema_tiempoCreativo_mkt'] );
        }
        if ( isset( $_POST['sistema_medioEntrada_mkt'] ) ){
            update_post_meta( $idsistema, 'sistema_medioEntrada_mkt', $_POST['sistema_medioEntrada_mkt'] );
        }
        if ( isset( $_POST['sistema_requerimiento_mkt'] ) ){
            update_post_meta( $idsistema, 'sistema_requerimiento_mkt', $_POST['sistema_requerimiento_mkt'] );
        }
        if ( isset( $_POST['sistema_personasExternas_mkt'] ) ){
            update_post_meta( $idsistema, 'sistema_personasExternas_mkt', $_POST['sistema_personasExternas_mkt'] );
        }
        if ( isset( $_POST['sistema_caracteristicas_mkt'] ) ){
            update_post_meta( $idsistema, 'sistema_caracteristicas_mkt', $_POST['sistema_caracteristicas_mkt'] );
        }
        if ( isset( $_POST['sistema_noPersonas_mkt'] ) ){
            update_post_meta( $idsistema, 'sistema_noPersonas_mkt', $_POST['sistema_noPersonas_mkt'] );
        }
        if ( isset( $_POST['sistema_detalles_mkt'] ) ){
            update_post_meta( $idsistema, 'sistema_detalles_mkt', $_POST['sistema_detalles_mkt'] );
        }
        if ( isset( $_POST['sistema_tiempoCreativo_stm'] ) ){
            update_post_meta( $idsistema, 'sistema_tiempoCreativo_stm', $_POST['sistema_tiempoCreativo_stm'] );
        }
        if ( isset( $_POST['sistema_medioEntrada_stm'] ) ){
            update_post_meta( $idsistema, 'sistema_medioEntrada_stm', $_POST['sistema_medioEntrada_stm'] );
        }
        if ( isset( $_POST['sistema_requerimiento_stm'] ) ){
            update_post_meta( $idsistema, 'sistema_requerimiento_stm', $_POST['sistema_requerimiento_stm'] );
        }
        if ( isset( $_POST['sistema_dominioHospedaje_stm'] ) ){
            update_post_meta( $idsistema, 'sistema_dominioHospedaje_stm', $_POST['sistema_dominioHospedaje_stm'] );
        }
        if ( isset( $_POST['sistema_dominio_stm'] ) ){
            update_post_meta( $idsistema, 'sistema_dominio_stm', $_POST['sistema_dominio_stm'] );
        }
        if ( isset( $_POST['sistema_ftp_stm'] ) ){
            update_post_meta( $idsistema, 'sistema_ftp_stm', $_POST['sistema_ftp_stm'] );
        }
        if ( isset( $_POST['sistema_detalles_stm'] ) ){
            update_post_meta( $idsistema, 'sistema_detalles_stm', $_POST['sistema_detalles_stm'] );
        }
        if ( isset( $_POST['sistema_tiempoCreativo_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_tiempoCreativo_ext', $_POST['sistema_tiempoCreativo_ext'] );
        }
        if ( isset( $_POST['sistema_solicitud1_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_solicitud1_ext', $_POST['sistema_solicitud1_ext'] );
        }
        if ( isset( $_POST['sistema_solic_fecha1_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_solic_fecha1_ext', $_POST['sistema_solic_fecha1_ext'] );
        }
        if ( isset( $_POST['sistema_solic_hora1_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_solic_hora1_ext', $_POST['sistema_solic_hora1_ext'] );
        }
        if ( isset( $_POST['sistema_req_fecha1_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_req_fecha1_ext', $_POST['sistema_req_fecha1_ext'] );
        }
        if ( isset( $_POST['sistema_req_hora1_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_req_hora1_ext', $_POST['sistema_req_hora1_ext'] );
        }
        if ( isset( $_POST['sistema_ent_fecha1_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_ent_fecha1_ext', $_POST['sistema_ent_fecha1_ext'] );
        }
        if ( isset( $_POST['sistema_ent_hora1_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_ent_hora1_ext', $_POST['sistema_ent_hora1_ext'] );
        }
        if ( isset( $_POST['sistema_solicitud2_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_solicitud2_ext', $_POST['sistema_solicitud2_ext'] );
        }
        if ( isset( $_POST['sistema_solic_fecha2_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_solic_fecha2_ext', $_POST['sistema_solic_fecha2_ext'] );
        }
        if ( isset( $_POST['sistema_solic_hora2_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_solic_hora2_ext', $_POST['sistema_solic_hora2_ext'] );
        }
        if ( isset( $_POST['sistema_req_fecha2_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_req_fecha2_ext', $_POST['sistema_req_fecha2_ext'] );
        }
        if ( isset( $_POST['sistema_req_hora2_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_req_hora2_ext', $_POST['sistema_req_hora2_ext'] );
        }
        if ( isset( $_POST['sistema_ent_fecha2_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_ent_fecha2_ext', $_POST['sistema_ent_fecha2_ext'] );
        }
        if ( isset( $_POST['sistema_ent_hora2_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_ent_hora2_ext', $_POST['sistema_ent_hora2_ext'] );
        }
        if ( isset( $_POST['sistema_solicitud3_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_solicitud3_ext', $_POST['sistema_solicitud3_ext'] );
        }
        if ( isset( $_POST['sistema_solic_fecha3_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_solic_fecha3_ext', $_POST['sistema_solic_fecha3_ext'] );
        }
        if ( isset( $_POST['sistema_solic_hora3_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_solic_hora3_ext', $_POST['sistema_solic_hora3_ext'] );
        }
        if ( isset( $_POST['sistema_req_fecha3_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_req_fecha3_ext', $_POST['sistema_req_fecha3_ext'] );
        }
        if ( isset( $_POST['sistema_req_hora3_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_req_hora3_ext', $_POST['sistema_req_hora3_ext'] );
        }
        if ( isset( $_POST['sistema_ent_fecha3_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_ent_fecha3_ext', $_POST['sistema_ent_fecha3_ext'] );
        }
        if ( isset( $_POST['sistema_ent_hora3_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_ent_hora3_ext', $_POST['sistema_ent_hora3_ext'] );
        }
        if ( isset( $_POST['sistema_solicitud4_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_solicitud4_ext', $_POST['sistema_solicitud4_ext'] );
        }
        if ( isset( $_POST['sistema_solic_fecha4_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_solic_fecha4_ext', $_POST['sistema_solic_fecha4_ext'] );
        }
        if ( isset( $_POST['sistema_solic_hora4_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_solic_hora4_ext', $_POST['sistema_solic_hora4_ext'] );
        }
        if ( isset( $_POST['sistema_req_fecha4_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_req_fecha4_ext', $_POST['sistema_req_fecha4_ext'] );
        }
        if ( isset( $_POST['sistema_req_hora4_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_req_hora4_ext', $_POST['sistema_req_hora4_ext'] );
        }
        if ( isset( $_POST['sistema_ent_fecha4_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_ent_fecha4_ext', $_POST['sistema_ent_fecha4_ext'] );
        }
        if ( isset( $_POST['sistema_ent_hora4_ext'] ) ){
            update_post_meta( $idsistema, 'sistema_ent_hora4_ext', $_POST['sistema_ent_hora4_ext'] );
        }
	}
}


//qo_clientes
add_action( 'add_meta_boxes', 'qo_clientes_custom_metabox' );

function qo_clientes_custom_metabox(){
	add_meta_box( 'qo_clientes_meta', 'Información Cliente', 'display_qo_clientes_atributos', 'qo_clientes', 'advanced', 'default');
}

function display_qo_clientes_atributos( $qo_clientes ){
    $razon_social       = esc_html( get_post_meta( $qo_clientes->ID, 'qo_clientes_razon_social', true ) );    
    $rfc            	= esc_html( get_post_meta( $qo_clientes->ID, 'qo_clientes_rfc', true ) );    
    $direction          = esc_html( get_post_meta( $qo_clientes->ID, 'qo_clientes_direction', true ) );    
    $proyectos          = esc_html( get_post_meta( $qo_clientes->ID, 'qo_clientes_proyectos', true ) );    
    $actividad          = esc_html( get_post_meta( $qo_clientes->ID, 'qo_clientes_actividad', true ) ); 
    $contactComercial   = esc_html( get_post_meta( $qo_clientes->ID, 'qo_clientes_contactComercial', true ) ); 
    $telefono   		= esc_html( get_post_meta( $qo_clientes->ID, 'qo_clientes_telefono', true ) ); 
    $email   			= esc_html( get_post_meta( $qo_clientes->ID, 'qo_clientes_email', true ) ); 
    $cumpleanos   		= esc_html( get_post_meta( $qo_clientes->ID, 'qo_clientes_cumpleanos', true ) ); 
?>

<div>
	<div class="row">
		<label>Razón social</label>
		<input type="text" name="qo_clientes_razon_social" value="<?php echo $razon_social; ?>">
	</div>
	<div class="row">
		<label>RFC</label>
		<input type="text" name="qo_clientes_rfc" value="<?php echo $rfc; ?>">
	</div>
	<div class="row">
		<label>Dirección</label>
		<input type="text" name="qo_clientes_direction" value="<?php echo $direction; ?>">
	</div>
	<div class="row">
		<label>Proyectos</label>
		<input type="text" name="qo_clientes_proyectos" value="<?php echo $proyectos; ?>">
	</div>
	<div class="row">
		<label>Actividad</label>
		<input type="text" name="qo_clientes_actividad" value="<?php echo $actividad; ?>">
	</div>
	<div class="row">
		<label>Contacto Comercial</label>
		<input type="text" name="qo_clientes_contactComercial" value="<?php echo $contactComercial; ?>">
	</div>
	<div class="row">
		<label>Teléfono</label>
		<input type="text" name="qo_clientes_telefono" value="<?php echo $telefono; ?>">
	</div>
	<div class="row">
		<label>Email</label>
		<input type="text" name="qo_clientes_email" value="<?php echo $email; ?>">
	</div>
	<div class="row">
		<label>Cumpleaños</label>
		<input type="text" name="qo_clientes_cumpleanos" value="<?php echo $cumpleanos; ?>">
	</div>
</div>
<?php

}

add_action( 'save_post', 'qo_clientes_save_metas', 10, 2 );
function qo_clientes_save_metas( $idqo_clientes, $qo_clientes ){
	//Comprobamos que es del tipo que nos interesa
	if ( $qo_clientes->post_type == 'qo_clientes' ){
	//Guardamos los datos que vienen en el POST
        if ( isset( $_POST['qo_clientes_razon_social'] ) ){
            update_post_meta( $idqo_clientes, 'qo_clientes_razon_social', $_POST['qo_clientes_razon_social'] );
        }
        if ( isset( $_POST['qo_clientes_rfc'] ) ){
            update_post_meta( $idqo_clientes, 'qo_clientes_rfc', $_POST['qo_clientes_rfc'] );
        }
        if ( isset( $_POST['qo_clientes_direction'] ) ){
            update_post_meta( $idqo_clientes, 'qo_clientes_direction', $_POST['qo_clientes_direction'] );
        } 
        if ( isset( $_POST['qo_clientes_proyectos'] ) ){
            update_post_meta( $idqo_clientes, 'qo_clientes_proyectos', $_POST['qo_clientes_proyectos'] );
        } 
        if ( isset( $_POST['qo_clientes_actividad'] ) ){
            update_post_meta( $idqo_clientes, 'qo_clientes_actividad', $_POST['qo_clientes_actividad'] );
        }
        if ( isset( $_POST['qo_clientes_contactComercial'] ) ){
            update_post_meta( $idqo_clientes, 'qo_clientes_contactComercial', $_POST['qo_clientes_contactComercial'] );
        }
        if ( isset( $_POST['qo_clientes_telefono'] ) ){
            update_post_meta( $idqo_clientes, 'qo_clientes_telefono', $_POST['qo_clientes_telefono'] );
        }
        if ( isset( $_POST['qo_clientes_email'] ) ){
            update_post_meta( $idqo_clientes, 'qo_clientes_email', $_POST['qo_clientes_email'] );
        }
        if ( isset( $_POST['qo_clientes_cumpleanos'] ) ){
            update_post_meta( $idqo_clientes, 'qo_clientes_cumpleanos', $_POST['qo_clientes_cumpleanos'] );
        }
	}
}


//qo_proveedores
add_action( 'add_meta_boxes', 'qo_proveedores_custom_metabox' );

function qo_proveedores_custom_metabox(){
	add_meta_box( 'qo_proveedores_meta', 'Información Proveedor', 'display_qo_proveedores_atributos', 'qo_proveedores', 'advanced', 'default');
}

function display_qo_proveedores_atributos( $qo_proveedores ){
    $razon_social       = esc_html( get_post_meta( $qo_proveedores->ID, 'qo_proveedores_razon_social', true ) );    
    $ruc            	= esc_html( get_post_meta( $qo_proveedores->ID, 'qo_proveedores_ruc', true ) );    
    $direction          = esc_html( get_post_meta( $qo_proveedores->ID, 'qo_proveedores_direction', true ) );    
    $prod_serv 			= esc_html( get_post_meta( $qo_proveedores->ID, 'qo_proveedores_prod_serv', true ) );
    $actividad          = esc_html( get_post_meta( $qo_proveedores->ID, 'qo_proveedores_actividad', true ) ); 
    $contactComercial   = esc_html( get_post_meta( $qo_proveedores->ID, 'qo_proveedores_contactComercial', true ) ); 
    $telefono   		= esc_html( get_post_meta( $qo_proveedores->ID, 'qo_proveedores_telefono', true ) ); 
    $email   			= esc_html( get_post_meta( $qo_proveedores->ID, 'qo_proveedores_email', true ) ); 
    $fecha_ingreso   	= esc_html( get_post_meta( $qo_proveedores->ID, 'qo_proveedores_fecha_ingreso', true ) ); 
?>

<div>
	<div class="row">
		<label>Razón social</label>
		<input type="text" name="qo_proveedores_razon_social" value="<?php echo $razon_social; ?>">
	</div>
	<div class="row">
		<label>RUC</label>
		<input type="text" name="qo_proveedores_ruc" value="<?php echo $ruc; ?>">
	</div>
	<div class="row">
		<label>Dirección</label>
		<input type="text" name="qo_proveedores_direction" value="<?php echo $direction; ?>">
	</div>
	<div class="row">
		<label>Producto/Servicio</label>
		<select name="qo_proveedores_prod_serv">
			<option value="">Seleccionar</option>
			<option value="Producto" <?php selected($prod_serv, 'Producto'); ?>>Producto</option>
			<option value="Servicio" <?php selected($prod_serv, 'Servicio'); ?>>Servicio</option>
		</select>
	</div>
	<div class="row">
		<label>Actividad</label>
		<input type="text" name="qo_proveedores_actividad" value="<?php echo $actividad; ?>">
	</div>
	<div class="row">
		<label>Contacto Comercial</label>
		<input type="text" name="qo_proveedores_contactComercial" value="<?php echo $contactComercial; ?>">
	</div>
	<div class="row">
		<label>Teléfono</label>
		<input type="text" name="qo_proveedores_telefono" value="<?php echo $telefono; ?>">
	</div>
	<div class="row">
		<label>Email</label>
		<input type="text" name="qo_proveedores_email" value="<?php echo $email; ?>">
	</div>
	<div class="row">
		<label>Fecha de Ingreso</label>
		<input type="text" name="qo_proveedores_fecha_ingreso" value="<?php echo $fecha_ingreso; ?>">
	</div>
</div>
<?php

}

add_action( 'save_post', 'qo_proveedores_save_metas', 10, 2 );
function qo_proveedores_save_metas( $idqo_proveedores, $qo_proveedores ){
	//Comprobamos que es del tipo que nos interesa
	if ( $qo_proveedores->post_type == 'qo_proveedores' ){
	//Guardamos los datos que vienen en el POST
        if ( isset( $_POST['qo_proveedores_razon_social'] ) ){
            update_post_meta( $idqo_proveedores, 'qo_proveedores_razon_social', $_POST['qo_proveedores_razon_social'] );
        }
        if ( isset( $_POST['qo_proveedores_ruc'] ) ){
            update_post_meta( $idqo_proveedores, 'qo_proveedores_ruc', $_POST['qo_proveedores_ruc'] );
        }
        if ( isset( $_POST['qo_proveedores_direction'] ) ){
            update_post_meta( $idqo_proveedores, 'qo_proveedores_direction', $_POST['qo_proveedores_direction'] );
        } 
        if ( isset( $_POST['qo_proveedores_prod_serv'] ) ){
            update_post_meta( $idqo_proveedores, 'qo_proveedores_prod_serv', $_POST['qo_proveedores_prod_serv'] );
        }
        if ( isset( $_POST['qo_proveedores_actividad'] ) ){
            update_post_meta( $idqo_proveedores, 'qo_proveedores_actividad', $_POST['qo_proveedores_actividad'] );
        }
        if ( isset( $_POST['qo_proveedores_contactComercial'] ) ){
            update_post_meta( $idqo_proveedores, 'qo_proveedores_contactComercial', $_POST['qo_proveedores_contactComercial'] );
        }
        if ( isset( $_POST['qo_proveedores_telefono'] ) ){
            update_post_meta( $idqo_proveedores, 'qo_proveedores_telefono', $_POST['qo_proveedores_telefono'] );
        }
        if ( isset( $_POST['qo_proveedores_email'] ) ){
            update_post_meta( $idqo_proveedores, 'qo_proveedores_email', $_POST['qo_proveedores_email'] );
        }
        if ( isset( $_POST['qo_proveedores_fecha_ingreso'] ) ){
            update_post_meta( $idqo_proveedores, 'qo_proveedores_fecha_ingreso', $_POST['qo_proveedores_fecha_ingreso'] );
        }
	}
}


//qo_cotizaciones
add_action( 'add_meta_boxes', 'qo_cotizaciones_custom_metabox' );

function qo_cotizaciones_custom_metabox(){
	add_meta_box( 'qo_cotizaciones_meta', 'Información Cotizacion', 'display_qo_cotizaciones_atributos', 'qo_cotizaciones', 'advanced', 'default');
}

function display_qo_cotizaciones_atributos( $qo_cotizaciones ){
    $modelo       = esc_html( get_post_meta( $qo_cotizaciones->ID, 'qo_cotizaciones_modelo', true ) );
    $modelo2       = esc_html( get_post_meta( $qo_cotizaciones->ID, 'qo_cotizaciones_modelo2', true ) );
    $modelo3       = esc_html( get_post_meta( $qo_cotizaciones->ID, 'qo_cotizaciones_modelo3', true ) );
    $modelo4       = esc_html( get_post_meta( $qo_cotizaciones->ID, 'qo_cotizaciones_modelo4', true ) );
    $nota         = esc_html( get_post_meta( $qo_cotizaciones->ID, 'qo_cotizaciones_nota', true ) );    
    $nota2         = esc_html( get_post_meta( $qo_cotizaciones->ID, 'qo_cotizaciones_nota2', true ) );    
    $nota3         = esc_html( get_post_meta( $qo_cotizaciones->ID, 'qo_cotizaciones_nota3', true ) );    
    $nota4         = esc_html( get_post_meta( $qo_cotizaciones->ID, 'qo_cotizaciones_nota4', true ) );    
    $piezas       = esc_html( get_post_meta( $qo_cotizaciones->ID, 'qo_cotizaciones_piezas', true ) );    
    $piezas2       = esc_html( get_post_meta( $qo_cotizaciones->ID, 'qo_cotizaciones_piezas2', true ) );   
    $piezas3       = esc_html( get_post_meta( $qo_cotizaciones->ID, 'qo_cotizaciones_piezas3', true ) );   
    $piezas4       = esc_html( get_post_meta( $qo_cotizaciones->ID, 'qo_cotizaciones_piezas4', true ) );   
    $precio       = esc_html( get_post_meta( $qo_cotizaciones->ID, 'qo_cotizaciones_precio', true ) );
    $precio2       = esc_html( get_post_meta( $qo_cotizaciones->ID, 'qo_cotizaciones_precio2', true ) );
    $precio3       = esc_html( get_post_meta( $qo_cotizaciones->ID, 'qo_cotizaciones_precio3', true ) );
    $precio4       = esc_html( get_post_meta( $qo_cotizaciones->ID, 'qo_cotizaciones_precio4', true ) );
    $muestra       = esc_html( get_post_meta( $qo_cotizaciones->ID, 'qo_cotizaciones_muestra', true ) );
    $iva_inc      = esc_html( get_post_meta( $qo_cotizaciones->ID, 'qo_cotizaciones_iva_inc', true ) );
?>

<div id="qo_cotizaciones">
	<div class="row text-center margin-bottom">
		<div class="col col-1_4">
			<label>Modelo</label>			
		</div>
		<div class="col col-1_4">
			<label>Nota</label>		
		</div>
		<div class="col col-1_4">
			<label>Piezas</label>			
		</div>
		<div class="col col-1_4">
			<label>Precio (sin IVA)</label>			
		</div>
	</div>
	<div class="row margin-bottom">
		<div class="col col-1_4">
			<input type="text" name="qo_cotizaciones_modelo" value="<?php echo $modelo; ?>">			
			<input type="text" name="qo_cotizaciones_modelo2" value="<?php echo $modelo2; ?>">			
			<input type="text" name="qo_cotizaciones_modelo3" value="<?php echo $modelo3; ?>" class="bg-gray">		
			<input type="text" name="qo_cotizaciones_modelo4" value="<?php echo $modelo4; ?>" class="bg-gray">			
		</div>
		<div class="col col-1_4">
			<input type="text" name="qo_cotizaciones_nota" value="<?php echo $nota; ?>">			
			<input type="text" name="qo_cotizaciones_nota2" value="<?php echo $nota2; ?>">			
			<input type="text" name="qo_cotizaciones_nota3" value="<?php echo $nota3; ?>" class="bg-gray">			
			<input type="text" name="qo_cotizaciones_nota4" value="<?php echo $nota4; ?>" class="bg-gray">			
		</div>
		<div class="col col-1_4">
			<input type="text" name="qo_cotizaciones_piezas" value="<?php echo $piezas; ?>">			
			<input type="text" name="qo_cotizaciones_piezas2" value="<?php echo $piezas2; ?>">			
			<input type="text" name="qo_cotizaciones_piezas3" value="<?php echo $piezas3; ?>" class="bg-gray">		
			<input type="text" name="qo_cotizaciones_piezas4" value="<?php echo $piezas4; ?>" class="bg-gray">			
		</div>
		<div class="col col-1_4">
			<input type="text" name="qo_cotizaciones_precio" value="<?php echo $precio; ?>">			
			<input type="text" name="qo_cotizaciones_precio2" value="<?php echo $precio2; ?>">			
			<input type="text" name="qo_cotizaciones_precio3" value="<?php echo $precio3; ?>" class="bg-gray">		
			<input type="text" name="qo_cotizaciones_precio4" value="<?php echo $precio4; ?>" class="bg-gray">			
		</div>
	</div>
	<div class="row margin-bottom-large">
		<p>*Los ultimos dos renglones sólo se mostrarán en la "Plantilla predeterminada"*</p>
	</div>	
	<div class="row margin-bottom-large">
		<div class="input-image">
            <label for="qo_cotizaciones_muestra">Muestra</label><br>
            <input type="text" name="qo_cotizaciones_muestra" id="qo_cotizaciones_muestra" class="meta-image regular-text" value="<?php echo $muestra; ?>">
            <input type="button" class="button image-upload" value="Seleccionar">
        </div>
        <div class="image-preview">
            <img src="<?php echo $muestra; ?>">
        </div>
	</div>
	<div class="row margin-bottom-large">
		<label>¿Esta cotización incluirá IVA?*</label>
		<select name="qo_cotizaciones_iva_inc">
			<option value="Sí" <?php selected($iva_inc, 'Sí'); ?>>Sí</option>
			<option value="No" <?php selected($iva_inc, 'No'); ?>>No</option>
		</select>	
	</div>
	<div class="row">
		<p>Para imprimir todo correctamente activa -> <strong>Imprimir > Configuración > Gráficos de fondo</strong></p>
	</div>
</div>
<?php

}

add_action( 'save_post', 'qo_cotizaciones_save_metas', 10, 2 );
function qo_cotizaciones_save_metas( $idqo_cotizaciones, $qo_cotizaciones ){
	//Comprobamos que es del tipo que nos interesa
	if ( $qo_cotizaciones->post_type == 'qo_cotizaciones' ){
	//Guardamos los datos que vienen en el POST
        if ( isset( $_POST['qo_cotizaciones_modelo'] ) ){
            update_post_meta( $idqo_cotizaciones, 'qo_cotizaciones_modelo', $_POST['qo_cotizaciones_modelo'] );
        } 
        if ( isset( $_POST['qo_cotizaciones_modelo2'] ) ){
            update_post_meta( $idqo_cotizaciones, 'qo_cotizaciones_modelo2', $_POST['qo_cotizaciones_modelo2'] );
        } 
        if ( isset( $_POST['qo_cotizaciones_modelo3'] ) ){
            update_post_meta( $idqo_cotizaciones, 'qo_cotizaciones_modelo3', $_POST['qo_cotizaciones_modelo3'] );
        } 
        if ( isset( $_POST['qo_cotizaciones_modelo4'] ) ){
            update_post_meta( $idqo_cotizaciones, 'qo_cotizaciones_modelo4', $_POST['qo_cotizaciones_modelo4'] );
        } 
        if ( isset( $_POST['qo_cotizaciones_nota'] ) ){
            update_post_meta( $idqo_cotizaciones, 'qo_cotizaciones_nota', $_POST['qo_cotizaciones_nota'] );
        }
        if ( isset( $_POST['qo_cotizaciones_nota2'] ) ){
            update_post_meta( $idqo_cotizaciones, 'qo_cotizaciones_nota2', $_POST['qo_cotizaciones_nota2'] );
        }
        if ( isset( $_POST['qo_cotizaciones_nota3'] ) ){
            update_post_meta( $idqo_cotizaciones, 'qo_cotizaciones_nota3', $_POST['qo_cotizaciones_nota3'] );
        }
        if ( isset( $_POST['qo_cotizaciones_nota4'] ) ){
            update_post_meta( $idqo_cotizaciones, 'qo_cotizaciones_nota4', $_POST['qo_cotizaciones_nota4'] );
        }
        if ( isset( $_POST['qo_cotizaciones_piezas'] ) ){
            update_post_meta( $idqo_cotizaciones, 'qo_cotizaciones_piezas', $_POST['qo_cotizaciones_piezas'] );
        }
        if ( isset( $_POST['qo_cotizaciones_piezas2'] ) ){
            update_post_meta( $idqo_cotizaciones, 'qo_cotizaciones_piezas2', $_POST['qo_cotizaciones_piezas2'] );
        }
        if ( isset( $_POST['qo_cotizaciones_piezas3'] ) ){
            update_post_meta( $idqo_cotizaciones, 'qo_cotizaciones_piezas3', $_POST['qo_cotizaciones_piezas3'] );
        }
        if ( isset( $_POST['qo_cotizaciones_piezas4'] ) ){
            update_post_meta( $idqo_cotizaciones, 'qo_cotizaciones_piezas4', $_POST['qo_cotizaciones_piezas4'] );
        }
        if ( isset( $_POST['qo_cotizaciones_precio'] ) ){
            update_post_meta( $idqo_cotizaciones, 'qo_cotizaciones_precio', $_POST['qo_cotizaciones_precio'] );
        }
        if ( isset( $_POST['qo_cotizaciones_precio2'] ) ){
            update_post_meta( $idqo_cotizaciones, 'qo_cotizaciones_precio2', $_POST['qo_cotizaciones_precio2'] );
        }
        if ( isset( $_POST['qo_cotizaciones_precio3'] ) ){
            update_post_meta( $idqo_cotizaciones, 'qo_cotizaciones_precio3', $_POST['qo_cotizaciones_precio3'] );
        }
        if ( isset( $_POST['qo_cotizaciones_precio4'] ) ){
            update_post_meta( $idqo_cotizaciones, 'qo_cotizaciones_precio4', $_POST['qo_cotizaciones_precio4'] );
        }
        if ( isset( $_POST['qo_cotizaciones_muestra'] ) ){
            update_post_meta( $idqo_cotizaciones, 'qo_cotizaciones_muestra', $_POST['qo_cotizaciones_muestra'] );
        }
        if ( isset( $_POST['qo_cotizaciones_iva_inc'] ) ){
            update_post_meta( $idqo_cotizaciones, 'qo_cotizaciones_iva_inc', $_POST['qo_cotizaciones_iva_inc'] );
        }
	}
}



/**
* CUSTOM POST Private
*/

/*function force_type_private($post)
{
    if ($post['post_type'] == 'qo_cotizaciones' || $post['post_type'] == 'sistema')
    $post['post_status'] = 'private';
    return $post;
}
add_filter('wp_insert_post_data', 'force_type_private');*/