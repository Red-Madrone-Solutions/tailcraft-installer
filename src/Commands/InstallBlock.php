<?php

namespace RMS\TailCraftInstaller\Commands;

use RMS\TailCraftInstaller\Options;
use RMS\TailCraftInstaller\Process\Rsync;

use function Laravel\Prompts\error;
use function Laravel\Prompts\info;
use function Laravel\Prompts\warning;

class InstallBlock extends Base
{
  protected function run(Options $options) : void
  {
    $base_source_dir = $options->source();
    $base_target_dir = $options->target();

    $block = $options->block();

    $source_dir = $base_source_dir . '/blocks/' . $block . '/';
    info('source_dir: ' . $source_dir);

    if ( !is_dir($source_dir) ) {
      error( 
        sprintf(
          'Cannot find block (%s) in source (%s)',
          $block,
          $base_source_dir
        )
      );
      return;
    }

    $target_blocks_dir = $base_target_dir . '/blocks';
    $target_dir = $target_blocks_dir . '/' . $block . '/';
    info('target_dir: ' . $target_dir);

    if ( is_dir($target_dir) ) {
      if ( !$options->force() ) {
        error(
          sprintf(
            'Block (%s) already exists. You must use `--force` option to overwrite it.',
            $block
          )
        );
        return;
      }

      warning(
        sprintf(
          'Block (%s) already exists. Overwriting it due to use of `--force` flag',
          $block
        )
      );
    }

    if ( !is_dir($target_blocks_dir) ) {
      mkdir($target_blocks_dir);
    }

    if ( !is_dir($target_dir) ) {
      mkdir($target_dir);
    }

    $rsync = new Rsync($source_dir, $target_dir);
    $rsync();
  }
}
