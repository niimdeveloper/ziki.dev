<?php

namespace Ziki\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ZikiUserBundle extends Bundle
{
      public function getParent(){
          return 'FOSUserBundle';
      }
}
