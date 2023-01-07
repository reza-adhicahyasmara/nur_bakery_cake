<?php 
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * Class : BaseController
 * Base Class to control over all the classes
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class BaseControllerBackend extends CI_Controller {
	protected $global = array ();
	
	/**
	 * Takes mixed data and optionally a status code, then creates the response
	 *
	 * @access public
	 * @param array|NULL $data
	 *        	Data to output to the user
	 *        	running the script; otherwise, exit
	 */
	/**
     * This function used to load views
     * @param {string} $viewName : This is view name
     * @param {mixed} $headerInfo : This is array of header information
     * @param {mixed} $pageInfo : This is array of page information
     * @param {mixed} $footerInfo : This is array of footer information
     * @return {null} $result : null
     */

	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('encryption');
	}

	/**
	 * This function is used to load the set of views
	 */
	function accessDenied(){
		$this->global ['pageTitle'] = 'SisInventory - Access Denied';		
		$this->load->view ('backend/navigation_backend', $this->global);
		$this->load->view ('access_denied');
		$this->load->view ('footer_empty');
	}

    function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerName = ""){
    	
        $this->load->view('backend/navigation_backend',$headerInfo);
        $this->load->view($viewName, $pageInfo);
        $this->load->view($footerName);
    }
}
