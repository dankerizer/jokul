<?php
namespace Dankerizer\Jokul;

use Dankerizer\Jokul\Commons\JokulRequest;
use Dankerizer\Jokul\Services\GenerateInvoice;
use Dotenv\Dotenv;

class DokuJokul{


    use GenerateInvoice;


    private $apiUrl;
    private $client_id;
    private $secret_key;
    private $shared_key;
    private $environment;

    protected $request;

    private $config;

    public function __construct(
        $client_id =null,
        $secret_key = null,
        $mode = null
    )
    {
        try {
            $this->secret_key = $secret_key ?? $this->readEnv('DOKU_JOKUL_SECRET_KEY');
            if (is_null($this->secret_key) || $this->secret_key == '') {
                throw new \Exception('Api Key harus di isi!');
            }

            $this->client_id = $client_id ?? $this->readEnv('DOKU_JOKUL_CLIENT_ID');
            if (is_null($this->client_id) || $this->client_id == '') {
                throw new \Exception('Client ID harus di isi!');
            }

            if (!empty($mode)) {
                $modeVar = $mode;
            } else if (!empty($this->readEnv('DOKU_JOKUL_MODE'))) {
                $modeVar = $this->readEnv('DOKU_JOKUL_MODE');
            } else {
                $modeVar = 'live';
            }

            $this->environment = $modeVar == 'live' || $modeVar == 'sandbox' ? $modeVar : 'live';

            $this->config = [
                'environment'=>$this->environment,
                'shared_key'=>$this->shared_key,
                'client_id'=>$this->client_id
            ];

            $this->request = new JokulRequest();

        } catch (\Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }




    public function readEnv(){
        $immutable = base_path();
        $dotenv = Dotenv::createImmutable($immutable);
        $dotenv->load();
        $dotenv->required('DOKU_JOKUL_CLIENT_ID');
        $dotenv->required('DOKU_JOKUL_SECRET_KEY');
        $dotenv->required("DOKU_JOKUL_MODE");

        if (empty($env_key)) {
            return $_ENV;
        }

        return $_ENV[$env_key];
    }



    public function getConfig()
    {
        return $this->config;
    }




}
