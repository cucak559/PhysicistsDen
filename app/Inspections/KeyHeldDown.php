<?php


namespace App\Inspections;


class KeyHeldDown {
      public function detect($attribute)
      {
            if (preg_match('/(.)\\1{4,}/' , $attribute))
            {
                  throw new \Exception('Your reply contains spam');
            };
      }
}