<?php
class Paginator
{
    private $pageCount;
    private $around;
    private $actualPage;

    public function __construct($pc, $a = 3, $ap = 1)
    {
        $this->pageCount = $pc;
        $this->around = $a;
        $this->actualPage = $ap;
    }

    public function render()
    {
        $out = '';
        $dots = false;
        for ($i = 1; $i <= $this->pageCount; $i++) {
            if (
                $i == 1 || $i == $this->pageCount ||
                ($i >= $this->actualPage - $this->around && $i <= $this->actualPage + $this->around)
            ) {
                $out .= $i != 1 && !$dots ? " " : "";
                $out .= ($i != $this->actualPage) ? '<a href="#' . $i . '">' . $i . '</a>' : $i;
                $dots = false;
            } else {
                if (!$dots) {
                    $out .= " ... ";
                    $dots = true;
                }
            }
        }
        return "<div>$out</div>";
    }

    public function echo(){
        echo $this->render();
    }

    public function __toString()
    {
        return $this->render();
    }
}
