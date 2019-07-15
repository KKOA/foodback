<?php
/**
 * Created by : PhpStorm.
 * User : keith
 * Date : 26/06/2019
 */
declare(strict_types=1);

namespace Tests\Browser\MyHelper;

use Laravel\Dusk\Browser;

/**
 * Trait DuskFormHelper
 */
trait DuskFormHelper
{
	/**
	 * Check field is of type text
	 * @param array $data
	 * @return bool
	 */
	public function isTextField(array $data) :bool
	{
		$validFields =['text','password'];
		return in_array($data['field_type'],$validFields);
	}


	/**
	 * Check field is of type checkbox
	 * @param array $data
	 * @return bool
	 */
	public function isCheckBox(array $data) :bool
	{
		return $data['field_type'] === 'checkbox';
	}

	/**
	 * fill the all text fields on a form
	 * @param Browser $browser
	 * @param array $rows
	 * @return void
	 */
	public function fillTextFields(Browser $browser, array $rows) :void
	{
		foreach($rows as $row)
		{
			$browser->type($row['field_name'], $row['field_value']);
		}
	}

	/**
	 * fill the all checkbox fields on a form
	 * @param Browser $browser
	 * @param array $rows
	 * @return void
	 */
	public function fillCheckBox(Browser $browser, array $rows) :void
	{
		foreach($rows as $row)
		{
			$browser->click('#'.$row['field_name']);
		}
	}

	/**
	 * Performs the relevant action based field type and submit form
	 * @param Browser $browser
	 * @param array $fields
	 */
	public function submitForm(Browser $browser, array $fields)
	{
		$this->fillTextFields($browser, array_filter($fields,[$this, "isTextField"]));
		$this->fillCheckBox($browser, array_filter($fields,[$this, "isCheckBox"]));
		$browser->click('button[type="submit"]');
	}





}