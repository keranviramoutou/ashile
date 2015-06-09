<?php

	class AES
	{
		function __construct($options) {
			if (isset($options)) {
				$this->options = $options;
			} else {
				throw new Exception('Unable to set AES Options');
			}
		}
		public function encrypt() {
			if (isset($this->options['encryption_key'])) {
				if (isset($this->options['data_to_encrypt']) && !empty($this->options['data_to_encrypt'])) {
					return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->options['encryption_key'], $this->options['data_to_encrypt'], MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
				} else {
					throw new Exception('pas de données cryptées trouvées.');
				}
			} else {
				throw new Exception('pas de clef de cryptage trouvée.');
			}
		}
		
		public function decrypt() {	
			if (isset($this->options['encryption_key'])) {
				if (isset($this->options['data_to_decrypt']) && !empty($this->options['data_to_decrypt'])) {
					return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $encryption_key, base64_decode($this->options['data_to_decrypt']), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
				} else {
					throw new Exception('pas de données a crypté trouvées.');
				}
			} else {
				throw new Exception('pas de clef de cryptage trouvée.');
			}
		}
	}
	
?>	
