<?php 
/**
 * Plugin Name: فونت های پارسی سپیدمان
 * Plugin URI: http://plugins.sepideman.com/sepideman-persian-fonts
 * Description: افزودن فونت های پارسی محبوب به پوسته وردپرسی شما
 * Version: 1.0.0
 * Author: زرتشت سپیدمان
 * Author URI: http://www.ZartoshtSepideman.com
 * License: GPLv2 
 */
if ( ! defined( 'ABSPATH' ) ) {die();}

add_action( 'wp_enqueue_scripts', 'register_plugin_styles' );

function register_plugin_styles() {
	wp_register_style( 'font', plugins_url( 'sepideman-persian-fonts/css/fonts.css' ) );
	wp_enqueue_style( 'font' );
}

add_action( 'admin_menu', 'my_plugin_menu' );
function my_plugin_menu() {
	add_options_page( 'فونت های پارسی سپیدمان', 'فونت های پارسی سپیدمان', 'manage_options', 'sepideman-persian-fonts', 'sepideman_persian_fonts_options' );
}

add_action( 'admin_init', 'register_mysettings' );
function register_mysettings(){
	register_setting( 'sepideman-settings', 'yekan' );
	register_setting( 'sepideman-settings', 'bbcnassim' );
	register_setting( 'sepideman-settings', 'byekan' );
	register_setting( 'sepideman-settings', 'gess' );
}

function sepideman_persian_fonts_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap"><h2>تنظیمات نویسه‌های پارسی سپیدمان</h2>';
	echo '<form method="post" action="options.php">';
			settings_fields( 'sepideman-settings' );
			do_settings_sections( 'sepideman-settings' );
	echo '<table style="width: 100%"><tr>';
	echo '<td style="width: 110px">یکان : </td><td><textarea style="width: 100%" dir="ltr" type="text" name="yekan" >' . esc_attr( get_option('yekan') ) . '</textarea></td></tr>';
	echo '<tr><td>بی‌بی‌سی نسیم : </td><td><textarea style="width: 100%" dir="ltr" type="text" name="bbcnassim">' . esc_attr( get_option('bbcnassim') ) . '</textarea></td></tr>';
	echo '<tr><td>بی‌یکان : </td><td><textarea style="width: 100%" dir="ltr" type="text" name="byekan" >' . esc_attr( get_option('byekan') ) . '</textarea></td></tr>';
	echo '<tr><td>گس : </td><td><textarea style="width: 100%" dir="ltr" type="text" name="gess" >' . esc_attr( get_option('gess') ) . '</textarea></td></tr></table>';
	submit_button();
	echo '</form>';
	echo '<h3>طرز استفاده</h3>' .
	'<p>برای تغییر فونت هر المان شناسه، کلاس و یا نام المان را در بخش فونت مربوطه بنویسید. نام هر المان را با یک "," جدا کنید. به عنوان مثال: <code>a,ht,#content-title</code>. سپس کد <code>[sepideman_pf]</code> را در بخشی که میخواهید تغییر فونت دهد قرار دهید.</p>' .
	'<h3>نکات:</h3>' .
	'<ul><li>با تغییر بخشی از یک صفحه تمام صفحه تغییر می‌کند.</li><li>برای تغییر جزئی، با استفاده از منوی <code>Inspect Element</code> سپس <code>Copy Unique Selector</code> مشخصه جزئی المان را کپی کنید.</li><li>برای تغییر تمام فونت‌ها به یک فونت، در فیلد مقابل فونت <code>*</code> بگذارید.</li><li>برای انجام تغییر در تمام سایت، کد کوتاه <code>[sepideman_pf]</code> را در ویجت فوتر و یا هدر که در تمام برگه‌ها و نوشته‌ها قابل دیدن است قرار دهید.</li></ul>';
	echo '</div>';
}

function sepideman_persian_fonts() {
	echo '<script>jQuery(document).ready(function(){jQuery("' . esc_attr( get_option('yekan') ) . '").css({ "font-family" : "yekan" });});</script>';
	echo '<script>jQuery(document).ready(function(){jQuery("' . esc_attr( get_option('bbcnassim') ) . '").css({ "font-family" : "bbcnasim" });});</script>';
	echo '<script>jQuery(document).ready(function(){jQuery("' . esc_attr( get_option('byekan') ) . '").css({ "font-family" : "byekan" });});</script>';
	echo '<script>jQuery(document).ready(function(){jQuery("' . esc_attr( get_option('gess') ) . '").css({ "font-family" : "gess" });});</script>';
}
add_shortcode( 'sepideman_pf', 'sepideman_persian_fonts' );
?>