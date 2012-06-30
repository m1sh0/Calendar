<?php

/**
 * This is the model class for table "meeting".
 *
 * The followings are the available columns in table 'meeting':
 * @property integer $id
 * @property string $date
 * @property string $place
 * @property integer $category_id
 * @property string $note
 */
class Meeting extends CActiveRecord
{

    public $participants;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Meeting the static model class
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
		return 'meeting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		    array('date, note', 'required'),
			array('category_id', 'numerical', 'integerOnly'=>true),
			array('place', 'length', 'max'=>200),
			array('date, note, participants', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date, place, category_id, note', 'safe', 'on'=>'search'),
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
		    'participants'=>array(self::HAS_MANY, 'Contact', 'contact_meeting(contact_id, meeting_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date' => 'Date',
			'place' => 'Place',
			'category_id' => 'Category',
			'note' => 'Note',
		);
	}
	
	
	public function afterSave()
	{
	    $this->saveParticipants($this->participants);
	    return parent::afterSave();
	}

	
	public function saveParticipants($participants_string) {
	    $participants = preg_split('/\s*,\s*/',$participants_string,-1,PREG_SPLIT_NO_EMPTY);
		foreach($participants as $participant)
		{
		    list($name, $surname)=explode(' ', $participant);
		    $row=Contact::model()->find('name=:name && surname=:surname', array('name'=>$name, 'surname'=>$surname));
	        $sql="INSERT INTO contact_meeting (meeting_id, contact_id) VALUES(:meeting_id,:contact_id)";
            $connection=Yii::app()->db;
            $command=$connection->createCommand($sql);
	        if($row) 
	        {
	            $id = $this->id;
	            $command->bindParam(":meeting_id",$id,PDO::PARAM_INT);
	            $command->bindParam(":contact_id",$row->id,PDO::PARAM_INT);
	            $command->execute();
	        }		    
		}
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('place',$this->place,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function mySearch($name, $surname)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->compare('id',$this->id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('place',$this->place,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	  public function beforeSave()
        {
                if($this->date != '') {
				  list($dateT, $time) = explode(' ', $this->date);
				  list($y, $m, $d) = explode('-', $dateT);
				  list($hours, $minutes) = explode(':', $time);
				  $this->date = date('Y-m-d G:i', mktime($hours, $minutes, 0, $m, $d, $y));
				} else
				  $this->date = null;

                return parent::beforeSave();
        } //End beforeSave()    

        /**
         * Actions to take after to saving the model.
         * @return boolean parent::afterFind()
         */
        public function afterFind()
        {
                $retVal = parent::afterSave();
                $this->date=date('Y-M-d G:i', strtotime($this->date)); 

                return $retVal;
        } //End beforeFind()  
}
