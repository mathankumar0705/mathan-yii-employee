<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%employee}}".
 *
 * @property integer $id
 * @property string $emp_name
 * @property string $emp_id
 * @property string $email
 * @property integer $phone_no
 * @property string $dob
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%employee}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone_no', 'emp_name', 'emp_id', 'email','dob'], 'required'],
            [['phone_no', 'created_by', 'updated_by'], 'integer'],
            [['dob', 'created_at', 'updated_at'], 'safe'],
            [['emp_name', 'emp_id', 'email'], 'string', 'max' => 45],
            ['email', 'email', 'message'=>'Email Address is not a valid.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'emp_name' => 'Employee Name',
            'emp_id' => 'Employee ID',
            'email' => 'Email',
            'phone_no' => 'Phone No',
            'dob' => 'Dob',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
