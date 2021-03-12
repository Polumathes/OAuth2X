<?php

if(!class_exists('motifGsmParentRestController'))
    require_once 'gsmparentcontroller.php';


Class motifControllerUserInfo extends motifGsmParentRestController {

    public $classKey = '';
    public $protected = false;

    public function __construct(modX $modx, modRestServiceRequest $request, array $config = array())
    {
        $this->modx =$modx;
        parent::__construct($modx, $request, $config);
        //  $this->full_access_permission = $this->modx->getOption('gsmblogs.full_access_permission',null,'update_any_blog');
    }
    public function isUser()
    {
        if(!$this->verifyAuthentication())return false;
        return true;
    }

    public function get()
    {

        $is_valid = $this->isUser();
        if (!$is_valid) return $this->failure('Permission Denied');
        $user_class = $this->modx->user->get('class_key');
        $user = $this->modx->getObject($user_class,$this->modx->user->get('id'));

        $profile = $user->getOne('Profile');
        $data    = $user->getOne('Data');

        $res['id']   = $profile->get('id');
        $res['email']= $profile->get('email');
        $res['marketing_fname']   = ($data != '')?$data->get('marketing_fname'):'';
        $res['marketing_lname']= ($data != '')?$data->get('marketing_lname'):'';

        return $this->success('',$res);

    }
    public function post()
    {
        return $this->failure('Permission Denied');
    }
    public function put()
    {
        return $this->failure('Permission Denied');
    }
    public function delete()
    {
        return $this->failure('Permission Denied');
    }

}
