<?php

class DB
{

    /***************************************
     * connexion à la BD
     */
    private function connectBD()
    {
        try{
            $this->db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
            $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
            die($msg);
        }
    } //end connectBD()

    /**********
     * deconnexion à la base de données
     */
    private function disconctBD()
    {
        $this->db = null;
    }

    /**********
     * @param $sqlQuery
     * @return mixed
     */
    private function doQuerryReturn($sqlQuerry)
    {
        $this->connectBD();
        $sth = $this->db->prepare($sqlQuerry);
        try{
            $sth->execute();
        }catch(Exception $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
        $sections = $sth->fetchAll();
        $this->disconctBD();
        return $sections;
    }

    /**********
     * @param $sqlQuery
     */
    private function doQuerry($sqlQuerry)
    {
        $this->connectBD();
        $sth = $this->db->prepare($sqlQuerry);
        try{
            $sth->execute();
        }catch(Exception $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
        $this->disconctBD();
    }

        /**
     * @param $email
     * @return mixed l'utilisateur trouvé s'il existe sinon vide
     */
    public function getActiveUserByMail($email)
    {
        $sqlQuerry = "
            SELECT *
            FROM users 
            WHERE email = '".$email."'
            AND active = 1;";
        return $this->doQuerryReturn($sqlQuerry);
    }

    /**
     * @return mixed tous les utilisateurs
     */
    public function getAllUser()
    {
        $sqlQuerry = "
            SELECT *
            FROM users;";
        return $this->doQuerryReturn($sqlQuerry);
    }

    /**
     * @param $user
     * @return mixed tous les message de 'user'
     */
    public function getAllMessagesForUser($user) 
    {
        $sqlQuerry = "
            SELECT *
            FROM messages 
            WHERE receiver_email = '".$user."'
            ;";
        return $this->doQuerryReturn($sqlQuerry);
    }

    /**
     * @param $id, l'id du message
     * @return mixed le message
     */
    public function getMessageById($id)
    {
        $sqlQuerry = "
            SELECT *
            FROM messages
            WHERE id = '".$id."';       
        ";
        return $this->doQuerryReturn($sqlQuerry);
    } 

     /**
     * @param $id, l'id du message
     */
    public function delMessage($id)
    {
        $sqlQuerry = "
        DELETE FROM `messages` WHERE id = ".$id." ;
        ";
        return $this->doQuerry($sqlQuerry);
    }

     /**
     * @param $email, l'email de l'utilisateur
     */
    public function delUser($email)
    {
        $sqlQuerry = "
        UPDATE users
        SET active = 0
        WHERE email = '".$email."';
        ";
        return $this->doQuerry($sqlQuerry);
    }

     /**
     * @param $sender
     * @param $receiver
     * @param $obbject
     * @param $content
     */
    public function insertMessage($sender,$receiver,$object,$content, $date)
    {
        $sqlQuerry = "
        INSERT INTO 'messages' ('receiver_email', 'sender_email', 'object', 'content', 'datestamp', 'status') 
        VALUES ('".$receiver."','".$sender."', '".$object."', '".$content."', '".$date."', 0);     
        ";
        return $this->doQuerry($sqlQuerry);
    }

    /**
     * 
     */
    public function updatePassword($email, $newPwd) 
    {
        $sqlQuerry = "
        UPDATE users
        SET password ='".$newPwd."'
        WHERE email = '".$email."';
        ";
        return $this->doQuerry($sqlQuerry);
    }

    /**
     * @param $id
     * @param $actif
     * @param $role
     */
    public function updateUser($email, $active, $role)
    {
        $sqlQuerry = "
        UPDATE users
        SET active='".$active."', 'admin'='".$role."' 
        WHERE email = '".$email."';
        ";
        return $this->doQuerry($sqlQuerry);
    }

       /**
     * @param $email
     * @return mixed the role
     */
    public function getRoleByEmail($email)
    {
        $sqlQuerry = "
            SELECT admin
            FROM Utilisateur
            WHERE email = '".$email."';      
        ";
        return $this->doQuerryReturn($sqlQuerry);
    }

       /**
     * @param $email
     * @param $mdp
     * @param $actif
     * @param $role
     */
    public function createUser($email, $mdp, $actif, $role)
    {
        $sqlQuerry = "
        INSERT INTO users ('email', 'password', 'admin', 'active') 
        VALUES ('".$email."', '".$mdp."', '".$actif."', '".$role."');
        ";
        return $this->doQuerry($sqlQuerry);
    }

    







 
    /**
     * @return mixed le nom et l'id de tous les utilisateurs
     */
    public function getAllUserName()
    {
        $sqlQuerry = "
            SELECT IdUser, Prenom, Nom
            FROM Utilisateur
            WHERE Actif != 0;       
        ";
        return $this->doQuerryReturn($sqlQuerry);
    }

    /**
     * @param $id, l'id de l'utilisateur à exclure
     * @return mixed le nom et l'id de tous les utilisateurs sauf de l'utilisateur excul
     */
    public function getAllUserNameWithoutCurrentUser($id)
    {
        $sqlQuerry = "
            SELECT IdUser, Prenom, Nom
            FROM Utilisateur
            WHERE Actif != 0 AND IdUser != ".$id.";       
        ";
        return $this->doQuerryReturn($sqlQuerry);
    }


    /**
     * @param $idSender
     * @param $idReceiver
     * @param $subject
     * @param $content
     */
    public function insertMessag($idSender,$idReceiver,$subject,$content)
    {
        $sqlQuerry = "
        INSERT INTO `Message` (`DateReception`, `Sujet`,`Contenu`, `fk_emetteur`, `fk_recepteur`) 
        VALUES ('".date('Y-m-d H:i:s')."', '".$subject."','".$content."', '".$idSender."', '".$idReceiver."');     
        ";
        return $this->doQuerry($sqlQuerry);
    }
    
    /**
     * @param $idSender
     * @param $idReceiver
     * @param $subject
     * @param $content
     * @param $idMessage l'id du message qui recoit la réponse
     */
    public function insertMessageReponse($idSender,$idReceiver,$subject,$content,$idMessage)
    {
        $sqlQuerry = "
        INSERT INTO `Message` (`DateReception`, `Sujet`,`Contenu`, `fk_emetteur`, `fk_recepteur`) 
        VALUES ('".date('Y-m-d H:i:s')."', '".$subject."','".$content."', '".$idSender."', '".$idReceiver."');     
        INSERT INTO `db_STI_projet1`.`Reponse` (`IdRsp`, `fk_msg`) SELECT @@IDENTITY, '".$idMessage."';        
        ";
        return $this->doQuerry($sqlQuerry);
    }

    
    /**
     * @param $id, l'id de l'utilisateur
     * @return mixed tous les messages de l'utilisateur
     */
    public function getAllMessageToUser($id)
    {
        $sqlQuerry = "
            SELECT *
            FROM Message
            INNER JOIN Utilisateur 
            ON Message.fk_emetteur = Utilisateur.idUser
            WHERE Message.fk_recepteur = '".$id."';       
        ";
        return $this->doQuerryReturn($sqlQuerry);
    } 


    /**
     * @param $email
     * @param $password
     * @return mixed l'utilisateur trouvé s'il existe sinon vide
     */
    public function loginValidation($email, $password)
    {
        $sqlQuerry = "
            SELECT * 
            FROM users 
            WHERE email = '".$email."'
            AND password = '".$password."'
            AND active = 1;";
        return $this->doQuerryReturn($sqlQuerry);
    }
}