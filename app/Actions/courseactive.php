<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class courseactive extends AbstractAction
{
    public function getTitle()
    {
        return $this->data->{'activate'}== 0 ?'لم يتم التفعيل':'تم التفعيل';
    }

    public function getIcon()
    {
        return $this->data->{'activate'}== 0 ?'voyager-x':'voyager-external';
    }

    public function getPolicy()
    {
        return 'read';
    }
    public function shouldActionDisplayOnDataType()
    {
        // show or hide the action button, in this case will show for ads model
        if($this->dataType->slug == 'courses' )
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
        
        return route('courseactive', ["id"=>$this->data->id]);
    }
}