<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class payForMarketer extends AbstractAction
{
    public function getTitle()
    {
        return $this->data->amount>0?'لم يتم الدفع':'تم الدفع';
    }

    public function getIcon()
    {
        return 'voyager-external';
    }

    public function getPolicy()
    {
        return 'read';
    }
    public function shouldActionDisplayOnDataType()
    {
        // show or hide the action button, in this case will show for ads model
        if($this->dataType->slug == 'markete-infos')
    		return true;
        
        return false ; 
    }
       
    public function getAttributes()
    {
        // Action button class
        return [
            'class' => 'btn btn-sm btn-primary pull-right',
            'style' => ' margin-left: 5px;'
        ];
    }

    public function getDefaultRoute()
    {
        
        return route('payMarketer', ["id"=>$this->data->user_id]);
    }
}