<?php
namespace System\Site\Controller;
use System\Core\SiteController;
use System\Core\View;
use System\Libs\DI;

class Kalkulator extends SiteController {

    function __construct()
    {
        parent::__construct();
        $this->loadModel('kalkulator_model');
    }

    /**
     * 
     */
    public function index()
    {
        $page_data = $this->kalkulator_model->getPageData('kalkulator');
        $data = $this->addGlobalData();

        $data['title'] = $page_data['metatitle'];
        $data['description'] = $page_data['metadescription'];
        $data['keywords'] = $page_data['metakeywords'];
        $data['content'] = $page_data['body'];

        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));
        $view->add_link('js', DI::get('url_helper')->autoVersion(SITE_JS . 'pages/kalkulator.js'));
        $view->render('kalkulator/tpl_kalkulator', $data);
    }

    /**
     * 
     */
    public function ajax()
    {
        $data = $this->request->get_post();

        $html = file_get_contents('system/Site/view/kalkulator/tpl_ajax_response.php');

        /*         * ************ felhasználás célja: minőségi vakolással megelőzni a falnedvességi problémákat *********** */
        /*         * ****************************************************************************************************** */

        /*         * ********************** Goldmix ************************ */
        if ($data['felhcel'] == 1 && $data['kulter_belter'] == 1 && $data['esohely'] == 1 && $data['hely'] == 1) {
            $mennyiseg = 0.08 * $data['terulet'] * $data['vakolat_vastagsag'];
            $ar = 188.32 * $data['terulet'] * $data['vakolat_vastagsag'];
            $termek = 'Goldmix-re';
            $html = $this->contentReplace($mennyiseg, $ar, $termek, $html);
        } elseif (
        /*         * ********************** Mészpótló ************************ */
                $data['felhcel'] == 1 && $data['kulter_belter'] == 1 && $data['esohely'] == 2 && $data['hely'] == 1) {
            $mennyiseg = 0.02 * $data['terulet'] * $data['vakolat_vastagsag'];
            $ar = 31.32 * $data['terulet'] * $data['vakolat_vastagsag'];
            $termek = 'Mészpótlóra';

            $html = $this->contentReplace($mennyiseg, $ar, $termek, $html);
        } elseif (
        /*         * ********************** C+M ************************ */
                $data['felhcel'] == 1 && $data['kulter_belter'] == 2 && $data['falszarito'] == 1 && $data['hely'] == 1) {
            $mennyiseg = 0.025 * $data['terulet'] * $data['vakolat_vastagsag'];
            $ar = 62.775 * $data['terulet'] * $data['vakolat_vastagsag'];
            $termek = 'C+M-re';

            $html = $this->contentReplace($mennyiseg, $ar, $termek, $html);
        } elseif (
        /*         * ********************** Hidro ************************ */
                $data['felhcel'] == 1 && $data['kulter_belter'] == 1 && ($data['esohely'] == 1 || $data['esohely'] == 2) && $data['hely'] == 2) {
            $mennyiseg = 0.055 * $data['terulet'] * $data['vakolat_vastagsag'];
            $ar = 116.49 * $data['terulet'] * $data['vakolat_vastagsag'];
            $termek = 'Hidro-ra';

            $html = $this->contentReplace($mennyiseg, $ar, $termek, $html);
        } elseif (
        /*         * ********************** C+M ************************ */
                $data['felhcel'] == 1 && $data['kulter_belter'] == 2 && $data['falszarito'] == 1 && $data['hely'] == 3) {
            $mennyiseg = 0.025 * $data['terulet'] * $data['vakolat_vastagsag'];
            $ar = 62.775 * $data['terulet'] * $data['vakolat_vastagsag'];
            $termek = 'C+M-re';

            $html = $this->contentReplace($mennyiseg, $ar, $termek, $html);
        } elseif (
        /*         * ********************** C+M ************************ */
                $data['felhcel'] == 1 && $data['kulter_belter'] == 2 && $data['falszarito'] == 2 && $data['hely'] == 3
        ) {
            $mennyiseg = 0.08 * $data['terulet'] * $data['vakolat_vastagsag'];
            $ar = 188.32 * $data['terulet'] * $data['vakolat_vastagsag'];
            $termek = 'Goldmix-re';

            $html = $this->contentReplace($mennyiseg, $ar, $termek, $html);
        }

        echo $html;
    }

    /**
     * 
     */
    public function contentReplace($mennyiseg, $ar, $termek, $html)
    {
        $html = str_replace('{{mennyiseg}}', $mennyiseg, $html);
        $html = str_replace('{{ar}}', $ar, $html);
        $html = str_replace('{{termek}}', $termek, $html);
        return $html;
    }

}
?>