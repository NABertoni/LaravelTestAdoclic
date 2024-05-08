<?php

use App\Http\Controllers\ApiDataController;

Route::get('/{category}', [ApiDataController::class, 'getDataByCategory']);

