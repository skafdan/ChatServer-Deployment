# ChatServer-Deployment- COSC349 - Assignment 2
A deployment of a Java TCP chatserver using cloud services, namely Amazon webservices.

# Cloning
This project contains a submodule use `git clone --recurse-submodules git@github.com:skafdan/ChatServer-Deployment.git` to clone with submodule.
### Pulling
To ensure submodule is at the latest change `cd` in to the `ChatServer` directory and checkout to the master branch then pull the changes.
# Dependences
All thats needed to deploy is `vagrant` and the [vagrant-aws](https://github.com/mitchellh/vagrant-aws) plugin, and an AWS account.

# Deployment instructions 
Most of the deployment is handled automatically but the vagrant provisioning, some manual interaction is required.
1. Create [security groups](#security-groups) for EC2 and RDS.
2. Create a [SSH](#ssh-keys) keypair.
3. Chmod the keys.
4. Create the [RDS](#database) instance.
5. Update [database endpoints](#database) and credentials in `data.properties` and `setupDB.sh`.
6. Set [environment variables](#aws-authentication) for your AWS credentials.
7. Set ssh-keys in the `Vagrantfile` and the newly created security groups.
8. `Vagrant up` the instance, ssh in, run the `make` command, and then [start the server](#starting-the-server).

Details about these instructions can be found in the subsequent sections, just click the links.
# AWS authentication
The vagrant file uses the aws plugin by [mitchellh](https://github.com/mitchellh/vagrant-aws).
To install please use:
```
$ vagrant plugin install vagrant-aws

$ vagrant up --provider=aws
```
A vagrant dummy box file needs to be added:
```
vagrant box add dummy https://github.com/mitchellh/vagrant-aws/raw/master/dummy.box
```
Three environment variables from your AWS account, need to be set for your deployment to work; 
- access_key_id, `AWS_ACCESS_KEY_ID`
- secret_access_key, `AWS_SECRET_ACCESS_KEY`
- session_token,`AWS_SESSION_TOKEN`
### SSH-keys
In addition a `ssh keypair` needs to be created and the private key must be present somewhere accessible on your system.
Ensure the correct permissions are set:
```
$ chmod 400 /path/to/<your keypair name>.pem
```
### Security groups
You will need to create two security groups for the deployment.
The first needs to be for the `EC2` instance and have the following open ports:
- `80` - HTTP 
- `7777` - TCP
- `22` - SSH

The second is for the `RDS` instance:
- Allow all traffic from `0.0.0.0/0` 

Update the ssh-key pair parameters and security groups in the 
`Vagrantfile`:
```
    aws.keypair_name = <your keypair name>

    aws.ami = "ami-09e67e426f25ce0d7"
    aws.instance_type = "t2.micro" 
    aws.security_groups = <EC2 security group>
    override.ssh.username = "ubuntu"
    override.ssh.private_key_path = /path/to/<your keypair name.pem>

```
# Database 
An Amazon RDS - `mariadb` needs to be manually created and select the option to 
create an initial database called `chatserver` also set the username and password.

The endpoint, username and password need to updated in the following locations:
- `ChatServer/data.properties`
- `database/setupDB.sh`

# Starting the server
Log into the created instance with `vagrant ssh`, then `cd` into the project directory.
```
$ cd /vagrant/ChatServer/
```
Compile with the `make` command and start the server with the provided script.
```
$ make
$ sudo ./startServer.sh
```


## Submodule documentation
# ChatServer
A simple terminal chat-server and terminal client written in Java that uses TCP 
and TLS encryption.

## Dependencies 

- `JDK 16` - Written using `openjdk-jdk-16`, tested `JDk-8` also works.
- `mariadb-JDBC 2.7.3` this can be downloaded using your package manager or directly from the [website](https://downloads.mariadb.com/Connectors/java/connector-java-2.7.3/)
- `keytool` for generating TLS certificate
- `Web sever` - tested with `apache` and `nginx`
- `make`

## Installation 

Install all the required dependencies and run this command to link the mariadb-jdbc connection to your java runtime.
```
# ln -s /usr/share/java/mariadb-jdbc/mariadb-java-client.jar /usr/lib/jvm/default-runtime/jre/lib/ext
```
If you downloaded the `mariadb-jdbc` connecter manually place it into this directory first.
```
/usr/share/java/mariadb-jdbc/mysql-connector-java-bin-2.7.3.jar
```

Git clone the repository and run the make command.
```
$ git clone https://github.com/skafdan/ChatServer

$ cd /path/to/ChatServer

$ make
```

## Usage
Run the installation script `startServer.sh` as root.
```
/path/to/ChatServer/ # ./startServer.sh
```
It can also be run with an optional port number, however it will use the port `7777`  if not provided.

```
/path/to/ChatServer/ # ./startServer.sh [port]
```

The script generates the TLS certificate and copies it the to default root of the 
webserver `/var/www/html/` to be downloaded by the client when they connect.

### data.properties
The authentication and address for the database are imported using java properties library, as such
a `data.properties` file with 3 key-value pairs needs to be in the root directory of the project
```
host=jdbc::mysql://<address>/chatserver
username=<username>
password=<password>
```

## Database setup


The database requires two tables;
- `user` - A table for users of the database
    - Columns:
        - username: Unique name of the user (Primary-Key)
        - passwd: sha256 hashed password+salt
        - salt: created at time of user creation
- `message` - A table containing log of messages sent
    - Columns:
        - timestamp: uses `now()` function to timestamp messages
        - message_id: auto-incrementing id of the message (Primary-key)
        - message_user_id: sender of message also (Foreign-Key to `user` table)
        - message_content: the message content

## References to resources used
- [SSLSockets - Stackoverflow](https://stackoverflow.com/questions/13874387/create-app-with-sslsocket-java)

- [HTTP requests java](https://www.techiedelight.com/download-file-from-url-java)

- [Java docs - SSL](https://docs.oracle.com/javase/8/docs/technotes/guides/security/jsse/JSSERefGuide.html)

- [Java docs - SQL](https://dev.mysql.com/doc/connector-j/8.0/en/)

- [MariaDB JDBC - Arch Wiki](https://wiki.archlinux.org/title/JDBC_and_MySQL)

- [MariaDB JDBC](https://docs.cs.cf.ac.uk/notes/accessing-mysql-with-java/)

- [Vagrant-aws](https://github.com/mitchellh/vagrant-aws)
