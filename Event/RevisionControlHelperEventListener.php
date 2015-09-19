<?php
class RevisionControlHelperEventListener extends BcHelperEventListener {
/**
 * 登録イベント
 *
 * @var array
 */
	public $events = array(
		'Form.afterEnd'
	);


	public function formAfterEnd(CakeEvent $event) {
		$view = $event->subject;

		foreach(Configure::read('RevisionControl.views') as $modelName => $requestTarget) {
			if ($requestTarget['controller'] == $view->request['controller']
				&& $requestTarget['action'] == $view->request['action']
			) {

				$revisionControlMdl = ClassRegistry::init('RevisionControl.RevisionControl');
				$id = $view->request->data[$modelName]['id'];

				// 過去リヴィジョンのデータを取得
				$revList = $revisionControlMdl->find('all', array(
					'conditions' => array(
						'model_name' => $modelName,
						'model_id' => $id,
					),
					'order' => 'revision desc'
				));

				if ($revList) {

					?>
					<div class="RevisionControlList">
						<h3>リビジョン情報</h3>
						<ul>
							<?php foreach($revList as $data): ?>
								<?php
								$urlParams = array(
									'controller' => $view->request['controller'],
									'action' => $view->request['action'],
								);
								if ($view->request['pass']) {
									$urlParams +=$view->request['pass'];
								}
								if ($view->request['named']) {
									$urlParams +=$view->request['named'];
								}
								$urlParams['rev'] = $data['RevisionControl']['revision'];
								?>
							<li>
								<a href="<?php echo Router::url($urlParams ); ?>" onclick="return confirm('旧リヴィジョンで編集を開きますか？')">
									<?php echo date("Y.m.d H:i:s", strtotime($data['RevisionControl']['created'])) ?>
									(<?php echo $data['RevisionControl']['revision']; ?>)
								</a>
							</li>
							<?php endforeach; ?>
						</ul>

					</div>
					<?php

				}
			}
		}
	}
}
