<?php
class ControllerApiEmail extends Controller {
    public function orcamento() {
        $this->load->language('api/email');
		$json = array();
 
        if (!isset($this->session->data['api_id'])) {
			$json['error'] = 'no permission';
		} else {
            if (!$json) {
                
                /* DATA RECEIVED FROM POST */
                $data['id'] = $this->request->post['id'];
                $data['data'] = $this->request->post['data'];
                $data['email'] = $this->request->post['email'];
                $data['nome'] = $this->request->post['nome'];
                $data['descricao'] = $this->request->post['descricao'];
                $data['store_url'] = $this->config->get('config_ssl');
        
        
                $data['store_name_url'] = "StoreX";

                /* Function to save sended emails in db */
               // $this->load->model('api/email');
                //$this->model_api_email->addEmail($data);



                $this->load->model('setting/setting');
		
                $from = $this->model_setting_setting->getSettingValue('config_email', $order_info['store_id']);
                
                if (!$from) {
                    $from = $this->config->get('config_email');
                }
                $mail = new Mail($this->config->get('config_mail_engine'));
                $mail->parameter = $this->config->get('config_mail_parameter');
                $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
                $mail->smtp_username = $this->config->get('config_mail_smtp_username');
                $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
                $mail->smtp_port = $this->config->get('config_mail_smtp_port');
                $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

                $mail->setTo([$data['email'],"geral@xxx.com"]);              
                $mail->setFrom($from);
                $mail->setSender("Storex");
                $mail->setSubject('Subject'. $data['id']);
                $mail->setHtml($this->load->view('api/email', $data));
                $mail->send();
				$json['success'] = "Sended email";

			} else {
				$json['error']['key'] = $this->language->get('error_key');
			}
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
        
    }
}
} 