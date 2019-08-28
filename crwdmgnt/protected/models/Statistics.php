<?php

/**
 * This is the model class for table "icm_statistics".
 *
 * The followings are the available columns in table 'icm_statistics':
 * @property integer $id
 * @property string $ip
 * @property string $datetime
 * @property string $long
 * @property string $lati
 * @property integer $icm_system_city_id
 * @property string $icm_website_unq_id
 *
 * The followings are the available model relations:
 * @property IcmSystemCity $icmSystemCity
 * @property IcmWebsite $icmWebsiteUnq
 */
class Statistics extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Statistics the static model class
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
			array('ip, datetime, long, lati, icm_system_city_id, icm_website_unq_id', 'required'),
			array('icm_system_city_id', 'numerical', 'integerOnly'=>true),
			array('ip, long, lati', 'length', 'max'=>45),
			array('icm_website_unq_id', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ip, datetime, long, lati, icm_system_city_id, icm_website_unq_id', 'safe', 'on'=>'search'),
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
			'icmSystemCity' => array(self::BELONGS_TO, 'IcmSystemCity', 'icm_system_city_id'),
			'icmWebsiteUnq' => array(self::BELONGS_TO, 'IcmWebsite', 'icm_website_unq_id'),
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
			'long' => 'Long',
			'lati' => 'Lati',
			'icm_system_city_id' => 'Icm System City',
			'icm_website_unq_id' => 'Icm Website Unq',
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
		$criteria->compare('long',$this->long,true);
		$criteria->compare('lati',$this->lati,true);
		$criteria->compare('icm_system_city_id',$this->icm_system_city_id);
		$criteria->compare('icm_website_unq_id',$this->icm_website_unq_id,true);

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