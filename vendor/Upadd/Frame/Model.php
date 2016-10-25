<?php

namespace Upadd\Frame;

use Upadd\Frame\Query;

class Model
{
    public $Query = null;

    /**
     * 初始化
     * Model constructor.
     * @param null $db
     */
    public function __construct($dbInfo = null)
    {
        $this->Query = new Query();
        if ($dbInfo !== null) {
            $this->Query->_dbInfo = $dbInfo;
        } else {
            $this->Query->_dbInfo = conf('database@db');
            //派发数据库
            $this->Query->distribution();
        }
        $this->Query->connection();
    }

    /**
     * 获取为止参数
     * @param $key
     * @return null
     */
    public function __get($key)
    {
        if (array_key_exists($key, $this->Query->parameter))
        {
            return $this->Query->parameter[$key];
        } else {
            return null;
        }
    }

    /**
     * 设置未知的参数
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        $this->parameter [$key] = $value;
    }

    /**
     * 获取设置的参数
     * @return mixed
     */
    public function getData()
    {
        return $this->getParameter();
    }

    public function __call($name, $parameters)
    {
        try {
            return call_user_func_array(array($this->Query, $name), $parameters);
        }catch(\Exception $e){
            p($e);
        }
    }

    public static function __callStatic($method, $parameters)
    {
        try {

            /**
             * 实例化自己
             */
            $instance = new static;

            return call_user_func_array([$instance->Query, $method], $parameters);

        }catch(\Exception $e)
        {
            p($e);
        }
    }

}
