<?php	
	/**
	 * @author: Emil Carlsson
	 * @version: 0.8 beta
	 * @license: GNU GENERAL PUBLIC LICENSE v3
	 * @copyright:2012
	 * @contact: emilcarlsson81@gmail.com
	 * 
	 *    This program is free software: you can redistribute it and/or modify
	 *    it under the terms of the GNU General Public License as published by
	 *    the Free Software Foundation, either version 3 of the License, or
	 *    (at your option) any later version.
	 *
	 *    This program is distributed in the hope that it will be useful,
	 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
	 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 *    GNU General Public License for more details.
	 *
	 *    You should have received a copy of the GNU General Public License
	 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
	 * 
	 *  Usage: 
	 * To use this small and humble test framework you have
	 * two different options. For more information, please 
	 * consult the documentation or the readme file.
	 * 
	 * Option 1:
	 * Single tests, instantiate the CPurpleKiwiTestLite class
	 * with the proper testname. If no testname is given it will
	 * automatically be set to "Standard test". This can be 
	 * changed. 
	 * 
	 * Then run your tests and call the GetResult() function
	 * with no parameters. This will generate a HTML output
	 * in your browser.
	 * 
	 * Option 2:
	 * Multiple tests, set up the test as normal. But instead
	 * of calling GetResult() with empty parameter. Call it 
	 * with the string "array" and it will return an array
	 * of your test results. You can store this array in an
	 * array of your own.
	 * 
	 * Then instatiate CPurpleKiwiView and pass in your array 
	 * as first parameter and output type as second. If second 
	 * parameter is not used a html page will be rendered with 
	 * all your tests.
	 */
	
	/*******************************************
	 * Set the standard name for unnamed tests *
	 *******************************************/
	define("STANDARD_TEST_NAME", "Standard test", false);
    
    /******************************************
	 * Set the messages that appears when an  *
	 * evaluation fails, and succeeds here    *
	 ******************************************/
	
	define("EVALUATION_FAILED", "Evaluation failed.", FALSE);
    define("EVALUATION_SUCCESS", "Evaluation succeeded", FALSE);
	
	/********************************************
	 * 	 WARNING: Do not change in code below.  *
	 * 											*
	 * Changing the code below might compromise *
	 * the functionality of the tests. 			*
	 * ******************************************/
	
	define("RETURN_JSON", "json", TRUE);
	define("RETURN_HTML", "html", TRUE);
	define("RETURN_ARRAY", "array", TRUE);
	
    class CPurpleKiwiTestLite {

		private $m_rgResult;
		
		/**
		 * __construct: A small framework to make testing easy.
		 * 
		 * @param:$strTestName:string Name of the test to be preformed.
		 * 
		 * @return:void
		 */		
		public function __construct($strTestName = "Standard test") {
			$this->m_rgResult = NULL;
			$this->m_rgResult['testname'] = $strTestName;
			$this->m_rgResult['preformed'] = date("Y-m-d - H:i:s (T)");
		}
		
		/**
		 * AssertIsNull: Will succeed if passed argument evaluates to null.
		 * 
		 * @param:$e:expression: Expression to be evaluated.
		 * @param:$test_name:string: Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:void
		 */
		public function AssertIsNull($e, $test_name = false) {
			$result[$this->GetTestName($test_name)] = array(is_null($e), var_export($e, true), "NULL");
			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * AssertIsNotNull: Will succeed if passed argument evaluates to not null.
		 * 
		 * @param:$e:expression: Expression to be evaluated.
		 * @param:$test_name:string: Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:void
		 */
		public function AssertIsNotNull($e, $test_name = false) {
			$result[$this->GetTestName($test_name)] = array(!is_null($e), var_export($e, true), "NULL");
			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * AssertIsEmpty: Will succeed if passed argument is empty.
		 * 
		 * @param:$e:expression: Expression to be evaluated.
		 * @param:$test_name:string: Name to identify the test with.
		 * If None given, the name of the test will be the number of
		 * when it was preformed in the suite.
		 * 
		 * @return:void
		 */
		public function AssertIsEmpty($e, $test_name = false) {
			$result[$this->GetTestName($test_name)] = array(empty($e), var_export($e, true), "Empty");
			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * AssertIsNotEmpty: Will succeed if passed argument is not empty.
		 * 
		 * @param:$e:expression: Expression to be evaluated.
		 * @param:$test_name:string: Name to identify the test with.
		 * If None given, the name of the test will be the number of
		 * when it was preformed in the suite.
		 * 
		 * @return:void
		 */
		public function AssertIsNotEmpty($e, $test_name = false){
			$result[$this->GetTestName($test_name)] = array(!empty($e), var_export($e, true), "Empty");
			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * AssertIsTrue: Will succeed if passed argument evaluates to true.
		 * 
		 * @param:$e:expression: Expression to be evaluated.
		 * @param:$test_name:string: Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:void
		 */
		public function AssertIsTrue($e, $test_name = false) {
    		if ($e === true){
				$result[$this->GetTestName($test_name)] = array(true, var_export($e, true), "TRUE");
			}
			
			else {
				$result[$this->GetTestName($test_name)] = array(false, var_export($e, true), "TRUE");
			}
			
			$this->m_rgResult['result'][] = $result;
    	}
		
		/**
		 * AssertIsFalse: Will succeed if passed argument evaluates to true.
		 * 
		 * @param:$e:expression: Expression to be evaluated.
		 * @param:$test_name:string: Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:void
		 */
		public function AssertIsFalse($e, $test_name = false) {
			$result = array();
			if ($e === false){
				$result[$this->GetTestName($test_name)] = array(true, var_export($e, true), "FALSE");
			}
			
			else {
				$result[$this->GetTestName($test_name)] = array(false, var_export($e, true), "FALSE");
			}
			
			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * AssertIsObject: Will succeed if passed argument is an object.
		 * 
		 * @param:$e:Object: Object to test against.
		 * @param:$test_name:string: Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:void
		 */
		public function AssertIsObject($e, $test_name = false) {								
			$result[$this->GetTestName($test_name)] = array(is_object($e), var_export($e, true), "object");			
			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * AssertIsArray: Will succeed if passed argument is an array.
		 * 
		 * @param:$e:Array Array to be tested.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:void
		 */		
		public function AssertIsArray($e, $test_name = false) {
			$result[$this->GetTestName($test_name)] = array(is_array($e), var_export($e, true), "Array");			
			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * AssertIsInteger: Will succeed if passed argument is an integer.
		 * 
		 * @param:$e:Int Integer to be tested.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:void
		 */	
		public function AssertIsInteger($e, $test_name = false) {
			$result[$this->GetTestName($test_name)] = array(is_int($e), var_export($e, true), "integer");			
			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * AssertIsString: Will succeed if passed argument is an integer.
		 * 
		 * @param:$e:string String to be tested.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:void
		 */	
		public function AssertIsString($e, $test_name = false) {
			$result[$this->GetTestName($test_name)] = array(is_string($e), var_export($e, true), "string");			
			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * AssertIsDouble: Will succeed if passed argument is a double.
		 * 
		 * @param:$e:double Number to be tested.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:void
		 */	
		public function AssertIsDouble($e, $test_name = false) {	
			$result[$this->GetTestName($test_name)] = array(is_float($e), var_export($e, true), "double");
			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * AssertIsFloat: Will succeed if passed argument is a float.
		 * 
		 * @param:$e:float Number to be tested.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:void
		 */			
		public function AssertIsFloat($e, $test_name = false) {
			$result[$this->GetTestName($test_name)] = array(is_float($e), var_export($e, true), "float");
			$this->m_rgResult['result'][] = $result;
		}		
		
		/**
		 * AssertIsGreaterThan: Will succeed if first argument is greater
		 * than second argrument.
		 * 
		 * @param:$e1:arg First argument to use.
		 * @param:$e2:arg Second argument to use.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:void
		 */	
		public function AssertIsGreaterThan($e1, $e2, $test_name = false) {
			if ($e1 > $e2)
				$res_val = true;
			else
				$res_val = false;
			
			$result[$this->GetTestName($test_name)] = array ($res_val, var_export($e1, true), 
				"greater than ". var_export($e2, true));
			
			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * AssertIsLessThan: Will succeed if first argument is less
		 * than second argrument.
		 * 
		 * @param:$e1:arg First argument to use.
		 * @param:$e2:arg Second argument to use.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:void
		 */	
		public function AssertIsLessThan($e1, $e2, $test_name = false) {
			if ($e1 < $e2)
				$res_val = true;
			else
				$res_val = false;
			
			$result[$this->GetTestName($test_name)] = array ($res_val, var_export($e1, true), 
				"less than ". var_export($e2, true));
			
			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * AssertIsEqual: Will succeed if first argument is equal
		 * to second argrument.
		 * 
		 * @param:$e1:arg First argument to use.
		 * @param:$e2:arg Second argument to use.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:void
		 */
		public function AssertIsEqual($e1, $e2, $test_name = false) {
			if ($e1 == $e2)
				$res_val = true;
			else
				$res_val = false;
			
			$result[$this->GetTestName($test_name)] = array ($res_val, var_export($e1, true), 
				"equal to ". var_export($e2, true));
			
			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * AssertIsNotEqual: Will succeed if first argument is not equal
		 * to second argrument.
		 * 
		 * @param:$e1:arg First argument to use.
		 * @param:$e2:arg Second argument to use.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:void
		 */
		public function AssertIsNotEqual($e1, $e2, $test_name = false) {
			if ($e1 != $e2)
				$res_val = true;
			else
				$res_val = false;
			
			$result[$this->GetTestName($test_name)] = array ($res_val, var_export($e1, true), 
				"not equal ". var_export($e2, true));
			
			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * AssertIsIdentical: Will succeed if first argument is identical (===)
		 * to second argrument.
		 * 
		 * @param:$e1:arg First argument to use.
		 * @param:$e2:arg Second argument to use.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:void
		 */
		public function AssertIsIdentical($e1, $e2, $test_name = false) {
			if ($e1 === $e2)
				$res_val = true;
			else
				$res_val = false;
			
			$result[$this->GetTestName($test_name)] = array ($res_val, var_export($e1, true), 
				"identical to ". var_export($e2, true));
			
			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * AssertIsNotIdentical: Will succeed if first argument is not identical (!==)
		 * to second argrument.
		 * 
		 * @param:$e1:arg First argument to use.
		 * @param:$e2:arg Second argument to use.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:void
		 */
		public function AssertIsNotIdentical($e1, $e2, $test_name = false) {
			if ($e1 !== $e2)
				$res_val = true;
			else
				$res_val = false;
			
			$result[$this->GetTestName($test_name)] = array ($res_val, var_export($e1, true), 
				"is not identical to ". var_export($e2, true));
			
			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * AssertInArray: Method to see if a value can be found in an array.
		 * 
		 * @param:$needle:string The information to search the array for.
		 * @param:$haystack:array The array to search the value for.
		 * 
		 * @return:void
		 */
		public function AssertInArray($needle, $haystack, $test_name = false) {
			if(in_array($needle, $haystack))
				$result[$this->GetTestName($test_name)] = array(true, var_export($needle, true),
					"could be found in supplied array");
			else 
				$result[$this->GetTestName($test_name)] = array(false, var_export($needle, true),
					"could be found in supplied array");

			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * AssertNotInArray: Method to see if a value can be found in an array.
		 * 
		 * @param:$needle:string The information to search the array for.
		 * @param:$haystack:array The array to search the value for.
		 * 
		 * @return:void
		 */
		public function AssertNotInArray($needle, $haystack, $test_name = false) {
			if(!in_array($needle, $haystack))
				$result[$this->GetTestName($test_name)] = array(true, var_export($needle, true),
					"could not be found in supplied array");
			else 
				$result[$this->GetTestName($test_name)] = array(false, var_export($needle, true),
					"could not be found in supplied array");

			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * AssertFail: Method to add expected faulures to the test.
		 * 
		 * @param:$message:string Message to be printed. Defaulted empty string.
		 * @param:$failure:bool Indicates if to be concidered a success or failure. Default as success test with value true.
		 * @param:$test_name:string Name of the test to be stored for the test evaluation.
		 * 
		 * @return:void
		 */
		public function AssertFail($message = NULL, $success = true, $test_name = false) {
			$result[$this->GetTestName($test_name)] = array(
				$success, $message, 'AssertFail'
			);
				
			$this->m_rgResult['result'][] = $result;
		}
		
		/**
		 * GetResult:Method to retrieve the results of your test.
		 * 
		 * @param:$output:array The output prefered. Pass in "array", "html"
		 * or "json".
		 * 
		 * @return:void:array
		 */
		public function GetResult($output = RETURN_HTML) {
			
			$output = strtolower($output);
			
			switch ($output) {
				case RETURN_ARRAY:
						return $this->m_rgResult;
					break;
				
				default:
						new CPurpleKiwiView(array($this->m_rgResult), $output);
					break;
			}
		}
		
		/**
		 * GetTestName: Check if name of a test, if none given the number of the test
		 * is inserted as name.
		 * 
		 * @param:$name:string The name of the test.
		 * 
		 * @return:string
		 */
		private function GetTestName($name = false) {
			if (!$name) {
				$c = (array_key_exists('result', $this->m_rgResult) ? (count($this->m_rgResult['result'])) : 0);
				$name = 'Test number: '. ($c + 1);
			}
					
			return $name;
		}
	}

	class CPurpleKiwiView {
		
		private $m_rgResult;
		
		/**
		 * __construct: Return the result of all tests made.
		 * 
		 * @param:$rgTests:array: Array of preformed tests.
		 * @param:$r:string: Return method - HTML (defalut) or JSON.
		 * 
		 * @return:HTML:JSON
		 */
    	public function __construct($rgTests, $r = RETURN_HTML) {
    		
    		if (!is_array($rgTests))
    			throw new Exception("Passed argument is not an array.", 1);
			
    		if (empty($rgTests))
    			throw new Exception("Passed array is empty.", 2);
			
    		$r = strtolower($r);
			$this->m_rgResult = $rgTests;
			
			switch ($r) {
				case RETURN_JSON:
					$this->ReturnJSON();					
					break;
				
				default:
					$this->ReturnHTML();
					break;
			}
    	}
		
		
		/**
		 * ReturnJSON: Prints the m_rgResult array as a JSON object.
		 * 
		 * @return:void
		 */
		private function ReturnJSON() {
			print json_encode($this->m_rgResult, JSON_FORCE_OBJECT);	
		}
		
		/**
		 * ReturnHTML: Returns a predefined HTML page with the information of
		 * m_rgResult as a structured HTML page.
		 * 
		 * @return:void
		 */
		private function ReturnHTML() {
			$output = "<html>\n";
			$output .= "\t<head>\n";
			$output .= "\t\t<title>Test report - ". date("Y-m-d - H:i:s (T)") ."</title>\n";
			$output .= "\t</head>";
			$output .= "\t<style type='text/css'>$this->m_style</style>\n";
			$output .= "\t<body>\n";
			
			foreach ($this->m_rgResult as $tests) {				
				$output .= "\t\t<div class='content'>\n";
				$output .= "\t\t\t<h1>Test results: ".$tests['testname']."</h1>\n";
				$output .= "\t\t\t<h2>Test preformed: ".$tests['preformed']."</h2>\n";
					foreach ($tests['result'] as $value) {
						foreach ($value as $k => $v) {
							$output .= "\t\t\t<div class='wrapper'>\n";
							
							if ($v[0])
								$output .= "\t\t\t\t<div class='win'>\n";
							else 
								$output .= "\t\t\t\t<div class='fail'>\n";
							
							$output .= "\t\t\t\t\t<h3>". $k ." - $v[2]</h3>\n";
							$output .= "\t\t\t\t</div>\n";
							
							$var_val = str_replace("\n", "<br />\n", $v[1]);
							
							if ($v[0])
								$output .= "\t\t\t\t<p>\n\t\t\t\t\t".EVALUATION_SUCCESS.".\n\t\t\t\t</p>\n\t\t\t\t<p>\n\t\t\t\t\t<span class='value'>$var_val</span> evaluated to $v[2]\n\t\t\t\t</p>\n";
							else
								$output .= "\t\t\t\t<p>\n\t\t\t\t\t".EVALUATION_FAILED."\n\t\t\t\t</p>\n\t\t\t\t<p>\n\t\t\t\t\t<span class='value'>$var_val</span> did not evaluate to $v[2].\n\t\t\t\t</p>\n";
							$output .= "\t\t\t</div>\n";
						}
					}				
				$output .= "\t\t\t<h4>End of test.</h4>\n";
				$output .= "\t\t</div>\n";
			}
			$output .= "\t</body>\n";
			$output .= "</html>";
			
			print $output;
		}
		
		/**
		 * CSS of the webtemplate.
		 */
		private $m_style = 'body {
							font-family: "Consolas", "Courier", monospace;
							color: #000000;
							font-size: 12px;
							background-color: #EEEEE0;
						}
						
						h1 {
							margin-left: 5px;
							color: #000000;
							font-size: 18px;
							text-decoration: underline;
							font-weight: bold;
						}
						
						h2 {
							margin-left: 5px;
							color: #000000;
							font-size: 16px;
							text-decoration: underline;
							font-weight: bold;
						}
						
						h3 {
							margin: 0;
							padding: 0;
							margin-left: 5px;
							color: #000000;
							font-size: 14px;
							font-weight: bold;
						}
						
						h4 {
							margin-left: 5px;
							color: #000000;
							font-size: 12px;
							font-style: italic;
						}
						
						p {
							padding: 2px;
							margin-left: 10px;
						}
						
						div {
							margin: 10px;
							padding: 0;
						}
						
						.wrapper {
							background: #FEFEFE;
							min-width: 400px;
							max-width: 700px;
							border: #000000 1px solid;
							margin-left: 10px;
							min-height: 50px;
							padding-top: 0;
						}
						
						.fail {
							margin: 0;
							padding: 5px;
							background-color: #D43D1A;
							border-bottom: #000000 1px solid;
						}
						
						.win {
							margin: 0;
							padding: 5px;
							border-bottom: #000000 1px solid;
							background-color: #A2BC13;
						}
						.value {
							font-weight: bold;
							font-style: italic;
						}
						.content {
							min-width: 500px;
							max-width: 980px;				
							margin: auto;
						}';
    }