<?php

/**
 * This is the model class for table "wine_items".
 *
 * The followings are the available columns in table 'wine_items':
 * @property integer $id
 * @property string $wine_title
 * @property string $wine_description
 * @property integer $wine_id
 * @property string $glass_price
 * @property string $bottle_price
 * @property string $update_date
 *
 * The followings are the available model relations:
 * @property MenusWine $wine
 */
class WineItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WineItems the static model class
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
		return 'wine_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wine_title, wine_id, glass_price, bottle_price, update_date', 'required'),
			array('wine_id', 'numerical', 'integerOnly'=>true),
			array('wine_title, wine_description', 'length', 'max'=>255),
			array('glass_price, bottle_price', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, wine_title, wine_description, wine_id, glass_price, bottle_price, update_date', 'safe', 'on'=>'search'),
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
			'wine' => array(self::BELONGS_TO, 'MenusWine', 'wine_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'wine_title' => 'Wine Title',
			'wine_description' => 'Wine Description',
			'wine_id' => 'Wine',
			'glass_price' => 'Glass Price',
			'bottle_price' => 'Bottle Price',
			'update_date' => 'Update Date',
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
		$criteria->compare('wine_title',$this->wine_title,true);
		$criteria->compare('wine_description',$this->wine_description,true);
		$criteria->compare('wine_id',$this->wine_id);
		$criteria->compare('glass_price',$this->glass_price,true);
		$criteria->compare('bottle_price',$this->bottle_price,true);
		$criteria->compare('update_date',$this->update_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}