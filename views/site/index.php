<?php

/** @var yii\web\View $this */

$this->title = 'Books';
?>
<div id="app">
</div>
<script>
    window.app_data = {
        author_list: <?= json_encode($authorList) ?>,
        token: <?= json_encode(Yii::$app->request->getCsrfToken()) ?>
    };
</script>