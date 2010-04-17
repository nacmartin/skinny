<?php
class sfGuardUserChangePasswordValidator extends sfValidatorBase
{
    public function configure($options = array(), $messages = array())
    {
        $this->addRequiredOption('user_id', null);
        $this->addOption('password_field', 'currentpassword');
        $this->setMessage('invalid', 'The password is invalid.');
    }
    public function doClean($values)
    {
        // only validate if userid and password are both present
        if ($this->getOption('user_id') && isset($values[$this->getOption('password_field')])){
            $user_id = $this->getOption('user_id');
            $password = $values[$this->getOption('password_field')];
    
            if ($user = Doctrine::getTable('sfGuardUser')->find($user_id))
            {
                if ($user->checkPassword($password))
                {
                    return $values;
                }
            }
            throw new sfValidatorErrorSchema($this, array(
                $this->getOption('password_field') => new sfValidatorError($this, 'invalid'),
            ));

        }
        // assume a required error has already been thrown, skip validation
        return $values;
    }
}
