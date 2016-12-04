<?php namespace System\Modules\Filesystem;

/*
 ===========================================================================
 = Application File System
 ===========================================================================
 =
 = Responsible for doing all the file manipulation of the application.
 = 
 */

use \ErrorException;
use \InvalidArgumentException;
use \System\Exceptions\FileNotFoundException;

use \System\Interfaces\FileInterface;

use \FilesystemIterator;
use \Symfony\Component\Finder\Finder;

/**
 * File System
 * @link https://github.com/lleocastro/genniuz-framework/
 * @license (MIT) https://github.com/lleocastro/genniuz-framework/blob/master/LICENSE
 * @author Leonardo Carvalho <leonardo_carvalho@outlook.com>
 * @package \System\Modules\Filesystem;
 * @copyright 2016 
 * @version 1.0.0
 */
class FileManipulator implements FileInterface
{
	/**
     * Check a file exists.
     * @param string $path
     * @return bool
     */
    public function exists(string $path):bool
    {
        return is_readable($path);
    }
    
	/**
     * Get the contents of file.
     * @param string $path
     * @return string
     */
    public function read(string $path, bool $planText = false):array
    {
        if(!is_readable($path)):
            throw new FileNotFoundException('File not found!');
        endif;
        
        if($planText):
            $file = fopen($path, 'r');

            $data = [];
            $i = 0;

            while(!feof($file)):
                $data[$i] = fgets($file, 4096);
                $i++;
            endwhile;
            
            return array_filter($data);
        endif;

        return [file_get_contents($path)];
    }

    /**
     * Write the contents of file.
     * @param string $path
     * @param string $contents
     * @return bool
     */
    public function write(string $path, string $contents):bool
    {
        if($this->checkFile($path)):
            return file_put_contents($path, $contents);
        endif;
    }

    /**
     * Append to a file.
     * @param string $path
     * @param string $data
     * @return bool
     */
    public function append(string $path, string $data):bool
    {}

    /**
     * Copy a file to a new location.
     * @param string $from
     * @param string $to
     * @return bool
     */
    public function copy(string $from, string $to):bool
    {}

    /**
     * Move a file to a new location.
     * @param string $from
     * @param string $to
     * @return bool
     */
    public function move(string $from, string $to):bool
    {}

    /**
     * Get the file size.
     * @param string $path
     * @return int
     */
    public function size(string $path):bool
    {}

    /**
     * Delete the files. Recursive..
     * @param string|array $paths
     * @return bool
     */
    public function delete(string $paths):bool
    {}

    /**
     * Get the file's last modification time.
     * @param string $path
     * @return int
     */
    public function lastModified(string $path):bool
    {}

    /**
     * Get an array of all files in a directory.
     * @param string $directory
     * @param bool $recursive
     * @return array
     */
    public function allFiles(string $directory, bool $recursive = false):array
    {}

    /**
     * Create directory.
     * @param string $path
     * @return bool
     */
    public function createDirectory(string $path):bool
    {}

    /**
     * Delete directory.
     * @param string $directory
     * @return bool
     */
    public function deleteDirectory(string $directory):bool
    {}

    /**
     * Get all of the directories.
     * @param string $directory
     * @param bool $recursive
     * @return array
     */
    public function allDirectories(string $directory, bool $recursive = false):array
    {}

    private function checkFile(string $path):bool
    {
        if(!is_readable($path)):
            throw new FileNotFoundException('File not found!');
        endif;

        return true;
    }

}