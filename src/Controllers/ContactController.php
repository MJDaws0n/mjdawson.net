<?php

namespace App\Controllers;

class ContactController
{
    public function submit()
    {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => 'Please contact via email, form isn\'t working at the moment'
        ]);
    }
}
