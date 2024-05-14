<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        echo "Hola mundo";
        return view('welcome_message');
    }

    public function index2()
    {
        echo json_encode($data['data'] = [
            'key1' => "value1",
            'key2' => "value2",
            'key3' => "value3"
        ]);
    }

    public function update($id, $otro=5)
    {
        echo $id . "" . $otro;
    }
}
