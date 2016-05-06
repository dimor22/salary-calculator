<?php

namespace App;

/**
 * Class CalcSalary
 *
 * @date      5/4/16
 * @author    dave
 * @copyright Copyright (c) Infostream Group
 */

/**
 * Class CalcSalary
 *
 * Long description of class goes here. What is this for?
 *
 * <h4>Example</h4>
 *
 * <code>
 * // Example code goes here
 * </code>
 *
 * @see  Display a link to the documentation for an element here
 * @link Display a hyperlink to a URL in the documentation here
 */
class CalcSalary {

	public $input;
	public $output;

/**
 * According to OPM.GOV
 * I'm using their 2,087-Hour Divisor
 * https://www.opm.gov/policy-data-oversight/pay-leave/pay-administration/fact-sheets/computing-hourly-rates-of-pay-using-the-2087-hour-divisor/
 */
	private $total_work_hours = 2087;

	public function __construct($input)
	{
		setlocale(LC_MONETARY, 'en_US');
		$this->input = $input;
		$this->calculateSalary();
	}

	function calculateSalary()
	{
		if ($this->input < 1000) {
			$this->output = [
				'yearly'    => $this->input * 40 * 52.175,
				'monthly'   => $this->input * 40 * 4,
				'biweekly'  => $this->input * 40 * 2,
				'weekly'    => $this->input * 40
			];

			foreach($this->output as $key => $value){
				$this->output[$key] =  '$' . number_format($value, 2);
			}

			return $this->output;
		}

		if ($this->input > 1000) {
			$this->output = [
				'hourly'    => $this->input / $this->total_work_hours,
				'weekly'    => $this->input / $this->total_work_hours * 40,
				'biweekly'  => $this->input / $this->total_work_hours * 40 * 2,
				'monthly'   => $this->input / $this->total_work_hours * 40 * 4
			];

			foreach($this->output as $key => $value){
				$this->output[$key] =  '$' . number_format($value, 2);
			}

			return $this->output;
		}

		return false;
	}

}