<?php $this->assign('title_for_layout', 'UTM statistics tree'); ?>

<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        background: #f5f7fb;
        color: #1f2937;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
    }

    .page {
        max-width: 1180px;
        margin: 0 auto;
        padding: 40px 24px 56px;
    }

    .hero {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 24px;
        margin-bottom: 28px;
        flex-wrap: wrap;
    }

    .hero__content h1 {
        margin: 0 0 10px;
        font-size: 40px;
        line-height: 1.1;
        color: #0f172a;
    }

    .hero__content p {
        margin: 0;
        font-size: 16px;
        line-height: 1.6;
        color: #475569;
        max-width: 760px;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(150px, 1fr));
        gap: 16px;
        min-width: 420px;
        flex: 1;
        max-width: 520px;
    }

    .stat-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 18px 18px 16px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
    }

    .stat-card__label {
        display: block;
        margin-bottom: 8px;
        font-size: 13px;
        color: #64748b;
    }

    .stat-card__value {
        font-size: 30px;
        font-weight: 700;
        color: #0f172a;
    }

    .legend {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 24px;
    }

    .legend__item {
        background: #eef2ff;
        color: #3730a3;
        border: 1px solid #c7d2fe;
        border-radius: 999px;
        padding: 10px 14px;
        font-size: 14px;
        line-height: 1;
        font-weight: 600;
    }

    .panel {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 24px;
        box-shadow: 0 14px 36px rgba(15, 23, 42, 0.06);
        overflow: hidden;
    }

    .panel__header {
        padding: 28px 28px 16px;
        border-bottom: 1px solid #eef2f7;
    }

    .panel__title {
        margin: 0 0 8px;
        font-size: 28px;
        color: #0f172a;
    }

    .panel__text {
        margin: 0;
        color: #64748b;
        line-height: 1.6;
        font-size: 15px;
    }

    .panel__body {
        padding: 28px;
    }

    .tree {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .tree--level-0 > .tree__item {
        margin-bottom: 18px;
    }

    .tree--level-1,
    .tree--level-2,
    .tree--level-3,
    .tree--level-4,
    .tree--level-5 {
        margin-top: 12px;
        margin-left: 22px;
        padding-left: 18px;
        border-left: 2px dashed #d7deea;
    }

    .tree__item {
        margin: 10px 0;
    }

    .tree-node {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #f8fafc;
        border: 1px solid #dbe3ef;
        border-radius: 14px;
        padding: 10px 14px;
        box-shadow: 0 4px 10px rgba(15, 23, 42, 0.03);
    }

    .tree-node__type {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 999px;
        background: #dbeafe;
        color: #1d4ed8;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .tree-node__separator {
        color: #94a3b8;
        font-weight: 700;
    }

    .tree-node__value {
        font-size: 16px;
        color: #0f172a;
        font-weight: 600;
    }

    .pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-top: 28px;
        flex-wrap: wrap;
    }

    .pagination__info {
        color: #64748b;
        font-size: 14px;
    }

    .pagination__controls {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .page-link,
    .page-current,
    .page-disabled {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        height: 42px;
        padding: 0 14px;
        border-radius: 12px;
        font-size: 14px;
        text-decoration: none;
        border: 1px solid #dbe3ef;
    }

    .page-link {
        background: #ffffff;
        color: #1e293b;
    }

    .page-link:hover {
        background: #f8fafc;
    }

    .page-current {
        background: #2563eb;
        border-color: #2563eb;
        color: #ffffff;
        font-weight: 700;
    }

    .page-disabled {
        background: #f8fafc;
        color: #94a3b8;
    }

    .empty-state {
        padding: 24px;
        border-radius: 16px;
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        color: #64748b;
    }

    @media (max-width: 900px) {
        .stats {
            min-width: 100%;
            grid-template-columns: repeat(3, 1fr);
        }

        .hero__content h1 {
            font-size: 32px;
        }
    }

    @media (max-width: 640px) {
        .page {
            padding: 24px 16px 40px;
        }

        .stats {
            grid-template-columns: 1fr;
        }

        .panel__header,
        .panel__body {
            padding: 20px;
        }

        .tree-node {
            flex-wrap: wrap;
        }
    }
</style>

<div class="page">
    <div class="hero">
        <div class="hero__content">
            <h1>UTM statistics tree</h1>
            <p>
                Структура данных показана в логическом порядке, чтобы было сразу понятно,
                что за чем следует: <strong>source → medium → campaign → content → term</strong>.
                На странице отображается не более 20 уникальных source.
            </p>
        </div>

        <div class="stats">
            <div class="stat-card">
                <span class="stat-card__label">Текущая страница</span>
                <span class="stat-card__value"><?php echo (int)$pagination['current_page']; ?></span>
            </div>

            <div class="stat-card">
                <span class="stat-card__label">Всего страниц</span>
                <span class="stat-card__value"><?php echo (int)$pagination['page_count']; ?></span>
            </div>

            <div class="stat-card">
                <span class="stat-card__label">Всего source</span>
                <span class="stat-card__value"><?php echo (int)$pagination['total_sources']; ?></span>
            </div>
        </div>
    </div>

    <div class="legend">
        <div class="legend__item">1. source</div>
        <div class="legend__item">2. medium</div>
        <div class="legend__item">3. campaign</div>
        <div class="legend__item">4. content</div>
        <div class="legend__item">5. term</div>
    </div>

    <div class="panel">
        <div class="panel__header">
            <h2 class="panel__title">Дерево UTM-структуры</h2>
            <p class="panel__text">
                Каждый следующий уровень вложенности уточняет предыдущий:
                сначала источник трафика, затем канал, затем кампания, контент и term.
                Значение <strong>NULL</strong> означает, что поле пустое в базе данных.
            </p>
        </div>

        <div class="panel__body">
            <?php echo $this->UtmTree->render($tree); ?>

            <?php if ($pagination['page_count'] > 1): ?>
                <div class="pagination">
                    <div class="pagination__info">
                        Показана страница <?php echo (int)$pagination['current_page']; ?>
                        из <?php echo (int)$pagination['page_count']; ?>
                    </div>

                    <div class="pagination__controls">
                        <?php if ($pagination['has_prev']): ?>
                            <?php echo $this->Html->link(
                                '← Назад',
                                array(
                                    'controller' => 'statistics',
                                    'action' => 'utm_list',
                                    '?' => array('page' => $pagination['current_page'] - 1)
                                ),
                                array('class' => 'page-link')
                            ); ?>
                        <?php else: ?>
                            <span class="page-disabled">← Назад</span>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $pagination['page_count']; $i++): ?>
                            <?php if ($i === (int)$pagination['current_page']): ?>
                                <span class="page-current"><?php echo $i; ?></span>
                            <?php else: ?>
                                <?php echo $this->Html->link(
                                    $i,
                                    array(
                                        'controller' => 'statistics',
                                        'action' => 'utm_list',
                                        '?' => array('page' => $i)
                                    ),
                                    array('class' => 'page-link')
                                ); ?>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <?php if ($pagination['has_next']): ?>
                            <?php echo $this->Html->link(
                                'Вперёд →',
                                array(
                                    'controller' => 'statistics',
                                    'action' => 'utm_list',
                                    '?' => array('page' => $pagination['current_page'] + 1)
                                ),
                                array('class' => 'page-link')
                            ); ?>
                        <?php else: ?>
                            <span class="page-disabled">Вперёд →</span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>