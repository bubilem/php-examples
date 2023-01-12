<?php
class Table
{
    private $class;
    private $data;
    private $cols;
    private $caption;

    public function __construct($class = '')
    {
        $this->caption = '';
        $this->class = $class;
        $this->data = [];
        $this->cols = [];
    }

    public function setCaption(string $caption): self
    {
        $this->caption = $caption;
        return $this;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;
        return $this;
    }

    public function setCols(array $cols): self
    {
        $this->cols = $cols;
        return $this;
    }

    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function loadData(string $filename): self
    {
        $data = json_decode(file_get_contents(__DIR__ . "/" . $filename), true);
        $this->setData(is_array($data) ? $data : []);
        return $this;
    }

    public function toHtml(): string
    {
        $str = $this->caption ? "<caption>{$this->caption}</caption>" . PHP_EOL : "";
        $str .= "<tr>";
        foreach ($this->cols as $col) {
            $str .= "<th>$col</th>";
        }
        $str .= "</tr>" . PHP_EOL;
        foreach ($this->data as $row) {
            $str .= "<tr>";
            foreach ($this->cols as $key => $name) {
                $str .= "<td>" . (empty($row[$key]) ? "" : $row[$key]) . "</td>";
            }
            $str .= "</tr>" . PHP_EOL;
        }
        return "<table" . (empty($this->class) ? "" : ' class="' . $this->class . '"') . ">" . PHP_EOL .
            "$str</table>" . PHP_EOL;
    }

    public function __toString()
    {
        return $this->toHtml();
    }
}
