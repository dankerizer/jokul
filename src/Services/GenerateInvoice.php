<?php
namespace Dankerizer\Jokul\Services;

trait GenerateInvoice{


    public function generate_invoice($params){
        $params['targetPath'] = '/bca-virtual-account/v2/payment-code';

        return $this->request->post($this->config,$params);
    }

}
