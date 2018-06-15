<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {


    // Here we can manipulate what data this api will share
       return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'subject'=>$this->subject,
            'body'=>$this->body
       ];
    }
    
    public function with($request)
    {
        return [
            'Version'=>'1.0.0',
            'Author_url'=>'stefanos',
        ];
    }
}
