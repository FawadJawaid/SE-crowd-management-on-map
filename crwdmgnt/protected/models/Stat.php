<?php

/**
 * This is the model class for table "icm_statistics".
 *
 * The followings are the available columns in table 'icm_statistics':
 * @property integer $id
 * @property string $ip
 * @property string $datetime
 * @property string $icm_website_unq_id
 * @property integer $icm_system_city_id
 *
 * The followings are the available model relations:
 * @property IcmWebsite $icmWebsiteUnq
 * @property IcmSystemCity $icmSystemCity
 */
class Stat extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Stat the static model class
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
		return 'icm_statistics';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ip, datetime, icm_website_unq_id, icm_system_city_id', 'required'),
			array('icm_system_city_id', 'numerical', 'integerOnly'=>true),
			array('ip', 'length', 'max'=>45),
			array('icm_website_unq_id', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ip, datetime, icm_website_unq_id, icm_system_city_id', 'safe', 'on'=>'search'),
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
			'icmWebsiteUnq' => array(self::BELONGS_TO, 'IcmWebsite', 'icm_website_unq_id'),
			'icmSystemCity' => array(self::BELONGS_TO, 'IcmSystemCity', 'icm_system_city_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ip' => 'Ip',
			'datetime' => 'Datetime',
			'icm_website_unq_id' => 'Icm Website Unq',
			'icm_system_city_id' => 'Icm System City',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('datetime',$this->datetime,true);
		$criteria->compare('icm_website_unq_id',$this->icm_website_unq_id,true);
		$criteria->compare('icm_system_city_id',$this->icm_system_city_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}