<?php
    
    global $rendu;
    
    class Formulaire {
        
        private $method;
        private $class;
        private $rendu;
        
        function __construct($method, $class) {
            $this->method = $method;
            $this->class = $class;
            $this->rendu = "";
        }
        
        function getMethod() {
            return $this->method;
        }
        
        function setMethod($method) {
            $this->method = $method;
        }
        
        public function getClass() {
            return $this->class;
        }
        
        public function setClass($class) {
            $this->class = $class;
        }
        
        public function inputText($nomChamp, $type, $class = 'form_input_text', $value = '' , $placeholder = '', $label) {
            $this->rendu .= "<label for='$nomChamp'>$label</label><br><input type='$type' name='$nomChamp' id='$nomChamp' class='$class' value='$value' placeholder='$placeholder'/><br>";
        }
        
        public function select($nomSelect, $valuesArray) {
            $choix = '';
            foreach ($valuesArray as $value) {
                $option = $value;
                $choix .= "<option value='$value'>$option</option><br>";
            }
            $this->rendu .= "<select name='$nomSelect'>$choix</select><br>";
        }
        
        public function radio($nomRadio, $valuesArray, $spanClass = 'form_radio') {
            foreach ($valuesArray as $value) {
                $option = $value;
                $this->rendu .= "<span class='$spanClass'><input id='$option' type='radio' name='$nomRadio' value='$option'/><label for='$option'>$option</label></span><br>";
            }
        }
        
        public function checkBox($nom, $valeur, $label, $spanClass = 'form_checbox') {
            $this->rendu .= "<span class='$spanClass'><label for='$nom'>$label</label><br><input type='checkbox' id='$nom' name='$nom' value='$valeur'/></span><br>";
        }
        
        public function submit($name, $send, $class = 'form_submit') {
            $this->rendu .= "<input type='submit' class='$class' name='$name' value='$send'/><br>";
        }
    
        public function renderLoginPage() {
            return "<div class='form_login_page'><form method='$this->method' class='$this->class'>" . $this->rendu . "</form></div>";
        }
    
        public function renderLoginHeader() {
            return "<div class='form_login_page'><form method='$this->method' class='$this->class'>" . $this->rendu . "</form></div>";
        }
        
    }
