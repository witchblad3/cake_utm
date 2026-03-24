<?php

class UtmTreeBuilder {

    public function build(array $rows) {
        $tree = array();

        foreach ($rows as $row) {
            if (empty($row['UtmDatum'])) {
                continue;
            }

            $item = $row['UtmDatum'];

            $source = $item['source'];
            $medium = $item['medium'];
            $campaign = $item['campaign'];
            $content = $this->normalizeNullable($item['content']);
            $term = $this->normalizeNullable($item['term']);

            if (!isset($tree[$source])) {
                $tree[$source] = array();
            }

            if (!isset($tree[$source][$medium])) {
                $tree[$source][$medium] = array();
            }

            if (!isset($tree[$source][$medium][$campaign])) {
                $tree[$source][$medium][$campaign] = array();
            }

            if (!isset($tree[$source][$medium][$campaign][$content])) {
                $tree[$source][$medium][$campaign][$content] = array();
            }

            if (!isset($tree[$source][$medium][$campaign][$content][$term])) {
                $tree[$source][$medium][$campaign][$content][$term] = array();
            }
        }

        return $tree;
    }

    protected function normalizeNullable($value) {
        return ($value === null || $value === '') ? 'NULL' : (string)$value;
    }
}
