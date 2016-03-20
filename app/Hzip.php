<?php namespace App;


use ZipArchive;

class HZip 
{ 
  private static function folderToZip($folder, &$zipFile, $exclusiveLength) { 
    $handle = opendir($folder); 
    while (false !== $f = readdir($handle)) { 
      if ($f != '.' && $f != '..') { 
        $filePath = "$folder/$f"; 
        // Remove prefix from file path before add to zip. 
        $localPath = substr($filePath, $exclusiveLength); 
        if (is_file($filePath)) { 
          $zipFile->addFile($filePath, $localPath); 
        } elseif (is_dir($filePath)) { 
          $zipFile->addEmptyDir($localPath); 
          self::folderToZip($filePath, $zipFile, $exclusiveLength); 
        } 
      } 
    } 
    closedir($handle); 
  } 
  
  public static function zipDir($sourcePath, $outZipPath) 
  { 
    $pathInfo = pathInfo($sourcePath); 
    $parentPath = $pathInfo['dirname']; 
    $dirName = $pathInfo['basename']; 
    $dirName = iconv('UTF-8','GBK',$dirName);
    $sourcePath=$parentPath.'/'.$dirName;
    $z = new ZipArchive(); 
    $z->open($outZipPath, ZIPARCHIVE::CREATE);
    $z->addEmptyDir($dirName);
    self::folderToZip($sourcePath, $z, strlen("$parentPath/")); 
    $z->close(); 
  } 
} 
?>