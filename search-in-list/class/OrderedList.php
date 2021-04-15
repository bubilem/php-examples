<?php
class OrderedList extends BaseList implements IList
{

    public function add(int $value)
    {
        if (!$this->count() || $value >= $this->items[$this->count() - 1]) {
            $this->items[] = $value;
            return;
        }
        $this->items[] = $this->items[$this->count() - 1];
        for ($i = $this->count() - 2; $i >= -1; $i--) {
            if (!isset($this->items[$i]) || $this->items[$i] <= $value) {
                $this->items[$i + 1] = $value;
                break;
            }
            $this->items[$i + 1] = $this->items[$i];
        }
    }

    public function exists(int $value): bool
    {
        return $this->searchByHalving($value, 0, $this->count() - 1);
    }

    private function searchByHalving(int $value, int $startIndex, int $stopIndex): bool
    {
        if ($stopIndex - $startIndex <= 1) {
            if ($value == $this->items[$startIndex] || $value == $this->items[$stopIndex]) {
                return true;
            } else {
                return false;
            }
        }
        $middleIndex = floor(($stopIndex - $startIndex) / 2) + $startIndex;
        if ($value <= $this->items[$middleIndex]) {
            return $this->searchByHalving($value, $startIndex, $middleIndex);
        } else {
            return $this->searchByHalving($value, $middleIndex + 1, $stopIndex);
        }
    }
}
