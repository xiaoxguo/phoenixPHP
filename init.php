#!/usr/local/php-7.0/bin/php
<?php
define('DS', DIRECTORY_SEPARATOR);

class InitRun
{
    public static $argv = [];

    public static function read($path)
    {
        if(!is_dir($path)){
            throw new Error('被打开的不是目录');
        }

        $handle = opendir($path);
        while(false !== $file = readdir($handle)){
            if($file == '.' || $file == '..') continue;
            $newPath = $path . DS . $file;
            if(substr($file, strpos($file, '.') + 1) == 'php'){
                if($newPath == $path.DS.'init.php'){
                    continue;
                }
                $fileString     = file_get_contents($newPath);
                $fileArr        = explode("\n", $fileString);
                static::$argv[$newPath] = $fileArr;
            }
            if(is_dir($newPath)){
                self::read($newPath);
            }
        }
        closedir($handle);
    }

    public static function write()
    {
        $result = [];
        foreach(static::$argv as $path => $item){
            $result[$path] = self::pipei($item);
        }


//        var_dump($result);die;

    }

    private static function pipei($item)
    {
        $result['namespace'] = self::getNamespace($item);
        $result['class']     = [];
        foreach($item as $v){
            $arr = [];
            preg_match("#(interface)|(trait)|(class) [^\$]\w+#", $v, $arr);
            if($arr){
                var_dump($arr);
                $result['class'][] = explode(' ', trim($arr[0]))[1];
            }
        }

        return $result;
    }

    private static function getNamespace($item)
    {
        foreach($item as $v){
            $namespaceIndex = strpos($v, 'namespace');
            if($namespaceIndex !== false){
                return trim(str_replace('namespace', '', $v), ' ;');
            }
        }

        return false;
    }

    private static function getClass($string)
    {
        if(strpos($string, 'class') !== false){
            $string = trim($string);
            $class  = explode(' ', $string)[1];
        }
    }

}

InitRun::read(dirname(__FILE__));
InitRun::write();

