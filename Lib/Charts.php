<?php 

class charts {
    protected $data;
    protected $subject;
    protected $sub_name;
    protected $test;
    public function __construct($data, $subject, $sub_name, $test) {
        $this->data = $data;
        $this->subject = $subject;
        $this->sub_name = $sub_name;
        $this->test = $test;
    }
    
    public function PlotGraph(){
        $dataPoints = array();
        //append the marks to the dataPoints array
        foreach ($this->data as $mark) {
            if ($this->test == 'FA') {
                $arr = ['FA-1', 'FA-2', 'FA-3', 'FA-4'];
            } else {
                $arr = ['SA-1', 'SA-2'];
            }
            if (in_array($mark['res_test'], $arr)) {
                $marks[] = [
                    "label" => $mark['res_test'],
                    "y" => $mark[$this->subject],
                ];
            }
            foreach ($marks as $mark) {
                $dataPoints[] = $mark;
            }  
            return $dataPoints;
        }
    }
}