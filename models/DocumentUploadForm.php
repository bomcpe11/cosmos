<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
* UploadForm is the model behind the upload form.
*/
class DocumentUploadForm extends Model
{
	/**
	 * @var UploadedFile|Null file attribute
	 */
	public $file;
	public $image_file;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
	    return [
	        [['file'], 'file']
	    ];
	}

	public function upload($path)
	{
		$fileName = '';

		if ($this->validate()) {
			$fileName = $this->getFileName();
            $this->file->saveAs($path.$fileName);

            return $fileName;
        } else {
            return $fileName;
        }
	}

	private function getFileName()
	{
		return $this->file->baseName.'_'.time().'.'.$this->file->extension;
	}
}