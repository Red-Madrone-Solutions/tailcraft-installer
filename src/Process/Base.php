<?php

namespace RMS\TailCraftInstaller\Process;

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
      0 => ['pipe', 'r'],
      1 => ['pipe', 'w'],
      2 => ['pipe', 'w'],
    ];

    $full_command = sprintf('%s %s', $this->command, implode(' ', $this->args));
    $process = proc_open($full_command, $descriptors, $pipes);
    if ( is_resource($process) ) {
      fclose($pipes[0]);
      fclose($pipes[1]);
      fclose($pipes[2]);
      return proc_close($process);
    }

    return null;
  }
}
