<?php

namespace RMS\TailCraftInstaller\Process;

use Exception;
use RMS\TailCraftInstaller\Process\Base;

class GitClone extends Base {

  public function __construct(
    string $repo,
    string $destination = '.',
    string $service = 'github'
  ) {
    if ( $service !== 'github' ) {
      throw new Exception('Unknown service: ' . $service);
    }

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
}

