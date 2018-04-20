<?php

require_once 'src/models/Post.php';

class PostController
{
    public function index()
    {
        $posts = Post::getAll();

        include 'src/view/post/index.php';
    }

    public function create()
    {
        include 'src/view/post/create.php';
    }

    public function store()
    {
        if (!isset($_POST['title']) || empty($_POST['title'])) {
            throw new \Exception('Title must be set');
        }
        if (!isset($_POST['content']) || empty($_POST['content'])) {
            throw new \Exception('Content must be set');
        }
        
        Post::save($_POST['title'], $_POST['content']);

        header('Location: ?module=post&action=index');
    }
}