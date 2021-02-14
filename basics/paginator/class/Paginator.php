<?php
class Paginator
{
    private $pageCount;
    private $around;
    private $actualPage;

    public function __construct($pageCount, $around = 3, $actualPage = 1)
    {
        $this->pageCount = intval($pageCount);
        $this->around = intval($around);
        $this->setActualPage($actualPage);
    }

    public function setActualPage($actualPage)
    {
        $ap = intval($actualPage);
        if ($ap >= 1 && $ap <= $this->pageCount) {
            $this->actualPage = $ap;
        } else {
            $this->actualPage = 1;
        }
        return $this;
    }

    public function getActualPage(){
        return $this->actualPage;
    }

    public function render()
    {
        if(!$this->pageCount){
            return '';
        }
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

    public function echo()
    {
        echo $this->render();
    }

    public function __toString()
    {
        return $this->render();
    }
}
