<?php

namespace HTPL {
  use \Exception;
  use \SimpleXMLElement as Stmt;

  require_once "Util.php";

  class Interpreter {
    public static function evaluate(Stmt $ast) {
      foreach ($ast as $value) {
        Interpreter::parseNode($value);
      }
    }

    private static function parseNode($value = null) {
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

    private static function _print($value) {
      if (Util::isNode($value)) {
        Util::checkArity($value, 1);
        $result = Interpreter::parseNode($value->children()[0]);

        var_dump($result);
        return print($result);
      } else {
        return print(dom_import_simplexml($value)->textContent);
      }
    }

    private static function callBuiltin($value) {
      if ($value->getName() === "upper") {
        if (Util::isNode($value)) {
          Util::checkArity($value, 1);
          return strtoupper(Interpreter::parseNode($value->children()[0]));
        } else {
          return strtoupper(dom_import_simplexml($value)->textContent);
        }
      }
    }
  }
}
