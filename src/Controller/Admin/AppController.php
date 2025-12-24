<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use Cake\Core\Configure;
use JeffAdmin5\Controller\AppController as JeffAdmin5;

class AppController extends JeffAdmin5
{
    public function initialize(): void
    {
        parent::initialize();

        //$this->loadComponent('Flash');

        //$this->loadComponent('FormProtection');
    }
}
