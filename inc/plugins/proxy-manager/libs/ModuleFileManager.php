<?php
namespace Plugins\ProxyManager;

// Disable direct access
if (!defined('APP_VERSION')) {
    die("Yo, what's up?");
}

class ModuleFileManager
{
    /**
     * @var $paths
     */
    private $paths = [];

    /**
     * @var $moduleFolder
     */
    private $moduleFolder;

    /**
     * @param $path
     * @return $this
     */
    public function addPath($path)
    {
        $this->paths[] = $path;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModuleFolder()
    {
        return $this->moduleFolder;
    }

    /**
     * @param $moduleFolder
     * @return $this
     */
    public function setModuleFolder($moduleFolder)
    {
        $this->moduleFolder = $moduleFolder;
        return $this;
    }

    /**
     * @param $path
     * @return array|mixed
     */
    public function getFileName($path)
    {
        $filename = $path;
        $filename = explode('/', $filename);
        $filename = end($filename);
        return $filename;
    }

    /**
     * @param string $path
     * @param bool $isIncludeFileName
     * @return array|string
     */
    public function getAppPath($path, $isIncludeFileName = true)
    {
        $appPath = ROOTPATH.'/'.$path;

        if(!$isIncludeFileName) {
            $appPath = explode("/", $appPath);
            $appPath = array_slice($appPath, 0, count($appPath) - 1);
            $appPath = implode("/", $appPath);
        }

        return $appPath;
    }

    /**
     * @param $path
     * @param null $moduleFolderName
     * @return string
     */
    public function getModulePath($path, $moduleFolderName = null)
    {
        $moduleFolder = $moduleFolderName;

        if($this->moduleFolder) {
            $moduleFolder = $this->moduleFolder;
        }

        $modulePath = ROOTPATH.'/inc/plugins/'.IDNAME.'/'.$moduleFolder.'/'.$this->getFileName($path);

        return $modulePath;
    }

    /**
     * Reset paths
     */
    public function reset() {
        $this->paths = [];
        return $this;
    }

    /**
     * Backup from source to destination
     */
    public function backup()
    {
        foreach ($this->paths as $path) {
            copy($this->getAppPath($path), $this->getModulePath($path, "backup"));
        }

        $this->reset();

        return $this;
    }

    /**
     * Restore from source to destination
     */
    public function restore()
    {
        foreach ($this->paths as $path) {
            copy($this->getModulePath($path,"backup"), $this->getAppPath($path));
        }

        $this->reset();

        return $this;
    }

    /**
     * Replace from source to destination
     */
    public function replace()
    {
        foreach ($this->paths as $path) {
            copy($this->getModulePath($path,"replace"), $this->getAppPath($path));
        }

        $this->reset();

        return $this;
    }

    /**
     * Delete file
     */
    public function delete()
    {
        foreach ($this->paths as $path) {
            // Ensure file exist to delete to prevent error
            $appPath = $this->getAppPath($path);
            if(file_exists($appPath)) {
                unlink($appPath);
            }
        }

        $this->reset();

        return $this;
    }
}