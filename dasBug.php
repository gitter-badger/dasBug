<?php

//
namespace dasBug\dasBug;

//
use dBug\dBug\dBug;

/**
 * dasBug class
 *
 * @package default
 * @author  Paul McIntosh
 */
class dasBug{

	// constructor
	public function __construct($module=false,$line=false){

		//TODO: Get line number, associated function, etcs
		//$this->process_debug_backtrace(debug_backtrace());

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

		// get set array
		if($type=='array'){

			// array
			$this->process_array($module,$type); 

		}// end type array
		
		// get set array
		if($type=='string'){
			
			//
			$this->process_string($module,$type);

		}// end type array		
		
		

		//is_numeric, is_bool, is_null, is_float, is_int, is_string, is_object, is_array

	}//end detect type

	/**
	* @param : $module = array
	**/
	public function process_array($module=false,$type=false){
		
		//
		$row="
		<tr>
			<td style=\"border:1px solid #ccc;background-color:#999;\" colspan=\"2\">".$type."</td>
		</tr>
		";
		
		//
		foreach ($module as $key => $value) {
			
			
			// if value is array
			if(is_array($value)){
				
				//
				$value=$this->process_array_recursive($value,$type,$key);
				
			}

			// set row
			$row.="
			<tr>\n
				<td style=\"border:1px solid #ccc;background-color:#999;\">&nbsp;".$key."</td>
				<td style=\"border:1px solid #ccc;\">&nbsp;".$value."</td>
			</tr>\n
			";// end row
			
			
		}// end for each
		
		
		echo "<table style=\"border:1px solid #ccc;\">".$row."</table>";


	}// end process_array
	
	/**
	* @param : $module = array
	**/
	public function process_array_recursive($module=false,$type=false,$pkey=false){
		
		//
		$row="";
		
		//
		foreach ($module as $key => $value) {
			
			
			// if value is array
			if(is_array($value)){
				
				//
				$value=$this->process_array_recursive($value,$type,$pkey);
				
			}

			// set row
			$row.="
			<tr>\n
				<td style=\"border:1px solid #ddd;background-color:#888;\">&nbsp;".$key."</td>
				<td style=\"border:1px solid #ddd;\">&nbsp;".$value."</td>
			</tr>\n
			";// end row
						
			
		}// end for each
		
		
		return "<table style=\"border:1px solid #ddd;\">".$row."</table>";


	}// end process_array	
	
	
	
	/**
	* @param : $module = array
	**/
	public function process_string($module=false,$type=false){
		
		echo "
		<table style=\"border:1px solid #ccc;\">
			<tr>
				<td style=\"border:1px solid #ccc;background-color:#999;\">&nbsp;".$type."</td>
			</tr>
			<tr>
				<td style=\"border:1px solid #ccc;\">&nbsp;".$module."</td>
			</tr>
		</table>";
		
	}// end process_string	

	/**
	* @param : $module = array
	**/
	public function process_debug_backtrace($module=false){
		
		if(isset($module) && !empty($module)){
			
			// get set backtrace
			$backtrace = $module;
						
		}
		
	}// end process_debug_backtrace()	
		

}// end of dasBug
?>
