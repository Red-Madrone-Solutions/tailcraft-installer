<?php

namespace RMS\TailCraftInstaller\Commands;

use function RMS\TailCraftInstaller\info;

class Help extends Base {
  protected function run() : void
  {
    info('This is the installer for the TailCraft base theme');
    info('By default, it will setup a new WordPress theme with Tailwind and Alpine.js. If you already have a TailCraft-based theme setup, you can install ACF-based blocks for rapid theme setup.');
    info('Run `tailcraft --list` for a list of all available commands');
  }
}


