<?php

function backend_view($file) {
    return call_user_func_array( 'view', ['backend/' . $file] + func_get_args() );
}

function backend_path($uri='') {
    return public_path( 'backend/' . $uri );
}

function backend_asset($uri='') {
    return asset( 'public/backend/' . ltrim($uri,'/') );
}
function frontend_asset($uri='') {
    return asset( 'public/frontend/' . ltrim($uri,'/') );
}
function frontend_view($file) {
    
    return call_user_func_array( 'view', ['frontend/' . $file] + func_get_args() );
}
function backend_url($uri='/') {
    return call_user_func_array( 'url', ['backend/' . ltrim($uri,'/')] + func_get_args() );
}
function frontend_url($uri='/') {
    return call_user_func_array( 'url', ['/' . ltrim($uri,'/')] + func_get_args() );
}

function constants($key) {
    return config( 'constants.' . $key );
}