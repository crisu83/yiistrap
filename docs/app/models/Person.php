<?php
class Person extends CModel
{
	public $id;
	public $firstName;
	public $lastName;
	public $language;
	public $hours;
	public $firstLetter;

	public function attributeNames()
	{
		return array(
			'id',
			'firstName',
			'lastName',
			'language',
			'hours'
		);
	}

	/**
	 * Helper function to return a datagrid for the grid examples
	 * @return CArrayDataProvider
	 */
	public static function getGridDataProvider()
	{
		$mark = new Person();
		$mark->id = 1;
		$mark->firstName = 'Mark';
		$mark->lastName = 'Otto';
		$mark->language = 'CSS';
		$mark->hours = 10;

		$jacob = new Person();
		$jacob->id = 2;
		$jacob->firstName = 'Jacob';
		$jacob->lastName = 'Thornton';
		$jacob->language = 'JavaScript';
		$jacob->hours = 20;

		$stu = new Person();
		$stu->id = 3;
		$stu->firstName = 'Stu';
		$stu->lastName = 'Dent';
		$stu->language = 'HTML';
		$stu->hours = 15;

		$sunny = new Person();
		$sunny->id = 4;
		$sunny->firstName = 'Sunny';
		$sunny->lastName = 'Man';
		$sunny->language = 'HTML';
		$sunny->hours = 15;

		$persons = array($mark, $jacob, $stu, $sunny);

		return new CArrayDataProvider($persons, array(
			'pagination' => array('pageSize' => 2)
		));
	}


	public function search()
	{
		return new Person();
	}
}
