<?php

namespace RMS\TailCraftInstaller\Commands;

abstract class Base {
  public function __invoke() 
  {
    $this->run();
  }

  protected abstract function run();
}

