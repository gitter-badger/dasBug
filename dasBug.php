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

		echo __LINE__ ;


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

		// datatype
		$type="";

		// detect type
		echo $type=gettype($module);

		if($type=='array'){

			// array
			$this->process_array($module); 


		}

		//is_numeric, is_bool, is_null, is_float, is_int, is_string, is_object, is_array

	}//end detect type

	/**
	* @param : $module = array
	**/
	public function process_array($module=false){

		echo "<pre>";
		print_r($module);
		echo "</pre>";

		// start array loop
		foreach ($module as $key => $value) {
			
			//if key is array
			if(is_array($key)){

				echo "<pre>";
				print_r($key);
				echo "</pre>";

			}


		}
		// end 

	}// end render

}// end of dasBug
?>
