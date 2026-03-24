<?php
App::uses('Hash', 'Utility');

class UtmDataRepository {

    protected $UtmDatum;

    public function __construct($UtmDatum) {
        $this->UtmDatum = $UtmDatum;
    }

    public function countDistinctSources() {
        $table = $this->UtmDatum->useTable;
        $result = $this->UtmDatum->query(
            sprintf('SELECT COUNT(DISTINCT source) AS total_count FROM %s', $table)
        );

        if (empty($result[0][0]['total_count'])) {
            return 0;
        }

        return (int)$result[0][0]['total_count'];
    }

    public function findDistinctSourcesPage($page, $limit) {
        $page = max(1, (int)$page);
        $limit = max(1, (int)$limit);

        $rows = $this->UtmDatum->find('all', array(
            'fields' => array('UtmDatum.source'),
            'group' => array('UtmDatum.source'),
            'order' => array('UtmDatum.source' => 'ASC'),
            'limit' => $limit,
            'offset' => ($page - 1) * $limit,
            'recursive' => -1
        ));

        return Hash::extract($rows, '{n}.UtmDatum.source');
    }

    public function findBySources(array $sources) {
        if (empty($sources)) {
            return array();
        }

        return $this->UtmDatum->find('all', array(
            'conditions' => array(
                'UtmDatum.source' => $sources
            ),
            'fields' => array(
                'UtmDatum.source',
                'UtmDatum.medium',
                'UtmDatum.campaign',
                'UtmDatum.content',
                'UtmDatum.term'
            ),
            'order' => array(
                'UtmDatum.source' => 'ASC',
                'UtmDatum.medium' => 'ASC',
                'UtmDatum.campaign' => 'ASC',
                'UtmDatum.content' => 'ASC',
                'UtmDatum.term' => 'ASC'
            ),
            'recursive' => -1
        ));
    }
}
