# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.berkshelf.enabled = true
  config.omnibus.chef_version = :latest

  config.vm.synced_folder ".", "/vagrant", id: "vagrant-root", mount_options: ["dmode=777","fmode=666"]

  config.vm.provider "virtualbox" do |v|
    v.customize ["modifyvm", :id, "--memory", "2048"]
  end

  config.vm.box = "forms"
  config.vm.box_url = "http://opscode-vm-bento.s3.amazonaws.com/vagrant/virtualbox/opscode_ubuntu-12.04_chef-provisionerless.box"
  config.vm.network :forwarded_port, guest: 80, host: 9079
  config.vm.provision :chef_solo do |chef|
    chef.cookbooks_path = ".provision"
    chef.add_recipe "apt"
    chef.add_recipe "hf-lamp::web"
    chef.add_recipe "hf-lamp::mysql_server"
    chef.add_recipe 'phpunit'
    chef.json = { 'mysql' => {'server_debian_password' => '739e8971e306f8dae3b27582bab8bc82',
                             'server_root_password' => '739e8971e306f8dae3b27582bab8bc82',
                             'server_repl_password' => '739e8971e306f8dae3b27582bab8bc82'},
                  'hf-lamp' => { 'docroot-dir' => '/vagrant', 
                                 'sites' => [{'host' => 'localhost', 
                                              'docroot' => 'www',
                                              'single-vhost' => true,
                                              'manage_db' => true,
                                              'db' => {'user' => 'forms',
                                                       'name' => 'forms', 
                                                       'password' => 'forms'}}]}}
                                             
  end
end

