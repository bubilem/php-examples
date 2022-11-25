<?php

/**
 * Router určuje jaký controller se spustí
 * Určenému controlleru se předá konfigurace a URL parametry
 */
class Router
{
    /**
     * Hlavní routovací metoda
     * 
     * 1. Načte si konfiguraci.
     * 2. Zpracuje URL parametry do pole
     * 3. Z prvního (index 0) se pokusí vytvořit jméno kontroleru
     * 4. Zkusí (try) kontroler vytvořit
     * 5. Když to nejde (catch Exception) vytvoří defaultní PageController
     * 6. U controlleru spustí jeho metodu run()
     *
     * @param string $url
     * @return void
     */
    public function route(string $url)
    {
        $config = new Config();
        $params = explode("/", substr($url, strlen($config->get("URL_DIR"))));
        $className = empty($params[0]) ? "PageController" : (ucfirst($params[0]) . "Controller");
        try {
            $controller = new $className($config, $params);
        } catch (Exception $e) {
            $controller = new PageController($config, $params);
        }
        $controller->run();
    }
}
