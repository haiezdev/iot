<?php
namespace App\Services;

use phpseclib3\Net\SSH2;

class SSHConnect
{
    public function configureTrunkPort($host, $username, $password, $enablePassword, $port = 'GigabitEthernet0/1')
    {
        $ssh = new SSH2($host);

        if (!$ssh->login($username, $password)) {
            return 'Login failed';
        }

        $ssh->write("enable\n");
        $ssh->write("$enablePassword\n");
        $ssh->write("configure terminal\n");
        $ssh->write("interface $port\n");
        $ssh->write("switchport mode trunk\n");
        $ssh->write("exit\n");
        $ssh->write("exit\n");
        $ssh->write("write memory\n");

        sleep(2);

        $output = $ssh->read();
        return $output;
    }
}
