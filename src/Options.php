<?php

namespace RMS\TailCraftInstaller;

class Options
{
  protected array $options;

  public function __construct()
  {
    $this->options = getopt(
      'hsi:l::vb:d',
      [ 
        'help', 'setup', 'install:', 'list',
        'list:', 
        'source:', 'target:', 'refresh-libs',
        'block:', 'cpt:', 'taxonomy:',
        'force',
      ]
    );
  }

  public function dev() : bool
  {
    return isset($this->options['d']);
  }

  public function force() : bool
  {
    return isset($this->options['force']);
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

  public function installBlock() : bool
  {
    return isset($this->options['b']) || isset($this->options['block']);
  }

  public function block() : string
  {
    return isset($this->options['b']) 
      ? $this->options['b'] 
      : $this->options['block']
    ;
  }

  public function installCpt() : bool
  {
    return isset($this->options['cpt']);
  }

  public function cpt() : string
  {
    return $this->options['cpt'];
  }

  public function installTaxonomy() : bool
  {
    return isset($this->options['taxonomy']);
  }

  public function taxonomy() : string
  {
    return $this->options['taxonomy'];
  }

  public function refresh() : bool
  {
    return isset($this->options['refresh-libs']);
  }

  public function verbose() : bool
  {
    return isset($this->options['v']);
  }

  public function target() : ?string
  {
    return isset($this->options['target']) ? $this->options['target'] : null;
  }

  public function source() : ?string
  {
    return isset($this->options['source']) ? $this->options['source'] : null;
  }
}


