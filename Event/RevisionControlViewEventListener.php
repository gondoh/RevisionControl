<?php
class RevisionControlViewEventListener extends BcViewEventListener {
/**
 * 登録イベント
 *
 * @var array
 */
	public $events = array(
		'beforeRender'
	);

/**
 * beforeRender
 *
 * @param CakeEvent $event
 * @return boolean
 */
	public function beforeRender(CakeEvent $event) {
		$view = $event->subject;

		foreach(Configure::read('RevisionControl.views') as $modelName => $requestTarget) {
			if ($requestTarget['controller'] == $view->request['controller']
			&& $requestTarget['action'] == $view->request['action']) {

				if(isset($view->request->params['named']['rev'])) {
					$revisionControlMdl = ClassRegistry::init('RevisionControl.RevisionControl');
					$rev = $view->request->params['named']['rev'];
					$id = $view->request->data[$modelName]['id'];

					// 過去リヴィジョンのデータを取得
					$data = $revisionControlMdl->find('first', array(
						'conditions' => array(
							'model_name' => $modelName,
							'model_id' => $id,
							'revision' => $rev,
						)
					));

					// 旧リヴィジョンデータのマウント
					if ($data) {
						$dataObj = unserialize($data['RevisionControl']['deta_object']);
						$overWriteModels = Configure::read('RevisionControl.models.' . $modelName);
						foreach($overWriteModels  as $overWriteModel) {
							if (!empty($dataObj[$overWriteModel])) {
								$view->request->data[$overWriteModel] =$dataObj[$overWriteModel];
							}

						}
					}
				}
			}
		}
	}

}
