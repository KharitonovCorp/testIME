<?php 

class connectBD //класс подключения к БД
{


    private $host = "localhost";
	private $user = "root";
    private $password = "";
    private $database = "test_work";
	


    public $link;
    function connect() 
    {
    	return $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database);
    }

    function closeConnect() 
    {
    	return $this->link = mysqli_close($this->link);
    }

}

?>