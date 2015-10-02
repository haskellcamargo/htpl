<?php

namespace HTPL {
  use \Exception;
  use \SimpleXMLElement as Ast;

  class Interpreter {
    public static function evaluate(Ast $ast) {
      var_dump($ast);
    }
  }
}
