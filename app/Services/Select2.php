<?php
namespace App\Services;

class Select2
{
    protected $data = [];
    protected $textPattern = [];
    
    public function __construct($data, $textPattern)
    {
        $this->data = $data->toArray();
        $this->textPattern = $textPattern;
    }

    public function array()
    {
        $result = [];
        foreach ($this->data as $item)
        {
            $item = (object) json_decode(json_encode($item));

            $text = [];
            foreach($this->textPattern as $pattern)
            {
                $text[] = $item->{$pattern};
            }

            $result[] = [
                'id' => $item->id,
                'text' => implode(' - ', $text),
            ];
        }
        return $result;
    }

    public function original()
    {
        return $this->data;
    }

    public function json()
    {
        return json_encode($this->array());
    }
}