<?php

namespace HTPL {
  use \Exception;

  class Util {
    static $fn = ["upper", "lower"];

    public static function isNode($object) {
      return $object->count() > 0;
    }

    public static function checkArity($object, $arity) {
      if (!($object->count() === $arity)) {
        throw new Exception("Arity error on {$object->getName()}");
      }
    }

    public static function isBuiltinFunction($name) {
      return in_array($name, Util::$fn);
    }
  }
}
