<?php

namespace HTPL
{
  use \Exception;
  use \SimpleXMLElement as Stmt;

  require_once "Util.php";
  require_once "StdLib.php";

  class Interpreter
  {
    public static $memory = [
      "native_function" => NULL
    ];

    public static function evaluate(Stmt $ast) {
      Interpreter::$memory["native_function"] = StdLib::getBuiltinInstances();

      foreach ($ast as $value) {
        Interpreter::parseNode($value);
      }
    }

    private static function parseNode($value = null)
    {
      $instruction = $value->getName();

      switch ($instruction) {
        case "print":
          return Interpreter::_print($value);
        default:
          if (Util::isBuiltinFunction($instruction)) {
            return Interpreter::callBuiltin($value);
          }
          throw new Exception("Unrecognized instruction {$instruction}.");
      }
    }

    private static function _print($value)
    {
      if (Util::isNode($value)) {
        Util::checkArity($value, 1);
        return print(Interpreter::parseNode($value->children()[0]));
      } else {
        return print(dom_import_simplexml($value)->textContent);
      }
    }

    private static function callBuiltin($value)
    {
      $name = $value->getName();
      if (array_key_exists($name, Interpreter::$memory["native_function"])) {
        $fn = Interpreter::$memory["native_function"][$name]->getClosure();
        return $fn($value);
      } else {
        throw new Exception("Undefined function {$name}");
      }
    }
  }
}
