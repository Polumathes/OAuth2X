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
        $this->id ='';
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
        $this->id   = $this->modx->user->get('id');
        $user = $this->modx->getObject($user_class,$this->id);
        // $extuser = $this->modx->getObject('extUser',$this->id);



        $profile = $user->getOne('Profile');
        $data    = $user->getOne('Data');

        $res['id']   = $profile->get('id');
        $res['email']= $profile->get('email');
        $res['marketing_fname']   = ($data != '')?$data->get('marketing_fname'):'';
        $res['marketing_lname']= ($data != '')?$data->get('marketing_lname'):'';
        $res['permissions']= $this->getPermissions();

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
    public function getPermissions(){
        $permissions = [];
        /** modify to suit app needs */
        $groups = $this->getUserGroups();
        $ugms = $this->modx->getCollection('modUserGroupMember',['member'=>$this->id]);

        if(empty($ugms) || empty($groups)) return $permissions;
        $authority = 9999;
        foreach($ugms as $ugm){
            $role = $ugm->getOne('UserGroupRole');
            $auth = $role->get('authority');
            if($auth < $authority) $authority = $auth;
        }
        $pq = $this->modx->newQuery('modAccessPolicy');
        $pq->innerJoin('modAccessContext','Context','Context.policy = modAccessPolicy.id');
        $pq->where(array('Context.target'=>$this->modx->context->key,'Context.principal:IN'=>$groups,'Context.authority:>='=>$authority));
        $policyobjs = $this->modx->getCollection('modAccessPolicy',$pq);
        foreach($policyobjs as $policy){
            $data = $policy->get('data');
            $data = is_array($data) ? $data : json_decode($data);
            $permissions = array_merge($permissions,array_keys(array_filter($data,function($v){return((int) $v === 1);})));
        }
        return $permissions;
    }
    public function getUserGroups() {

        $groups= array();
        $id = $this->id;

        if (isset($_SESSION["modx.user.{$id}.userGroups"])) {
            $groups= $_SESSION["modx.user.{$id}.userGroups"];
        } else {
            $memberGroups= $this->modx->getCollectionGraph('modUserGroup', '{"UserGroupMembers":{}}', array('UserGroupMembers.member' => $this->id));

            if ($memberGroups) {
                /** @var modUserGroup $group */
                foreach ($memberGroups as $group) $groups[]= $group->get('id');
            }
            $_SESSION["modx.user.{$id}.userGroups"]= $groups;
        }
        return $groups;
    }


}
