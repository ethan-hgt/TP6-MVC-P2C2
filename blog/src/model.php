<?php
function getPosts() {
    try {
        $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'blog', 'password');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $statement = $database->query(
        "SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date 
         FROM billets ORDER BY date_creation DESC LIMIT 0, 5"
    );

    $posts = [];
    while ($row = $statement->fetch()) {
        $post = [
            'title' => $row['titre'],
            'french_creation_date' => $row['french_creation_date'],
            'content' => $row['contenu'],
        ];
        $posts[] = $post;
    }

    return $posts;
}