<?php

/**
 * This is the model class for table "icm_users".
 *
 * The followings are the available columns in table 'icm_users':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $age
 * @property string $gender
 * @property string $datetime
 * @property integer $icm_users_type_id
 *
 * The followings are the available model relations:
 * @property IcmUsersType $icmUsersType
 * @property IcmWebsite[] $icmWebsites
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'icm_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email, password, age, gender, datetime, icm_users_type_id', 'required'),
			array('age, icm_users_type_id', 'numerical', 'integerOnly'=>true),
			array('name, email, password', 'length', 'max'=>45),
			array('gender', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, email, password, age, gender, datetime, icm_users_type_id', 'safe', 'on'=>'search'),
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
			'icmUsersType' => array(self::BELONGS_TO, 'IcmUsersType', 'icm_users_type_id'),
			'icmWebsites' => array(self::HAS_MANY, 'IcmWebsite', 'icm_users_id'),
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
			'email' => 'Email',
			'password' => 'Password',
			'age' => 'Age',
			'gender' => 'Gender',
			'datetime' => 'Datetime',
			'icm_users_type_id' => 'Icm Users Type',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('datetime',$this->datetime,true);
		$criteria->compare('icm_users_type_id',$this->icm_users_type_id);

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