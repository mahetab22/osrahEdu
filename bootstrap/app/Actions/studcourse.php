<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class studcourse extends AbstractAction
{
    public function getTitle()
    {
        return 'استخراج الطلاب المشتركين'; 
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
        
        return route('studcourse', ["id"=>$this->data->id]);
    }
}