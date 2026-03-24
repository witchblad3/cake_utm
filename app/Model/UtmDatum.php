<?php
App::uses('AppModel', 'Model');

class UtmDatum extends AppModel {

    public $useTable = 'utm_data';

    public $validate = array(
        'source' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Source is required.'
            )
        ),
        'medium' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Medium is required.'
            )
        ),
        'campaign' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Campaign is required.'
            )
        )
    );
}
