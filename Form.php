<?php

class Form {
	/* ------------------------------------- *\
			Private
	\* ------------------------------------- */
    /* --- VAR --- */
    private $tab_form; // Tableau du formulaire
    private $method; // method du formulaire
    private $action; // action du formulaire
    private $br; // retour à la ligne ou nom
    private $autoClose; // fermer le formulaire ou non
    /* --- FUN --- */

    // ...

	/* ------------------------------------- *\
			Public
	\* ------------------------------------- */
    /* --- VAR --- */

    // ...

    /* --- FUN --- */

    public function __construct (array $form) {
        $this->tab_form = $form;
        $this->setMethod();
        $this->setAction();
        $this->setBr(true, 1);
        $this->setAutoClose();
    }

    /* ___ SET ___ */

    /**
     * Define the form methode
     * @param string $m POST or GET or null (so GET by default)
     */
    public function setMethod(string $m=null) {
        if($m == "GET" || $m == "POST"){
            $this->method = $m;
        } else { $this->method = "POST"; }
    }
    
    /**
     * Define the action's file
     * @param string $a file's url or nul (so # by default)
     */
    public function setAction(string $a=null) {
        if(!is_null($a) && is_string($a)){
            if (file_exists($a)) {
                $this->action = $a;
            } else {
                throw new Exception("The form's action file doesn't exist", 1);
                die();
            }
        } else { $this->action = "#"; }
    }

    /**
     * Define the new line mode
     * @param string $br true or false to activate or deactivate the new ligne
     * @param string $mode "1" -> input in the same line that its label, "2" -> input under its label
     */
    public function setBr(bool $br = true, int $mode = 0){
        if ($br) {
            if ($mode == 0) {
                $this->br = ['<br>',''];
            } elseif ($mode == 1) {
                $this->br = ['<br>','<br>'];
            }
        } else { $this->br = ['','']; }
    }

    /**
     * Define if the form must close after printing input, to add some others inputs
     * @param string $br true or false to close or not the form
     */
    public function setAutoClose(bool $c = true){
        $this->autoClose = $c;
    }

    /* ___ GET ___ */

    /**
     * Print your form
     */
    public function getForm(){
        $nb_label = 0;
        $formToPrint = "<form action='".$this->action."' method='".$this->method."'>";
        foreach ($this->tab_form as $k => $v) {
            $name = " name='".$k."'";
            
            // $type
            if(empty($v['type'])){
                $type = " type='text'";
            } else {
                $type = " type='".$v['type']."'";
            };

            // $value
            if(!empty($v["value"])){
                $value = " value='".$v['value']."'";
            } else {
                $value="";
            }

            // $placeholder
            if(!empty($v["placeholder"])){
                $placeholder = " placeholder='".$v['placeholder']."'";
            } else {
                $placeholder="";
            }

            // <label>
            if (!empty($v['label'])) {
                $label = '<label for="Form-'.$nb_label.'">'.$v["label"].'</label>'.$this->br[1];
            } else { $label =""; }

            // required
            if (isset($v["required"]) && !empty($v["required"])){
                if (is_bool($v["required"])) {
                    $required = $v["required"] ? "required" : "";
                } else { $required =""; }
            } else { $required =""; }

            // Others in input
            if (isset($v['others']) && !empty($v['others'])) {
                $others = " ".$v['others']." ";
            } else { $others =""; }

            // write <input>
            if(preg_match('/textarea/i', $type)){ // if it's a textarea

                $input = "<textarea".$name.$value.$placeholder;
                if(!empty($label)){
                    $input .= " id='Form-".$nb_label."'";
                }
                $input .= "></textarea>".$this->br[0];
                
                $formToPrint .= $label.$input;

            }else {

                $input = "<input".$type.$name.$value.$placeholder;
                if(!empty($label)){
                    $input .= " id='Form-".$nb_label."'";
                }
                $input .= $required.$others."/>".$this->br[0];

                if(preg_match('/checkbox/i', $type)) { // if it's checkbox
                    $formToPrint .= str_replace("<br>", " ", $input).$label;
                } else {
                    $formToPrint .= $label.$input;
                }
            }

            $nb_label++;
        }

        $formToPrint .= $this->autoClose ? "</form>" : "";

        echo $formToPrint;
    }

    /**
     * Get the form closer </form>
     */
    public function getCloser() {
        echo "</form>";
    }

    /**
     * Print your form
     */
    public function getValue(){
        $m = ($this->method == "POST") ? $_POST : $_GET;
        if (isset($m) && !empty($m)) {

            if ($this->method == "POST") {
                return filter_input_array(INPUT_POST, $m);
            } else {
                return filter_input_array(INPUT_GET, $m);
            }
            
        } else {
            return false;
        }
    }

}


?>