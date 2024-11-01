<?php
/*
Plugin Name: Spam-Free Contact Form
Plugin URI: http://www.nischalmaniar.info/
Version: 1.0
Author: <a href="http://www.nischalmaniar.info/">Nischal Maniar</a>
Description: A Spam-Free Contact form plugin.
*/

function add_sfcf_style()
{
  echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/spam-free-contact-form/sfcf-style.css" />' . "\n";
}

function addSFCF($content)
{
  if(false !== strpos($content, '[sfcf]'))
  {
    include('contact-form.php');
  }
  else
  {
    return $content;
  }
}

function sfcf_options()
{
	include('sfcf-options.php');
}

function sfcf_settings()
{
  add_options_page('Spam Free Contact Form Options', 'Spam Free Contact Form', 8, __FILE__, 'sfcf_options');
}
add_action('wp_head','add_sfcf_style');
add_action('admin_menu', 'sfcf_settings');
add_filter('the_content','addSFCF');
?>