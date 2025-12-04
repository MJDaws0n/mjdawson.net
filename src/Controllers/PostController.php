<?php

namespace App\Controllers;

use App\Core\Database;

class PostController
{
    public function index()
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT * FROM posts ORDER BY created_at DESC");
        $posts = $stmt->fetchAll();

        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'data' => $posts]);
    }

    public function store()
    {
        // Basic security check - in a real app this would be authenticated
        // For now, we just assume it's protected or not in use as requested
        
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['title']) || !isset($input['content'])) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Missing title or content']);
            return;
        }

        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO posts (title, content) VALUES (:title, :content)");
        $stmt->execute([
            ':title' => $input['title'],
            ':content' => $input['content']
        ]);

        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'Post created']);
    }
}
