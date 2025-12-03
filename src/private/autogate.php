<?php
namespace Net\MJDawson\WebWorks\AutoGate;
use Exception;

if (!(extension_loaded('gd') && function_exists('gd_info'))) {
    echo "GD is not enabled.";
}

class AutoGate{
    private $conn;
    private $resources;

    public function __construct($conn, $resources){
        $tableExists = $conn->query("SHOW TABLES LIKE 'AutoGate'");

        $this->resources = $resources;

        if ($tableExists->num_rows == 0) {
            $this->createAutoGateTable($conn);
        }
        $this->conn = $conn;

        // Remove sessions older than 2 minutes
        $deleteOldSessionsStmt = $conn->prepare("DELETE FROM AutoGate WHERE created_at < NOW() - INTERVAL 2 MINUTE");
        $deleteOldSessionsStmt->execute();
        $deleteOldSessionsStmt->close();
    }
    private function createAutoGateTable($conn) {
        $sql = "CREATE TABLE AutoGate (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            type VARCHAR(50) NOT NULL,
            answer VARCHAR(255) NOT NULL,
            session VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        if ($conn->query($sql) !== TRUE) {
            throw new Exception("Error creating table: " . $conn->error);
        }
    }
    private function uploadResult($type, $answer, $session) {
        $stmt = $this->conn->prepare("INSERT INTO AutoGate (type, answer, session) VALUES (?, ?, ?)");
        
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $this->conn->error);
        }
        
        $stmt->bind_param("sss", $type, $answer, $session);
        
        if (!$stmt->execute()) {
            throw new Exception("Error executing statement: " . $stmt->error);
        }
        
        $stmt->close();
    }
    public function check($answer, $session){
        // Retrieve the stored answer from the database
        $stmt = $this->conn->prepare("SELECT answer, type FROM AutoGate WHERE session = ?");
        $stmt->bind_param("s", $session);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            echo json_encode(['status' => 'error', 'message' => 'Session not found']);
            return;
        }

        $storedAnswer = '';
        $type = null;

        $stmt->bind_result($storedAnswer, $type);
        $stmt->fetch();
        $stmt->close();

        if($type === null){
            throw new Exception('Type not set correctly');
        }

        // Check type
        if($type == 'photo_1'){
            // Parse the answers
            list($storedX, $storedY) = explode('_', $storedAnswer);
            list($userX, $userY) = explode('_', $answer);

            // Check if the user answer is within the acceptable range
            $range = 4;
            if (abs($storedX - $userX) <= $range && abs($storedY - $userY) <= $range) {
                // Update record
                $updateStmt = $this->conn->prepare("UPDATE AutoGate SET type = 'resolved' WHERE session = ?");
                $updateStmt->bind_param("s", $session);
                $updateStmt->execute();
                $updateStmt->close();

                return ['human' => true];
            } else {
                // Delete record
                $deleteStmt = $this->conn->prepare("DELETE FROM AutoGate WHERE session = ?");
                $deleteStmt->bind_param("s", $session);
                $deleteStmt->execute();
                $deleteStmt->close();

                // Verification failed
                return ['human' => false];
            }
        }
        if($type == 'photo_2'){
            // Parse the answers
            list($storedX, $storedY) = explode('_', $storedAnswer);
            list($userX, $userY) = explode('_', $answer);

            // Check if the user answer is within the acceptable range
            $range = 25;
            if (abs($storedX - $userX) <= $range && abs($storedY - $userY) <= $range) {
                // Update record
                $updateStmt = $this->conn->prepare("UPDATE AutoGate SET type = 'resolved' WHERE session = ?");
                $updateStmt->bind_param("s", $session);
                $updateStmt->execute();
                $updateStmt->close();

                return ['human' => true];
            } else {
                // Delete record
                $deleteStmt = $this->conn->prepare("DELETE FROM AutoGate WHERE session = ?");
                $deleteStmt->bind_param("s", $session);
                $deleteStmt->execute();
                $deleteStmt->close();

                // Verification failed
                return ['human' => false];
            }
        }
        if($type == 'word_1'){
            if (strtolower($answer) == strtolower($storedAnswer)) {
                // Update record
                $updateStmt = $this->conn->prepare("UPDATE AutoGate SET type = 'resolved' WHERE session = ?");
                $updateStmt->bind_param("s", $session);
                $updateStmt->execute();
                $updateStmt->close();

                return ['human' => true];
            } else {
                // Delete record
                $deleteStmt = $this->conn->prepare("DELETE FROM AutoGate WHERE session = ?");
                $deleteStmt->bind_param("s", $session);
                $deleteStmt->execute();
                $deleteStmt->close();

                // Verification failed
                return ['human' => false];
            }
        }

        return ['human' => false];
    }
    public function new(){
        $type = $this->generateType();


        $resources = null;
        $answer = null;

        if ($type == 'photo_1') {
            // Fetch the image content
            $imageUrl = 'https://picsum.photos/500/500';
            $imageContent = file_get_contents($imageUrl);
        
            if ($imageContent === false) {
                die('Failed to download image');
            }
        
            // Create the main image from the downloaded content
            $sourceImg = imagecreatefromstring($imageContent);
            if (!$sourceImg) {
                die('Failed to create image from content');
            }
        
            $width = imagesx($sourceImg);
            $height = imagesy($sourceImg);
        
            // Generate random coordinates for the circle placement
            $x = rand(0, $width - 100);
            $y = rand(0, $height - 100);
        
            // Create a true color image to hold the cropped area behind the circle
            $behindCircleImg = imagecreatetruecolor(100, 100);
            imagecopy($behindCircleImg, $sourceImg, 0, 0, $x, $y, 100, 100);
        
            // Draw the circle directly on the main image
            $circleColor = imagecolorallocatealpha($sourceImg, 255, 255, 255, 0);
        
            // Draw a filled circle
            imagefilledellipse($sourceImg, $x + 47, $y + 47, 95, 95, $circleColor);
        
            // Encode images to data URLs
            ob_start();
            imagepng($behindCircleImg);
            $dataURLBehindCircle = 'data:image/png;base64,' . base64_encode(ob_get_clean());
        
            ob_start();
            imagepng($sourceImg);
            $dataURLFinal = 'data:image/png;base64,' . base64_encode(ob_get_clean());
        
            // Clean up resources
            imagedestroy($behindCircleImg);
            imagedestroy($sourceImg);
        
            $answer = $x . '_' . $y;
            $resources = ['cutout' => $dataURLBehindCircle, 'image' => $dataURLFinal];
        }
        if($type == 'photo_2'){
            $shapesDir = $this->resources . DIRECTORY_SEPARATOR . 'shapes';
            $shapes = ['square', 'triangle', 'circle'];
            shuffle($shapes);
            $imageWidth = 500;
            $imageHeight = 500;
        
            // Create a blank image
            $image = imagecreatetruecolor($imageWidth, $imageHeight);
            $bgColor = imagecolorallocate($image, 255, 255, 255);
            imagefill($image, 0, 0, $bgColor);
        
            // Draw random noise
            for ($i = 0; $i < 100000; $i++) {
                $color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
                imagesetpixel($image, rand(0, $imageWidth), rand(0, $imageHeight), $color);
            }
        
            // Store positions of already placed shapes
            $occupiedPositions = [];

            $shapeName = null;
        
            // Add random shapes
            for ($i = 0; $i < 3; $i++) {
                $shape = $shapes[$i];
                $randomSize = rand(50, 80);
                
                // Try to find a non-overlapping position
                $placed = false;
                while (!$placed) {
                    $randomX = rand(0, $imageWidth - $randomSize);
                    $randomY = rand(0, $imageHeight - $randomSize);
        
                    // Check for overlap
                    $overlap = false;
                    foreach ($occupiedPositions as [$x, $y, $size]) {
                        if (
                            $randomX < $x + $size && $randomX + $randomSize > $x &&
                            $randomY < $y + $size && $randomY + $randomSize > $y
                        ) {
                            $overlap = true;
                            break;
                        }
                    }
        
                    if (!$overlap) {
                        $occupiedPositions[] = [$randomX, $randomY, $randomSize];
                        $placed = true;
        
                        $shapeFile = $shapesDir . DIRECTORY_SEPARATOR . $shape . DIRECTORY_SEPARATOR . rand(1, 6) . '.webp';
                        if (file_exists($shapeFile)) {
                            // This is the second option, so now we need to store it's position as the x and y
                            if($i == 1){
                                $centerX = $randomX;
                                $centerY = $randomY;
                                $answer = $centerX . '_' . $centerY;
                                $shapeName = $shape;
                            }
                            $shapeImage = imagecreatefromwebp($shapeFile);
                            imagecopyresampled($image, $shapeImage, $randomX, $randomY, 0, 0, $randomSize, $randomSize, imagesx($shapeImage), imagesy($shapeImage));
                        }
                    }
                }
            }
            
        
            // More noise
            for ($i = 0; $i < 50000; $i++) {
                $color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
                imagesetpixel($image, rand(0, $imageWidth), rand(0, $imageHeight), $color);
            }
        
            // Output the image as base64
            ob_start();
            imagepng($image);
            $imageData = ob_get_contents();
            ob_end_clean();
        
            imagedestroy($image);
        
            $resources = ['shape' => $shapeName, 'image' => 'data:image/png;base64,' . base64_encode($imageData)];
        }
        if($type == 'word_1'){
            function generate_captcha_text($length = 6) {
                return substr(str_shuffle("QWERTYUIOPASDFGHJKLZXCVBNM"), 0, $length);
            }
        
            $text = generate_captcha_text();
        
            // Create an image
            $width = 200;
            $height = 70;
            $image = imagecreatetruecolor($width, $height);
        
            // Colors
            $bg_color = imagecolorallocate($image, 255, 255, 255);
            $text_color = imagecolorallocate($image, 0, 0, 0);
        
            // Fill the background
            imagefilledrectangle($image, 0, 0, $width, $height, $bg_color);
        
            // Add random noise
            $noise = 200;
            for ($i = 0; $i < $noise; $i++) {
                imagesetpixel($image, rand(0, $width), rand(0, $height), $text_color);
            }
            // Add more
            $noise = 200;
            for ($i = 0; $i < $noise; $i++) {
                imagesetpixel($image, rand(0, $width), rand(0, $height), imagecolorallocate($image, 255, 0, 0));
            }
            // Even more
            $noise = 200;
            for ($i = 0; $i < $noise; $i++) {
                imagesetpixel($image, rand(0, $width), rand(0, $height), imagecolorallocate($image, 0, 0, 255));
            }
            // And EVEN more
            $noise = 200;
            for ($i = 0; $i < $noise; $i++) {
                imagesetpixel($image, rand(0, $width), rand(0, $height), imagecolorallocate($image, 0, 255, 0));
            }
        
            // Array of font paths
            $fonts = [
                'Fitamint Script.ttf',
                'Deafening Silence.ttf',
                'Nervous.ttf',
                'Killing Loneliness.ttf',
                'mouthbrebb.ttf'
            ];
            $path = $this->resources . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR;

            $fonts = array_map(function($font) use ($path) {
                return $path . $font;
            }, $fonts);
        
            // Initial x position for text
            $x = 10;
        
            // Loop through each character in the text
            for ($i = 0; $i < strlen($text); $i++) {
                // Randomly select a font
                $font = $fonts[array_rand($fonts)];
                
                // Make font size random
                $font_size = rand(20, 30);
                $y = rand(40, 60);
        
                // Draw the letter with the selected font
                imagettftext($image, $font_size, 0, $x, $y, $text_color, $font, $text[$i]);
                
                // Increment x position for the next character
                $x += $font_size;
            }
            // Add more noise after the text
            $noise = 300;
            for ($i = 0; $i < $noise; $i++) {
                imagesetpixel($image, rand(0, $width), rand(0, $height), $text_color);
            }
            // Add more
            $noise = 300;
            for ($i = 0; $i < $noise; $i++) {
                imagesetpixel($image, rand(0, $width), rand(0, $height), imagecolorallocate($image, 255, 0, 0));
            }
            // Even more
            $noise = 300;
            for ($i = 0; $i < $noise; $i++) {
                imagesetpixel($image, rand(0, $width), rand(0, $height), imagecolorallocate($image, 0, 0, 255));
            }
            // And EVEN more
            $noise = 300;
            for ($i = 0; $i < $noise; $i++) {
                imagesetpixel($image, rand(0, $width), rand(0, $height), imagecolorallocate($image, 0, 255, 0));
            }
            ob_start();
            
            imagepng($image);
            $imageData = ob_get_contents();
        
            ob_end_clean();
            $base64 = 'data:image/png;base64,'.base64_encode($imageData);
            imagedestroy($image);

        
            $answer = $text;
            $resources = ['image' => $base64];
        }

        // Future me answer is missing from photo_2

        if($resources === null || $answer === null){
            throw new Exception('An error occurred. Answer and / or resources are not set properly');
        }

        // Create the session
        $session = bin2hex(random_bytes(16 / 2));

        // Upload to database
        $this->uploadResult($type, $answer, $session);

        return ['session' => $session, 'resources' => $resources, 'type'=> $type];
    }
    public function isHuman($session){
        // Check the record
        $checkStmt = $this->conn->prepare("SELECT 1 FROM AutoGate WHERE session = ? AND `type` = 'resolved'");
        $checkStmt->bind_param("s", $session);
        $checkStmt->execute();
        $checkStmt->store_result();
        $isResolved = $checkStmt->num_rows > 0;
        $checkStmt->close();

        // Delete the record to only allow the check once
        $deleteStmt = $this->conn->prepare("DELETE FROM AutoGate WHERE session = ?");
        $deleteStmt->bind_param("s", $session);
        $deleteStmt->execute();
        $deleteStmt->close();        
        
        return $isResolved;
    }
    private function generateType(){
        $options = [
            'photo_1',
            // 'photo_2',
            // 'word_1'
        ];
        
        // Select a random option
        $randomKey = array_rand($options);
        $randomChoice = $options[$randomKey];
        
        // Output the random choice
        return $randomChoice;
    }
}