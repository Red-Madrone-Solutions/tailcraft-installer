<?php

namespace RMS\TailCraftInstaller;

class Options
{
  protected array $options;

  public function __construct()
  {
    $this->options = getopt(
      'hsi:ll:',
      [ 
        'help', 'setup', 'install:', 'list',
        'list:',
      ]
    );
  }

  public function help() : bool
  {
    return isset($this->options['h']) || isset($this->options['help']);
  }

  public function setup() : bool
  {
    return isset($this->options['s']) || isset($this->options['setup']);
  }

  public function list() : bool
  {
    return isset($this->options['l']) || isset($this->options['list']);
  }
}


