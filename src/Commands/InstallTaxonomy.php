<?php

namespace RMS\TailCraftInstaller\Commands;

use RMS\TailCraftInstaller\Options;
use RMS\TailCraftInstaller\Process\Rsync;

use function Laravel\Prompts\error;
use function Laravel\Prompts\info;
use function Laravel\Prompts\warning;

class InstallTaxonomy extends Base
{
  protected function run(Options $options) : void
  {
    $base_source_dir = $options->source();
    $base_target_dir = $options->target();

    $taxonomy = $options->taxonomy();

    $source_dir = $base_source_dir . '/taxonomies/' . $taxonomy . '/';
    info('source_dir: ' . $source_dir);
    $source_file = $source_dir . $taxonomy . '.php';
    info('source_file: ' . $source_file);

    if ( !is_dir($source_dir) || !is_file($source_file) ) {
      error( 
        sprintf(
          'Cannot find taxonomy (%s) in source (%s)',
          $taxonomy,
          $base_source_dir
        )
      );
      return;
    }

    $target_taxonomys_dir = $base_target_dir . '/taxonomies';
    $target_file = $target_taxonomys_dir . '/' . $taxonomy . '.php';
    info('target_file: ' . $target_file);

    if ( is_file($target_file) ) {
      if ( !$options->force() ) {
        error(
          sprintf(
            'Taxonomy (%s) already exists. You must use `--force` option to overwrite it.',
            $taxonomy
          )
        );
        return;
      }

      warning(
        sprintf(
          'Taxonomy (%s) already exists. Overwriting it due to use of `--force` flag',
          $taxonomy
        )
      );
    }

    if ( !is_dir($target_taxonomys_dir) ) {
      mkdir($target_taxonomys_dir);
    }

    // TODO handle namespace to match theme
    copy($source_file, $target_file);
  }
}

