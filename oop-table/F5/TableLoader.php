<?php
class TableLoader
{
    private Table $table;

    public function __construct()
    {
        $this->table = new Table();
    }

    public function load(string $conf_file): self
    {
        $conf = $this->loadJsonFileToArray($conf_file);
        $this->table->setCaption($conf["caption"] ?? '');
        $this->table->setClass($conf["class"] ?? '');
        $this->table->setCols($conf["cols"] ?? '');
        if (!empty($conf['data'])) {
            $data = $this->loadJsonFileToArray($conf['data']);
            $this->table->setData(is_array($data) ? $data : []);
        }
        return $this;
    }

    public function loadJsonFileToArray(string $filename)
    {
        $data = json_decode(file_get_contents(__DIR__ . "/" . $filename), true);
        return is_array($data) ? $data : [];
    }

    public function getTable(): Table
    {
        return $this->table;
    }
}
