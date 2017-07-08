# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

    config.vm.box = "ubuntu/trusty64"
    config.vm.provision :shell, path: "./bin/env.sh"
    config.vm.network :forwarded_port, guest: 80, host: 8080
    #config.ssh.shell = "bash -c 'BASH_ENV=/etc/profile exec bash'"
    config.vm.provision "ansible" do |ansible|
      ansible.playbook = "playbook.yml"
    end
end
