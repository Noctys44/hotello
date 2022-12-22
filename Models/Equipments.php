<?php 

    class Equipments{

        private $id_equip, $equip_name, $erreurs = [];

        const ID_EQUIPMENT_INVALIDE = 9;
        const NAME_INVALIDE = 10;


        public function __construct($data)
        {
            if(!empty($data))
            {
                $this->assignement($data);
            }
        }
    
        public function assignement($data)
        {
            foreach($data as $key => $value)
            {
                $method = 'set'.ucfirst($key);
                if(method_exists($this, $method))
                {
                    $this->$method($value);
                }
            }
        }

        /* --------------------------------------------- */
        /* SETTERS - SETTERS - SETTERS - SETTERS - SETTERS */
        /* --------------------------------------------- */

        
        public function setEquipmentId($id_equip){
            if(empty($id_equip)){
                $this->erreur[] = self::ID_EQUIPMENT_INVALIDE;
            }else{
                $this->id_equip = $id_equip;
            }
        }

        
        public function setEquipmentName($equip_name){
            if(empty($equip_name)){
                $this->erreur[] = self::NAME_INVALIDE;
            }else{
                $this->equip_name = $equip_name;
            }
        }


        public function setErreurs($erreurs){
            $this->erreurs = $erreurs;
            return $this;
        }


        /* --------------------------------------------- */
        /* GETTERS - GETTERS - GETTERS - GETTERS - GETTERS */
        /* --------------------------------------------- */


        public function getIdEquipment(){
            $this->id_equip;
        }

        public function getEquipmentName(){
            $this->equip_name;
        }

        public function getErreurs(){
            return $this->erreurs;
        }
    }
