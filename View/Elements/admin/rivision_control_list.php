<div class="RevisionControlList">
    <h3>リビジョン情報</h3>
    <ul>
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
            <li>
                <a href="<?php echo Router::url($urlParams ); ?>" onclick="return confirm('過去のリビジョン情報で編集を開きますか？')">
                    <?php echo date("Y.m.d H:i:s", strtotime($data['RevisionControl']['created'])) ?>
                    (<?php echo $data['RevisionControl']['revision']; ?>)
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>