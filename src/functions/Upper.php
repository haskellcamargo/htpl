<?php

namespace HTPL\Functions
{
  require_once "src/Interpreter.php";
  require_once "src/Util.php";
  require_once "src/HTPLFunction.php";

  use \HTPL\Interpreter  as I;
  use \HTPL\Util         as U;
  use \HTPL\HTPLFunction as F;

  function upper()
  {
    return new F("upper", 1, function($node) {
      return strtoupper(
        U::isNode($node)
          ? I::parseNode($node)->children()[0]
          : dom_import_simplexml($node)->textContent
      );
    });
  }
}
