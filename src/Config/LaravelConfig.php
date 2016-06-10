<?php

namespace Vynyl\Campaigner\Config;

class LaravelConfig implements Config
{
    public function getBaseUrl()
    {
        return \Illuminate\Support\Facades\Config::get('campaigner.api_url');
    }

    public function getApiKey()
    {

    }
}
