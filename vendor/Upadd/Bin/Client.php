<?php
namespace Upadd\Bin;

use Upadd\Swoole\Lib\Help;

abstract class Client{


    public $host = null;

    public $type = null;

    /**
     * set in port
     * @var null
     */
    public $port = null;


    /**
     * Client constructor.
     * @param $address
     * @param null $data
     */
    public function __construct($address,$data=null)
    {
        $parse  = Help::parseAddress($address);
        print_r($parse);

    }

    /**
     * @param $address
     * @param null $data
     * @return static
     */
    public static function create($address,$data=null)
    {
        return new static($address,$data);
    }


    /**
     * @return mixed
     */
   abstract public function asyncHttp();

    /**
     * @return mixed
     */
   abstract public function asyncTcp();

    /**
     * @return mixed
     */
   abstract public function close();




}