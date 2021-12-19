<?php

class RouterController extends MainController
{

    public function run(): void
    {
        switch ($this->getUrlParam(0)) {
            case 'file':
                (new FileController())->run();
                break;
            case '':
            case 'gallery':
                (new GalleryController())->run();
                break;
            default:
                (new ErrorController())->run();
        }
    }
}
