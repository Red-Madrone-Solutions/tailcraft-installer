<?php

namespace RMS\TailCraftInstaller;

use RMS\TailCraftInstaller\Commands\Help;
use RMS\TailCraftInstaller\Commands\InstallBlock;
use RMS\TailCraftInstaller\Commands\InstallCpt;
use RMS\TailCraftInstaller\Commands\InstallTaxonomy;
use RMS\TailCraftInstaller\Commands\ListCommands;
use RMS\TailCraftInstaller\Commands\Refresh;
use RMS\TailCraftInstaller\Commands\Setup;

class Controller
{
  public function run() : void
  {
    $options = new Options();

    try {
      match (true) {
        $options->help() => (new Help)(),
        $options->setup() => (new Setup)(),
        $options->refresh() => (new Refresh)($options),
        $options->list() => (new ListCommands)($options),
        $options->installBlock() => (new InstallBlock)($options),
        $options->installCpt() => (new InstallCpt)($options),
        $options->installTaxonomy() => (new InstallTaxonomy)($options),
      };
    } catch (\UnhandledMatchError $e) {
      // Default action
      (new Setup)();
    }
  }
}
