<?php

/**
 * This is the model class for table "bk_student".
 *
 * The followings are the available columns in table 'bk_student':
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $bio
 * @property string $photo
 * @property integer $is_admin
 * @property string $last_login_timestamp
 * @property integer $faculty_id
 *
 * The followings are the available model relations:
 * @property DownloadInfo[] $downloadInfos
 * @property Note[] $notes
 * @property Note[] $rates
 * @property Note[] $reports
 * @property Review[] $reviews
 * @property Badge[] $badges
 * @property Testimonial[] $testimonials
 */
class Student extends CActiveRecord
{
	/**
	 * A constant defining the max length of $photo.
	 */
	const MAX_FILENAME_LENGTH = 64;
	/**
	 * A constant defining the maximum length of $name.
	 */
	const MAX_NAME_LENGTH = 128;
	/**
	 * A constant defining the maximum allowed file size.
	 */
	const MAX_FILE_SIZE = 102400;

	public $file;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Student the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bk_student';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name, faculty_id', 'required'),
			array('name', 'length', 'max'=>self::MAX_NAME_LENGTH),
			array('file', 'file', 'allowEmpty'=>true, 'maxSize'=>self::MAX_FILE_SIZE, 'types'=>'jpg, png'),
			array('faculty_id', 'numerical', 'integerOnly'=>true),
			array('faculty_id', 'exist', 'className'=>'Faculty', 'attributeName'=>'id'),
			array('username, bio, photo, is_admin, last_login_timestamp', 'safe'),

			array('id, username, photo, is_admin, last_login_timestamp', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'downloadInfos' => array(self::HAS_MANY, 'DownloadInfo', 'student_id'),
			'notes' => array(self::HAS_MANY, 'Note', 'student_id'),
			'rates' => array(self::MANY_MANY, 'Note', 'bk_rate(student_id, note_id)'),
			'reports' => array(self::MANY_MANY, 'Note', 'bk_report(student_id, note_id)'),
			'reviews' => array(self::HAS_MANY, 'Review', 'student_id'),
			'badges' => array(self::MANY_MANY, 'Badge', 'bk_student_badge(student_id, badge_id)'),
			'testimonials' => array(self::HAS_MANY, 'Testimonial', 'student_id'),
			'faculty' => array(self::BELONGS_TO, 'Faculty', 'faculty_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'name' => 'Nama',
			'bio' => 'Bio',
			'file' => 'Foto Profil',
			'is_admin' => 'Is Admin',
			'last_login_timestamp' => 'Terakhir Masuk',
			'faculty_id' => 'Fakultas',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('is_admin',$this->is_admin);
		$criteria->compare('last_login_timestamp',$this->last_login_timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function grant()
	{
		$testi = new Testimonial('grant');
		$testi->student_id = $this->id;
		$testi->timestamp = date('Y-m-d H:i:s');
		$testi->status = 1;
		$testi->save();
	}
}