<?php
/**
 * @var $this AdminController
 * @var $Rules ForwardRule[]
 */

?>

<h1>Test</h1>

<div class="row">
    <div class="col-lg-8">
        <?php if(count($Rules) == 0):?>
            <h2 class="disabled">No rules yet</h2>
        <?php else:?>
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <th class="col-lg-5">Match</th>
                        <th class="col-lg-5">Forward</th>
                        <th class="col-lg-2">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($Rules as $rule):?>
                        <tr>
                            <td>
                                <a href="<?php echo '/Admin/Edit/' . $rule->Id;?>">
                                    <?php echo $rule->MatchingPath;?>
                                    <?php if($rule->IsActive == 0):?>
                                        <span class="gray">(Inactive)</span>
                                    <?php endif;?>
                                </a>
                            </td>
                            <td><?php echo $rule->ForwardAddress;?></td>
                            <td>
                                <?php if($rule->IsActive == 1):?>
                                    <a href="<?php echo '/Admin/Deactivate/' . $rule->Id;?>" class="btn btn-md btn-default"><span class="glyphicon glyphicon-arrow-down"</a>
                                <?php else:?>
                                    <a href="<?php echo '/Admin/Activate/' . $rule->Id;?>" class="btn btn-md btn-default"><span class="glyphicon glyphicon-arrow-up"</a>
                                <?php endif;?>
                                <a href="<?php echo '/Admin/Delete/' . $rule->Id;?>" class="btn btn-md btn-default"><span class="glyphicon glyphicon-trash"</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        <?php endif;?>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Create new rule</h2>
            </div>
            <div class="panel-body">
                <?php echo $this->Form->Start('ForwardRule', array('location' => '/Admin/Create'));?>
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
                <?php echo $this->Form->Submit('Create', array('attributes' => array('class' => 'btn btn-medium btn-default')));?>
                <?php echo $this->Form->End();?>
            </div>
        </div>
    </div>
</div>