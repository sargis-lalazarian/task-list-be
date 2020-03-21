<?php

class Admin extends Model
{
    public function getAdminByUsername($username)
    {
        $sql = "SELECT * FROM admins WHERE username = :username";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([
            'username' => $username,
        ]);

        return $req->fetch();
    }
}
