<?php
/**
 * @var $this AdminController
 * @var $ForwardRule ForwardRule
 * @var $ForwardLogs ForwardLog[]
 */ ?>

<div class="row">
    <div class="col-lg-8">
        <h1>Rule</h1>
        <?php if($ForwardRule->IsActive == 0):?>
            <h2 class="gray">Not active</h2>
        <?php endif;?>
        <div class="row">
            <div class="col-lg-12">
                <?php echo $this->Form->Start('ForwardRule');?>
                <?php echo $this->Form->Hidden('Id');?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Matching Path</label>
                            <?php echo $this->Form->Input('MatchingPath', array('attributes' => array('class' => 'form-control', 'required' => 'true')));?>
                        </div>
                        <div class="col-lg-6">
                            <label>Forward Address</label>
                            <?php echo $this->Form->Input('ForwardAddress', array('attributes' => array('class' => 'form-control', 'required' => 'true')));?>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->Submit('Update', array('attributes' => array('class' => 'btn btn-md btn-primary')));?>
                <?php echo $this->Form->End();?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2>Log</h2>
                <?php foreach($ForwardLogs as $log):?>
                    <div class="row">
                        <div class="col-lg-4">
                            Date/Time: <?php echo $log->DateTime;?>
                        </div>
                        <div class="col-lg-8">
                            Source: <?php echo $log->Source;?>
                        </div>
                        <div class="col-lg-12">
                            <?php echo $log->PayLoad;?>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
<a href="/Admin">Back</a>


