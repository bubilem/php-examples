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

    public function setCaption(string $caption)
    {
        $this->caption = $caption;
    }

    public function setClass(string $class)
    {
        $this->class = $class;
    }

    public function setCols(array $cols)
    {
        $this->cols = $cols;
    }

    public function setData(array $data)
    {
        $this->data = $data;
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
}
