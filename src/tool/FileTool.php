<?php

namespace Vzinger\Tool;

class FileTool
{

    /**
     * 检查目录/文件是否可写
     * @param $path
     * @return bool
     */
    public static function path_is_writable($path)
    {
        if (DIRECTORY_SEPARATOR == '/' && !@ini_get('safe_mode')) {
            return is_writable($path);
        }

        if (is_dir($path)) {
            $path = rtrim($path, '/') . '/' . md5(mt_rand(1, 100) . mt_rand(1, 100));
            if (($fp = @fopen($path, 'ab')) === false) {
                return false;
            }

            fclose($fp);
            @chmod($path, 0777);
            @unlink($path);

            return true;
        } elseif (!is_file($path) || ($fp = @fopen($path, 'ab')) === false) {
            return false;
        }

        fclose($fp);
        return true;
    }

    /**
     * 检查目录/文件是否可写
     * @param $path
     * @return bool
     */
    public static function create_dir($path)
    {
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        return true;
    }


    /**
     * 删除文件夹
     * @param string $dirname 目录
     * @param bool   $delself 是否删除自身
     * @return boolean
     */
    public static function deldir($dirname, $delself = true)
    {
        if (!is_dir($dirname)) {
            return false;
        }
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dirname, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $fileinfo) {
            if ($fileinfo->isDir()) {
                self::deldir($fileinfo->getRealPath());
            } else {
                @unlink($fileinfo->getRealPath());
            }
        }
        if ($delself) {
            @rmdir($dirname);
        }
        return true;
    }

    /**
     * 删除一个路径下的所有相对空文件夹（删除此路径中的所有空文件夹）
     * @param string $path 相对于根目录的文件夹路径，如 c:BuildAdmin/a/b/
     * @return void
     */
    public static function del_empty_dir($path)
    {
//        $path = str_replace(root_path(), '', rtrim(path_transform($path), DIRECTORY_SEPARATOR));
        $path = array_filter(explode(DIRECTORY_SEPARATOR, $path));
        for ($i = count($path) - 1; $i >= 0; $i--) {
            $dirPath = realpath(dirname(__DIR__)) . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $path);
            if (!is_dir($dirPath)) {
                unset($path[$i]);
                continue;
            }
            if (self::dir_is_empty($dirPath)) {
                self::deldir($dirPath);
                unset($path[$i]);
            } else {
                break;
            }
        }
    }

    public static function dir_is_empty($dir)
    {
        $handle = opendir($dir);
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                closedir($handle);
                return false;
            }
        }
        closedir($handle);
        return true;
    }

}
