<?php
require_once "../config.php";


class ArticlesController {
    public function articleList() {
        $sql = "SELECT * FROM articles";
        $conn = config::getConnexion();
        try {
            $result = $conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    

    public function getArticleById($id) {
        $sql = "SELECT * FROM articles WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function addArticle($article) {
        $sql = "INSERT INTO articles (titre_art, contenu, date, nom_user) 
                VALUES (:titre, :contenu, :date, :nom_user)";
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                'titre' => $article->getTitreArt(),
                'contenu' => $article->getContenu(),
                'date' => $article->getDate() ?? date('Y-m-d H:i:s'),
                'nom_user' => $article->getNomUser(),
            ]);
            echo "Article inserted successfully";
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function updateArticle($article, $id) {
        $sql = "UPDATE articles SET 
                    titre_art = :titre,
                    contenu = :contenu,
                    date = :date,
                    nom_user = :nom
                WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'titre' => $article->getTitreArt(),
                'contenu' => $article->getContenu(),
                'date' => $article->getDate(),
                'nom' => $article->getNomUser(),
            ]);
            echo $query->rowCount() . " article updated successfully<br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteArticle($id) {
        $sql = "DELETE FROM articles WHERE id = :id";
        $conn = config::getConnexion();
        try {
            $req = $conn->prepare($sql);
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();
            echo "Article deleted successfully";
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function searchArticles($searchTerm) {
        $searchTerm = "%" . $searchTerm . "%"; // Use wildcard for partial matching
        $db = config::getConnexion(); // Get the database connection from the config class
        
        try {
            $query = "SELECT * FROM articles WHERE titre_art LIKE :searchTerm OR contenu LIKE :searchTerm ORDER BY date DESC";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    
}

   
?>
