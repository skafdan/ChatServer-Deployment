# -*- mode: ruby -*-
# vi: set ft=ruby :
class Hash
    def slice(*keep_keys)
        h = {}
        keep_keys.each { |key| h[key] = fetch(key) if has_key?(key) }
        h
    end unless Hash.method_defined?(:slice)
    def except(*less_keys)
        slice(*keys - less_keys)
    end unless Hash.method_defined?(:except)
end

Vagrant.configure("2") do |config|
  # All of our VMs will use this box, to save on space/cache
  config.vm.box = "dummy"

  config.vm.provider :aws do |aws, override|
    aws.region = "us-east-1"
    override.nfs.functional = false
    override.vm.allowed_synced_folder_types = :rsync

    aws.keypair_name = <key pair name>
    override.ssh.private_key_path = <path to key pair>

    aws.instance_type = "t2.micro"

    aws.security_groups = [<security groups>]

    # aws.availability_zone = "us-east-1a"
    # aws.subnet_id = ""

    aws.ami = "ami-09e67e426f25ce0d7"
    override.ssh.username = "ubuntu"
  end

  config.vm.define "chatserver" do |chatserver|
        chatserver.vm.synced_folder ".", "/vagrant", type: "rsync"
        chatserver.vm.provision "shell", inline: <<-SHELL
            apt-get update
            apt-get install -y mysql-server make openjdk-16-jdk nginx python3-pip
            mkdir -p /usr/share/java/mariadb-jdbc/
            mkdir -p /usr/lib/jvm/default-runtime/jre/lib/ext/
            wget https://downloads.mariadb.com/Connectors/java/connector-java-2.7.3/mariadb-java-client-2.7.3.jar
            mv mariadb-java-client-2.7.3.jar /usr/share/java/mariadb-jdbc/
            ln -s ln -s /usr/share/java/mariadb-jdbc/mariadb-java-client.jar /usr/lib/jvm/default-runtime/jre/lib/ext/
            SHELL

        chatserver.vm.provision "shell", path: "database/backup_setup.sh", privileged: false
        chatserver.vm.provision "shell", path: "database/setupDB.sh"
  end

    config.vm.define "webserver" do |webserver|
        webserver.vm.hostname = "webserver"
        webserver.vm.synced_folder ".", "/vagrant", type: "rsync"

        webserver.vm.provision "shell", inline: <<-SHELL
            apt-get update
            apt-get install -y apache2 php libapache2-mod-php php-mysql
            cp /vagrant/usersite.conf /etc/apache2/sites-available/
            cp /vagrant/Client.jar /vagrant/www/
            a2ensite usersite
            a2dissite 000-default
            service apache2 reload
        SHELL
    
    end

end