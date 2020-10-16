<?php 
include_once 'class_connect.php';


class CreaterUser
{

    private $name;
    private $age;
    private $phone;
    private $maxLenghName;
    private $maxLenghPhone;
    private $minLenghPhone;
    function __construct($name,$age,$phone)
    {
        $this->name = htmlspecialchars($name);
        $this->age = htmlspecialchars($age);
        $this->phone = htmlspecialchars($phone);
        $this->maxLenghName = 30;
        $this->maxAge = 120;
        $this->maxLenghPhone = 19;
        $this->minAge = 0;
    }

    public function addition()  //основной метод добавления пользователя
    {
        if ($this->checkNameDB()) {
            return false;   
        }
        else {
            if ($this->checkName()) {
                if ($this->checkAge()) {
                    if ($this->checkPhone()) {
                        if ($this->addUserDB()) {
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                    else {
                        return false;
                    }
                }
                else {
                    return false;
                }
            }
            return false;
        }
    }

    public function addUserDB() //метод добавления записи в БД
    {
        $connect = new connectBD();
        $link = $connect->connect();

        $query = 'INSERT INTO users (name,age,phone_number) VALUES ("'.$this->name.'",'.$this->age.',"'.$this->phone.'")';
        $result = mysqli_query($link, $query);
        if ($result) {
            return true;
        }
        else{
            return false;
        }

        $connect->closeConnect();
    }

    public function checkName() //метод проверки на валидность имени пользователя
    {
        if (strlen($this->name) <= $this->maxLenghName) 
		{
            $reg = "/^[ ].*$/i";
            if (!preg_match($reg, $this->name))
            {
                return true;
            }
            else
            {
                return false;
            }
		}
		else {
            return false;
        }
    }

    public function checkAge() //метод проверки на валидность возраста пользователя
    {
        if (filter_var($this->age,FILTER_VALIDATE_INT))
        {
            if ($this->age > $this->minAge && $this->age < $this->maxAge)
            {
                    return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function checkPhone()  //метод проверки на валидность телефона пользователя
    {
        if (strlen($this->phone) >= $this->minLenghPhone && strlen($this->phone) <= $this->maxLenghPhone) 
		{
            $reg = "/^\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}$/";
            if (preg_match($reg, $this->phone))
            {
                return true;
            }
            else
            {
                return false;
            }
		}
		else {
            return false;
        }
    }

    public function checkNameDB() //метод проверки имени пользователя на занятость
    {
        $connect = new connectBD();
        $link = $connect->connect();

        $query = 'SELECT * FROM users WHERE name = "'.$this->name.'"';
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0) {
            return true;
        }
        else{
            return false;
        }

        $connect->closeConnect();
    }

}