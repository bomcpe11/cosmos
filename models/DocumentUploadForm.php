<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use kartik\icons\Icon;

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

	public function getAllowedFileExtensions()
	{
		return ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf', 'txt'];
	}

	public function getIcon($ext)
	{
		if ($ext == 'doc' || $ext == 'docx') {
			return Icon::show('file-word-o', ['class' => 'text-primary']);
		} else if ($ext == 'xls' || $ext == 'xlsx') {
			return Icon::show('file-excel-o', ['class' => 'text-success']);
		} else if ($ext == 'ppt' || $ext == 'pptx') {
			return Icon::show('file-powerpoint-o', ['class' => 'text-danger']);
		} else if ($ext == 'pdf') {
			return Icon::show('file-pdf-o', ['class' => 'text-danger']);
		} else if ($ext == 'txt') {
			return  Icon::show('file-text');
		}
	}

	private function getFileName()
	{
		return $this->file->baseName.'_'.time().'.'.$this->file->extension;
	}
}