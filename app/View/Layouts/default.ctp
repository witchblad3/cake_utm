<!DOCTYPE html>
<html lang="ru">
<head>
    <?php echo $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo !empty($title_for_layout) ? h($title_for_layout) : 'UTM statistics'; ?>
    </title>

    <?php
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
</head>
<body>
<?php echo $this->fetch('content'); ?>
</body>
</html>