<?php

namespace common\models;

class Contact extends \yii\db\ActiveRecord

{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacts';
    }

    public function getStakeholder()
    {
        return $this->hasOne(Stakeholder::class, ['stakeholder_id' => 'stakeholder_id']);
    }
    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['contact_category', 'gender', 'academic_titles', 'last_name', 'first_name', 'call_name',
                'current_company', 'designation', 'previous_company', 'house_number', 'street', 'city',
                'postal_code', 'extra_info_of_place', 'country', 'web_link', 'geo_data', 'landline_phone_1',
                'landline_phone_2', 'fax', 'cell_phone_1', 'cell_phone_2', 'cell_phone_3', 'cell_phone_4',
                'email_1', 'email_2', 'email_3', 'email_4', 'whatsapp_1', 'whatsapp_2', 'whatsapp_3',
                'whatsapp_4'], 'string', 'max' => 255],
            [['stakeholder_id'], 'integer'],
            [['stakeholder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stakeholder::class,
                'targetAttribute' => ['stakeholder_id' => 'stakeholder_id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_contacts' => 'ID',
            'contact_category' => 'Contact Category / Capacity',
            'gender' => 'Gender',
            'academic_titles' => 'Academic / Military / Other Titles',
            'last_name' => 'Last Name',
            'first_name' => 'First Name',
            'call_name' => 'Call Name',
            'current_company' => 'Company / Institution Currently Working For',
            'designation' => 'Designation',
            'previous_company' => 'Previous Company / Institution and Designation',
            'house_number' => 'House Number',
            'street' => 'Street',
            'city' => 'City',
            'postal_code' => 'Postal Code',
            'extra_info_of_place' => 'Extra Info to Locate the Place',
            'country' => 'Country',
            'web_link' => 'Web-link',
            'geo_data' => 'Geo-Data',
            'landline_phone_1' => 'Landline Phone 1',
            'landline_phone_2' => 'Landline Phone 2',
            'fax' => 'Fax',
            'cell_phone_1' => 'Cellphone 1',
            'cell_phone_2' => 'Cellphone 2',
            'cell_phone_3' => 'Cellphone 3',
            'cell_phone_4' => 'Cellphone 4',
            'email_1' => 'Email 1',
            'email_2' => 'Email 2',
            'email_3' => 'Email 3',
            'email_4' => 'Email 4',
            'whatsapp_1' => 'WhatsApp 1',
            'whatsapp_2' => 'WhatsApp 2',
            'whatsapp_3' => 'WhatsApp 3',
            'whatsapp_4' => 'WhatsApp 4',
            'stakeholder_id' => 'Stakeholder ID',
        ];
    }
}
