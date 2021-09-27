<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class activatesub extends AbstractAction
{
    public function getTitle()
    {
        return $this->data->{'done'}== 0 ?'لم يتم الأشتراك':'تم الاشتراك';
    }

    public function getIcon()
    {
        return $this->data->{'done'}== 0 ?'voyager-x':'voyager-external';
    }

    public function getPolicy()
    {
        return 'read';
    }
    public function shouldActionDisplayOnDataType()
    {
        // show or hide the action button, in this case will show for ads model
        if($this->dataType->slug == 'bankfiles' )
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
        
        return route('stusubscriptioncourse', ["id"=>$this->data->id]);
    }
}