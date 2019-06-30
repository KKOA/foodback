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
	 * Check field is of text
	 * @param array $data
	 * @return bool
	 */
	public function isTextField(array $data) :bool
	{
		$validFields =['text','password'];
//		return $data['field_type'] === 'text';
		return in_array($data['field_type'],$validFields);
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




}