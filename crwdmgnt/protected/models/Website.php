<?php

/**
 * This is the model class for table "icm_website".
 *
 * The followings are the available columns in table 'icm_website':
 * @property string $unq_id
 * @property string $web_url
 * @property string $web_type
 * @property string $datetime
 * @property integer $icm_users_id
 *
 * The followings are the available model relations:
 * @property IcmStatistics[] $icmStatistics
 * @property IcmUsers $icmUsers
 */
class Website extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Website the static model class
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
		return 'icm_website';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unq_id, web_url, web_type, datetime, icm_users_id', 'required'),
			array('icm_users_id', 'numerical', 'integerOnly'=>true),
			array('unq_id', 'length', 'max'=>100),
			array('web_url, web_type', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('unq_id, web_url, web_type, datetime, icm_users_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'icmStatistics' => array(self::HAS_MANY, 'IcmStatistics', 'icm_website_unq_id'),
			'icmUsers' => array(self::BELONGS_TO, 'IcmUsers', 'icm_users_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'unq_id' => 'Unq',
			'web_url' => 'Web Url',
			'web_type' => 'Web Type',
			'datetime' => 'Datetime',
			'icm_users_id' => 'Icm Users',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('unq_id',$this->unq_id,true);
		$criteria->compare('web_url',$this->web_url,true);
		$criteria->compare('web_type',$this->web_type,true);
		$criteria->compare('datetime',$this->datetime,true);
		$criteria->compare('icm_users_id',$this->icm_users_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function rec_time()
        {
            $sqldate = date('Y-m-d H:i:s');
            $this->datetime=$sqldate;
        }
}