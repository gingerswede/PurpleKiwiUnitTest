<?php	
	/**
	 * @author: Emil Carlsson
	 * @version: 2.0
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
	
	define("EVALUATION_FAILED", "Assertion fail.", FALSE);
    define("EVALUATION_SUCCESS", "Assertion success", FALSE);
	
	/********************************************
	 * 	 WARNING: Do not change in code below.  *
	 * 											*
	 * Changing the code below might compromise *
	 * the functionality of the tests. 			*
	 * ******************************************/
	
	define("RETURN_JSON", "json", TRUE);
	define("RETURN_HTML", "html", TRUE);
	define("RETURN_ARRAY", "array", TRUE);
	define("ASSERT_SUCCESSFUL", 'Assert successful.', TRUE);
	define("ASSERT_FAILURE", 'Assert failed', TRUE);
	
    class CPurpleKiwiTestLite {

		protected $m_rgResult;
		protected $m_testNumber = 0;
		
		/**
		 * __construct: A small framework to make testing easy.
		 * 
		 * @param:$strTestName:string Name of the test to be preformed.
		 * 
		 * @return:void
		 */		
		public function __construct($strTestName = "Standard test") {
			$this->m_rgResult = new TestSuite($strTestName);
			$this->m_testNumber = 1;
		}
		
		//READ THIS IF YOU CHANGE IN THE API:
		//Constructor of TestResult:
		//First param = Test name.
		//Second param = Result of the test.
		//Third param = Assert type (function name).
		//Fourth param = Text to go with the result, can take boolean value to fallback on constants.
		//Fifth param = Expression asserted.
		//Sixth param = Expression used in comparrison asserts.
		
		/**
		 * AssertIsNull: Will succeed if passed argument evaluates to null.
		 * 
		 * @param:$e:expression: Expression to be evaluated.
		 * @param:$test_name:string: Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:bool
		 */
		public function AssertIsNull($e, $test_name = false) {
			$result = is_null($e);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, $result, $e)
			);
			return $result;
		}
		
		/**
		 * AssertIsNotNull: Will succeed if passed argument evaluates to not null.
		 * 
		 * @param:$e:expression: Expression to be evaluated.
		 * @param:$test_name:string: Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:bool
		 */
		public function AssertIsNotNull($e, $test_name = false) {
			$result = !is_null($e);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, $result, $e)
			);
			return $result;
		}
		
		/**
		 * AssertIsEmpty: Will succeed if passed argument is empty.
		 * 
		 * @param:$e:expression: Expression to be evaluated.
		 * @param:$test_name:string: Name to identify the test with.
		 * If None given, the name of the test will be the number of
		 * when it was preformed in the suite.
		 * 
		 * @return:bool
		 */
		public function AssertIsEmpty($e, $test_name = false) {
			$result = empty($e);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, $result, $e)
			);
			return $result;
		}
		
		/**
		 * AssertIsNotEmpty: Will succeed if passed argument is not empty.
		 * 
		 * @param:$e:expression: Expression to be evaluated.
		 * @param:$test_name:string: Name to identify the test with.
		 * If None given, the name of the test will be the number of
		 * when it was preformed in the suite.
		 * 
		 * @return:bool
		 */
		public function AssertIsNotEmpty($e, $test_name = false){
			$result = !empty($e);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, $result, $e)
			);
			return $result;
		}
		
		/**
		 * AssertIsTrue: Will succeed if passed argument evaluates to true.
		 * 
		 * @param:$e:expression: Expression to be evaluated.
		 * @param:$test_name:string: Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:bool
		 */
		public function AssertIsTrue($e, $test_name = false) {
    		$result = ($e === true);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, $result, $e)
			);			
			return $result;
    	}
		
		/**
		 * AssertIsFalse: Will succeed if passed argument evaluates to true.
		 * 
		 * @param:$e:expression: Expression to be evaluated.
		 * @param:$test_name:string: Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:bool
		 */
		public function AssertIsFalse($e, $test_name = false) {
			$result = ($e === false);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, $result, $e)
			);			
			return $result;
		}
		
		/**
		 * AssertIsObject: Will succeed if passed argument is an object.
		 * 
		 * @param:$e:Object: Object to test against.
		 * @param:$test_name:string: Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:bool
		 */
		public function AssertIsObject($e, $test_name = false) {
			$result = is_object($e);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, $result, $e)
			);			
			return $result;
		}
		
		/**
		 * AssertIsArray: Will succeed if passed argument is an array.
		 * 
		 * @param:$e:Array Array to be tested.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:bool
		 */		
		public function AssertIsArray($e, $test_name = false) {
			if (is_array($e)) {
				$this->m_rgResult->Add(
					new TestResult($this->GetTestName($test_name), TRUE, __FUNCTION__, 'Passed argument is an array.')
				);
				return true;
			}
			else {
				$this->m_rgResult->Add(
					new TestResult($this->GetTestName($test_name), FALSE, __FUNCTION__, 'Passed argument is not an array.')
				);
				return false;
			}
		}
		
		/**
		 * AssertIsNotArray: Will succeed if passed argument isn't an array.
		 * 
		 * @param:$e: Parameter to be evaluated.
		 * @param:$test_name:string Name to identify the test with.
		 * 
		 * @return:bool
		 */
		public function AssertIsNotArray($e, $test_name = false) {
			if (!is_array($e)) {
				$this->m_rgResult->Add(
					new TestResult($this->GetTestName($test_name), TRUE, __FUNCTION__, 'Passed argument is not an array')
				);
				return true;
			}
			else {
				$this->m_rgResult->Add(
					new TestResult($this->GetTestName($test_name), FALSE, __FUNCTION__, 'Passed argument is an array')
				);
				return false;
			}
		}
		
		/**
		 * AssertIsInteger: Will succeed if passed argument is an integer.
		 * 
		 * @param:$e:Int Integer to be tested.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:bool
		 */	
		public function AssertIsInteger($e, $test_name = false) {
			$result = is_int($e);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, $result, $e)
			);
			return $result;			
		}
		
		/**
		 * AssertIsNotInteger: Will succeed if passed argument isn't an integer.
		 * 
		 * @param:$e:var Value to be tested.
		 * @param:$test_name:string Name to identify the test with
		 * 
		 * @return:bool
		 */
		public function AssertIsNotInteger($e, $test_name = false) {
			$result = !is_int($e);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, $result, $e)
			);
			return $result;	
		}
		
		/**
		 * AssertIsString: Will succeed if passed argument is an string.
		 * 
		 * @param:$e:string String to be tested.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:bool
		 */	
		public function AssertIsString($e, $test_name = false) {
			$result = is_string($e);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, $result, $e)
			);
			return $result;	
		}
		
		/**
		 * AssertIsNotString: Will succeed if passed argument isn't a string.
		 * 
		 * @param:$e Parameter to be tested.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:bool
		 */	
		public function AssertIsNotString($e, $test_name = false) {
			$result = !is_string($e);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, $result, $e)
			);
			return $result;	
		}
		
		/**
		 * AssertIsDouble: Will succeed if passed argument is a double.
		 * 
		 * @param:$e:double Number to be tested.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:bool
		 */	
		public function AssertIsDouble($e, $test_name = false) {	
			$result = is_double($e);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, $result, $e)
			);
			return $result;	
		}
		
		/**
		 * AssertIsDouble: Will succeed if passed argument isn't a double.
		 * 
		 * @param:$e:double Number to be tested.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:bool
		 */	
		public function AssertIsNotDouble($e, $test_name = false) {	
			$result = !is_double($e);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, $result, $e)
			);
			return $result;	
		}
		
		/**
		 * AssertIsFloat: Will succeed if passed argument is a float.
		 * 
		 * @param:$e:float Number to be tested.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:bool
		 */			
		public function AssertIsFloat($e, $test_name = false) {
			$result = is_float($e);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, $result, $e)
			);
			return $result;	
		}
		
		/**
		 * AssertIsFloat: Will succeed if passed argument isn't a float.
		 * 
		 * @param:$e:float Number to be tested.
		 * @param:$test_name:string Name to identify the test with. 
		 * If none given, the name of the test will be it's number in 
		 * order it is preformed.
		 * 
		 * @return:bool
		 */			
		public function AssertIsNotFloat($e, $test_name = false) {
			$result = !is_float($e);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, $result, $e)
			);
			return $result;	
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
		 * @return:bool
		 */	
		public function AssertIsGreaterThan($e1, $e2, $test_name = false) {
			$result = ($e1 > $e2);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, 'Is greater than.', $e1, $e2)
			);
			return $result;
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
		 * @return:bool
		 */	
		public function AssertIsLessThan($e1, $e2, $test_name = false) {
			$result = ($e1 < $e2);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, 'Is less than.', $e1, $e2)
			);
			return $result;
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
		 * @return:bool
		 */
		public function AssertIsEqual($e1, $e2, $test_name = false) {
			$result = ($e1 == $e2);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, 'Is equal to.', $e1, $e2)
			);
			return $result;
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
		 * @return:bool
		 */
		public function AssertIsNotEqual($e1, $e2, $test_name = false) {
			$result = ($e1 != $e2);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, 'Is not equal to.', $e1, $e2)
			);
			return $result;
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
		 * @return:bool
		 */
		public function AssertIsIdentical($e1, $e2, $test_name = false) {
			$result = ($e1 === $e2);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, 'Is identical to.', $e1, $e2)
			);
			return $result;
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
		 * @return:bool
		 */
		public function AssertIsNotIdentical($e1, $e2, $test_name = false) {
			$result = ($e1 !== $e2);
			
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $result, __FUNCTION__, 'Is not identical to.', $e1, $e2)
			);
			return $result;
		}
		
		/**
		 * AssertInArray: Method to see if a value can be found in an array.
		 * 
		 * @param:$needle:string The information to search the array for.
		 * @param:$haystack:array The array to search the value for.
		 * 
		 * @return:bool
		 */
		public function AssertInArray($needle, $haystack, $test_name = false) {
			if(in_array($needle, $haystack)){
				$this->m_rgResult->Add(
					new TestResult($this->GetTestName($test_name), TRUE, __FUNCTION__, 'Could be found in supplied array.', $needle)
				);
				
				return true;
			}
			else {
				$this->m_rgResult->Add(
					new TestResult($this->GetTestName($test_name), FALSE, __FUNCTION__, 'Could not be found in supplied array.', $needle)
				);
				
				return false;
			}
		}
		
		/**
		 * AssertNotInArray: Method to see if a value can be found in an array.
		 * 
		 * @param:$needle:string The information to search the array for.
		 * @param:$haystack:array The array to search the value for.
		 * 
		 * @return:bool
		 */
		public function AssertNotInArray($needle, $haystack, $test_name = false) {
			if(!in_array($needle, $haystack)){
				$this->m_rgResult->Add(
					new TestResult($this->GetTestName($test_name), TRUE, __FUNCTION__, 'Could not be found in supplied array.', $needle)
				);
				
				return true;
			}
			else {
				$this->m_rgResult->Add(
					new TestResult($this->GetTestName($test_name), FALSE, __FUNCTION__, 'Could be found in supplied array.', $needle)
				);
				
				return false;
			}
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
			$this->m_rgResult->Add(
				new TestResult($this->GetTestName($test_name), $success, __FUNCTION__, $message)
			);
				
			return $success;
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
					return $this->m_rgResult->ToArray();
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
		protected function GetTestName($name = false) {
			if (!$name) {
				$name = 'Test number: '. $this->m_testNumber;
			}
			$this->m_testNumber++;
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
			//$result = array();
			foreach ($this->m_rgResult as $suite) {
				print $suite->ToJSon();
			}
			//print json_encode($result, JSON_FORCE_OBJECT);
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
				$successPercent = $tests->SuccessPercent();
				$failPercent = $tests->FailPercent();
								
				$output .= "\t\t<div class='content'>\n";
				$output .= "\t\t\t<h1>Test results: ".$tests->Suitename()."</h1>\n";
				$output .= "\t\t\t<h2>Test preformed: ".$tests->Performed()."</h2>\n";
				$output .= "\t\t\t<div id='percentDisplay'>\n";
				$output .= "\t\t\t\t<p class='percentText'>Success: $successPercent% | Fail: $failPercent%</p>\n";
				$output .= "\t\t\t\t<p class='percentText'>Keep the bar green and your code is clean.</p>\n";
				$output .= "\t\t\t\t<p id='successPercent' style='width:". 500*($successPercent/100) ."px' class='percent'></p>\n";
				$output .= "\t\t\t\t<p id='failPercent' style='width:". 500*($failPercent/100) ."px' class='percent'></p>\n";
				$output .= "\t\t\t</div>\n";
				
				//Not working, why?
				foreach ($tests as $test) {
					$output .= "\t\t\t<div class='wrapper'>\n";
					$output .= $test->ToHTMLString();
					$output .= "\t\t\t</div>\n";
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
							margin: 10px;
							text-align: center;
							color: #000000;
							font-size: 18px;
							text-decoration: underline;
							font-weight: bold;
						}
						
						h2 {
							margin: 5px;
							text-align: center;
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
							text-align: center;
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
							min-width: 505px;
							max-width: 700px;
							border: #000000 1px solid;
							margin: auto;
							margin-top: 10px;
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
							width: 980px;				
							margin: auto;
						}
						.percent {
							margin: 0; 
							padding: 0;
							float: left;
							height: 20px;
							text-align: center;
							font-weight: 600;
						}
						#percentDisplay {
							margin:auto;
							padding: 3;
							width: 510px;
							text-align: center;
						}
						#successPercent {
							border-left: 1px solid #000;
							border-top:  1px solid #000;
							border-bottom:  1px solid #000;
							border-right: 1px dotted #000;
							background-color: green;
						}
						.percentText {
							margin:2px;
						}
						#failPercent {
							border-right: 1px solid #000;
							border-top:  1px solid #000;
							border-bottom:  1px solid #000;
							background-color: red;
						}';
    }

    /**
	 * Class to manage testresults.
	 */
    class TestResult {
    	const TEST_NAME = 'testname';
		const RESULT = 'result';
		const OPERATOR_ONE = 'operatorone';
		const OPERATOR_TWO = 'operatortwo';
		const RESULT_TEXT = 'resulttext';
		const ASSERT_TYPE = 'asserttype';
		
    	private $m_testName;
    	private $m_result;
		private $m_operatorOne;
		private $m_operatorTwo;
		private $m_resultText;
		private $m_assertType;
		
		/**
		 * Constructor that initiate a test result object.
		 *
		 * @param:$testName:string Name of the test.
		 * @param:$result:bool True for success, false for failure.
		 * @param:$resultText:string Text to be printed in html formatting.
		 * @param:$assertType:string Assert method called.
		 * @param:$operatorOne:string First operator used in the test.
		 * @param:$operatorTwo:string Second operator used.
		 * 
		 * @return:void
		 */
		public function __construct($testName, $result, $assertType, $resultText = false, 
									$operatorOne = false, $operatorTwo = false) {
			$this->m_testName = $testName;
			$this->m_result = $result;
			$this->m_resultText = $resultText;
			$this->m_assertType = $assertType;
			
			if ($operatorOne) {
				$this->m_operatorOne = var_export($operatorOne, true);
			}
			else {
				$this->m_operatorOne = false;
			}
			if ($operatorTwo) {
				$this->m_operatorTwo = var_export($operatorTwo, true);
			}
			else {
				$this->m_operatorTwo = false;
			}
		}
		//TODO: Comment the accessors.
		public function Result() {
			return $this->m_result;
		}
		
		public function OperatorOne() {
			return ($this->m_operatorOne) ? $this->m_operatorOne : false;
		}
		
		public function OperatorTwo() {
			return ($this->m_operatorTwo) ? $this->m_operatorTwo : false;
		}
		
		public function ResultText() {
			return ($this->m_resultText) ? $this->m_resultText : false;
		}
		
		public function AssertType() {
			return ($this->m_assertType) ? $this->m_assertType : false;
		}
		
		/**
		 * Returns a HTML formatted string.
		 * 
		 * @return:string
		 */
		public function ToHTMLString() {
			$outcome = ($this->m_result) ? 'win' : 'fail';
			$result = '<div class='.$outcome.'>';
			$result .= "<h3>$this->m_testName - $this->m_assertType</h3>";
			$result .= '</div>';
			$result .= '<p>';
			$result .= ($this->m_result) ? EVALUATION_SUCCESS : EVALUATION_FAILED;
			$result .= '</p>';
			$result .= '<p>';
			if ($this->m_operatorOne) {
				$result .= "<span class='value'>$this->m_operatorOne</span></p><p>";
			}
			if (!is_string($this->m_resultText)) {
				$result .= ($this->m_resultText) ? ASSERT_SUCCESSFUL : ASSERT_FAILURE;
			}
			else {
				$result .= $this->m_resultText;
			}
			if ($this->m_operatorTwo) {
				$result .= '</p><p>'.$this->m_operatorTwo;
			}
			$result .= '</p>';
			
			return $result;
		}
		
		/**
		 * Return the test results as an associative array.
		 * 
		 * @return:array
		 */
		public function ToArray() {
			$result = array(
				self::TEST_NAME => $this->m_testName,
				self::RESULT => $this->m_result,
				self::ASSERT_TYPE => $this->m_assertType,
				self::OPERATOR_ONE => $this->m_operatorOne,
				self::OPERATOR_TWO => $this->m_operatorTwo,
			);
			if (!is_string($this->m_resultText)) {
				$result[self::RESULT_TEXT] = ($this->m_resultText) ? ASSERT_SUCCESSFUL : ASSERT_FAILURE;
			}
			else {
				$result[self::RESULT_TEXT] = $this->m_resultText;
			}
			
			return $result;
		}
    }

	/**
	 * Class to manage test results in a suite.
	 */
    class TestSuite 
    implements Iterator {
    	
    	private $m_suite;
		private $m_success = 0;
		private $m_fail = 0;
		private $m_performed;
		private $m_suitename;
		private $m_position;
    	
    	public function __construct($suitename) {
    		$this->m_suite = array();
			$this->m_performed = date("Y-m-d - H:i:s (T)");
			$this->m_suitename = $suitename;
			$this->m_position = 0;
    	}
		
		public function Add(TestResult $result) {
			$this->m_suite[$this->m_position] = $result;
			$this->next();
			//var_dump($this->m_suite);
			if ($result->Result())
				$this->m_success++;
			else
				$this->m_fail++;
		}
		
		public function SuccessPercent() {
			return round(($this->m_success / count($this->m_suite)*100), 2);
		}
		
		public function FailPercent() {
			return round(($this->m_fail / count($this->m_suite)*100), 2);
		}
		
		public function Performed() {
			return $this->m_performed;
		}
		
		public function Suitename() {
			return $this->m_suitename;
		}
		
		public function ToJSon() {
			return json_encode($this->ToArray(), JSON_FORCE_OBJECT);
		}
		
		public function ToArray() {
			$result = array();
			foreach ($this->m_suite as $test) {
				$result[] = $test->ToArray();
			}
			return $result;
		}
		
		//Iterator implementation.
		function rewind() {
	        $this->m_position = 0;
	    }
	
	    function current() {
	        return $this->m_suite[$this->m_position];
	    }
	
	    function key() {
	        return $this->m_position;
	    }
	
	    function next() {
	        $this->m_position++;
	    }
	
	    function valid() {
	        return isset($this->m_suite[$this->m_position]);
	    }
    }
