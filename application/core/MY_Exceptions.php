<?php 
class MY_Exceptions extends CI_Exceptions {

	private $CI;

	public function __construct() {
	    parent::__construct();
	    $this->CI =& get_instance();
	}

	function show_error($heading, $message, $template = 'error_general', $status_code = 500) {
		if(isset($this->CI->input) && $this->CI->input->is_ajax_request()) {
			echo $this->CI->output
	            ->set_content_type('application/json', 'utf-8')
	            ->set_status_header(500)
	            ->set_output(json_encode([
					'status' => false, 
					'message' => $message
				],  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))->_display();
		} else if(is_cli()){
			echo 'Custom exception trigerred: '.$message.PHP_EOL;
		} else {
			echo parent::show_error($heading, $message, $template = 'error_general', $status_code = 500);
		}
	}
}
?>