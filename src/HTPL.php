<?php

namespace HTPL
{
  use \Exception;

  require_once "Parser.php";
  require_once "Interpreter.php";

  class HTPL
  {
    public static function init($argc, $argv)
    {
      if ($argc === 1) {
        echo "No mode selected", PHP_EOL;
        return;
      }

      switch ($argv[1]) {
        case "-c":
          HTPL::parse($argv);
          break;
      }
    }

    public static function parse(array &$argv)
    {
      if (!isset($argv[2])) {
        echo "No input file", PHP_EOL;
        return;
      }

      if (!file_exists($argv[2])) {
        echo "File doesn't exists", PHP_EOL;
        return;
      }

      try {
        $parser = new Parser(file_get_contents($argv[2]));
        $ast = $parser->getAst();
        Interpreter::evaluate($ast);
      } catch (Exception $e) {
        echo $e->getMessage(), PHP_EOL;
        return;
      }
    }
  }
}
