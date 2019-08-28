<?php

/**
 * This is the model class for table "icm_system_country".
 *
 * The followings are the available columns in table 'icm_system_country':
 * @property integer $id
 * @property string $name
 * @property integer $icm_system_region_id
 *
 * The followings are the available model relations:
 * @property IcmSystemRegion $icmSystemRegion
 * @property IcmSystemState[] $icmSystemStates
 */
class SystemCountry extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SystemCountry the static model class
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
		return 'icm_system_country';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, icm_system_region_id', 'required'),
			array('icm_system_region_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, icm_system_region_id', 'safe', 'on'=>'search'),
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
			'icmSystemRegion' => array(self::BELONGS_TO, 'IcmSystemRegion', 'icm_system_region_id'),
			'icmSystemStates' => array(self::HAS_MANY, 'IcmSystemState', 'icm_system_country_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'icm_system_region_id' => 'Icm System Region',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('icm_system_region_id',$this->icm_system_region_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}