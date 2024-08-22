<?php

namespace RMS\TailCraftInstaller\Commands;

use RMS\TailCraftInstaller\Options;
use RMS\TailCraftInstaller\Process\Rsync;

use function Laravel\Prompts\info;

class Refresh extends Base
{
  protected function run(Options $options) : void
  {
    $base_source_dir = $options->source();
    $base_target_dir = $options->target();

    $source_dir = $base_source_dir . '/src-php/';
    info('source_dir: ' . $source_dir);

    $target_dir = $base_target_dir . '/src-php/';
    info('target_dir: ' . $target_dir);

    $rsync = new Rsync($source_dir, $target_dir);
    $rsync();
  }
}
