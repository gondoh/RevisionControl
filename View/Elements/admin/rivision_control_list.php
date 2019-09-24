<?php
/**
 * @var array $revList 
 */
?>
<div class="RevisionControlList">
    <h2 class="bca-main__heading" data-bca-heading-size="lg">リビジョン情報</h2>
    <ul class="clear bca-update-log__list">
        <?php foreach($revList as $data): ?>
            <?php
            $urlParams = array(
                'controller' => $this->request['controller'],
                'action' => $this->request['action'],
            );
            if ($this->request['pass']) {
                $urlParams +=$this->request['pass'];
            }
            if ($this->request['named']) {
                $urlParams +=$this->request['named'];
            }
            $urlParams['rev'] = $data['RevisionControl']['revision'];
            ?>
            <li class="bca-update-log__list-item">
                <a href="<?php echo Router::url($urlParams ); ?>" onclick="return confirm('過去のリビジョン情報で編集を開きますか？')">
                    <?php echo date("Y.m.d H:i:s", strtotime($data['RevisionControl']['created'])) ?>
                    (<?php echo $data['RevisionControl']['revision']; ?>)
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>