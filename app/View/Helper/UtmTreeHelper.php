<?php
App::uses('AppHelper', 'View/Helper');

class UtmTreeHelper extends AppHelper {

    protected $levelLabels = array(
        0 => 'source',
        1 => 'medium',
        2 => 'campaign',
        3 => 'content',
        4 => 'term',
    );

    public function render(array $tree) {
        if (empty($tree)) {
            return '<div class="empty-state">Нет данных для отображения.</div>';
        }

        return $this->renderLevel($tree, 0);
    }

    protected function renderLevel(array $nodes, $depth) {
        $html = '<ul class="tree tree--level-' . (int)$depth . '">';

        foreach ($nodes as $label => $children) {
            $html .= '<li class="tree__item">';
            $html .= $this->renderNode($label, $depth);

            if (!empty($children)) {
                $html .= $this->renderLevel($children, $depth + 1);
            }

            $html .= '</li>';
        }

        $html .= '</ul>';

        return $html;
    }

    protected function renderNode($label, $depth) {
        $safeLabel = htmlspecialchars((string)$label, ENT_QUOTES, 'UTF-8');
        $levelName = isset($this->levelLabels[$depth]) ? $this->levelLabels[$depth] : 'level';

        $html  = '<div class="tree-node">';
        $html .= '<span class="tree-node__type">' . $levelName . '</span>';
        $html .= '<span class="tree-node__separator">→</span>';
        $html .= '<span class="tree-node__value">' . $safeLabel . '</span>';
        $html .= '</div>';

        return $html;
    }
}