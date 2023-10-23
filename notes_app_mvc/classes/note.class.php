<?php

class Note extends dbh
{
    protected function setNote($title, $desc)
    {
        $sth = $this->connect()->prepare("insert into notes (title, description, create_date) values (?, ?, ?)");
        $sth->execute(array($title, $desc, date('y-m-d h:i:s')));
        $sth = null;
    }
    // get all notes
    protected function getNotes()
    {
        $sth = $this->connect()->query("select * from notes");
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    protected function deleteNote($id)
    {
        $sth = $this->connect()->prepare("delete from notes where id = ?");
        $sth->execute(array($id));
        $sth = null;
    }
    protected function updateNote($id, $title, $description)
    {
        $sth = $this->connect()->prepare("update notes set title = ?, description = ? , create_date = ? where id = ?");
        $sth->execute(array($title, $description, date('y-m-d h:i:s'), $id));
        $sth = null;
    }
}
