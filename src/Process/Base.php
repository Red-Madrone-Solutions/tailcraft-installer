<?php

namespace RMS\TailCraftInstaller\Process;

use function Laravel\Prompts\info;

class Base {
  protected string $command;
  protected array $args;

  public function __construct(
    string $command,
    array $args = []
  ) {
    $this->command = $command;
    $this->args = $args;
  }

  public function __invoke() : ?int
  {
    $descriptors = [
      0 => ['pipe', 'r'], // stdin
      1 => ['pipe', 'w'], // stdout
      2 => ['pipe', 'w'], // stderr
    ];

    $full_command = sprintf('%s %s', $this->command, implode(' ', $this->args));
    $process = proc_open($full_command, $descriptors, $pipes);
    if ( is_resource($process) ) {
      info( stream_get_contents($pipes[1]) );

      fclose($pipes[0]);
      fclose($pipes[1]);
      fclose($pipes[2]);
      return proc_close($process);
    }

    return null;
  }
}
