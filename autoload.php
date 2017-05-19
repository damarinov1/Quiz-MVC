<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "app/models/Database.php";
require_once "app/models/AbstractRepository.php";
require_once "app/models/QuestionRepository.php";
require_once "app/models/Question.php";
require_once "app/models/AnswerRepository.php";
require_once "app/models/Answer.php";

require_once 'app/controllers/IndexController.php';
require_once 'app/controllers/SingleController.php';
require_once 'app/controllers/MultipleController.php';

require_once 'app/AnswerCheck.php';
require_once 'app/Router.php';
require_once 'app/Session.php';
require_once 'app/Results.php';
require_once 'app/View.php';
