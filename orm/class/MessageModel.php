<?php
class MessageModel
{

    private $id;
    private $date;
    private $content;

    public function __construct(int $id = 0)
    {
        if (!empty($id)) {
            $this->load($id);
        }
    }

    public function load(int $id)
    {
        $result = DB::fetchQueryToArray("SELECT * FROM message WHERE id = $id");
        if (isset($result[0])) {
            $this->setId($result[0]['id']);
            $this->setDate($result[0]['date']);
            $this->setContent($result[0]['content']);
        }
    }

    public function save()
    {
        if ($this->getId()) {
            DB::query("UPDATE message SET date = '" . $this->date . "', content = '" . $this->content . "' WHERE id = " . $this->id);
        } else {
            if (!$this->getDate()) {
                $this->setDate();
            }
            DB::query("INSERT INTO message (date, content) VALUES ('" . $this->getDate() . "', '" . $this->getContent() . "')");
            $this->setId(DB::getInsertId());
        }
    }

    public function delete()
    {
        if (!$this->getId()) {
            return null;
        }
        $result = DB::query("DELETE FROM message WHERE id = " . $this->id);
        if ($result !== false) {
            $result = DB::getAffectedRows();
            if ($result == 1) {
                $this->id = $this->date = $this->content = null;
            }
        }
        return $result;
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId(int $value)
    {
        $this->id = $value;
        return $this;
    }

    public function getDate(bool $human = false)
    {
        if (!$human) {
            return $this->date;
        } else {
            return date("j. n. Y G:i", strtotime($this->date));
        }
    }

    public function setDate($value = null)
    {
        $this->date = $value ?? date("Y-m-d H:i:s");
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent(string $value)
    {
        $this->content = $value;
        return $this;
    }
}
