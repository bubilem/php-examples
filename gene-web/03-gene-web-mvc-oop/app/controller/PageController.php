<?php

/**
 * Page Controller
 */
class PageController extends MainController
{
    /**
     * Hlavní spouštěcí metoda run
     * 
     * 1. Načte si model (data stránky)
     * 2. Načte si template webové stránky, doplní jej daty z modelu a výsledek vypíše na výstup
     * 3. Template stránky může být sestaven z dalších šablon (header, footer...)
     *
     * @return void
     */
    public function run()
    {
        // HEADER
        $menuModel = new MenuModel();
        $headerTmplt = new Template("header.html");
        $aTmplt = new Template("a.html");
        $items = "";
        foreach ($menuModel->getItems() as $val) {
            $aTmplt->setData([
                "url" => $val['url'],
                "label" => $val['label']
            ]);
            $items .= $aTmplt->render();
        }
        $headerTmplt->setData(["links" => $items]);

        // FOOTER
        $footerTmplt = new Template("footer.html");
        $footerTmplt->setData(["year" => date("Y"), "version" => $this->config->get("VER")]);

        // PAGE
        $pageModel = new PageModel($this->getParam(0));
        $pageTmplt = new Template("page.html");
        $pageTmplt->setData([
            "url-base" => $this->config->get("URL_SRV") . $this->config->get("URL_DIR"),
            "header" => $headerTmplt->render(),
            "footer" => $footerTmplt->render(),
            "caption" => $pageModel->getCaption(),
            "description" => $pageModel->getDescription()
        ]);
        echo $pageTmplt;
    }
}
