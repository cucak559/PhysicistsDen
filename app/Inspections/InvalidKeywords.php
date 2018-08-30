<?php


namespace App\Inspections;


class InvalidKeywords {
      protected $keywords = [
            'yahoo customer support'
      ];

      public function detect($attribute)
      {
            foreach ($this->keywords as $keyword)
            {

                  if (stripos($attribute , $keyword) !== false)
                  {
                        throw new \Exception('Your reply contains spam');
                  }

            }
      }
}