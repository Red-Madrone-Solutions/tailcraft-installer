<?php

namespace RMS\TailCraftInstaller\Process;

class Rsync extends Base
{
  public function __construct(
    string $source,
    string $destination,
    bool $test = false
  ) {
    $args = [ 
      '-rltv',
      '--exclude .DS_Store',
    ];
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
