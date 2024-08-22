<?php

namespace RMS\TailCraftInstaller\Commands;

use RMS\TailCraftInstaller\Options;

abstract class Base {
  public function __invoke(?Options $options = null) 
  {
    $this->run($options);
  }

  protected abstract function run(Options $options);
}

