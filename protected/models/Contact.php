<?php

/**
 * This is the model class for table "contact".
 *
 * The followings are the available columns in table 'contact':
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $birthday
 * @property string $phone
 * @property string $note
 * @property integer $user_id
 */
class Contact extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contact the static model class
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
		return 'contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, user_id', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('name, surname', 'length', 'max'=>50, 'min'=>1),
			array('email', 'length', 'max'=>255),
			array('email', 'email'),
			array('phone', 'length', 'max'=>18),
			array('birthday, note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, surname, email, birthday, phone, note', 'safe', 'on'=>'search'),
		);
	}
	
	public function beforeValidate()
	{
	    $this->user_id = Yii::app()->getModule('user')->user()->id;
	    return parent::beforeValidate();
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		    'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => 'Name',
			'surname' => 'Surname',
			'email' => 'Email',
			'birthday' => 'Birthday',
			'phone' => 'Phone',
			'note' => 'Note',
		);
	}
	
	/**
	 * Suggests a list of existing contacts matching the specified keyword.
	 * @param string the keyword to be matched
	 * @param integer maximum number of tags to be returned
	 * @return array list of matching tag names
	 */
	public function suggestParticipants($keyword,$limit=20)
	{
	    $participants=$this->findAll(array(
			'condition'=>'name LIKE :keyword',
			'order'=>'name',
			'limit'=>$limit,
			'params'=>array(
				':keyword'=>'%'.strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
			),
		));
		$names=array();
		
		foreach($participants as $participant)
			$names[]=$participant->name.' '.$participant->surname;
			
		return $names;
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

		$criteria->compare('name',$this->name,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function afterSave()
	{
	    if($this->birthday) {
			$meeting = new Meeting;
			$meeting->date = $this->birthday;
			$note = $this->name . ' ' . $this->surname . ' has birthday';
			$meeting->note = $note;
			$meeting->save();
		}
	    return parent::afterSave();
	}
	
		  public function beforeSave()
        {
                if ($this->birthday == '') {
                        $this->setAttribute('birthday', null);
                } else {
                   $this->birthday=date('Y-m-d', strtotime($this->birthday));
                }

                return parent::beforeSave();
        } //End beforeSave()    

        /**
         * Actions to take after to saving the model.
         * @return boolean parent::afterFind()
         */
        public function afterFind()
        {
                $retVal = parent::afterSave();
                $this->birthday=date('m/d/Y', strtotime($this->birthday)); 

                return $retVal;
        } //End beforeFind()  
}
