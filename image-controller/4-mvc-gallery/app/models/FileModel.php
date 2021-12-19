<?php

class FileModel
{
    private $data;

    public function __construct(string $id)
    {
        foreach (json_decode(file_get_contents(DATA_DIR . 'db.json'), true) as $record) {
            if ($record['id'] == $id) {
                $this->data = $record;
                break;
            }
        }
    }

    public function exists(): bool
    {
        return !empty($this->data) && file_exists(DATA_DIR . "/files/" . $this->id . '.' . $this->ext);
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    public function getUrl(bool $thumb = false): string
    {
        return URL . URL_DIR . 'file/' . $this->id . '/' . ($thumb ? 'thumb/' : '') . Str::toSimple($this->name) . '.' . $this->ext;
    }

    public function getPath(bool $thumb = false): string
    {
        return $this->path . $this->id . ($thumb ? '_thumb' : '') . '.' .  $this->ext;
    }

    public function getContent(bool $thumb = false)
    {
        return file_get_contents($this->getPath($thumb));
    }
}
