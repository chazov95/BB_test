<?php
use App\Services\Route;

Route::make('/client','GET','MainController','show');
Route::make('/addBankRequest','POST','FormController','addBankRequest');
