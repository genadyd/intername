<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 1/31/21
 * Time: 6:11 PM
 */


namespace App\Models;


use App\Db\DbConnection;


class Posts
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = DbConnection::getConnection();
    }

    public function create(array $post_params):int
    {
        $title = htmlspecialchars($post_params['title']);
        $body = htmlspecialchars($post_params['body']);

        /*===============================================================*/
        /* inserting post with random created_at data for testing AVG query */
//    $query = "INSERT INTO posts ( user_id, title, body, created_at )
//    VALUES (:USER, :TITLE, :BODY, (SELECT FROM_UNIXTIME(RAND() * 2147483647)))";
        /*========================================================*/

        /* regular query*/

        $query = "INSERT INTO posts ( user_id, title, body, created_at ) VALUES (:USER, :TITLE, :BODY, CURRENT_TIMESTAMP )";
        $st = $this->db->prepare($query);
        $st->bindParam(":USER", $post_params['user_id'], \PDO::PARAM_INT);
        $st->bindParam(":TITLE", $title, \PDO::PARAM_STR);
        $st->bindParam(":BODY", $body, \PDO::PARAM_STR);

        /*
         * kill the "duplicate values" exception
         * if the exception - do nothing
         * */
        try {
            if ($st->execute()) {
                return $this->db->lastInsertId();
            }
        } catch (\Exception $e) {}
        return 0;

    }
    public function searchById(int $id):array|bool{
        $query = "SELECT * FROM posts WHERE id = :ID";
        $st = $this->db->prepare($query);
        $st->bindParam(":ID",$id, \PDO::PARAM_INT);
        $st->execute();
        return $st->fetch(\PDO::FETCH_ASSOC);
    }
    public function searchByUserId(int $user_id):array|bool{
        if(!Users::checkIfUserExistsById($user_id)){
            return false;
        }
        $query = "SELECT * FROM posts WHERE user_id = :USER_ID ORDER BY id";
        $st = $this->db->prepare($query);
        $st->bindParam(":USER_ID",$user_id, \PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function searchByContent(string $search_string):array|bool{
       /* $query = "SELECT * FROM posts WHERE title LIKE :SEARCH OR body LIKE :SEARCH"; *//* "LIKE" query */
        $query = "SELECT * FROM posts WHERE title REGEXP :SEARCH OR body REGEXP :SEARCH";/*"REGEXP query*/
        /*
         * $search_string = '%'.$search_string.'%';
         * prepare search string for use in "LIKE" query
         * */

        $st = $this->db->prepare($query);
        $st->bindParam(":SEARCH",$search_string, \PDO::PARAM_STR);
        $st->execute();
        return $st->fetchAll(\PDO::FETCH_ASSOC);
    }

}
