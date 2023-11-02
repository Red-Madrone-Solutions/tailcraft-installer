<?php

namespace RMS\TailCraftInstaller\Util;


class TextReplace {
  protected string $find;
  protected string $replace;

  public function __construct(
    string $find,
    string $replace
  ) {
    $this->find = $find;
    $this->replace = $replace;
  }

  public function __invoke( array $paths ) : void {
    foreach ($paths as $path) {
      file_put_contents(
        $path,
        str_replace(
          $this->find,
          $this->replace,
          file_get_contents($path)
        )
      );
    }
  }
}
