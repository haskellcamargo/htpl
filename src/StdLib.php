<?php

namespace HTPL
{
  require_once "functions/Upper.php";
  use \HTPL\Functions as F;

  class StdLib
  {
    public static function getBuiltinInstances()
    {
      return [
        "upper" => F\upper()
      ];
    }
  }
}
