<?php
class AdminController extends Controller
{
    public function BeforeAction()
    {
        $ipAddress = $_SERVER['REMOTE_ADDR'];

        if(!startsWith($ipAddress, '10.13.') && !startsWith($ipAddress, '172.18')){
            echo "Dafuw";
            return $this->HttpStatus(403);
        }

        $this->Title = 'Webhook Admin';
    }

    public function Index()
    {
        $this->Set('Rules', $this->Models->ForwardRule->Where(array('IsDeleted' => 0))->OrderBy('Id'));
        return $this->View();
    }

    public function Edit($id = '')
    {
        if($id == ''){
            return $this->HttpNotFound();
        }

        $forwardRule = $this->Models->ForwardRule->Find($id);
        if($forwardRule == null || $forwardRule->IsDeleted == 1){
            return $this->HttpNotFound();
        }

        if($this->IsPost()){
            $forwardRule = $this->Data->DbParse('ForwardRule', $this->Models->ForwardRule);
            $forwardRule->Save();
        }

        $this->Set('ForwardLogs', $this->Models->ForwardLog->Where(array('ForwardRuleId' => $forwardRule->Id))->OrderByDescending('Id'));
        $this->Set('ForwardRule', $forwardRule);
        return $this->View();
    }

    public function Create()
    {
        if($this->IsPost()){
            $rule = $this->Data->Parse('ForwardRule', $this->Models->ForwardRule);
            $rule->Save();

            return $this->Redirect('/Admin');
        }

        return $this->HttpNotFound();
    }

    public function Delete($id = '')
    {
        if($id == ''){
            return $this->HttpNotFound();
        }

        $forwardRule = $this->Models->ForwardRule->Find($id);
        if($forwardRule == null || $forwardRule->IsDeleted == 1){
            return $this->HttpNotFound();
        }

        $forwardRule->IsDeleted = 1;
        $forwardRule->Save();

        return $this->Redirect('/Admin');
    }

    public function Activate($id = '')
    {
        if($id == ''){
            return $this->HttpNotFound();
        }

        $forwardRule = $this->Models->ForwardRule->Find($id);
        if($forwardRule == null || $forwardRule->IsDeleted == 1){
            return $this->HttpNotFound();
        }

        $forwardRule->IsActive = 1;
        $forwardRule->Save();

        return $this->Redirect('/Admin');
    }

    public function Deactivate($id = '')
    {
        if($id == ''){
            return $this->HttpNotFound();
        }

        $forwardRule = $this->Models->ForwardRule->Find($id);
        if($forwardRule == null || $forwardRule->IsDeleted == 1){
            return $this->HttpNotFound();
        }

        $forwardRule->IsActive = 0;
        $forwardRule->Save();

        return $this->Redirect('/Admin');
    }
}