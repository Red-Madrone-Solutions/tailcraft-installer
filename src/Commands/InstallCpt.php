<?php

namespace RMS\TailCraftInstaller\Commands;

use RMS\TailCraftInstaller\Options;
use RMS\TailCraftInstaller\Process\Rsync;

use function Laravel\Prompts\error;
use function Laravel\Prompts\info;
use function Laravel\Prompts\warning;

class InstallCpt extends Base
{
  protected function run(Options $options) : void
  {
    $base_source_dir = $options->source();
    $base_target_dir = $options->target();

    $cpt = $options->cpt();

    $source_dir = $base_source_dir . '/cpts/' . $cpt . '/';
    info('source_dir: ' . $source_dir);
    $source_file = $source_dir . $cpt . '.php';
    info('source_file: ' . $source_file);

    if ( !is_dir($source_dir) || !is_file($source_file) ) {
      error( 
        sprintf(
          'Cannot find cpt (%s) in source (%s)',
          $cpt,
          $base_source_dir
        )
      );
      return;
    }

    $target_cpts_dir = $base_target_dir . '/cpts';
    /* $target_dir = $target_cpts_dir . '/' . $cpt . '/'; */
    /* info('target_dir: ' . $target_dir); */
    $target_file = $target_cpts_dir . '/' . $cpt . '.php';
    info('target_file: ' . $target_file);

    if ( is_file($target_file) ) {
      if ( !$options->force() ) {
        error(
          sprintf(
            'Cpt (%s) already exists. You must use `--force` option to overwrite it.',
            $cpt
          )
        );
        return;
      }

      warning(
        sprintf(
          'Cpt (%s) already exists. Overwriting it due to use of `--force` flag',
          $cpt
        )
      );
    }

    if ( !is_dir($target_cpts_dir) ) {
      mkdir($target_cpts_dir);
    }

    // TODO handle namespace on taxonomies in CPT PHP file
    copy($source_file, $target_file);

    $cpt_acf_dir = $source_dir . '/acf-json/';
    if ( is_dir($cpt_acf_dir) ) {
      $target_acf_dir = $base_target_dir . '/acf-json/';

      if ( !is_dir($target_acf_dir) ) {
        mkdir($target_acf_dir);
      }

      // TODO use copy instead of rsync
      $rsync = new Rsync(
        source: $cpt_acf_dir,
        destination: $target_acf_dir,
      );
      $rsync();
    }

    $cpt_template_parts_dir = $source_dir . '/template-parts/';
    if ( is_dir($cpt_template_parts_dir) ) {
      $target_template_parts_dir = $base_target_dir . '/template-parts/';

      if ( !is_dir($target_template_parts_dir) ) {
        mkdir($target_template_parts_dir);
      }

      $rsync = new Rsync(
        source: $cpt_template_parts_dir,
        destination: $target_template_parts_dir
      );
      $rsync();
    }
  }
}
