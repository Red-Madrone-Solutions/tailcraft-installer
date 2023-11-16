<?php

namespace RMS\TailCraftInstaller\Util;

class DirectoryDelete 
{
  protected string $directory;

  public function __construct($directory) {
    $this->directory = $directory;
  }

  public function __invoke() : void 
  {
    if ( !is_dir($this->directory) ) {
      return;
    }

    $dir_handle = opendir($this->directory);

    while ( ($file = readdir($dir_handle)) !== false ) {
      if ( $file === '.' || $file === '..' ) {
        continue;
      }

      // TODO handle other directory separators
      $file_path = $this->directory . '/' . $file;

      if ( is_dir($file_path) ) {
        $dir_delete = new self($file_path);
        $dir_delete();
      } else {
        unlink($file_path);
      }
    }

    closedir($dir_handle);

    rmdir($this->directory);
  }
}
