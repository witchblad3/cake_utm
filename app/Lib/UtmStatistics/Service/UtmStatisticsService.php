<?php
App::uses('UtmDataRepository', 'Lib/UtmStatistics/Repository');
App::uses('UtmTreeBuilder', 'Lib/UtmStatistics/Service');

class UtmStatisticsService {

    protected $repository;
    protected $treeBuilder;

    public function __construct($repository, $treeBuilder) {
        $this->repository = $repository;
        $this->treeBuilder = $treeBuilder;
    }

    public function getTreePage($page, $limit) {
        $page = max(1, (int)$page);
        $limit = max(1, (int)$limit);

        $totalSources = $this->repository->countDistinctSources();
        $pageCount = $totalSources > 0 ? (int)ceil($totalSources / $limit) : 1;

        if ($page > $pageCount) {
            $page = $pageCount;
        }

        $sources = $this->repository->findDistinctSourcesPage($page, $limit);
        $rows = $this->repository->findBySources($sources);
        $tree = $this->treeBuilder->build($rows);

        return array(
            'tree' => $tree,
            'pagination' => array(
                'current_page' => $page,
                'limit' => $limit,
                'total_sources' => $totalSources,
                'page_count' => $pageCount,
                'has_prev' => $page > 1,
                'has_next' => $page < $pageCount
            )
        );
    }
}
