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
	
	public $backtrace;

	// constructor
	public function __construct($module=false,$line=false){

		//TODO: Get line number, associated function, etcs
		$this->backtrace=$this->process_array($this->backtrace(),'INVOKED FILES',TRUE);

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

		//TODO: Remove echo detect type
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
	public function process_array($module=false,$type=false,$option=false){
		
		// if module
		if(isset($module) && !empty($module)){
			
			
			//
			$row="
			<tr>
				<td style=\"border:1px solid #ccc;background-color:#999;\" colspan=\"2\">".$type."</td>
			</tr>
			";
			
			//
			foreach ($module as $key => $value) {
				
				//new dBUg(array($key => $value));
				
				//
				$json="";
	
				// if value is array
				if(is_array($value)){
					
					//
					$value=$this->process_array_recursive($value,$type,$key);
					
				} else {
					
					// json
					$value.=$this->process_json($value);				
					
				}
													
	
				// set row
				$row.="
				<tr>\n
					<td style=\"border:1px solid #ccc;background-color:#999;\">&nbsp;".$key."</td>
					<td style=\"border:1px solid #ccc;\">&nbsp;".$value."</td>
				</tr>\n
				";// end row
				
				
			}// end for each
			
			if($option==TRUE){
				
				return "<table style=\"border:1px solid red;\">".$row."</table>";
				
			} else {
				
				//
				if(isset($this->backtrace) && !empty($this->backtrace)){
					
					//
					$row.="
					<tr>
						<td style=\"border:1px solid #ccc;background-color:#999;\">FILES CALLED</td>
						<td>".$this->backtrace."</td>
					</tr>
					";			
				
			}
				
				echo "<table style=\"border:1px solid #ccc;\">".$row."</table>";
			}
			
			
			
		}// end $module
		

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
				<td style=\"border:1px solid #ddd;\" align=\"left\" valign=\"top\">&nbsp;".$value."</td>
			</tr>\n
			";// end row
						
			
		}// end for each
		
		
		return "<table style=\"border:1px solid #ddd;width:100%;margin:0px;padding:0px;\">".$row."</table>";


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
	public function backtrace($Object=false) {
	   
	    // counter	
	    $x = 0;
		
		//
		$row=array();
		
		
	    foreach((array)debug_backtrace($Object ? DEBUG_BACKTRACE_PROVIDE_OBJECT : 0) as $aVal)
	    {
				
	        //new dBug($aVal);
			// if set file	
			if(isset($aVal['file']) && !empty($aVal['file'])){
				
				// get set file
				$row[$x]['file']= $aVal['file'];
				
			}
			
			// if set line	
			if(isset($aVal['line']) && !empty($aVal['line'])){
				
				// get set file
				$row[$x]['line']= $aVal['line'];
				
			}			

			// if set function	
			if(isset($aVal['function']) && !empty($aVal['function'])){
				
				// get set function
				$row[$x]['function']= $aVal['function'];
				
			}
			
			// if set class	
			if(isset($aVal['class']) && !empty($aVal['class'])){
				
				// get set class
				$row[$x]['class']= $aVal['class'];
				
			}			
			
			// if set args	
			if(isset($aVal['args'][0]) && !empty($aVal['args'][0]) && is_array($aVal['args'][0])){
				
				// get set class
				$row[$x]['args']= $aVal['args'];
				
			}
			// if set type	
			if(isset($aVal['type']) && !empty($aVal['type'])){
				
				// get set type
				$row[$x]['type']= $aVal['type'];
				
			}
				
				
	        //$row[$x]['file']     = $aVal['file'];
	        //$row[$x]['line']     = $aVal['line'];
	        //$row[$x]['function'] = $aVal['function'];
	        //$row[$x]['class']    = $aVal['class'];
	        //$row[$x]['args']     = $aVal['args'];
	        ++$x;
	    }
	    return $row;
	}
	
	
	/**
	* @param : $module = array
	**/
	public function process_json($module=false){
		
		// search for opening bracket
		$search="{";
		
		//output
		$output="";
		
		if(isset($module) && !empty($module)){			

			// find match
			if(strpos($module, $search) !==false){
				
				// get set json
				$output=$this->process_array(json_decode($module,TRUE),'Json',TRUE);
				
			} else {
				
				//
				$output=$module;
				
			}// end find match

			
		}// end if $module
		
		
		if($module!=$output){
			
			// return $module
			return $output;
		}
		

		
	}// end process_json

	
}// end of dasBug
?>
