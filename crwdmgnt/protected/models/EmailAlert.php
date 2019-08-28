<?php

/**
 * This is the model class for table "icm_email_alert".
 *
 * The followings are the available columns in table 'icm_email_alert':
 * @property integer $id
 * @property string $icm_website_unq_id
 * @property integer $alert_type
 *
 * The followings are the available model relations:
 * @property IcmWebsite $icmWebsiteUnq
 */
class EmailAlert extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmailAlert the static model class
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
		return 'icm_email_alert';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('icm_website_unq_id, alert_type', 'required'),
			array('alert_type', 'numerical', 'integerOnly'=>true),
			array('icm_website_unq_id', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, icm_website_unq_id, alert_type', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'icm_website_unq_id' => 'Icm Website Unq',
			'alert_type' => 'Alert Type',
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
		$criteria->compare('icm_website_unq_id',$this->icm_website_unq_id,true);
		$criteria->compare('alert_type',$this->alert_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}