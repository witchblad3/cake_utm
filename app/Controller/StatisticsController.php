<?php
App::uses('AppController', 'Controller');
App::uses('UtmDataRepository', 'Lib/UtmStatistics/Repository');
App::uses('UtmTreeBuilder', 'Lib/UtmStatistics/Service');
App::uses('UtmStatisticsService', 'Lib/UtmStatistics/Service');

class StatisticsController extends AppController {

    public $uses = array('UtmDatum');
    public $helpers = array('Html', 'UtmTree');

    protected $utmStatisticsService = null;

    public function utm_list() {
        $page = (int)$this->request->query('page');
        if ($page < 1) {
            $page = 1;
        }

        $limit = 20;
        $result = $this->getUtmStatisticsService()->getTreePage($page, $limit);

        if ($page !== (int)$result['pagination']['current_page']) {
            return $this->redirect(array(
                'controller' => 'statistics',
                'action' => 'utm_list',
                '?' => array('page' => $result['pagination']['current_page'])
            ));
        }

        $this->set('tree', $result['tree']);
        $this->set('pagination', $result['pagination']);
    }

    protected function getUtmStatisticsService() {
        if ($this->utmStatisticsService === null) {
            $repository = new UtmDataRepository($this->UtmDatum);
            $treeBuilder = new UtmTreeBuilder();

            $this->utmStatisticsService = new UtmStatisticsService(
                $repository,
                $treeBuilder
            );
        }

        return $this->utmStatisticsService;
    }
}
