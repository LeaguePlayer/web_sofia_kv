<?php

class TourBehavior extends CActiveRecordBehavior{
	
	public function afterSave($event)
	{
		$tour_file = $this->owner->tour_3d;

		if($tour_file){
			$root = YiiBase::getPathOfAlias('webroot');
			$uploads_dir = $root.DIRECTORY_SEPARATOR."uploads";
			$tour_dir = $uploads_dir.DIRECTORY_SEPARATOR."tours";

			if(!is_dir($uploads_dir))
				mkdir($uploads_dir, 0777);

			if(!is_dir($tour_dir)) 
				mkdir($tour_dir, 0777);

			if(!is_dir($tour_dir.DIRECTORY_SEPARATOR.$this->owner->id)) 
				mkdir($tour_dir.DIRECTORY_SEPARATOR.$this->owner->id, 0777);

			//clear directory
			$files = glob($tour_dir.DIRECTORY_SEPARATOR.$this->owner->id.DIRECTORY_SEPARATOR.'*'); // get all file names
			foreach($files as $file){
			 	if(is_file($file)) @unlink($file);
			}

			$tour_file->saveAs($tour_dir.DIRECTORY_SEPARATOR.$this->owner->id.DIRECTORY_SEPARATOR.$this->owner->tour_3d->name);

		}
	}

	public function beforeDelete($event)
	{
		$dir = YiiBase::getPathOfAlias('webroot').DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR.'tours'.DIRECTORY_SEPARATOR.$this->owner->id;
		@unlink($dir.DIRECTORY_SEPARATOR.$this->owner->tour_3d);
		if(is_dir($dir)){
			rmdir($dir);
		}
	}
}