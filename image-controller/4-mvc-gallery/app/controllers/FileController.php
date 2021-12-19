<?php

class FileController extends MainController
{

    public function run(): void
    {
        $file = new FileModel($this->getUrlParam(1));
        if (!$file->exists()) {
            $this->redirect("error");
        }
        header("Pragma: cache");
        header("Cache-Control: max-age=2592000"); //30days (60sec * 60min * 24hours * 30days)
        header("Expires: " . gmdate("D, d M Y H:i:s", time() + 2592000) . " GMT");
        header("Keep-Alive: timeout=5, max=50");
        header("Content-type: " . $file->type);
        echo $file->getContent($this->getUrlParam(2) == 'thumb');
        exit;
    }
}
