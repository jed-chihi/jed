<?php
require_once "../config.php";


class CommentaireController {

    // Method to get all comments for a specific article
    public function getCommentsByArticleId($article_id) {
        $sql = "SELECT * FROM commentaires WHERE article = :article_id ORDER BY date DESC";
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare($sql);
            $query->bindValue(':article_id', $article_id, PDO::PARAM_INT); // Bind article_id to the article column
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC); // Return all comments for the given article
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function getCommentaireById($id)
{
    $sql = "SELECT * FROM commentaires WHERE id = :id";
    $conn = config::getConnexion();
    try {
        $query = $conn->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT); // Bind the ID
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC); // Return the comment details as an associative array
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}

    // Method to add a new comment
    public function addComment($contenu, $article_id) {
        $date = date('Y-m-d H:i:s'); // Get the current timestamp
        $like = 0; // Default like count is 0 when a comment is created
   
        // Insert comment into the database
        $sql = "INSERT INTO commentaires (contenu, date, `like`, article) 
                VALUES (:contenu, :date, :like, :article_id)";
        
        // Get the database connection
        $conn = config::getConnexion();
        
        try {
            // Prepare the query
            $query = $conn->prepare($sql);
            
            // Execute the query with the parameters
            $query->execute([
                'contenu' => $contenu,
                'date' => $date,
                'like' => $like, // Default like value
                'article_id' => $article_id, // The correct column for article is 'article' in 'commentaires'
            ]);
            
            // Return success message
            echo "Comment added successfully";
        } catch (Exception $e) {
            // Return the exact error message
            echo 'Error: ' . $e->getMessage(); // This will display the actual error that happened
        }
    }
    // Method to delete a comment by ID
    public function deleteComment($id) {
        $sql = "DELETE FROM commentaires WHERE id = :id";
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT); // Bind the comment ID
            $query->execute();
            echo "Comment deleted successfully";
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Method to update a comment (if required)
    public function updateComment($id, $contenu) {
        $sql = "UPDATE commentaires SET contenu = :contenu WHERE id = :id";
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                'id' => $id,
                'contenu' => $contenu,
            ]);
            echo "Comment updated successfully";
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
?>

