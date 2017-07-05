<?php
/**
 * Gb Ads
 *
 * @package gb
 * @subpackage gb-ads
 */

/**
 * Choose ad config and load it
 *
 * @since 1.0
 */
class GbAd
{
	/**
	 * Save the position for the ad
	 *
	 * @var string
	 */
	private $_position;
	/**
	 * Save the ad type
	 *
	 * @var string
	 */
	private $_type;
	/**
	 * Save the ad content if it exists
	 *
	 * @var string
	 */
	private $_ad;

	/**
	 * the class constructor
	 *
	 * @param $position string Position for the ad
	 * @param $type string Ad type
	 * @param $type string Ad content. It can be `chitika` or `adsense`
	 */
	function __construct($position, $type, $ad = null)
	{
		$this->_position = $position;
		$this->_type = $type;
		$this->_ad = $ad;

		$this->loadAd();
	}
	/**
	 * Get ad config and load it
	 */
	private function loadAd()
	{
		if (!$opt = $this->getAdPosition()) {
			echo '<p class="alert alert-danger"><strong>Error:</strong> el anuncio "' . $this->_name . '" no está registrado.</p>';
			return;
		}

		$position = $this->_position;
		$type = $this->_type;

		$element = (array_key_exists('element', $opt)) ? $opt['element'] : 'div';

		$pull = (array_key_exists('pull', $opt)) ? ' pull-' . $opt['pull'] : '';

		$aClass = (array_key_exists('additional-class', $opt)) ? ' ' . $opt['additional-class'] : '';
		$cClass = 'class="' . $position . '-advertise' . $pull . $aClass . '"';

		$oTag = '<' . $element . ' ' . $cClass . '>';
		$cTag = '</' . $element . '>';

		$adClass = $this->getAdClass();
		$adClass = (array_key_exists('centered', $opt)) ? 'class="' . $adClass . ' center-block"' : 'class="' . $adClass . '"';

		$ad = $this->getAd();

		echo $oTag;
		echo '<div ' . $adClass . '>' . $ad . '</div>';
		echo $cTag;
	}
	/**
	 * Gets ad position and its configs
	 *
	 * @return array If position exists returns ad configs
	 */
	private function getAdPosition()
	{
		$positions = array(
			'header' => array(
				'pull' => 'right',
				'additional-class' => 'hidden-xs',
				),
			'main' => array(
				'additional-class' => 'hidden-xs',
				'centered' => true
				),
			'sidebar' => array(
				'centered' => true,
				),
			'footer' => array(
				'centered' => true
				),
			);

		return $positions[$this->_position];
	}
	/**
	 * Gets ad class
	 * 
	 * @return string The name of the ad class
	 */
	private function getAdClass() {

		$class = 'ad-';

		switch ($this->_type) {
			case 'square' :
				$class = $class . '300x250';
				break;
			case 'horizontal' :
				$class = $class . '728x90';
				break;
			case 'vertical' :
				$class = $class . '300x600';
				break;
		}

		return $class;
	}
	/**
	 * Get the ad content
	 */
	private function getAd()
	{
		if (!$this->_ad) {
			return '<p><a href="' . get_permalink(get_page_by_title('Contacto')) . '">Contactanos</a> para anunciarte en este espacio.</p>';
		} else {
			switch ($this->_type) {
				case 'square':
					$adName = '300x250';
					break;
				case 'horizontal':
					$adName = '728x90';
					break;
				case 'vertical':
					$adName = '300x600';
					break;
			}

			if ($this->_ad === 'chitika') {
				$adPrefix = 'chitika-';
			} else if ($this->_ad === 'adsense') {
				$adPrefix = 'adsense-';
			}

			//$adPath = __DIR__ . '/ads/' . $adPrefix . $adName . '.php';
			$adPath = gb_get_function_path('ads-' . $adPrefix . $adName);

			if (file_exists($adPath)) {
				ob_start();
				include $adPath;
				$ad = ob_get_contents();
				ob_end_clean();

				return $ad;
			}
		}
	}
}

/**
 * Loads ads
 * This function can be used enywhere you want to load an add.
 * Gb Ads works with chitika and AdSense.
 *
 * @example Follow this instructions
 *
 * 		- First of all, you need to crate your add using chitika or AdSense.
 *
 * 		- Save the script with the following name structure:
 * 			ads-<vendor>-<size>.php
 * 			Where vendor equals 'adsense' or 'chitika', and size equals 300x250 or 300x600 or 728x90
 * 			For example: `ads-adsense-300x250.php`
 *
 * 		- Now, wherever you nedd your ad, add the following example code
 * 			<?php gb_get_ad('sidebar', 'square', 'adsense',); '>
 *
 * 		- Position in this template are: 
 * 			header, main, sidebar and footer. You can change them in the `getAdPosition()` method
 * 			from the `GbAd` class.
 *
 * 		- The ad types are:
 *			'square' 		= 300x250 px
 *			'horizontal' 	= 728x90 px
 * 			'vertical' 	= 300x600 px
 *
 *	@since 1.0
 *
 * @param string $position Where the ad will be shown
 * @param string $type The add type for its size
 * @param string $ad The third party company: chitika or adsense
 */
function gb_get_ad($position, $type, $ad = null)
{
	$ad = new GbAd($position, $type, $ad);
}

?>