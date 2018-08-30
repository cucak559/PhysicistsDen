<?php

namespace App\Inspections;

class Spam {

      protected $inspections = [
            InvalidKeywords::class ,
            KeyHeldDown::class
      ];


      public function detect($attribute = [])
      {
            foreach ($this->inspections as $inspection)
            {
                  app($inspection)->detect($attribute);
            }

            return false;
      }
}