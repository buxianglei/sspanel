<?php
namespace App\Transformers;

/**
 * 转换基底类
 */
abstract class Transformer
{
    /**
     * 代转换属性
     *
     * @var Object|Array
     */
    protected $attritube;

    /**
     * 主转换抽象方法
     *
     * @param Array $attritube
     * @return Array
     */
    public abstract function transform($attritube);

    /**
     * 构造方法
     *
     * @param Object|Array $attritube
     */
    public function __construct($attritube = null)
    {
        $this->attritube = $attritube;
    }

    /**
     * 批量转换方法
     *
     * @param Object|Array $attritube
     * @return Array
     */
    public function transforms($attritube = null)
    {
        $this->attritube = $attritube;

        if ($this->attritube == null) {
            return abort(500, 'the transformer class\'s attritube is null');
        }

        if (method_exists($this->attritube, 'toArray')) {
            $this->attritube = $this->attritube->toArray();
        }

        if (is_object($this->attritube)) {
            $this->attritube = $this->objectToArray($this->attritube);
        }

        return array_map(array($this, 'transform'), $this->attritube);
    }

    /**
     * 将对象转换为数组
     *
     * @param Object $d
     * @return Array
     */
    public function objectToArray($d)
    {  
        if (is_object($d)) {  
            // Gets the properties of the given object  
            // with get_object_vars function  
            $d = get_object_vars($d);  
        }  
    
        if (is_array($d)) {  
            /* 
            * Return array converted to object 
            * Using __FUNCTION__ (Magic constant) 
            * for recursive call 
            */  
            return array_map(__FUNCTION__, $d);  
        }  
        else {  
            // Return array  
            return $d;  
        }  
    } 
}
