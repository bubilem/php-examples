<?php
class Table
{
    public static function toHtml(string $caption, string $class, array $cols, array $data): string
    {
        $str = $caption ? "<caption>{$caption}</caption>" . PHP_EOL : "";
        $str .= "<tr>";
        foreach ($cols as $col) {
            $str .= "<th>$col</th>";
        }
        $str .= "</tr>" . PHP_EOL;
        foreach ($data as $row) {
            $str .= "<tr>";
            foreach ($cols as $key => $name) {
                $str .= "<td>" . (empty($row[$key]) ? "" : $row[$key]) . "</td>";
            }
            $str .= "</tr>" . PHP_EOL;
        }
        return "<table" . (empty($class) ? "" : ' class="' . $class . '"') . ">" . PHP_EOL .
            "$str</table>" . PHP_EOL;
    }
}
