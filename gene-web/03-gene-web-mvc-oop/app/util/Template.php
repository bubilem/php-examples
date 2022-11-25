<?php

/**
 * Template
 * Do načteného souboru (obvykle HTML) se na místo {} pokouší vkládat data
 * 
 */
class Template
{
    /**
     * Název šablonového souboru
     *
     * @var string
     */
    private $filename;

    /**
     * Data for template to replace
     *
     * @var array
     */
    private $data;

    /**
     * Konstruktor jen uloží název souboru v parametru do atributu
     *
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->data = [];
    }

    /**
     * Data setter
     *
     * @param array $data data for the template
     * @return Template this for fluent interface
     */
    public function setData(array $data): Template
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Render šablony
     * 
     * 1. Načtení obsahu souboru
     * 2. Nahrazení obsahu v {} patričnými daty
     * 3. Vrácení vygenerovaného obsahu
     *
     * @return string rendered string
     */
    public function render(): string
    {
        if (!file_exists("app/view/" . $this->filename)) {
            return "";
        }
        $content = file_get_contents("app/view/" . $this->filename);
        foreach ($this->data as $key => $val) {
            $content = str_replace("{" . $key . "}", $val, $content);
        }
        return $content;
    }


    public function __toString()
    {
        return $this->render();
    }
}
