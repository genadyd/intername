<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 1/31/21
 * Time: 6:10 PM
 */


namespace App\Models;


use App\Db\DbConnection;


class Users
{
   private static \PDO $db; /*db connection PDO type*/

   /*
    * fn @init()
    * init the static db Connection
    * */
   public static function init(){
       self::$db = DbConnection::getConnection();
   }

   /*
    * create new user
    * @param array $user_params = ['name','email']
    * @ return if user exists - 0, else ID of new user
    *
    * */
   public function create(array $user_params):int{

       $check_res = $this->checkIfUserExistsByEmail($user_params['email']);
       if(!is_bool($check_res)) return $check_res;

       $name = htmlspecialchars($user_params['name']);
       $email = htmlspecialchars($user_params['email']);
       $query = "INSERT INTO users ( name, email) VALUES (:NAME, :EMAIL) ";
       $st = self::$db->prepare($query);
       $st->bindParam(":NAME",$name, \PDO::PARAM_STR);
       $st->bindParam(":EMAIL",$email, \PDO::PARAM_STR);
       $st->execute();
       return self::$db->lastInsertId();
   }

   /*
    * check if user exists by email
    * */
   private function checkIfUserExistsByEmail( string $user_email ):int|bool{
       $user_email = htmlspecialchars($user_email);
       $query = "SELECT id from users WHERE email = :EMAIL";
       $st = self::$db->prepare($query);
       $st->bindParam(':EMAIL',$user_email,\PDO::PARAM_STR);
       $st->execute();
       return $st->rowCount()>0?$st->fetch(\PDO::FETCH_ASSOC)['id']:false ;
   }

    /*
     * check if user exists by id
     * use in Posts Class for check if user exists
     * where search Post by user_ID
     * @param checked user_id  int $id
     * @return bool true if user, else false
    * */
   public static function checkIfUserExistsById(int $id){
       $query = "SELECT id from users WHERE id = :ID ";
       $st = self::$db->prepare($query);
       $st->bindParam(':ID',$id,\PDO::PARAM_INT);
       $st->execute();
       return $st->rowCount()>0 ;
   }

}
Users::init();
