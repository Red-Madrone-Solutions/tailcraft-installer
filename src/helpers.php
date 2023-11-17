<?php

namespace RMS\TailCraftInstaller;

function info($str) : void
{
  \Laravel\Prompts\info( wordwrap($str, 76, "\n", true) );
}
