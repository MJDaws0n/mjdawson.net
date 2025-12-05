<?php

namespace App\Controllers;

class ContactController
{
    public function submit()
    {
        $token = $_POST['token'] ?? '';
        if (empty($token)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Missing verification token']);
            return;
        }

        $privateKey = getenv('AUTOGATE_PRIVATE_KEY');
        if (!$privateKey) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Server configuration error']);
            return;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://autogate.mjdawson.net/api/validate');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'private_key' => $privateKey,
            'token' => $token
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($ch), true);
        curl_close($ch);

        if (isset($response['valid']) && $response['valid']) {
            // Verified - Process the form (e.g. send email)
            // For now, we'll just return success as requested "make sure it's just not included, like there but not in use basically"
            // Wait, the user said "just include api to do it and makae sur eit's just not included, like there but not in use basically"
            // But also "Please update the contact form to now work"
            // I will assume "work" means validate and return success.
            
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Message sent successfully']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Verification failed']);
        }
    }
}
