<?php
class grand_total_helper
{
    public $formId;
    public $cssClass;
    public $htmlElement;
    public $valueExpression;
    public $maxValueExpression;
    public $search;
    public $star;
    public $entryStatus;
    public $thousandsSeparator;
    public $decimals;
    public $colors;

    function getValue()
    {
        return $this->getResultFromExpression($this->valueExpression, $this->search, $this->star, $this->entryStatus);
    }

    function getMaxValue()
    {
        return $this->getResultFromExpression($this->maxValueExpression, $this->search, $this->star, $this->entryStatus);
    }

    private function getResultFromExpression($expression, $search = '', $star = null, $entryStatus = 'active')
    {
        $leads = RGFormsModel::get_leads($this->formId, 0, 'DESC', $search, 0, 30, $star, null, false, null, null, $entryStatus);

        $total = 0;
        //Foreach form's entry...
        foreach ($leads as $key => $value) {
            $itemResult = 0;
            /** @noinspection PhpUnusedLocalVariableInspection */
            $lead = $leads[$key];
            $calculatedResult = str_replace("{{", "\$lead[", $expression);
            $calculatedResult = str_replace("}}", "]", $calculatedResult);
            eval("\$itemResult = $calculatedResult;");

            //echo "<pre>$itemResult</pre>";
            //$this->total += $itemResult;
            $total += is_numeric($itemResult) ? $itemResult : 0;
        }
        return $total;
    }
}
