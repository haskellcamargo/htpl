<?php

namespace HTPL {
  use \Exception;
  use \ReflectionFunction;

  class HTPLFunction {
    private $arity;
    private $name;
    private $closure;

    public function __construct($name, $arity = NULL, $fn)
    {
      $required = (new ReflectionFunction($fn))->getNumberOfRequiredParameters();
      if ($arity !== NULL && $required !== $arity) {
        throw new Exception("Out of arity function: [{$name}]");
      }
      list ($this->name, $this->arity, $this->closure) = [$name, $arity, $fn];
    }

    public function getArity()
    {
      return $this->arity;
    }

    public function getName()
    {
      return $this->name;
    }

    public function getClosure()
    {
      return $this->closure;
    }

    public function __invoke()
    {
      return call_user_func_array($this->closure, func_get_args());
    }
  }
}
