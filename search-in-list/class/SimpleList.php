<?php
class SimpleList extends BaseList implements IList
{

    public function add(int $value)
    {
        $this->items[] = $value;
    }

    public function exists(int $value): bool
    {
        foreach ($this->items as $item) {
            if ($item == $value) {
                return true;
            }
        }
        return false;
    }
}
