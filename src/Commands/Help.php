<?php

namespace RMS\TailCraftInstaller\Commands;

class Help extends Base {
  protected function run() : void
  {
    $this->info('This is the installer for the TailCraft base theme');
    $this->info('By default, it will setup a new WordPress theme with Tailwind and Alpine.js. If you already have a TailCraft-based theme setup, you can install ACF-based blocks for rapid theme setup.');
    $this->info('Run `tailcraft --list` for a list of all available commands');
  }

  protected function info($str) : void
  {
    \Laravel\Prompts\info( wordwrap($str, 76, "\n", true) );
  }
}


