## Description

This Vagrant file and accompanying Ansible playbook will get you two Ubuntu based Virtual machines that can be used for testing. One of the virtual machines will be called `control` and the other `omekadevvm`


## Setup

You will need to have [Vagrant](https://www.vagrantup.com) and [Virtualbox](https://www.virtualbox.org) installed on your computer. On Microsoft Windows make sure that the network settings on Virtualbox are set to bridged network otherwise your control machine will not see the digitalscvm. In addition to the software above we will install the [babun](http://babun.github.io/)

### clone this repo

Important to remember where you saved the repo as it will matter for the steps below. For documentation purposes let us say we cloned the repository into /Users/dewey/Documents/


#### Vagrant Setup

1. Launch your babun shell window and type the following sans quotes.

`pwd`

2. which should be your home.

`cd /c/Users/`

3. The go into your users directory. In our case the user is 'dewey' so.

`cd dewey`

4. You recall we cloned the repository in the Documents directory.

`cd Documents`

5. Change into the cloned directory

`cd digitalsc`

`vagrant up`

6. Then log into the control virtual machine with the following

`vagrant ssh control`

7. You will then have to generate your ssh-keys.

`ssh-keygen`

You do not need to save a password for the generated key.

8. Copy your keys from the control virtual machine to the digitalscvm with the following command

`ssh-copy-id -i ~/.ssh/id_rsa.pub 192.168.15.11`

Your password is the default vagrant password of 'vagrant'

9. You are now ready to run your ansible playbook.

Review the contents of the `vars.TEMPLATE.yml` change the password information. Copy this file into a new one called `vars.yml`

`cp vars.TEMPLATE.yml vars.yml`

run

`ansible-playbook omekaserver.yml -b`

10. This will install omeka on the other virtual machine. You can exit from this computer with

`exit`

11. To complete the installation

log into the digitalscvm with

`vagrant ssh digitalscvm`

12. Navigate to the omeka directory and enter the database information.

`cd /var/www/html/omeka-2.3`

edit the `db.ini` file

You can now exit the vm
