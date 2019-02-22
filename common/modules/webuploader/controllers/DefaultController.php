<?php

namespace common\modules\webuploader\controllers;

use common\core\ApiController;
use common\modules\webuploader\actions\CheckChunkAction;
use common\modules\webuploader\actions\CheckFileAction;
use common\modules\webuploader\actions\MergeChunksAction;
use common\modules\webuploader\actions\UploadAction;
use common\modules\webuploader\actions\UploadLinkAction;
use common\modules\webuploader\models\Uploadfile;

/**
 * Default controller for the `webuploader` module
 */
class DefaultController extends ApiController {
    
    public function actions() {
        return array_merge(parent::actions(),[
            'upload-link' =>                        ['class' => UploadLinkAction::class],
            'check-file' =>                         ['class' => CheckFileAction::class],
            'upload' =>                             ['class' => UploadAction::class],
            'merge-chunks' =>                       ['class' => MergeChunksAction::class],
            'check-chunk' =>                        ['class' => CheckChunkAction::class],
        ]);
    }
    
    public function actionGetFiles(){
        $files = Uploadfile::findAll(['is_del' => 0]);
        $data = [];
        /* @var $file Uploadfile */
        foreach ($files as $file){
            $data []= $file->toProcessedArray();
        }
        return ['data' => $data];
    }
}
