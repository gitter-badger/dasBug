<?php
/**
 * dasBug class
 *
 * @package default
 * @author  Paul McIntosh
 */
class dasBug{

	// constructor
	public function __construct($module=false){

		//TODO: Get line number, associated function, etcs


		// get set module
		if(isset($module) && !empty($module)){

			// get type
			$this->detect_type($module);
			// end get type

		}

	}// end construct

	// render
	public function render($module=false){

	}// end render

	// detect type
	public function detect_type($module=false){
		
		
		echo "value= ".$module."<br/>";

		// gettype()
		echo gettype($module);

		//is_numeric, is_bool, is_null, is_float, is_int, is_string, is_object, is_array

	}//end detect type

}// end of dasBug
?>
