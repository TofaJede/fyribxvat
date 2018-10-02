<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 01.10.18
 * Time: 18:45
 */

namespace MyMath;
class math
{
    private $mathPattern = "/(?:\-?\d+(?:\.?\d+)?[\+\-\*\/])+\-?\d+(?:\.?\d+)?/";
    private $bracketsPattern = "/\(([^\(\)]+)\)/";
    // private $temp               = NULL;
    // ????
    private $equation = NULL;
    private $onHold;
    private $number;
    public $clip = array("a");

    public function calculateOld($input)
    {
        // check if there is any math operation
        // '/' or ':' ?
        if (strpos($input, '+') != NULL ||
            strpos($input, '-') != NULL ||
            strpos($input, '*') != NULL ||
            strpos($input, '/') != NULL) {
            // Just to be sure (or i get only integer? Should get only integer?)
            $input = str_replace(',', '.', $input);
            // First you calculate whats in brackets
            while (strpos($input, '(') ||
                strpos($input, ')')) {
                // TODO: I will need this to be recursive
                $input = preg_replace_callback($this->bracketsPattern, 'self::callback', $input);

            }
            //  Calculate the result
            if (preg_match($this->mathPattern, $input, $match)) {
                return $this->computeOld($match[0]);
            }
            // To handle the special case of expressions surrounded by global parenthesis like "(1+1)"
            if (is_numeric($input)) {
                return $input;
            }

            return 0;
        }

        return $input;

    }

    private function callback($input)
    {
        if (is_numeric($input[1])) {
            return $input[1];
        } elseif (preg_match($this->mathPattern, $input[1], $match)) {
            // $v =  function($match){ return 0 + $match[0];};
            // var_dump($v); die();
            return $this->computeOld($match[0]);
        }
        return false;
    }

    private function computeOld($input)
    {
        // This is cheat:
        // $compute = create_function("", "return (" . $input . ");");
        // Another cheat:
        $compute = eval('return ' . $input . ';');
        return 0 + $compute;
    }


    public function calculate($input)
    {
        // TODO: Find first ')'
        // TODO: Find '(' to it
        // TODO: Cut it from origin
        // TODO: Parse numbers and digits
        // TODO: Add to stack and repeat...
        // TODO: Calculate the stack

        // Lets find if there are brackets
        if (preg_match($this->bracketsPattern, $input)) {
            $input = str_replace($this->getSubequation($input), '', $input);
        }
        $this->compute($input);
        // Nevim jak to udelat
        return $input;
    }

    private function getSubequation($input)
    {
        $endPosition    = strpos($input, ')');
        $startPosition  = strpos($input, '(');
        $length         = $endPosition - $startPosition;
        $input          = substr($input, $startPosition + 1, $length - 1);

        if (preg_match($this->bracketsPattern, $input)) {
            $input = str_replace($this->getSubequation($input), '', $input);
        }
        $this->compute($input);
        return '('.$input.')';
    }

    private function compute($input)
    {
        $input = explode(' ', $input);
        $i = 1;
        foreach ($input as $char) {
            switch ($char) {
                case '+':
                    $this->onHold = $char;
                    break;

                case '-':
                    $this->onHold = $char;
                    break;

                case '/':
                    $this->onHold = $char;
                    break;

                case '*':
                    $this->onHold = $char;
                    break;

                default:
                    if($char == ' '){
                        break;
                    }
                    $float = (float)$char;
                        $this->number[$i] = $float;
                        if ($i == 2) {
                            $this->clip[] = $this->onHold;
                            $this->clip[] = $this->number[1];
                            $this->clip[] = $this->number[2];
                            unset($this->onHold);
                            unset($this->number);
                            $i = 0;
                        }

                        $i++;

                    break;

            }
        }
    }

}