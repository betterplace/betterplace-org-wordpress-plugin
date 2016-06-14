<?php
/*
Plugin Name: betterplace.org
Description: Mit diesem Plugin können das Spendenformular sowie das Website-Widget eines Projektes von betterplace.org in eine Wordpress-Seite eingebunden werden. 
Version: 1.0
Author: Jochen Krämer
Author URI: http://www.jochenkraemer.com
License: GPL2
*/

//add color picker files for options page
add_action( 'admin_enqueue_scripts', 'bporg_add_color_picker' );
function bporg_add_color_picker( $hook ) {
 
    if( is_admin() ) { 
        // Add the color picker css file       
        wp_enqueue_style( 'wp-color-picker' ); 
         
        // Include our custom jQuery file with WordPress Color Picker dependency
        wp_enqueue_script( 'custom-script-handle', plugins_url( '/js/bporg.js', __FILE__ ), array( 'wp-color-picker' ), false, true ); 
    }
}

//add menu page and settings
add_action( 'admin_menu', 'bporg__add_admin_menu' );
add_action( 'admin_init', 'bporg__settings_init' );

function bporg__add_admin_menu(  ) { 
	add_menu_page( 'betterplace.org', 'betterplace.org', 'manage_options', 'betterplace', 'bporg__options_page', 'dashicons-heart' );
}


function bporg__settings_init(  ) { 
	register_setting( 'pluginPage', 'bporg__settings' );
	add_settings_section(
		'bporg__pluginPage_section', 
		__( '', 'wordpress' ), 
		null, 
		'pluginPage'
	);
	add_settings_field( 
		'projektID', 
		__( 'Projekt ID (Pflichtfeld)', 'wordpress' ), 
		'bporg__text_field_0_render', 
		'pluginPage', 
		'bporg__pluginPage_section' 
	);
	add_settings_field( 
		'donation_amount', 
		__( 'Voreingestellter Spendenbetrag <br/>(Standard: 50€)', 'wordpress' ), 
		'bporg__text_field_1_render', 
		'pluginPage', 
		'bporg__pluginPage_section' 
	);
	add_settings_field( 
		'bg_color', 
		__( 'Hintergrundfarbe des Spendenformulars in Hex <br/>(Standard: transparent)', 'wordpress' ), 
		'bporg__text_field_2_render', 
		'pluginPage', 
		'bporg__pluginPage_section' 
	);
	add_settings_field( 
		'color', 
		__( 'Farbe der Buttons und Banderole in Hex', 'wordpress' ), 
		'bporg__text_field_3_render', 
		'pluginPage', 
		'bporg__pluginPage_section' 
	);
	add_settings_field( 
		'width', 
		__( 'Breite des Spendenformulars', 'wordpress' ), 
		'bporg__text_field_4_render', 
		'pluginPage', 
		'bporg__pluginPage_section' 
	);
	add_settings_field( 
		'interval', 
		__( 'Voreinstellung für regelmäßige Spenden </br>(Standard: Einmalige Spende)', 'wordpress' ), 
		'bporg__text_field_5_render', 
		'pluginPage', 
		'bporg__pluginPage_section' 
	);
	


}


function bporg__text_field_0_render(  ) { 

	$options = get_option( 'bporg__settings' );
	?>
	<input type='text' name='bporg__settings[projektID]' value='<?php echo $options['projektID']; ?>'>
	<?php

}


function bporg__text_field_1_render(  ) { 

	$options = get_option( 'bporg__settings' );
	?>
	<input type='number' name='bporg__settings[donation_amount]' value='<?php echo $options['donation_amount']; ?>'>
	<?php

}

function bporg__text_field_2_render(  ) { 

	$options = get_option( 'bporg__settings' );
	?>
	<input type='text' name='bporg__settings[bg_color]' value='<?php echo $options['bg_color']; ?>' class="cpa-color-picker" >
	<?php

}

function bporg__text_field_3_render(  ) { 

	$options = get_option( 'bporg__settings' );
	?>
	<input type='text' name='bporg__settings[color]' value='<?php echo $options['color']; ?>' class="cpa-color-picker" >
	<?php

}

function bporg__text_field_4_render(  ) { 

	$options = get_option( 'bporg__settings' );
	?>
	<input type='number' name='bporg__settings[width]' value='<?php echo $options['width']; ?>'>
	<?php

}

function bporg__text_field_5_render(  ) { 

	$options = get_option( 'bporg__settings' );
	?>
	<select name='bporg__settings[interval]'>
          <option value="single" <?php selected($options['interval'], "single"); ?>>Einmalig</option>
          <option value="monthly" <?php selected($options['interval'], "monthly"); ?>>Monatlich</option>
          <option value="quarter_yearly" <?php selected($options['interval'], "quarter_yearly"); ?>>Vierteljährlich</option>
          <option value="half_yearly" <?php selected($options['interval'], "half_yearly"); ?>>Halbjährlich</option>
          <option value="yearly" <?php selected($options['interval'], "yearly"); ?>>Jährlich</option>
        </select>
	<?php
	
}

function bporg__options_page(  ) { 
	//create the options page including how-to and some bullet points about betterplace.org
	?>
	<form action='options.php' method='post'>

		<h2>betterplace.org // Spendenformular für die Wordpress-Seite</h2>
		<style type="text/css">
			.form-table th {width: 400px;}
			.options {float: left; width: 50%;}
			.description {float: left; width: 40%; margin-left: 2%; background-color: #fff; padding: 10px; border: 1px solid #e5e5e5;}
			.bporg {float: left; width: 92%; background-color: #fff; padding: 10px; border: 1px solid #e5e5e5;margin-top: 20px;}
			ul {list-style-type: square; margin-left: 2%;}
			.shortcode {font-family: "Courier New", Courier, monospace;}
			input, select {width: 140px;}
			input.button {width: 200px;}
		</style>
		
		<div class="options">
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
		</div>
		
		<!-- How to use -->
		<div class="description">
			<h1>Wie nutze ich dieses Plugin?</h1>
			<p>Mithilfe dieses Plugins können das offizielle betterplace.org Spendenformular sowie das Website-Widget in Deiner Wordpress-Seite eingebunden werden. Die Nutzung ist ganz einfach.</p>
			<h3>Spendenformular</h3>
			<p><b>Einstellungen</b>
			<br/>Auf dieser Seite können verschiedene Einstellungen für das Spendenformular vorgenommen werden. Die Eingabe der Projekt ID ist Pflicht, da betterplace.org anderenfalls nicht das korrekte Formular laden kann. Alle weiteren Einstellungen sind optional. Wenn die Felder leer gelassen werden, werden die Standardeinstellungen von betterplace.org genutzt. </p>
			<p>Wenn alle Einstellungen gespeichert sind, kann das Spendenformular auf jeder beliebigen Seite durch Nutzen des Shortcodes <span class="shortcode">[betterplace-formular]</span> eingebunden werden. 
			
			<h3>Widget</h3>
			<p>Das offizielle betterplace.org Widget kann auf zwei Arten in Deine Seite eingebunden werden:</p>
			<h4>1. Als Widget</h4>
				<p>Navigiere zu den Wordpress-Widgets (>Design >Widgets). Hier kannst Du das "betterplace.org Widget" auswählen. In den Widget Optionen kannst Du einen Titel (optional) sowie Deine Projekt ID (Pflicht) eingeben. </p>
			<h4>2. Mit einem Shortcode</h4>
				<p>Das betterplace.org Widget kann an jeder beliebigen Stelle Deiner Wordpress-Seite durch Nutzen des Shortcodes <span class="shortcode">[betterplace-widget projekt="<i>Deine ID</i>"]</span> eingebunden werden. Wichtig ist die Angabe Deiner Projekt ID. Zusätzlich kannst Du mit dem Parameter "width" die Breite definieren: <span class="shortcode">[betterplace-widget projekt="<i>Deine ID</i>" width="220"]</span>. Ohne Angabe von width wird der Standard von betterplace.org genutzt.</p>
		</div>
		
		<!-- Some information regarding betterplace.org -->
		<div style="clear: both;"></div>
		<div class="bporg">
			<a href="http://www.betterplace.org" target="_blank">
				<img src="<?php echo plugins_url( '/img/betterplace-logo.png', __FILE__ ); ?>" alt="betterplace.org" title="betterplace.org" height="80" style="float: right;" />
			</a>
			<h2><strong>Als soziale Organisation</strong>: Sammle kostenlos & unkompliziert Spenden.</h2>
				<ul>
					<li>Das geht ganz einfach: mit unseren Werkzeugen für besseres Online Fundraising.</li>
					<li>In unseren Schulungen wirst Du zum Profi – sie sind ebenfalls kostenlos.</li>
					<li>Oder suchst Du nach ehrenamtlichen Helfern? Lege los!</li>
				</ul>
			<h2>Warum wir gut sind</h2>
				<ul>
					<li><b>Mehr Engagement!</b> Wir helfen tausenden sozialen Projekten, im Internet Spenden zu sammeln - mit unseren Werkzeugen und Schulungen.</li>
					<li><b>Mehr Effizient!</b> Wir leiten 100% der Spenden an die Organisationen weiter - keine Gebühren, kein Haken.</li>
					<li><b>Mehr Wirksamkeit</b> Spender erleben mit, was ihr Geld bewirkt und können die Projekte bewerten und ihnen Fragen stellen.</li>
				</ul>
			<br/>
			<h4>Weitere Informationen findest Du unter <a href="https://www.betterplace.org/de/collect-donations" target="_blank">https://www.betterplace.org/de/collect-donations</a>.</h4>
		</div>
	</form>
	<?php

}



//create the shortcode function to use the donation form in pages & posts
function bporg_shortcode_function( $atts ) {
 
    // Buffer our contents
    ob_start();
	
	//get options from database
	$options 			= get_option('bporg__settings');
	$pID 				= $options["projektID"];
	$donation_amount	= $options["donation_amount"];
	$bg_color			= $options["bg_color"];
	$color				= $options["color"];
	$width				= $options["width"];
	$interval			= $options["interval"];
	
	//remove p from project ID, if given
	$pID 		= str_replace("p", "", $pID);
	
	//remove # from color codes
	$bg_color 	= str_replace("#", "", $bg_color);
	$color	 	= str_replace("#", "", $color);
	
	//get source-code of betterplace iframe
	$iframe = "<script type=\"text/javascript\">
				var _bp_iframe = _bp_iframe || {};
				_bp_iframe.project_id = ".$pID	."; /* REQUIRED */
				_bp_iframe.lang       = 'de'; /* Language of the form */";
	
	//set options from settings, if applicable
	if($donation_amount != "")
		$iframe .= " _bp_iframe.default_amount = ".$donation_amount."; /* Donation-amount, integer 1-99 */
					";
	if($color != "")
		$iframe .= " _bp_iframe.color = '".$color."'; /* Button and banderole color, hex without # */
					";
	if($bg_color != "")
		$iframe .= " _bp_iframe.background_color = '".$bg_color."'; /* Background-color, hex without # */
					";
	if($width != "")
		$iframe .= "_bp_iframe.width = ".$width."; /* Custom iframe-tag-width, integer */
					";
	if($interval != "")
		$iframe .= "_bp_iframe.recurring_interval = '".$interval."'; /* Interval for recurring donations, string out of ['single', 'monthly', 'quarter_yearly', 'half_yearly', 'yearly']  */
					";
		
	// _bp_iframe.default_data_transfer_accepted = false; /* true (default), false */
	$iframe .= "_bp_iframe.domain = '//www.bp42.com'; /* For development: set domain for testing, default betterplace.org */
				(function() {
					var bp = document.createElement('script'); bp.type = 'text/javascript'; bp.async = true;
					bp.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'asset1.bp42.com/assets/load_donation_iframe.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(bp, s);
				})();
			</script> 	
			<div id=\"betterplace_donation_iframe\" style=\"background: transparent url('https://www.betterplace.org/assets/new_spinner.gif') 275px 20px no-repeat;\"><strong><a href=\"https://www.bp42.com/de/projects/".$pID."/donations/new\">Jetzt spenden bei unserem Partner betterplace.org</a></strong></div>";
	return $iframe;
    
     // Return buffered contents
     return ob_get_clean();
 
}

//register shortcode
add_shortcode( 'betterplace-formular', 'bporg_shortcode_function' );


/**
* Include file for additional betterplace.org widget
* 
* creates a widget that can be used on Design > Widgets
*
**/
include("betterplace_widget.php");
add_action( 'widgets_init', function(){
     register_widget( 'betterplace_widget' );
});	





?>