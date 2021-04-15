<?php
class IndexList extends BaseList implements IList
{

    public function add(int $value)
    {
        if (!isset($this->items[$value])) {
            $this->items[$value] = 1;
        } else {
            $this->items[$value]++;
        }
    }

    public function exists(int $value): bool
    {
        if (isset($this->items[$value])) {
            return true;
        } else {
            return false;
        }
    }

    public function toJson(): string
    {
        $out = "";
        foreach ($this->items as $k => $v) {
            for ($i = 0; $i < $v; $i++) {
                $out .= ($out ? "," : "") . $k;
            }
        }
        return "[$out]";
    }
}
