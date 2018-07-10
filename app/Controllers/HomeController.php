<?php
/**
 * Created by PhpStorm.
 * User: tamat
 * Date: 10.07.18
 * Time: 12:43
 */

namespace App\Controllers;


use App\Controller;

class HomeController extends Controller
{

    public function actionIndex() {
        return $this->view('home', ['title' => 'Search in Google']);
    }
}