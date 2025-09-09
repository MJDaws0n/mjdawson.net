<?php
require dirname(__FILE__) . '/../../vendor/autoload.php';
require dirname(__FILE__) . '/../private/autogate.php';
require dirname(__FILE__) . '/../private/mailqueue.php';

use Net\MJDawson\WebWorks\AutoGate\AutoGate;
use Net\MJDawson\MailQueue\MailQueue;

// Initialize database connection
class Database
{
    public $conn;
    public function __construct()
    {
        $env = $this->loadEnv(dirname(__FILE__) . '/../private/.autogate_env');
        if (!isset($env['DB_HOST'], $env['DB_USER'], $env['DB_PASS'], $env['DB_NAME'])) {
            throw new Exception('Database credentials not found in .env file');
        }
        $this->conn = new \mysqli($env['DB_HOST'], $env['DB_USER'], $env['DB_PASS'], $env['DB_NAME']);
    }

    private function loadEnv($filePath)
    {
        $env = [];

        if (!file_exists($filePath)) {
            throw new Exception('No env file found');
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($key, $value) = explode('=', $line, 2);
            $value = trim($value, '"\' ');
            $env[trim($key)] = $value;
        }

        return $env;
    }
    public function close()
    {
        $this->conn->close();
    }
}
$database = new Database();

// Check connection
if ($database->conn->connect_error) {
    die("Connection failed");
}

$autoGate = new AutoGate($database->conn, dirname(__FILE__) . '/../private/.autogate_env');

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (!isset($_GET['type'])) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid type']);
        return;
    }

    $type = $_GET['type'];

    if ($type === "new") {
        $new = $autoGate->new();
        echo json_encode(['status' => 'success', 'session' => $new['session'], 'resources' => $new['resources'], 'type' => $new['type']]);
    } elseif ($type === "check") {
        if (!isset($_GET['answer']) || !isset($_GET['session'])) {
            echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
            return;
        }
        $check = $autoGate->check($_GET['answer'], $_GET['session']);

        echo json_encode(['status' => 'success', 'human' => $check['human']]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid type']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Get POST data
    $postData = $_POST;
    if (empty($postData['autogate'])) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid autogate token']);
        return;
    }
    // Load autogate
    $autoGate = new AutoGate($database->conn, './resources');

    // Verify token
    if (!$autoGate->isHuman($postData['autogate'])) {
        echo json_encode(['status' => 'error', 'message' => 'Captcha invalid, expired or already used.']);
        return;
    }

    // Load mail env
    $mailEnvPath = dirname(__FILE__) . '/../private/.mail_env';
    $mailEnv = [];
    if (file_exists($mailEnvPath)) {
        $lines = file($mailEnvPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0 || trim($line) === '')
                continue;
            list($key, $value) = explode('=', $line, 2);
            $mailEnv[trim($key)] = trim($value, "'\" ");
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Mail env not found']);
        return;
    }

    $mailApiKey = $mailEnv['MAIL_KEY'] ?? '';
    $mailApiUrl = $mailEnv['MAIL_HOST'] ?? '';
    if (!$mailApiKey || !$mailApiUrl) {
        echo json_encode(['status' => 'error', 'message' => 'Mail env missing params']);
        return;
    }

    // Get user info
    $userEmail = $postData['email'] ?? '';
    $userName = $postData['name'] ?? '';
    $userMessage = $postData['message'] ?? '';
    if (!$userEmail || !$userName || !$userMessage) {
        echo json_encode(['status' => 'error', 'message' => 'Missing contact info']);
        return;
    }

    // Send thank you email to user
    $mail = new MailQueue($mailApiKey, $mailApiUrl);
    $mail->setRecipient($userEmail, $userName);
    $mail->setSubject('Thank you for contacting mjdawson.net');
    $mail->setHtmlContent('<p>Hi ' . htmlspecialchars($userName) . ',</p>' .
        '<p>Thanks for contacting mjdawson.net! I will get back to you in 1-2 business days.</p>' .
        '<p>Here is a copy of your message:</p>' .
        '<blockquote>' . nl2br(htmlspecialchars($userMessage)) . '</blockquote>' .
        '<p>Best regards,<br>Max Dawson</p>');
    $userMailResult = $mail->send();

    // Forward message to contact@mjdawson.net
    $mail2 = new MailQueue($mailApiKey, $mailApiUrl);
    $mail2->setRecipient('contact@mjdawson.net', 'Max Dawson');
    $mail2->setSubject('New Contact Form Submission from ' . $userName);
    $mail2->setHtmlContent('<p>New contact form submission:</p>' .
        '<ul>' .
        '<li><strong>Name:</strong> ' . htmlspecialchars($userName) . '</li>' .
        '<li><strong>Email:</strong> ' . htmlspecialchars($userEmail) . '</li>' .
        '</ul>' .
        '<p><strong>Message:</strong></p>' .
        '<blockquote>' . nl2br(htmlspecialchars($userMessage)) . '</blockquote>' .
        '<p>Extra context: This message was sent via the mjdawson.net contact form.</p>');
    $adminMailResult = $mail2->send();

    echo json_encode([
        'status' => 'success',
        'userMail' => $userMailResult,
        'adminMail' => $adminMailResult
    ]);
}