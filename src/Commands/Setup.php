<?php

namespace RMS\TailCraftInstaller\Commands;

use function Laravel\Prompts\text;
use RMS\TailCraftInstaller\Process\Base as Process;
use RMS\TailCraftInstaller\Process\GitClone;

class Setup extends Base {
  protected string $theme_name = '';
  protected string $theme_slug = '';
  protected string $tailcraft_repo = 'Red-Madrone-Solutions/tailcraft';

  protected function run() : void
  {
    // TODO check if in theme folder or in WP install
    $this->getInfo();
    $this->setupTheme();
  }

  protected function setupTheme() : void
  {
    /* $mkdir = new Process('mkdir', $this->theme_slug); */
    $clone = new GitClone($this->tailcraft_repo, $this->theme_slug);
    $clone();
  }

  protected function getInfo() : void
  {
    $this->theme_name = text(
      label: 'What is the name of your theme?',
      hint: 'This will be visible in WordPress admin.',
      required: true,
      validate: fn (string $value) => 
        preg_match('/[^-\w ]/', $value)
          ? 'The theme name must be just letters, numbers, dashes, spaces, or underscores'
          : null
    );

    $suggested_slug = $this->asSlug($this->theme_name);
    $this->theme_slug = text(
      label: 'What is the slug for your theme?',
      hint: 'This will be used for the directory name for your theme.',
      required: true,
      default: $suggested_slug,
      validate: fn (string $value) => 
        preg_match('/[^-\w]/', $value)
          ? 'The theme directory must be just letters, numbers, dash, or underscore'
          : null
    );
  }

  protected function asSlug($text) : string
  {
    $slug = strtolower($text);
    $slug = preg_replace('/\s+/', '-', $slug);
    return $slug;
  }

  protected function asVarName($text) : string
  {
    $var_name = $this->asSlug($text);
    $var_name = str_replace('-', '_', $var_name);
    return $var_name;
  }
}

