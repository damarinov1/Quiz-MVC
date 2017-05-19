<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Router::register("index", ["IndexController", "index"]);
Router::register("results", ["IndexController", "getResults"]);
Router::register("destroy", ["IndexController", "destroySession"]);
Router::register("change-mode", ["IndexController", "changeMode"]);

Router::register("single", ["SingleController", "index"]);
Router::register("answer-check-tf", ["SingleController", "checkAnswer"]);

Router::register("multiple", ["MultipleController", "index"]);
Router::register("answer-check-mc", ["MultipleController", "checkAnswer"]);
