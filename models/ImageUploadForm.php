<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
* UploadForm is the model behind the upload form.
*/
class ImageUploadForm extends Model
{
	/**
	 * @var UploadedFile|Null file attribute
	 */
	public $file;
	public $image_file;
	public $fileName;
	public $absolutePath;
	public $urlPath;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
	    return [
	        [['file'], 'file']
	    ];
	}

	public function upload()
	{
		$this->absolutePath = \Yii::getAlias('@webroot').'/images/';
        $this->urlPath = \Yii::getAlias('@web').'/images/';

		if ($this->validate()) {
			$this->fileName = $this->getFileName();

            if ($this->file->saveAs($this->absolutePath.$this->fileName)) {
            	return true;
            } else {
            	return false;
            }
        } else {
        	return false;
        }
	}

	private function getFileName()
	{
		return $this->file->baseName.'_'.time().'.'.$this->file->extension;
	}
}