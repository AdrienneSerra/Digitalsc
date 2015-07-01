# Defines our Vagrant environment
#
# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  # create control node
  config.vm.define :control do |control_config|
      control_config.vm.box = "ubuntu/trusty64"
      control_config.vm.hostname = "control"
      control_config.vm.network :private_network, ip: "192.168.15.20"
      control_config.vm.provider "virtualbox" do |vb|
        vb.memory = "1024"
      end
      control_config.vm.provision :shell, path: "bootstrap-mgmt.sh"
  end

  # create omeka vm
  config.vm.define :digitalsc do |digitalsc_config|
      digitalsc_config.vm.box = "ubuntu/trusty64"
      digitalsc_config.vm.hostname = "digitalscvm"
      digitalsc_config.vm.network :private_network, ip: "192.168.15.21"
      digitalsc_config.vm.provider "virtualbox" do |vb|
        vb.memory = "2048"
      end
  end

end