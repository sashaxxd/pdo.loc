<?php



class Connection
{
    private $link;

    public function __construct()
    {
        $this->connect();
    }

    private function connect(){

        $config = require_once 'config.php';

        $dsn = 'mysql:host='.$config['host'].';dbname='.$config['db_name'].';charset='.$config['charset'];

        $this->link = new PDO($dsn, $config['username'], $config['password']);

        return $this;

    }

    public function execute($sql){

        $str = $this->link->prepare($sql);

        return $str->execute();

    }

    public function query($sql)
    {
        $str = $this->link->prepare($sql);

        $str->execute();

        $result = $str->fetchAll(\PDO::FETCH_ASSOC);

        if($result === false){
            return [];
        }

        return $result;

    }

}

$user = new Connection();
//$user->execute("INSERT INTO `users`(`name`, `password`, `date`) VALUES ('Залупа','666667','111')");

$us = $user->query("SELECT * FROM `users`");

print_r($us);