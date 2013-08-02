<?php

class SeoBehavior extends CActiveRecordBehavior
{
	public function attach($owner) {
        parent::attach($owner);
                
        $owner = $this->getOwner();

        $validators = $owner->getValidatorList();

        $validator = CValidator::createValidator('length', $owner, 'meta_title, meta_keys', array('max' => 255));
        $validators->add($validator);

        $validator = CValidator::createValidator('safe', $owner, 'meta_desc, meta_html');
        $validators->add($validator);
	}
}