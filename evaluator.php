<?php

namespace HTPL
{
  require_once "./src/HTPL.php";
  $argv = [__FILE__, "-c", "./examples/hello_world.htpl"];

  HTPL::init(sizeof($argv), $argv);
}
