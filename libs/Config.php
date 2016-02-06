<?php 
class Config{
	private $config = array();
	private $default = array(
		"users" => array(
			array(
				"email" => "admin@leoche.org",
				"password" => "0e7eb8233ba5c6e8fbb41f749452519a2d14252c155f4f37a1dcd782c0ca07b4"
			)
		),
		"online" => true,
		"whitelist" => array(
			"mods/Optifine.jar",
			"launcher.settings",
			"options.php",
			"options.php",
			"database/*",
			"hats/*",
			"logs/*",
			"resourcepacks/*",
			"saves/*"
		)
	);
	private $file_url = "./config/options.json";
    static $instance;
    static function getInstance(){
        if(!self::$instance){
            self::$instance = new Config();
        }
        return self::$instance;
    }
    public function __construct(){
		if(file_exists($this->file_url)) $this->config = json_decode(file_get_contents($this->file_url));
		else{
			$this->config = $this->default;
			$this->save();
		}
    }
	public function save(){
		if(!file_put_contents($this->file_url, json_encode($this->config)))
			throw new ConfigException("Can't write config.json, make sure /config/ is writable");
	}
	public function get($key){
		return $this->config->$key;
	}
	public function getJSON(){
		return json_encode($this->config);
	}
	public function set($key,$value){
		$this->config->$key = $value;
		$this->save();
	}
	public function webroot(){
		return "./template/";
	}
}