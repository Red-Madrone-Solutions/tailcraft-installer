<?php

namespace RMS\TailCraftInstaller\Commands;

use function Laravel\Prompts\text;
use function RMS\TailCraftInstaller\info;

use RMS\TailCraftInstaller\Process\GitClone;
use RMS\TailCraftInstaller\Util\TextReplace;

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
    $clone->cleanup();
    $this->personalizeTheme();
    $this->nextSteps();
  }

  protected function nextSteps() : void
  {
    info('Please run `composer install` and `npm install` and `npm run dev` in your new theme directory: ' . $this->theme_slug);
  }

  protected function personalizeTheme() : void
  {
    $var_replacer = new TextReplace('tailcraft_', $this->asVarName($this->theme_slug) . '_');
    $var_replacer([
      $this->asPath('functions.php'),
      $this->asPath('header.php'),
      $this->asPath('footer.php'),
      $this->asPath('template-parts/content.php'),
    ]);

    $slug_replacer = new TextReplace('tailcraft', $this->theme_slug);
    $slug_replacer([
      $this->asPath('style.css'),
      $this->asPath('template-parts/content.php'),
    ]);

    $name_replacer = new TextReplace('TailCraft Theme', $this->theme_name);
    $name_replacer([
      $this->asPath('style.css'),
    ]);
  }

  protected function asPath(string $file) : string
  {
    // TODO Handle Windows filesystem
    return $this->theme_slug . '/' . $file;
  }

  protected function getInfo() : void
  {
    $this->theme_name = text(
      label: 'What is the name of your theme?',
      hint: 'This will be visible in WordPress admin.',
      required: true,
      validate: fn (string $value) => 
        preg_match('/[^.-\w ]/', $value)
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
    $slug = preg_replace('/[.\s]+/', '-', $slug);
    return $slug;
  }

  protected function asVarName($text) : string
  {
    $var_name = $this->asSlug($text);
    $var_name = str_replace('-', '_', $var_name);
    return $var_name;
  }
}

