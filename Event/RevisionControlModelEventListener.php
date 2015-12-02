<?php
class RevisionControlModelEventListener extends BcModelEventListener {
/**
 * 登録イベント
 *
 * @var array
 */
	public $events = array(
		'afterSave',
	);

/**
 * afterSave
 *
 * @param CakeEvent $event
 * @return boolean
 */
	public function afterSave(CakeEvent $event) {

		$model = $event->subject;
		$modelName = $model->name;
		$modelId = null;
		$revision = null;
		$limit = null;

		if (array_key_exists($modelName, Configure::read('RevisionControl.models')) && $model->data[$modelName]['id']) {
			$modelId = $model->data[$modelName]['id'];
			$limit = Configure::read('RevisionControl.limit');
			$revisionControlMdl = ClassRegistry::init('RevisionControl.RevisionControl');

			// 最新リビジョン番号を取得
			$prevData = $revisionControlMdl->find('first', array(
				'conditions' => array(
					'model_name' => $modelName,
					'model_id' => $modelId
				),
				'order' => 'revision desc',
			));

			if (isset($prevData['RevisionControl']['revision'])) {
				$revision = intval($prevData['RevisionControl']['revision']) + 1;
			} else {
				$revision = 1;
			}
			// タイムスタンプデータを削除
			$revData = array(
				'RevisionControl' => array(
					'model_name' => $modelName,
					'model_id' => $modelId,
					'revision' => $revision,
					'deta_object' => serialize($model->data)
				)
			);
			// 更新ユーザ情報を追加
			$user = BcUtil::loginUser();
			if ($user) {
				$revData['RevisionControl']['user_id'] = $user['id'];
			}
			// 保存
			$revisionControlMdl->save($revData, false);

			// リビジョン制限オーバーデータの削除
			if ($limit) {
				$revisionList = $revisionControlMdl->find('all', array(
					'conditions' => array(
						'model_name' => $modelName,
						'model_id' => $modelId
					),
					'order' => 'revision desc',
				));
				$i = 0;
				foreach($revisionList as $data) {
					if (++$i > $limit) {
						$revisionControlMdl->delete(intval($data['RevisionControl']['id']));
					}
				}
			}
		}
		return true;

	}
}
