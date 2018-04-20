<?php

require_once 'src/database.php';

class Post
{
    public static function getAll()
    {
        $con = getConnection();
        $res = $con->query('SELECT `id`, `title`, `content` FROM posts ORDER BY `id`');

        $posts = [];
        while ($row = $res->fetch_assoc()) {
            $posts[] = $row;
        }

        $con->close();

        return $posts;
    }

    public static function save($title, $content)
    {
        $con = getConnection();
        $res = $con->query('INSERT INTO `posts` (title, content) VALUES (\''.$title.'\', \''.$content.'\')');;
        $con->close();
        
        return true;
    }
}