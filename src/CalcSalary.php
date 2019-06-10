<?php

namespace App;

/**
 * Class CalcSalary
 *
 * @date      5/4/16
 * @author    dave
 * @copyright Copyright (c) David Lopez
 */

/**
 * Class CalcSalary
 *
 * Salary Calculator
 *
 */
class CalcSalary {

	private $input;
	public $output;
	private $statusTax;

    /**
     * According to OPM.GOV
     * I'm using their 2,087-Hour Divisor
     * https://www.opm.gov/policy-data-oversight/pay-leave/pay-administration/fact-sheets/computing-hourly-rates-of-pay-using-the-2087-hour-divisor/
     */
	private $total_work_hours = 2087;

    /**
     * Taxes
     * https://smartasset.com/taxes/nevada-paycheck-calculator#cXWxjOrt1b
     */
	private $federal_tax_nv_married = 9.28;
	private $federal_tax_nv_single = 15.06;

    /**
     * State Insurance Taxes
     * https://smartasset.com/taxes/nevada-paycheck-calculator#cXWxjOrt1b
     */
    private $sit = 7.65;

	public function __construct($input, $status)
	{
		setlocale(LC_MONETARY, 'en_US');
		$this->input = $input;
		$this->statusTax = $status == 1 ? $this->federal_tax_nv_married : $this->federal_tax_nv_single;
		$this->totalTax = $this->statusTax + $this->sit;
		$this->calculateSalary();
	}

	function calculateSalary()
	{
		if ($this->input < 1000) {

            $this->hourlyBreakdown();
		}

		if ($this->input > 1000) {

		    $this->yearlyBreakdown();
		}

        $this->output['tableHeader'] = [
            'tax' => $this->totalTax
        ];

        return $this->output;

    }

	public function amountWithTax($amount){

	    return $amount - ($amount * ($this->totalTax/100));
    }

	public function hourlyBreakdown(){

        $yearly             = $this->input * $this->total_work_hours;
        $yearlyWithTax      = $this->amountWithTax($yearly);

        $monthly            = $this->input * 40 * 4;
        $monthlyWithTax     = $this->amountWithTax($monthly);

        $biweekly           = $this->input * 40 * 2;
        $biweeklyWithTax    = $this->amountWithTax($biweekly);

        $weekly             = $this->input * 40;
        $weeklyWithTax      = $this->amountWithTax($weekly);

        $hourly             = $this->input;
        $hourlyWithTax      = $this->amountWithTax($hourly);

        $this->output['tableData'] = [
            [
                'name'      => 'yearly',
                'amount'    => $yearly,
                'withTax'   => $yearlyWithTax
            ],
            [
                'name'      => 'monthly',
                'amount'    => $monthly,
                'withTax'   => $monthlyWithTax
            ],
            [
                'name'      => 'biweekly',
                'amount'    => $biweekly,
                'withTax'   => $biweeklyWithTax
            ],
            [
                'name'      => 'weekly',
                'amount'    => $weekly,
                'withTax'   => $weeklyWithTax
            ],
            [
                'name'      => 'hourly',
                'amount'    => $hourly,
                'withTax'   => $hourlyWithTax
            ]

        ];

    }

    public function yearlyBreakdown(){

        $yearly             = $this->input;
        $yearlyWithTax      = $this->amountWithTax($yearly);

        $hourly             = $this->input / $this->total_work_hours;
        $hourlyWithTax      = $this->amountWithTax($hourly);

        $monthly            = $this->input / $this->total_work_hours * 40 * 4;
        $monthlyWithTax     = $this->amountWithTax($monthly);

        $biweekly           = $this->input / $this->total_work_hours * 40 * 2;
        $biweeklyWithTax    = $this->amountWithTax($biweekly);

        $weekly             = $this->input / $this->total_work_hours * 40;
        $weeklyWithTax      = $this->amountWithTax($weekly);

        $this->output['tableData'] = [
            [
                'name'      => 'yearly',
                'amount'    => $yearly,
                'withTax'   => $yearlyWithTax
            ],
            [
                'name'      => 'monthly',
                'amount'    => $monthly,
                'withTax'   => $monthlyWithTax
            ],
            [
                'name'      => 'biweekly',
                'amount'    => $biweekly,
                'withTax'   => $biweeklyWithTax
            ],
            [
                'name'      => 'weekly',
                'amount'    => $weekly,
                'withTax'   => $weeklyWithTax
            ],
            [
                'name'      => 'hourly',
                'amount'    => $hourly,
                'withTax'   => $hourlyWithTax
            ]

        ];
    }

}