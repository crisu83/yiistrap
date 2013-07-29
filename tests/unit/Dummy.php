<?php

class Dummy extends CModel
{
    public $text = 'text';
    public $password = 'secret';
    public $url = 'http://www.getyiistrap.com';
    public $email = 'christoffer.niska@gmail.com';
    public $number = 42;
    public $range = 3.33;
    public $date = '2013-07-27';
    public $radio = true;
    public $checkbox = false;
    public $uneditable = 'Uneditable text';
    public $search = 'Search query';
    public $textarea = 'Textarea text';

    public function attributeNames()
    {
        return array();
    }
}