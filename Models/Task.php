<?php

class Task extends Model
{
    public function create($username, $email, $text)
    {
        $sql = "INSERT INTO tasks (username, text, email) VALUES (:username, :text, :email)";
        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'username' => $this->cleanUpText($username),
            'text' => $this->cleanUpText($text),
            'email' => $this->cleanUpText($email),
        ]);
    }

    public function showTask($id)
    {
        $sql = "SELECT * FROM tasks WHERE id = :id";
        $req = Database::getBdd()->prepare($sql);
        $req->execute(['id' => $id]);

        return $req->fetch();
    }

    public function showAllTasks($limit = 3, $offset = 1, $order = 'id', $orderType = 'ASC')
    {
        $sql = "SELECT * FROM tasks ORDER BY " . $order . " " . $orderType . " LIMIT :limit OFFSET :offset";
        $req = Database::getBdd()->prepare($sql);
        $req->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $req->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $req->execute();

        return $req->fetchAll();
    }

    public function totalRows()
    {
        $sql = "SELECT COUNT(*) FROM tasks";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();

        return (int) $req->fetch()[0];
    }

    public function edit($id, $text, $isCompleted)
    {
        $sql = "UPDATE tasks SET text = :text, is_completed = :is_completed WHERE id = :id";
        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'id' => $id,
            'text' => $this->cleanUpText($text),
            'is_completed' => $isCompleted,
        ]);
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM tasks WHERE id = ?';
        $req = Database::getBdd()->prepare($sql);

        return $req->execute([$id]);
    }
}
?>