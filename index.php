<?php

class Form {

}

class FormField {
    private string $displayName;
    private string $fieldName;
    private string|array $inputType;

    public function __construct($displayName, $fieldName, $inputType) {
        $this->displayName = $displayName;
        $this->fieldName = $fieldName;
        $this->inputType = $inputType;
    }

    public function renderInputPart($wrapElm, $wrapClass): string {
        if($this->inputType == "text") {
            return <<<HTML
                <$wrapElm class="$wrapClass">
                    <input name="{$this->fieldName}" type="{$this->inputType}">
                </$wrapElm>
            HTML;
        }
        return "ERR";
    }

    public function renderNamePart($wrapElm, $wrapClass): string {
        return <<<HTML
            <$wrapElm class="$wrapClass">
                {$this->displayName}
            </$wrapElm>
        HTML;
    }

    public function render($outerWrapElm, $outerWrapClass, $innerWrapElm, $innerWrapClass): string {
        return <<<HTML
            <$outerWrapElm class="$outerWrapClass">
            {$this->renderNamePart($innerWrapElm, $innerWrapClass)}
            {$this->renderInputPart($innerWrapElm, $innerWrapClass)}
            </$outerWrapElm>
        HTML;
    }
}

$fieldText = new FormField("Text", "text", "text");
echo "<table>" . $fieldText->render('tr', 'outer', 'td', 'inner') . "</table>";