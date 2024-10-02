<?php

namespace RMS\TailCraftInstaller\Process;

class Rsync extends Base
{
  public function __construct(
    string $source,
    string $destination,
    bool $test = false,
    array $excludes = []
  ) {
    $args = [ 
      '-rltv',
      '--exclude .DS_Store',
    ];
    foreach ( $excludes as $exclude ) {
      $args[]= "--exclude $exclude";
    }
    if ( $test ) {
      $args[]= '--dry-run';
    }
    $args[]= $source;
    $args[]= $destination;
    parent::__construct(
      'rsync',
      $args
    );
  }
}
