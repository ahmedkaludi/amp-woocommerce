<?php
class AMP_WOO_Form_Header {
	protected $posted = array();
	protected $request = array();
	protected $response = array();
	protected $AllowOrigin = '';
	protected $amp_woo_site = '';
	protected $amp_woo_source = '';
	protected $siteHost = '';
	protected $allowedSites = array(
		'*.ampproject.org',
		'*.amp.cloudflare.com'
	);
	protected $cors_Headers = array(
		'Content-Type'	=> 'application/json',
		'Access-Control-Allow-Origin'  => '',
		'AMP-Access-Control-Allow-Source-Origin'=> '',
		'Access-Control-Expose-Headers' => 'AMP-Access-Control-Allow-Source-Origin',
	);
	protected $more_Headers = array('Access-Control-Allow-Credentials' => 'true');
	public function __construct( $request, $data ) {
		$this->posted   = $data;
		$this->request  = $request;
		$this->response = array(
			'status' => 'ok', 'message' => '', 'link' => '', 'debug' => ''
		);
	}

	public function activate() {
		$this->checkMethodType()
		     ->preProcess()
		     ->CheckWordPressEnviorment()
		     ->validation()
		     ->setHooks()
		     ->run()
		     ->outputResponse()
		     ->pushResponse();
	}

	protected function checkMethodType() {
		return $this;
	}

	protected function validation() {
		foreach ( $_SERVER as $key => $value ) {
			switch ( true ) {
				case ( 'http_origin' == strtolower( $key ) ):
					$this->origin = $value;
					break;
				case ( 'http_amp_same_origin' == strtolower( $key ) ):
					$ampSameOrigin = $value;
					break;
			}
		}
		$this->amp_woo_source = empty( $this->request['__amp_source_origin'] ) ? '' : $this->request['__amp_source_origin'];
 
		$siteUrl = parse_url(
			get_site_url()
		);

		$this->siteHost = $siteUrl['host'];
 		
 		$this->amp_woo_site = $siteUrl['scheme'] . '://' . $siteUrl['host'];
 
		array_unshift(
			$this->allowedSites,
			$this->amp_woo_site
		); 

		if ( empty( $this->origin ) ) {
			if ( 'true' !== $ampSameOrigin ) { 
				$this->pushResponse( 'HTTP/1.1 403 FORBIDDEN' );
			}
		} else { 
			if ( ! $this->AllowOrigin( $this->origin ) ) {
				$this->pushResponse( 'HTTP/1.1 403 FORBIDDEN' );
			} 
			if (
				empty( $this->amp_woo_source )
				||
				$this->amp_woo_site != $this->amp_woo_source
			) {
				$this->pushResponse( 'HTTP/1.1 403 FORBIDDEN ' );
			}  
		}

		return $this;
	}

	protected function AllowOrigin( $AllowOrigin ) {
		return true;
	}

	protected function preProcess() {
		return $this;
	}

	protected function CheckWordPressEnviorment() {
		require( ABSPATH . '/wp-load.php' );
		return $this;
	}

	protected function setHooks() {
		return $this;
	}

	protected function run() {
		return $this;
	}

	protected function outputResponse() {
		nocache_headers();
		$headers = $this->getHeaders();
		foreach ( $headers as $name => $value ) {
			@header( esc_attr($name) . ': ' . esc_attr($value) );
		}
		echo wp_json_encode( $this->response );
		return $this;
	}

	protected function getHeaders() {
		$headers = $this->cors_Headers;
		$headers['Access-Control-Allow-Origin']  = esc_url($this->origin);
		$headers['AMP-Access-Control-Allow-Source-Origin'] = esc_url($this->amp_woo_site);
		$headers = array_merge(
			$headers,
			$this->more_Headers
		);
		return $headers;
	}

	protected function pushResponse( $header = '' ) {
		if ( ! empty( $header ) ) {
			header( $header );
		} exit;
	}
}