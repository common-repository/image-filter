<?php

/**
 * The plugin bootstrap file
 *
 * @link              https://kovatz.com/
 * @since             1.0.0
 * @package           Kov_Image_Filter
 *
 * @wordpress-plugin
 * Plugin Name:       Kovatz Image Filter
 * Plugin URI:        https://kovatz.com/image-filter-plugin/
 * Description:       Filter image, control brightness, saturation, contrast and more.
 * Version:           1.0.0
 * Author:            Nazmul Hassan
 * Author URI:        https://kovatz.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       image-filter
 * Domain Path:       /languages
 */

// Hook into 'plugin_row_meta' to add a "Buy Me a Coffee" link
add_filter('plugin_row_meta', 'my_plugin_add_buy_me_coffee_link', 10, 2);

/**
 * Add "Buy Me a Coffee" link to the plugin meta row on the Plugins page
 *
 * @param array  $links An array of the existing plugin meta links.
 * @param string $file  The plugin file path.
 * @return array Modified array of links.
 */
function my_plugin_add_buy_me_coffee_link($links, $file) {
    // Check if we're targeting your plugin
    if ($file == plugin_basename(__FILE__)) {
        // Define the Buy Me a Coffee link
        $buy_me_coffee_link = '<a href="https://buymeacoffee.com/nazmul.hassan" target="_blank">Buy Me a Coffee</a>';
        
        // Append the link to the existing meta links
        $links[] = $buy_me_coffee_link;
    }

    return $links;
}

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'IMAGE_FILTER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-image-filter-activator.php
 */
function kov_image_filter_plugin_activate() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-image-filter-activator.php';
  Image_Filter_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-image-filter-deactivator.php
 */
function kov_image_filter_plugin_deactivate() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-image-filter-deactivator.php';
  Image_Filter_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'kov_image_filter_plugin_activate' );
register_deactivation_hook( __FILE__, 'kov_image_filter_plugin_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-image-filter.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function kov_run_image_filter() {

	$plugin = new Image_Filter();
	$plugin->run();

}
kov_run_image_filter();

//require plugin_dir_path( __FILE__ ) . 'public/partials/image-filter-public-display.php';

function kov_image_filter_shortcode() {
    ob_start();
    ?>


<div class="container">
  <div class="row">
    <div class="col-md-8 m-auto">
      <div class="custom-file mb-3">
        <input type="file" class="custom-file-input" id="upload-file">
        <label for="upload-file" class="custom-file-label">Choose Image</label>
      </div>
      <div id="canvas-container" style="position: relative;">
            <canvas id="canvas"></canvas>
            <div id="loader" style="display: none;">
                <div class="spinner"></div>
            </div>
       </div>  
    



      <h4 class="text-center my-3">Filters</h4>

      <div class="row my-4 text-center">
        <div class="col-md-3">
          <div class="btn-group btn-group-sm">
            <button class="filter-btn brightness-remove btn btn-info">-</button>
            <button class="btn btn-secondary btn-disabled" disabled>Brightness</button>
            <button class="filter-btn brightness-add btn btn-info">+</button>
          </div>
        </div>

        <div class="col-md-3">
          <div class="btn-group btn-group-sm">
            <button class="filter-btn contrast-remove btn btn-info">-</button>
            <button class="btn btn-secondary btn-disabled" disabled>Contrast</button>
            <button class="filter-btn contrast-add btn btn-info">+</button>
          </div>
        </div>

        <div class="col-md-3">
          <div class="btn-group btn-group-sm">
            <button class="filter-btn saturation-remove btn btn-info">-</button>
            <button class="btn btn-secondary btn-disabled" disabled>Saturation</button>
            <button class="filter-btn saturation-add btn btn-info">+</button>
          </div>
        </div>

        <div class="col-md-3">
          <div class="btn-group btn-group-sm">
            <button class="filter-btn vibrance-remove btn btn-info">-</button>
            <button class="btn btn-secondary btn-disabled" disabled>Vibrance</button>
            <button class="filter-btn vibrance-add btn btn-info">+</button>
          </div>
        </div>
      </div>
      <!-- ./row -->

      <h4 class="text-center my-3">Effects</h4>

      <div class="row mb-3">
        <div class="col-md-3">
          <button class="filter-btn vintage-add btn btn-dark btn-block">
              Vintage
            </button>
        </div>
        <div class="col-md-3">
          <button class="filter-btn lomo-add btn btn-dark btn-block">
              Lomo
            </button>
        </div>
        <div class="col-md-3">
          <button class="filter-btn clarity-add btn btn-dark btn-block">
              Clarity
            </button>
        </div>
        <div class="col-md-3">
          <button class="filter-btn sincity-add btn btn-dark btn-block">
              Sin City
            </button>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <button class="filter-btn crossprocess-add btn btn-dark btn-block">
              Cross Process
            </button>
        </div>
        <div class="col-md-3">
          <button class="filter-btn pinhole-add btn btn-dark btn-block">
              Pinhole
            </button>
        </div>
        <div class="col-md-3">
          <button class="filter-btn nostalgia-add btn btn-dark btn-block">
              Nostalgia
            </button>
        </div>
        <div class="col-md-3">
          <button class="filter-btn hermajesty-add btn btn-dark btn-block">
              Her Majesty
            </button>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-6">
          <button id="download-btn" class="btn btn-primary btn-block">Download Image</button>
        </div>
        <div class="col-md-6">
          <button id="revert-btn" class="btn btn-danger btn-block">Remove Filters</button>
        </div>
      </div>
    </div>
  </div>
</div>
    <?php
    return ob_get_clean();
}
add_shortcode('kov_image_filter', 'kov_image_filter_shortcode');

?>