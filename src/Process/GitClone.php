<?php

namespace RMS\TailCraftInstaller\Process;

use Exception;
use RMS\TailCraftInstaller\Process\Base;
use RMS\TailCraftInstaller\Util\DirectoryDelete;

class GitClone extends Base {
  protected string $destination;

  public function __construct(
    string $repo,
    string $destination = '.',
    string $service = 'github'
  ) {
    if ( $service !== 'github' ) {
      throw new Exception('Unknown service: ' . $service);
    }

    $this->destination = $destination;

    $repo_url = 'https://github.com/' . $repo . '.git';
    parent::__construct(
      'git', 
      [ 'clone', '-b main', 
        escapeshellarg($repo_url), 
        escapeshellarg($destination),
        '--q',
      ]
    );
  }

  public function cleanup() : void
  {
    // Delete .git directory
    $dir_delete = new DirectoryDelete( $this->destination . '/.git' );
    $dir_delete();
  }
}

