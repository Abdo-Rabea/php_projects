<?php

// validate data and send it to model
class NewNoteContr extends Note
{
    private $title;
    private $desc;

    public function __construct($title, $desc)
    {
        $this->title = $title;
        $this->desc = $desc;
    }
    public function deleteNoteWithId($id)
    {
        $this->deleteNote($id);
    }
    public function updateNoteById($id)
    {
        $this->updateNote($id, $this->title, $this->desc);
    }
    public function saveNote()
    {
        // validate
        if ($this->isEmtpyFields()) {
            header('Location: ../index.php?error=emptyfields');
            exit;
        }
        // setdata
        $this->setNote($this->title, $this->desc);
    }
    private function isEmtpyFields()
    {
        $res = false;
        if (empty($this->title))
            $res = true;
        return $res;
    }
}
