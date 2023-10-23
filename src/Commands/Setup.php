<?php

namespace RMS\TailCraftInstaller\Commands;

use function Laravel\Prompts\text;

class Setup extends Base {
  protected function run() : void
  {
    $theme_name = text(
      label: 'What is the name of your theme?',
      required: true,
      validate: fn (string $value) => 
        preg_match('/[^-\w]/', $value)
          ? 'The theme name must be just letters, numbers, dash, or underscore'
          : null
    );
  }
}

