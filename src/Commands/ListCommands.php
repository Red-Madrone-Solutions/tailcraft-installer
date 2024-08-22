<?php

namespace RMS\TailCraftInstaller\Commands;

use RMS\TailCraftInstaller\Options;

use function Laravel\Prompts\table;

class ListCommands extends Base {
  protected function run(Options $options) : void
  {
    $flags = [
      [ '-h, --help', 'See help text' ],
      [ '-l, --list', 'Get a list of commands' ],
      [ '-s, --setup', 'Setup a new theme' ],
    ];
    if ( $options->verbose() ) {
      $flags = array_merge(
        $flags,
        [
          [ '--target [directory]', 'Target directory to operate in' ],
          [ '--source [directory]', 'Source directory to read from - used for development' ],
          [ '--refresh-libs', 'Refresh TailCraft libs - used for development' ],
        ]
      );
    }
    table(
      headers: [ 'Flag', 'Description' ],
      rows: $flags,
    );
  }
}

