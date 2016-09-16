<?php

/**
*   Direct Setup
*   Direct::[to, post](url, controller@method)
*/
Direct::get("/test", 'MainController@index');

Direct::get("/", 'MainController@test');
