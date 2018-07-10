<?php
/**
 * Created by PhpStorm.
 * User: tamat
 * Date: 10.07.18
 * Time: 15:26
 */

namespace App\Controllers;


use App\Controller;

class NotFoundController extends Controller
{

    public function actionIndex()
    {
        return $this->view('404', ['title' => 'Not found']);
    }

}